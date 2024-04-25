document.querySelector('.plantBottomWrapper')?.addEventListener('touchstart', function(e) {
    e.preventDefault();
    this.classList.toggle('clicked');
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
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + categoryId).submit();
            }
        });
    });
});
