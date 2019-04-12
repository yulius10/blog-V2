//Formularios
$(document).ready(function() {
    loadFormContact();
    

    loadEjemploForm();
    loadBtnFunctions();
});

//Cargar forms en fancy Ligthbox
function loadCodeInFancy() {
    validateFormImg();
    loadEjemploFormLightbox();
    loadEjemploFormLightbox2();
}

//Formulario Contacto
function loadFormContact() {
    var formContact = $('#formContact');
    if (formContact.length) {
        formContact.validate({
            rules: {
                Nombre: "required",
                Apellido: "required",
                Correo: "required",
                Asunto: "required",
                Mensaje: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'ajax/contact.php',
                    type: 'POST',
                    data: new FormData(form),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() { toggleLoading('open'); },
                    error: function() { alertErrorConnect(); }
                }).done(function(result) {
                    var result = result.trim();
                    if (result != '0') {
                        $.createAlert({
                            title: 'Notificacion',
                            content: '<p>Su mensaje a sido enviado correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'contact.php';
                            }
                        });
                    } else {
                        $.createAlert({
                            title: 'Error',
                            content: '<p>No se ha podido establecer la conexión. <br>Por favor intente más tarde.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'contact.php';
                            }
                        });
                    }
                });
            }
        })
    }
}


//Formulario buscardor
function loadFormBuscador() {
    var formBuscador = $('#formBuscador');
    if (formBuscador.length) {
        formBuscador.validate({
            rules: {
                buscar: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'resultBusqueda.php',
                    type: 'POST',
                    data: new FormData(form),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() { toggleLoading('open'); },
                    error: function() { alertErrorConnect(); }
                }).done(function(result) {
                    var result = result.trim();
                    if (result != '0') {
                        
                    } else {
                        $.createAlert({
                            title: 'Error',
                            content: '<p>No se ha podido establecer la conexión. <br>Por favor intente más tarde.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'index.php';
                            }
                        });
                    }
                });
            }
        })
    }
}


//Formulario ejemplo
function loadEjemploForm() {
    var formEje = $('#formEje');
    if (formEje.length) {
        formEje.validate({
            rules: {
                'multis': "required",
                'multis2': "required",
                'campo1': "required",
                'campo2': "required",
                'campo3': "required",
                'campo4': "required",
                'campo5': { required: true, email: true },
                'campo6': "required",
                'campo7': "required",
                'campo8': { required: true, number: true },
                'campo9': { required: true, url: true },
                'campo10': "required",
                'campo11': "required",
                'select1': "required",
                'select2[]': "required",
                'groupC': { required: true, minlength: 3 },
                'groupR': 'required',
                'check1': 'required',
                'check2': 'required',
                'text1': 'required',
                'editor1': 'required'
            },
            submitHandler: function() {
                $.createAlert({
                    title: 'Registro guardado',
                    content: 'Se ha guardado la información con exito',
                    closeButton: false,
                    acceptButton: true,
                    cancelButton: false,
                    onAccept: function() {
                        closeAlert();
                    }
                });
            }
        });
    }
}

//Formulario ejemplo lightbox
function loadEjemploFormLightbox() {
    var formEje = $('#formEjeLightbox');
    if (formEje.length) {
        formEje.validate({
            rules: {
                'mselect1': "required",
            },
            submitHandler: function() {
                setHtmlMSelect($('#mselect1'), $('#multis'));
                closeAlert();
            }
        });
    }
}

function loadEjemploFormLightbox2() {
    var formEje = $('#formEjeLightbox2');
    if (formEje.length) {
        formEje.validate({
            rules: {
                'mselect2': "required",
            },
            submitHandler: function() {
                setHtmlMSelect($('#mselect2'), $('#multis2'));
                closeAlert();
            }
        });
    }
}

function loadBtnFunctions() {
    var btnDelete = $('.ejemploEli');
    if (btnDelete.length) {
        btnDelete.on('click', function() {
            var tituloAlert = "Eliminar registro";
            var textAlert = "<p>¿Esta seguro que desea eliminar este registro?</p>";
            $.createAlert({
                title: tituloAlert,
                content: textAlert,
                closeButton: false,
                acceptButton: true,
                cancelButton: true,
                onAccept: function() {
                    toggleLoading('open');
                    setTimeout(function() {
                        ejemploEliminar();
                    }, 500);
                }
            });
        });
    }
}

function ejemploEliminar() {
    $.createAlert({
        title: 'Registro eliminado',
        content: 'Se ha eleminado con exito',
        closeButton: false,
        acceptButton: true,
        cancelButton: false,
        onAccept: function() {
            closeAlert();
        }
    });
}

//Form edicion imagen
function validateFormImg() {
    var formEditImage = $('#formEditImage');
    if (formEditImage.length) {
        formEditImage.validate({
            rules: {
                'tit': "required"
            },
            submitHandler: function() {

            }
        });
    }
}

function alertErrorConnect() {
    $.createAlert({
        title: 'Error',
        content: '<p>No se ha podido establecer la conexión. <br>Por favor intente más tarde.</p>',
        closeButton: false,
        acceptButton: true,
        cancelButton: false,
        onAccept: function() { closeAlert(); }
    });
}