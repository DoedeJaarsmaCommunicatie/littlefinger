/* eslint-disable no-undef */
const images = document.querySelectorAll('.lazy-load-me');

const options = {
    root: null,
    rootMargin: '50px 0px',
    threshold: 0,
};

const preloadImage = (element: any) => {
    element.setAttribute('src', element.dataset.lazy);
};

if ('IntersectionObserver' in window && images.length > 0) {
    const observers = [];

    for (let j = 0; j < images.length; j++) {
        observers[j] = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.intersectionRatio > 0) {
                    // observer.unobserve(entry.target);
                    preloadImage(entry.target);
                }
            });
        }, options);
    }

    for (let i = 0; i < images.length; i++) {
        observers[i].observe(images[i]);
    }
} else {
    Array.from(images).forEach(img => preloadImage(img));
}
