var archivos = [<?php  json_encode($registroGale)?>];) ? > );
$("#galeria-archivos").fileinput({
    theme: 'fa',
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: ["jpg", "png"],
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    overwriteInitial: false,
    initialPreviewAsData: true,
    allowedFileExtensions: ["jpg", "png", "pdf"],
    //initialPreview: [archivos]
    initialPreview: ["../archivos/5ab94c2faaaf9.jpg",
        "../archivos/5ab94c2fab51f.jpg"
    ]
});
$("#galeria-fotos").fileinput({
    theme: 'fa',
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: ["jpg", "png", "gif", "pdf"],
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    overwriteInitial: false,
    initialPreviewAsData: true,
    maxFileCount: 1,
    allowedFileExtensions: ["jpg", "png"],
    initialPreview: ["../images/" + $("#fotos").val()]
});