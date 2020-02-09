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

    let slickOpts = {
        dots: true
    };

    $('[data-slick-slider]').slick(slickOpts);

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
            mobileFirst:true,
            responsive: X_responsive
        };

        $(this).slick(carouselOpts);
    });


});