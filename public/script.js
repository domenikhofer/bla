document.querySelectorAll('.toggle').forEach(item => {
  item.addEventListener('click', event => {
    const parent = event.target.parentElement;
    parent.parentElement.parentElement.classList.toggle('open');
  });
})
