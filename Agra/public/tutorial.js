document.addEventListener("DOMContentLoaded", function() {
    const ctx = canvas.getContext('2d');
    ctx.fillStyle = 'lightgray';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    const button = document.getElementById('tutorial-btn');
    button.id = 'tutorialButton';
    button.textContent = 'Tutorial';

    const panel = document.createElement('div');
    panel.id = 'tutorialPanel';
    panel.style.zIndex = "100";
    document.body.appendChild(panel);

    const slideshowContainer = document.createElement('div');
    slideshowContainer.id = 'slideshowContainer';
    panel.appendChild(slideshowContainer);

    for (let i = 1; i <= 18; i++) {
        const slide = document.createElement('img');
        slide.src = `/AGRATUTORIAL/${i}.png`;
        slide.style.width = '80%';
        slide.style.height = '80%';
        slide.style.display = 'none';
        slideshowContainer.appendChild(slide);
    }


    let currentSlideIndex = 0;

    function showSlide(index) {
        const slides = slideshowContainer.children;
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = i === index ? 'block' : 'none';
        }
    }

    const prevButton = document.createElement('button');
    prevButton.id = 'prevButton';
    prevButton.textContent = 'Previous';
    prevButton.addEventListener('click', function() {
        currentSlideIndex = (currentSlideIndex - 1 + 18) % 18;
        showSlide(currentSlideIndex);
    });
    panel.appendChild(prevButton);

    const nextButton = document.createElement('button');
    nextButton.id = 'nextButton';
    nextButton.textContent = 'Next';
    nextButton.addEventListener('click', function() {
        currentSlideIndex = (currentSlideIndex + 1) % 18;
        showSlide(currentSlideIndex);
    });
    panel.appendChild(nextButton);


    const closeButton = document.createElement('button');
    closeButton.id = 'closeButton';
    closeButton.textContent = 'Close';
    panel.appendChild(closeButton);

    panel.style.display = 'none';

    button.addEventListener('click', function() {
        panel.style.display = 'block';
        showSlide(currentSlideIndex);
        blurAll();
    });

    closeButton.addEventListener('click', function() {
        panel.style.display = 'none';
        unBlurAll();
        document.body.style.transition = "";
        window.location.reload();
    });
});

function blurAll(){
    document.querySelector('body > *:not(#tutorialPanel)').style.filter = "blur(3px)";
}

function unBlurAll(){
    document.querySelector('body > *:not(#tutorialPanel)').style.filter = "blur(0px)";
}
