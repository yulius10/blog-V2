$('.delete').on("click", function() {
    //Recogemos la id del contenedor padre

    var parent = $(this).parent().attr('id');
    //Recogemos el valor del servicio
    var service = $(this).attr('data');
    var dataString = 'id=' + service;
    $.ajax({
        type: "POST",
        url: "gm-ajax/deleteCategories.php",
        data: dataString,
        success: function() {
            $.createAlert({
                title: 'Notificacion',
                content: '<p>Se ha eliminado correctamente.</p>',
                closeButton: false,
                acceptButton: true,
                cancelButton: false,
                onAccept: function() {
                    closeAlert();
                    location.href = 'categories.php';
                }
            });
        }
    });
});