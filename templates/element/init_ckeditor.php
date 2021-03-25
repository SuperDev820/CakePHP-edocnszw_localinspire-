<script type="text/javascript">
    // ClassicEditor
    //     .create(document.querySelector('#text'))
    //     .catch(error => {
    //         console.error(error);
    //     });
    editor = CKEDITOR.replace('<?= $ckid ?>', {
        extraPlugins: "justify",
        uiColor: '#FAFAFA',
        on: {
            instanceReady: function(ev) {
                this.dataProcessor.writer.setRules('p', {
                    indent: false,
                    breakBeforeOpen: false,
                    breakAfterOpen: false,
                    breakBeforeClose: false,
                    breakAfterClose: false
                });
            }
        }
    });
    editor.setData('<?= $text ?>');
    editor.on('required', function(evt) {
        editor.showNotification('This field is required.', 'warning');
        evt.cancel();
    });
    editor.on('dialogDefinition', function(ev) {
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        var editor = ev.editor;

        if (dialogName === 'image') {
            dialogDefinition.onOk = function(e) {
                var imageSrcUrl = e.sender.originalElement.$.src;
                var imgHtml = CKEDITOR.dom.element.createFromHtml('<a class="lightbox" href="' + imageSrcUrl + '"><img src=' + imageSrcUrl + ' style="max-width:500px" alt="" /></a>');
                editor.insertElement(imgHtml);
            };
        }
    });
</script>