(function ($) {
    // setting owlCarousel
    const owlCarouselElementorOptions = (options) => {
        let defaults = {
            loop: true,
            smartSpeed: 800,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
            dragEndSpeed: 800,
            navText: ['<i class="fa-solid fa-angle-left"></i>','<i class="fa-solid fa-angle-right"></i>'],
        }

        // extend options
        return $.extend(defaults, options)
    }

    // element image slider
    const elementImageSlider = ($scope, $) => {
        const slider = $scope.find('.element-image-carousel')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    /* Start Carousel slider */
    let ElementCarouselSlider = function ($scope, $) {
        let element_slides = $scope.find('.custom-owl-carousel')

        $(document).general_owlCarousel_custom(element_slides)
    };
    
    let ElementTestimonialSlider = function ($scope, $) {
        const mainSlider = $scope.find('.main-slider')
        const thumbSlider = $scope.find('.thumb-slider')
console.log(mainSlider)
        if ( mainSlider.length && thumbSlider.length ) {
            const mainSwiper = new Swiper(".main-slider", {
                slidesPerView: 1
            })

            const thumbSwiper = new Swiper(".thumb-slider", {
                slidesPerView: 2,
                direction: 'vertical',
                mousewheel: true,
                freeMode: true,
                watchSlidesProgress: true,
            })

            mainSwiper.controller.control = thumbSwiper;
            thumbSwiper.controller.control = mainSwiper;
        }
    }

    $(window).on('elementor/frontend/init', function () {
        // /* Element slider */
        // elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-slides.default', ElementCarouselSlider);
        //
        // /* Element post carousel */
        // elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-post-carousel.default', ElementCarouselSlider);
        //

        // /* Element carousel images */
        // elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-carousel-images.default', ElementCarouselSlider);

        // element image slider
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-image-carousel.default', elementImageSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-testimonial-slider.default', ElementTestimonialSlider);
    });

})(jQuery);