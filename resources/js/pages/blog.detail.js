/**
 *
 * BlogDetail
 *
 * Pages.Blog.Detail page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BlogDetail {
  constructor() {
    // Initialization of the page plugins
    this._initDetailGlideCarousel();
  }

  // Popular articles carousel
  _initDetailGlideCarousel() {
    if (document.querySelector('#glideBlogDetail') !== null && typeof GlideGallery !== 'undefined') {
      const element = document.querySelector('#glideBlogDetail');
      const glideLength = element.querySelector('.glide-large .glide__slides').children.length;
      const glideThumbCount = 5;
      const perView = Math.min(glideThumbCount, glideLength);
      new GlideGallery(
        element.querySelector('.glide-large'),
        element.querySelector('.glide-thumb'),
        {
          bound: true,
          rewind: false,
          focusAt: 0,
          perView: 1,
          startAt: 0,
        },
        {
          bound: true,
          rewind: false,
          perView: perView,
          perTouch: 1,
          focusAt: 0,
          startAt: 0,
          breakpoints: {
            1600: {
              perView: Math.min(4, glideLength),
            },
            576: {
              perView: Math.min(3, glideLength),
            },
            420: {
              perView: Math.min(2, glideLength),
            },
          },
        },
        glideLength,
        perView,
        70,
      );
    }
  }
}
