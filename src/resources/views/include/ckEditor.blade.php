<style type="text/css">
    main #editor {
        background: var(--ck-sample-color-white) ;
        box-shadow: 2px 2px 2px rgba(0,0,0,.1);
        border: 1px solid #DFE4E6;
        border-bottom-color: #cdd0d2;
        border-right-color: #cdd0d2;
        background-color: #fff;
    }
    main .ck.ck-editor {
        box-shadow: 2px 2px 2px rgba(0,0,0,.1);
    }
    main .ck.ck-content {
        font-size: 1em;
        line-height: 1.6em;
        margin-bottom: 0.8em;
        min-height: 200px;
        padding: 1.5em 2em;
    }
    main .document-editor {
        border: 1px solid #DFE4E6;
        border-bottom-color: #cdd0d2;
        border-right-color: #cdd0d2;
        border-radius: 2px;
        max-height: 700px;
        display: flex;
        flex-flow: column nowrap;
        box-shadow: 2px 2px 2px rgba(0,0,0,.1);
    }
    main .toolbar-container {
        z-index: 1;
        position: relative;
        box-shadow: 2px 2px 1px rgba(0,0,0,.05);
    }
    main .toolbar-container .ck.ck-toolbar {
        border-top-width: 0;
        border-left-width: 0;
        border-right-width: 0;
        border-radius: 0;
    }
    main .content-container {
        padding: var(--ck-sample-base-spacing);
        background: #eee;
        overflow-y: scroll;
    }
    main .content-container #editor {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 15.8cm;
        min-height: 21cm;
        padding: 1cm 1cm 2cm;
        margin: 0 auto;
        box-shadow: 2px 2px 1px rgba(0,0,0,.05);
    }
</style>
<main>
<div class="document-editor">
    <div class="toolbar-container"></div>
    <div class="content-container">
        <div id="editor">
            {!! $entity->content ?? '' !!}
        </div>
    </div>
</div>
</main>
<textarea name="content" id="content" style="display: none;">{!! $entity->content ?? '' !!}</textarea>
<script src="/statics/ckeditor5/ckeditor.js"></script>
<script type="text/javascript">
    DecoupledEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: ["heading", "|", "alignment:left", "alignment:center", "alignment:right", "alignment:adjust", "|", "bold", "italic", "blockQuote", "link", "|", "bulletedList", "numberedList", "imageUpload", "|", "undo", "redo"],
            ckfinder: {
                uploadUrl: "http://www:mywork.com/admin/attachment/uploadimage"
            }
        })
        .then( editor => {
            const toolbarContainer = document.querySelector( 'main .toolbar-container' );
            toolbarContainer.prepend( editor.ui.view.toolbar.element );
            editor.model.document.on('change:data', function () {
                var data = window.editor.getData();
                $("#content").text(data);
            })
            window.editor = editor;
        })

        .catch( err => {
            console.error( err.stack );
        });
</script>