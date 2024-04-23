<div class="code-editor-container">
    <script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <div id="code-editor" style="width: 100%; height: 300px;"></div>
    <script>

        let editor = ace.edit("code-editor");
        editor.setTheme("ace/theme/one_dark");
        editor.session.setMode("ace/mode/java"); // Adjust mode as needed
        editor.setShowPrintMargin(false);
        editor.setAutoScrollEditorIntoView(true);
        editor.resize();
        editor.setOptions({
            fontSize: "20px"
        });

        // Expose an event to emit code changes (optional)
        editor.on('change', function() {
            let code = editor.getValue();
            window.livewire.emit('editorUpdated', code);
        });


    </script>
</div>
