jQuery(document).ready(function ($) {

    $('[data-waypoint]').each(function () {
        var $element = $(this);
        var wpOffset = $element.data('waypoint-offset');
        var wpDirection = $element.data('waypoint-direction');
        var wpClass = $element.data('waypoint-class');

        $element.waypoint(function (direction) {
            if (direction == wpDirection) {
                if (!$element.hasClass(wpClass)) {
                    $element.addClass(wpClass);
                }
            }
            this.destroy();
        }, {
            offset: wpOffset
        });
    });

    /*let slickOpts = {
        dots: true
    };

    $('[data-slick-slider]').slick(slickOpts);*/

    $('[data-slick-slider]').each(function(e) {
        let slickOpts = $(this).data('slick');
        if(slickOpts) {
            $(this).slick(slickOpts);
        } else {
            $(this).slick();
        }
    });

    $('[data-slick-carousel]').each(function (e) {
        let breakpoints = $(this).data('breakpoints');
        let dataBP = breakpoints.split(',');
        let X_slidesToShow = 1;
        let X_slidesToScroll = 1;
        let X_dots = true;
        let X_responsive = [];
        let tbreakpoint = {};
        dataBP.forEach(function (BP) {
            let sBP = BP.split(':');
            tbreakpoint = {
                breakpoint: parseInt(sBP[0]),
                settings: {
                    slidesToShow: parseInt(sBP[1]),
                    slidesToScroll: parseInt(sBP[1])
                }
            };
            X_responsive.push(tbreakpoint);
            //window.console.log(tbreakpoint);
        });

        let carouselOpts = {
            dots: X_dots,
            slidesToShow: X_slidesToShow,
            slidesToScroll: 1,
            mobileFirst: true,
            responsive: X_responsive
        };

        $(this).slick(carouselOpts);
    });

    $('[data-slick-carousel]').on('afterChange', function (event, slick, currentSlide) {
        /*var next = $(this).find('[data-slick-index="'+(currentSlide+1)+'"]');
        var prev = $(this).find('[data-slick-index="'+(currentSlide-1)+'"]');
        console.log(next, prev);*/
        let id = $(this).parent().attr('id');
        if (id) {
            $('#' + id + ' .slick-slide.slick-active').removeClass('first-slide');
            $('#' + id + ' .slick-slide.slick-active').removeClass('last-slide');
            $('#' + id + ' .slick-slide.slick-active').first().addClass('first-slide');
            $('#' + id + ' .slick-slide.slick-active').last().addClass('last-slide');
        }
    });

    $('[data-slick-carousel]').each(function (e) {
        let id = $(this).parent().attr('id');
        if (id) {
            $('#' + id + ' .slick-slide.slick-active').removeClass('first-slide');
            $('#' + id + ' .slick-slide.slick-active').removeClass('last-slide');
            $('#' + id + ' .slick-slide.slick-active').first().addClass('first-slide');
            $('#' + id + ' .slick-slide.slick-active').last().addClass('last-slide');
        }
    });

    $('.slick-product-gallery').slick(
        {
            dots: false,
            infinite: true,
            arrows: false,
            speed: 600,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.slick-thumbnail-gallery'
        }
    );
    $('.slick-thumbnail-gallery').slick(
        {
            dots: true,
            infinite: false,
            arrows: false,
            speed: 600,
            slidesToShow: 2,
            slidesToScroll: 1,
            focusOnSelect: true,
            asNavFor: '.slick-product-gallery'
        }
    );
    $('.slick-product-gallery').slickLightbox({
        src: 'src',
        itemSelector: '.slick-product-slide img'
    })
});