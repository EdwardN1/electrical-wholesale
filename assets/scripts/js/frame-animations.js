jQuery(document).ready(function ($) {


    var delay = 3000;
    var frame0Fade = 1000;

    function fadeOut(e) {
        Foundation.Motion.animateOut($(e), 'fade-out', function () {
            //window.console.log(e + ' Faded Out');
        });
    }

    function fadeIn(e) {
        Foundation.Motion.animateIn($(e), 'fade-in', function () {
            //window.console.log(e + ' Faded In');
        });
    }

    function fadeInSlow(e) {
        Foundation.Motion.animateIn($(e), 'fade-in-slow', function () {
            //window.console.log(e + ' Faded In');
        });
    }

    function fadeInLeft(e) {
        Foundation.Motion.animateIn($(e), 'fade-in-left', function () {
            //window.console.log(e + ' Faded In');
        });
    }

    function fadeInRight(e) {
        Foundation.Motion.animateIn($(e), 'fade-in-right', function () {
            window.console.log(e + ' Faded In Right');
        });
    }

    function fadeInUp(e) {
        Foundation.Motion.animateIn($(e), 'fade-in-up', function () {
            //window.console.log(e + ' Faded In');
        });
    }

    function fadeInDown(e) {
        Foundation.Motion.animateIn($(e), 'fade-in-down', function () {
            //window.console.log(e + ' Faded In');
        });
    }

    function slideInLeft(e) {
        Foundation.Motion.animateIn($(e), 'slide-in-left', function () {
            //window.console.log(e + ' Slided In From Left');
        });
    }

    function slideInRight(e) {
        Foundation.Motion.animateIn($(e), 'slide-in-right', function () {
            //window.console.log(e + ' Slided In From Left');
        });
    }

    function slideInUp(e) {
        Foundation.Motion.animateIn($(e), 'slide-in-up', function () {
            //window.console.log(e + ' Slided In Up');
        });
    }

    function slideInDown(e) {
        Foundation.Motion.animateIn($(e), 'slide-in-down', function () {
            //window.console.log(e + ' Slided In Up');
        });
    }

    $('.slide-in-right').hide();
    $('.slide-in-left').hide();

    $('.slide-in-right').each(function () {
        let $e = $(this);
        $e.waypoint(function (direction) {
            if (direction == 'down') {
                //window.console.log('Going Down');
                Foundation.Motion.animateIn($e, 'slide-in-right', function () {
                    //window.console.log(e + ' Slided In From Left');
                });
            } else {

            }
        }, {
            offset: -175
        });
    });

    $('.slide-in-left').each(function () {
        let $e = $(this);
        $e.waypoint(function (direction) {
            if (direction == 'down') {
                //window.console.log('Going Down');
                Foundation.Motion.animateIn($e, 'slide-in-left', function () {
                    //window.console.log(e + ' Slided In From Left');
                });
            } else {

            }
        }, {
            offset: -175
        });
    });


    //==============================================Splash Screen Animations=================================

   /* setTimeout(function () {
        $('#frame-0 .left-chevron').show();
        slideInRight('#frame-0 .left-chevron');
        setTimeout(function () {
            $('#frame-0 .right-chevron').show();
            slideInRight('#frame-0 .right-chevron');
            setTimeout(function () {
                //fadeOut('#frame-0');
                slideInUp('#frame-0 .logo');
                setTimeout(function () {
                    slideInUp('#frame-0 .strap-line-message');
                    setTimeout(function () {
                        fadeOut('#frame-0');
                    }, frame0Fade)
                }, delay)
            }, delay)
        }, delay)
    }, delay);*/

    //==============================================First Section Animations=================================


    /*setTimeout(function () {
        fadeInRight('.first-section .frame-animation');
        slideInRight('.first-section .fly-in-chevron');
        setTimeout(function () {
            fadeIn('.first-section .strap-line');
        }, delay)
    }, delay*2);

    $('#first-section-waypoint-1').each(function () {
        var $e = $(this);
        $e.waypoint(function (direction) {
            if (direction == 'down') {
                //window.console.log('Going Down');
                fadeInRight('#first-section-waypoint-1 .sub-heading.animate');
                $('#first-section-waypoint-1 .sub-heading.animate').removeClass('animate');
                setTimeout(function () {
                    fadeIn('.first-section .bottom-chevrons .content.animate');
                    $('.first-section .bottom-chevrons .content.animate').removeClass('animate');
                }, delay);
            } else {

            }
        }, {
            offset: -175
        });
    });*/

    //==============================================Second Section Animations=================================




});
