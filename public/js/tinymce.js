tinymce.init({
    selector: 'textarea',
    height: 700,
    plugins: 'link image code imagetools spellchecker lists a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    toolbar: 'link image | code | a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table alignleft aligncenter alignright',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    automatic_uploads: true,
    file_picker_types: 'image',
    image_title: true,
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };
        input.click();
    },
});
