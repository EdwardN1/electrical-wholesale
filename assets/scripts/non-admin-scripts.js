jQuery(document).ready(function ($) {
    if (window.acf) {
        window.acf.addAction('load', function () {
            $('.read-only input, .readonly textarea').attr('readonly', 'true');
        });
    }
});