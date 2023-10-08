/**
 *
 * BlogHome
 *
 * Pages.Blog.Home page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BlogHome {
  constructor() {
    // Initialization of the page plugins
    this._initGlideCarousel();
  }

  // Popular articles carousel
  _initGlideCarousel() {
    if (document.querySelector('.glide-blog') !== null && typeof GlideCustom !== 'undefined') {
      new GlideCustom(
        document.querySelector('.glide-blog'),
        {
          gap: 0,
          perView: 3,
          type: 'carousel',
          peek: {before: 50, after: 50},
          breakpoints: {
            1000: {perView: 1},
            1600: {perView: 2},
            2560: {perView: 3},
          },
        },
        true,
      ).mount();
    }
  }
}
