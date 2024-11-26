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
    
    const ElementTestimonialSlider = function ($scope, $) {
        const thumbnail = $scope.find('.element-testimonial-slider .thumbnail')
        const featuredImage = $scope.find('.element-testimonial-slider .featured-image')

        thumbnail.on('click', function () {
            const newImageSrc  = $(this).data('featured-image')

            if (featuredImage.length && newImageSrc) {
                // Xóa class active của tất cả các ảnh thumbnail
                thumbnail.removeClass('active');

                // Thêm class active vào ảnh thumbnail hiện tại
                $(this).addClass('active');

                featuredImage.fadeOut(300, function () {
                    // Sau khi ảnh hiện tại ẩn đi, đổi src
                    featuredImage.attr('src', newImageSrc);

                    // Sau đó làm ảnh mới hiện lên với hiệu ứng fade-in
                    featuredImage.fadeIn(300);
                });
            }

            console.log('Changed featured image to:', newImageSrc);
        })
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