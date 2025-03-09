let lazyImages = document.querySelectorAll('.lazyLoad');

if(lazyImages) {
  lazyImages.forEach((image) => {
    image.addEventListener('load', () => {
      image.classList.add('loaded');
    });
    image.src = image.dataset.src;
  });
}
