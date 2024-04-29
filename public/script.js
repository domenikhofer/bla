document.querySelector('.plantBottomWrapper')?.addEventListener('touchstart', function (e) {
    e.preventDefault();
    this.classList.toggle('clicked');
});


document.addEventListener('keydown', function (event) {
    if (!event.target.parentElement.classList.contains('entry')) {
        return;
    }


    let entryTitle = event.target
    let entry = entryTitle.parentElement;
    // save to db

    if (event.key === 'Enter') {
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
});

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
