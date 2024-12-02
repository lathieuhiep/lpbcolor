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
    
    const elementTestimonialSlider = ($scope, $) => {
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
        })
    }

    const elementCountdownTimer = ($scope, $) => {
        const countdownTimer = $scope.find('.element-countdown-timer');

        if (countdownTimer.length) {
            const timeUnit = countdownTimer.data('time-unit');
            const timeValue = parseInt(countdownTimer.data('time-value')) - 1;
            let targetTime = Math.floor(new Date().getTime() / 1000);

            // Selector
            const daysSelector = countdownTimer.find('.val-days');
            const hoursSelector = countdownTimer.find('.val-hours');
            const minutesSelector = countdownTimer.find('.val-minutes');
            const secondsSelector = countdownTimer.find('.val-seconds');

            // Function to calculate target time based on time unit
            const calculateTargetTime = () => {
                const currentTime = new Date();
                let timeInSeconds;

                if (timeUnit === 'days') {
                    currentTime.setDate(currentTime.getDate() + timeValue);
                    currentTime.setHours(23, 59, 59, 999);
                    timeInSeconds = Math.floor(currentTime.getTime() / 1000);
                } else if (timeUnit === 'hours') {
                    currentTime.setHours(currentTime.getHours() + timeValue);
                    currentTime.setMinutes(59, 59, 999);
                    timeInSeconds = Math.floor(currentTime.getTime() / 1000);
                } else if (timeUnit === 'minutes') {
                    currentTime.setMinutes(currentTime.getMinutes() + timeValue);
                    currentTime.setSeconds(59, 999);
                    timeInSeconds = Math.floor(currentTime.getTime() / 1000);
                }

                return timeInSeconds;
            };

            // Function to update countdown
            const updateCountdown = () => {
                const now = Math.floor(new Date().getTime() / 1000);
                let distance = targetTime - now;

                if (distance <= 0) {
                    targetTime = calculateTargetTime(); // Reset lại targetTime
                    distance = targetTime - now; // Tính lại khoảng cách mới

                    // Reset giao diện về "00"
                    daysSelector.text("00");
                    hoursSelector.text("00");
                    minutesSelector.text("00");
                    secondsSelector.text("00");
                }

                // Tính toán thời gian còn lại
                const days = String(Math.floor(distance / (60 * 60 * 24))).padStart(2, '0');
                const hours = String(Math.floor((distance % (60 * 60 * 24)) / (60 * 60))).padStart(2, '0');
                const minutes = String(Math.floor((distance % (60 * 60)) / 60)).padStart(2, '0');
                const seconds = String(distance % 60).padStart(2, '0');

                // Cập nhật giao diện
                daysSelector.text(days);
                hoursSelector.text(hours);
                minutesSelector.text(minutes);
                secondsSelector.text(seconds);
            };

            // Tính toán targetTime lần đầu tiên
            targetTime = calculateTargetTime();

            // Cập nhật countdown ngay lập tức trước khi bắt đầu chu kỳ
            updateCountdown();

            // Cập nhật countdown mỗi giây
            setInterval(updateCountdown, 1000);
        }
    };

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
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-testimonial-slider.default', elementTestimonialSlider);

        /* Element countdown timer */
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-countdown-timer.default', elementCountdownTimer);
    });

})(jQuery);