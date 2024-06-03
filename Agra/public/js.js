// public/js/app.js
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.getElementById('app');
    const colors = ['#1e40af', '#bfdbfe', '#6b7280'];

    document.addEventListener('mousemove', (event) => {
        const { clientX: x, clientY: y } = event;
        const { innerWidth: width, innerHeight: height } = window;

        const xPercent = (x / width) * 100;
        const yPercent = (y / height) * 100;

        const color1 = colors[0];
        const color2 = colors[1];
        const color3 = colors[2];

        const gradient = `radial-gradient(circle at ${xPercent}% ${yPercent}%, ${color1}, ${color2}, ${color3})`;
        appElement.style.backgroundImage = gradient;
    });
});