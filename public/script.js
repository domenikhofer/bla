document.querySelectorAll('.toggle').forEach(item => {
  item.addEventListener('click', event => {
    const parent = event.target.parentElement;
    parent.parentElement.parentElement.classList.toggle('open');
  });
})

let diffX;
let diffY;

let handles = document.querySelectorAll('.js-drag-handle');
handles.forEach(handle => {
    handle.addEventListener('touchstart', function(e) {
        console.log('touchstart');
        e.preventDefault();
        let target = e.target;
        let parent = target.closest('.js-item');
        let parentRect = parent.getBoundingClientRect();
        let touchPosition = e.touches[0];
        let touchX = touchPosition.clientX;
        let touchY = touchPosition.clientY;
        let parentX = parentRect.left;
        let parentY = parentRect.top;
        diffX = touchX - parentX;
        diffY = touchY - parentY;


    });
    handle.addEventListener('touchmove', function(e) {
        // console.log('touchmove');
        e.preventDefault();
        let target = e.target;
        let parent = target.closest('.js-item');
        let parentRect = parent.getBoundingClientRect();
        let touchPosition = e.touches[0];
        let touchX = touchPosition.clientX;
        let touchY = touchPosition.clientY;
        // let circle1 = document.querySelector('.circle1');
        // circle1.style.left = (touchX - 25) + 'px';
        // circle1.style.top = (touchY - 25) + 'px';
        // console.log(parentRect, touchPosition);
        // let parentX = parentRect.x;
        // let parentY = parentRect.y;
        // let circle2 = document.querySelector('.circle2');
        // circle2.style.left = (parentX - 25) + 'px';
        // circle2.style.top = (parentY - 25) + 'px';
        // console.log(parentRect, touchPosition);
        // console.log(diffX, diffY);
        // circle2.style.left = (parentX + diffX - 25) + 'px';
        // circle2.style.top = (parentY + diffY - 25) + 'px';

        // circle1.style.left = (touchX - diffX - 25) + 'px';
        // circle1.style.top = (touchY - diffY - 25) + 'px';
        console.log(touchX , touchY );
        parent.style.transform = `translate(${touchX - diffX}px, ${touchY - diffY}px)`;
    });
});
