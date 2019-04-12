$("#galeria-archivos").fileinput({
    theme: 'fa',
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: ["jpg", "png"],
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    overwriteInitial: false,
    initialPreviewAsData: true,
    allowedFileExtensions: ["jpg", "png", "pdf"]
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
    allowedFileExtensions: ["jpg", "png"]
});