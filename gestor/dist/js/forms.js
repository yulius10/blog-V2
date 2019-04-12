//Formularios
$(document).ready(function() {
    loadFormLogin();
    loadFormAddCategories();
    loadFormEditCategories();
    loadFormAddBlog();
    loadFormEditBlog();
    loadFormAddUsers();
    loadFormEditUsers();
    loadFormEditSeo();

    loadEjemploForm();
    loadBtnFunctions();
});

//Cargar forms en fancy Ligthbox
function loadCodeInFancy() {
    validateFormImg();
    loadEjemploFormLightbox();
    loadEjemploFormLightbox2();
}

//Formulario Login
function loadFormLogin() {
    var formLogin = $('#formLogin');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                usu: "required",
                pass: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/login.php',
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
                            content: '<p>Ingreso correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'panel.php';
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
                                location.href = 'index.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario Agregar Categories
function loadFormAddCategories() {
    var formLogin = $('#formcategories');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                categorie: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/addCategories.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'categories.php';
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
                                location.href = 'categories.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario Editar categorias
function loadFormEditCategories() {
    var formLogin = $('#formEditCategories');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                categorie: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/editCategories.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'categories.php';
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
                                location.href = 'categories.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario Agregar Blog
function loadFormAddBlog() {
    var formLogin = $('#formBlog');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                "titulo": "required",
                "descripcionPeg": "required",
                "descripcion": "required",
                "tipoCategorie": "required",
                "Portada": "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/addBlog.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'blog.php';
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
                                location.href = 'blog.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario editar Blog
function loadFormEditBlog() {
    var formLogin = $('#formEditBlog');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                "titulo": "required",
                "descripcionPeg": "required",
                "descripcion": "required",
                "tipoCategorie": "required",
                "Portada": "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/editBlog.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'blog.php';
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
                                location.href = 'blog.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario Agregar Users
function loadFormAddUsers() {
    var formLogin = $('#formUsers');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                name: "required",
                lastname: "required",
                mail: { required: true, email: true },
                password: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/addUsers.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'users.php';
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
                                location.href = 'users.php';
                            }
                        });
                    }
                });
            }
        })
    }
}

//Formulario editar Blog
function loadFormEditUsers() {
    var formLogin = $('#formEditUsers');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                name: "required",
                lastname: "required",
                mail: { required: true, email: true },
                password: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/editUsers.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'users.php';
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
                                location.href = 'users.php';
                            }
                        });
                    }
                });
            }
        })
    }
}



//Formulario editar Seo
function loadFormEditSeo() {
    var formLogin = $('#formEditSeo');
    if (formLogin.length) {
        formLogin.validate({
            rules: {
                descripcion: "required",
                palabrasClave: "required",
                google: "required"
            },
            submitHandler: function(form) {
                $.ajax({
                    url: 'gm-ajax/editSeo.php',
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
                            content: '<p>Guardo correctamente.</p>',
                            closeButton: false,
                            acceptButton: true,
                            cancelButton: false,
                            onAccept: function() {
                                closeAlert();
                                location.href = 'SEO.php';
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
                                location.href = 'SEO.php';
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