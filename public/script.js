document.querySelector('.plantBottomWrapper').addEventListener('touchstart', function(e) {
    e.preventDefault();
    this.classList.toggle('clicked');
});

