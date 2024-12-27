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

    // element banner slider
    const elementBannerSlider = ($scope, $) => {
        const slider = $scope.find('.element-banner__owl')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = {
                    items: 5,
                    nav: true,
                    dots: false,
                    margin: 12,
                    navText: ['<i class="fa-solid fa-left-long"></i>','<i class="fa-solid fa-right-long"></i>'],
                    responsive: {
                        0: {
                            items: 3,
                            nav: false
                        },
                        576: {
                            items: 4,
                            nav: true
                        },
                        768: {
                            items: 5
                        },
                    },
                }

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))

                // Theo dõi kích thước khối chứa thay đổi và cập nhật Owl Carousel
                new ResizeObserver(() => {
                    thisSlider.trigger('refresh.owl.carousel'); // Làm mới Owl Carousel
                }).observe(thisSlider[0])
            })
        }
    }

    // element info grid slider
    const elementInfoGridSlider = ($scope, $) => {
        const infoGridSlider = $scope.find('.element-info-grid-slider')
        const mainSlider = infoGridSlider.find('.feature-image')
        const thumbnails = infoGridSlider.find('.thumbnail')

        if (mainSlider.length) {
            const options = {
                items: 1,
                nav: false,
                dots: false,
                loop: false,
                touchDrag: false,
                margin: 12,
                animateOut: 'fadeOut',
                responsive: {
                    0 : {
                        mouseDrag: false
                    }
                }
            }

            mainSlider.owlCarousel(
                owlCarouselElementorOptions(options)
            ).on("changed.owl.carousel", function (event) {
                const index = event.item.index
                thumbnails.removeClass("active")
                thumbnails.eq(index).addClass("active")
            })

            // Khi click vào thumbnail
            thumbnails.on("click", function () {
                const index = $(this).index()
                mainSlider.trigger("to.owl.carousel", [index, 250])
            })

            // Set initial active thumbnail
            thumbnails.eq(0).addClass("active")

            // popup
            const listMainImage = mainSlider.find('.owl-item')
            const popup = infoGridSlider.find('.popup')
            const closeBtn = popup.find('.close')
            const prevBtn = popup.find('.prev')
            const nextBtn = popup.find('.next')
            const countDisplay = popup.find('.popup-count')

            let currentIndex = -1
            
            const showPopup = (index) => {
                const imageSrc = listMainImage.eq(index).find('.item').attr('data-image')
                const totalItems = listMainImage.length

                popup.find('.popup-image').fadeOut(200, function() {
                    $(this).attr('src', imageSrc).fadeIn(200);
                });

                // update count image
                countDisplay.text(`${index + 1}/${totalItems}`)

                popup.fadeIn();
            }

            // open popup when click image
            mainSlider.on('click', '.owl-item', function() {
                currentIndex = listMainImage.index(this)
                showPopup(currentIndex)
            })

            // close popup
            closeBtn.on('click', function() {
                $(this).closest('.popup').fadeOut()
            })

            // prev image
            prevBtn.on('click', function() {
                currentIndex = (currentIndex - 1 + listMainImage.length) % listMainImage.length
                showPopup(currentIndex)
            })

            // next image
            nextBtn.on('click', function() {
                currentIndex = (currentIndex + 1) % listMainImage.length
                showPopup(currentIndex)
            })

            // close popup when clicking outside the content
            popup.on('click', function(event) {
                if ($(event.target).is($(this))) {
                    $(this).fadeOut()
                }
            })

        }
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

    // countdown timer
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
        // element slider banner
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-banner.default', elementBannerSlider);

        // element info grid slider
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-info-grid-slider.default', elementInfoGridSlider);

        // element image slider
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-image-carousel.default', elementImageSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-testimonial-slider.default', elementTestimonialSlider);

        /* Element countdown timer */
        elementorFrontend.hooks.addAction('frontend/element_ready/lpbcolor-countdown-timer.default', elementCountdownTimer);
    })

})(jQuery);