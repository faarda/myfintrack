const accordionBtn = document.querySelectorAll(".accordion--btn");
accordionBtn.forEach(el => {
    el.addEventListener('click', ()=> {
        el.classList.toggle('active');
        const content = el.nextElementSibling;
        (content.style.maxHeight) ? (
            content.style.maxHeight = null
            ) : content.style.maxHeight = `${content.scrollHeight}px`
    })

})