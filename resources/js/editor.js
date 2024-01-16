import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { CodeBlock } from '@ckeditor/ckeditor5-code-block';

ClassicEditor
    .create( document.querySelector( '#description' ),{
        // plugins: [ 'CodeBlock' ],
        // toolbar: [ 'codeBlock'],
        ckfinder: {
            uploadUrl: '<?= route("ckeditor.upload")."?=".csrf_token() ?>',
        },
        
    })
    .then( editor => {
        editor.model.document.on('change', () => {
            const editorContent = editor.getData();
            $('#description').val(editorContent);
        });
    } )
    .catch( error => {
        console.error( error );
    } );
    