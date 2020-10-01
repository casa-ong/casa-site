$(document).ready(function() {
    $('#summernote').summernote({
        lang: 'pt-BR',
        placeholder: 'Digite aqui o texto',
        tabsize: 2,
        height: 400,
        toolbar: [
            ['view', ['undo', 'redo',]],
            ['style', ['style']],
            ['font', ['bold', 'underline', 'italic', 'clear', 'fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'help']]
        ],
        styleTags: [
            'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
        ],
    });
});