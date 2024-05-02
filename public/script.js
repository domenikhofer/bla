document.querySelector('.plantBottomWrapper')?.addEventListener('touchstart', function (e) {
    e.preventDefault();
    this.classList.toggle('clicked');
});


document.addEventListener('keydown', function (event) {
    if (event.target.parentElement.classList.contains('entry')) {
        entryTitleKeydown(event);
    }
});

document.addEventListener('keyup', function (event) {

    if (event.target.parentElement.classList.contains('entry')) {
        const searchTerm = event.target.textContent.trim();
        let resultsDiv = event.target.parentElement.querySelector('.similar');
        let resultsDivContainer = resultsDiv.querySelector('.results');
        if (searchTerm.length >= 3) {
            fetch(`/better-list-app/public/api/entry/search?query=${searchTerm}&category_id=${document.querySelector('.entriesWrapper').dataset.category}`)
                .then(response => response.json())
                .then(data => {
                    let result = '';
                    resultsDivContainer.innerHTML = '';
                    if (data.length) {
                        resultsDiv.classList.add('active');
                        data.forEach(function (entry) {
                            result += `<div>${entry.value}</div>`;
                        });
                        resultsDivContainer.innerHTML = result;
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            resultsDiv.classList.remove('active');

            //resultsDiv.innerHTML = '';
        }
    }


});

document.addEventListener('click', function (event) {
    this.querySelectorAll('.entry .actions').forEach(function (link) {
        link.classList.remove('active')
    });
    document.querySelectorAll('.entry .similar').forEach(function (similar) {
        similar.classList.remove('active')
    })
    event.target.closest('.entry')?.querySelector('.actions')?.classList.add('active');
    if (event.target.parentElement.classList.contains('entry') && event.target.classList.contains('link')) {
        window.open('https://www.google.com/search?q=' + event.target.parentElement.querySelector('.title').textContent.trim(), '_blank');
    }
    if (event.target.closest('.entry').classList.contains('searchResult')) {
        document.querySelectorAll('.entry').forEach(function (entry) {
            entry.classList.remove('selected');
        })
        event.target.closest('.entry').classList.add('selected');
        document.querySelector('#value').value = event.target.closest('.searchResult').dataset.name;
        document.querySelector('#url').value = event.target.closest('.searchResult').dataset.url;
        document.querySelector('#image').value = event.target.closest('.searchResult').dataset.image;

    }
});


document.querySelector('.searchMovieTV')?.addEventListener('keydown', function (event) {

    if (event.key === 'Enter') {
        event.preventDefault();
        const searchTerm = event.target.value;
        let resultsDiv = document.querySelector('.imageEntryWrapper');

        const options = {
            method: 'GET',
            headers: {
                accept: 'application/json',
                Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MDk5YmYwNzMyMjU5MGRiNjM2N2RkOTk3MzcwMDc2NSIsInN1YiI6IjY1ZjlhODM4MjRiMzMzMDE2MTdhNDM0MSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O5HWEE0uBRS_WwNo0g4-TZKgKueV9aTyssQqXr6BNUM'
            }
        };
        fetch(`https://api.themoviedb.org/3/search/multi?query=${searchTerm}`, options)
            .then(response => response.json())
            .then(data => {
                let result = '';
                resultsDiv.innerHTML = '';
                if (data.results.length) {

                    data.results.forEach(function (entry) {
                        let posterUrl = (entry.poster_path ? `https://image.tmdb.org/t/p/w500/${entry.poster_path}` : 'https://via.placeholder.com/500x750');
                        result += `<div class="entry searchResult" data-url="https://www.themoviedb.org/${entry.media_type}/${entry.id}" data-image="${posterUrl}" data-name="${entry.name || entry.title}"><div class="image"><img src="${posterUrl}"></div></div>`;
                    });
                    resultsDiv.innerHTML = result;
                }
            })
            .catch(error => console.error('Error:', error));

    }
});

document.querySelector('.saveEntries')?.addEventListener('click', function (event) {
    let entries = [];
    document.querySelectorAll('.entry .title').forEach(function (title) {
        if (title.textContent.trim() !== '') {
            entries.push({
                value: title.textContent.trim(),
                category_id: event.target.dataset.category
            });
        }
    })
    fetch('/better-list-app/public/api/entry', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            entries,
            category_id: event.target.dataset.category
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            Swal.fire({
                title: 'Entries saved!',
                icon: 'success',
                showClass: {
                    popup: `
                      swalFadeIn
                    `
                },
                hideClass: {
                    popup: `
                      swalFadeOut
                    `
                }
            });
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});

function entryTitleKeydown(event) {

    let entryTitle = event.target
    let entry = entryTitle.parentElement;

    if (event.key === 'Enter') {
        document.querySelectorAll('.entry .similar').forEach(function (similar) {
            similar.classList.remove('active')
        })
        event.preventDefault();
        let entryElement = document.querySelector('.entry.template').cloneNode(true);
        entryElement.classList.remove('template');
        entry.after(entryElement)
        entryElement.querySelector('.title').focus();
    }
    if (event.key === 'Backspace' && entryTitle.textContent === '') {
        event.preventDefault();
        let previousEntry = entry.previousElementSibling;
        previousEntry.querySelector('.title').focus();
        setCursorToEndOfElement(previousEntry.querySelector('.title'))
        entry.remove();
    }
}

document.querySelectorAll('.delete-category-btn').forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        event.preventDefault();
        const categoryId = event.target.dataset.categoryId;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            focusConfirm: false,
            focusCancel: true,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            showClass: {
                popup: `
                  swalFadeIn
                `
            },
            hideClass: {
                popup: `
                  swalFadeOut
                `
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + categoryId).submit();
            }
        });
    });
});


function createRange(node, chars, range) {
    if (!range) {
        range = document.createRange()
        range.selectNode(node);
        range.setStart(node, 0);
    }

    if (chars.count === 0) {
        range.setEnd(node, chars.count);
    } else if (node && chars.count > 0) {
        if (node.nodeType === Node.TEXT_NODE) {
            if (node.textContent.length < chars.count) {
                chars.count -= node.textContent.length;
            } else {
                range.setEnd(node, chars.count);
                chars.count = 0;
            }
        } else {
            for (var lp = 0; lp < node.childNodes.length; lp++) {
                range = createRange(node.childNodes[lp], chars, range);

                if (chars.count === 0) {
                    break;
                }
            }
        }
    }

    return range;
};

function setCursorToEndOfElement(node) {
    var selection = window.getSelection();
    range = createRange(node, { count: node.textContent.length });

    if (range) {
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);

    }
};
