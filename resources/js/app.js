require('./bootstrap');


$(document).ready(function(){

    $('#reply-comment-but').on('click',function(){
        $(this.parentElement).find('#update-form').addClass('hide');
        $(this.parentElement).find('#reply-form').removeClass('hide');
    });
    
    $('#close-reply-form').on('click',function(){
        this.parentElement.classList.add('hide');
    });

    $('#edit-comment-but').on('click',function(){
        $(this.parentElement).find('#update-form').removeClass('hide');
        $(this.parentElement).find('#reply-form').addClass('hide');
    });

    $('.tab').on('click',function(){
        $('.tab-content').addClass('hide');
        $('#' + this.value).removeClass('hide');
    });

    $('.open-edit-category').on('click',function(){
        $('.category-name').removeClass('hide');
        $('.delete-category').removeClass('hide');
        $('.edit-category-block').addClass('hide');
        $('.open-edit-category').removeClass('hide');

        $(this.parentElement).find('.edit-category-block').removeClass('hide');
        $(this.parentElement).find('.category-name ,.delete-category').addClass('hide');
        this.classList.add('hide');
    });
    
    $('.close-category-edit').on('click',function(){
        $('.category-name').removeClass('hide');
        $('.delete-category').removeClass('hide');
        $('.edit-category-block').addClass('hide');
        $('.open-edit-category').removeClass('hide');
    });
    
});


tinymce.init({
    selector: "textarea#post-area",
    plugins: "     autolink lists  fullscreen preview   table   image",
    toolbar:
        "     pageembed  table image fullscreen preview format undo redo | formatselect | bold italic | alignleft aligncentre alignright alignjustify | indent outdent | bullist numlist",
    toolbar_mode: "floating",
    images_upload_url: 'postAcceptor.php',
    images_upload_credentials: true,
    relative_urls:false,
    file_picker_callback: elFinderBrowser
});

function elFinderBrowser (callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
        title: 'File Manager',
        url: '/elfinder/tinymce5',
        /**
         * On message will be triggered by the child window
         * 
         * @param dialogApi
         * @param details
         * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
         */
        onMessage: function (dialogApi, details) {
            if (details.mceAction === 'fileSelected') {
                const file = details.data.file;
                
                // Make file info
                const info = file.name;
                
                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback(file.url, {text: info, title: info});
                }
                
                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    callback(file.url, {alt: info});
                }
                
                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback(file.url);
                }
                
                dialogApi.close();
            }
        }
    });
}

