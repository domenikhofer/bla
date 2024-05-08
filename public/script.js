document.addEventListener('click', function (event) {

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



