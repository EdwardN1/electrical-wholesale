jQuery(document).ready(function ($) {

    function initCodeMirrors() {
        $('.scss-editor textarea').each(function (e) {
            let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
            let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
            window.console.log('setting up js codeMirror');
            let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
    }

    function refreshCodeMirrors() {
        $('.scss-editor textarea').each(function (e) {
            if ($(this).is(':visible')) {
                let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
            }
        });

        $('.html-editor textarea').each(function (e) {
            if ($(this).is(':visible')) {
                let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
            }
        });

        $('.js-editor textarea').each(function (e) {
            if ($(this).is(':visible')) {
                let editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
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
            }
        });
    }

    setInterval(refreshCodeMirrors,5000);

    if (window.acf) {
        window.acf.addAction('load', initCodeMirrors);
        window.acf.addAction('remount', refreshCodeMirrors)
    }


});