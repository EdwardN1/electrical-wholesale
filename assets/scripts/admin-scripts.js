jQuery(document).ready(function($) {

    $('.scss-editor textarea').each(function (e) {
        let editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
        editorSettings.codemirror = _.extend(
            {},
            editorSettings.codemirror,
            {
                indentUnit: 2,
                tabSize: 2,
                mode: 'text/x-scss',
                autoRefresh: true,
            }
        );
        wp.codeEditor.initialize($(this), editorSettings);
    });

    $('.html-editor textarea').each(function (e) {
        let editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
        editorSettings.codemirror = _.extend(
            {},
            editorSettings.codemirror,
            {
                indentUnit: 2,
                tabSize: 2,
                mode: 'htmlmixed',
                autoRefresh: true,
            }
        );
        wp.codeEditor.initialize($(this), editorSettings);
    });

    $('.js-editor textarea').each(function (e) {
        let editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
        editorSettings.codemirror = _.extend(
            {},
            editorSettings.codemirror,
            {
                indentUnit: 2,
                tabSize: 2,
                mode: 'javascript',
                autoRefresh: true,
            }
        );
        wp.codeEditor.initialize($(this), editorSettings);
    });

    /*$('.acf-tab-button').on('click',function () {
        window.console.log('clicked');
        $('.CodeMirror').each(function(i, el){
            window.console.log('Refresing');
            el.CodeMirror.refresh();
        });
    });*/


});