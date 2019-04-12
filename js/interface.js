// Interfaz grafica
$(document).ready(function () {
	loadBtnMMenu();
	loadBtnGMenu();
	loadBtnTOtable();
	blurGeneralSelects();
	loadICalendar();
	loadGSpinner();
	loadSelectMultiple();
	loadGTinyMCE();
	loadFancyContent();
	loadTabsForm();
	loadOrderTable();
	loadFiler();
	loadMSelect();
});
$(window).on({
	'load': function () {
		toggleGLoading();
		loadDocImgs();
	},
	'resize': function () {
		resizeFancy();
	}
});

// Toggle main menu
function loadBtnMMenu() {
	var btnMMenu = $('#btnMMenu'), mainMenu = $('#mainMenu');
	if (btnMMenu.length) {
		btnMMenu.on('click', function (e) { e.preventDefault(); e.stopPropagation(); toggleMainMenu($(this), mainMenu); toggleGMenu($('.openGMenu'), 'close'); });
		mainMenu.on('click', function (e) { e.stopPropagation() });
		$('body,html').on('click', function (e) { toggleMainMenu(btnMMenu, mainMenu, 'close') });
	}
	loadBtnSubmenus();
}
function toggleMainMenu(btn, menu, evento) {
	var clase = "active";
	if (btn.hasClass(clase) || evento == "close") { menu.removeClass(clase); btn.removeClass(clase); }
	else { menu.addClass(clase); btn.addClass(clase); }
}

// Submenus toggle
function loadBtnSubmenus() {
	var btnSubmenu = $('#mainMenu > ul > li > a');
	if (btnSubmenu.length) {
		$.each(btnSubmenu, function () {
			if ($(this).attr('href') == "#") { $(this).on('click', function (e) { e.preventDefault(); toggleSubmenu($(this)); }); }
		});
	}
}
function toggleSubmenu(btn) {
	var menuActive = $('#mainMenu li.mActive'), parent = btn.parents('li'), clase = "mActive";
	if (parent.hasClass(clase)) { menuActive.removeClass(clase); }
	else { menuActive.removeClass(clase); parent.addClass(clase); }
}

// Toggle General Menu
function loadBtnGMenu() {
	var openGMenu = $('.openGMenu');
	if (openGMenu.length) {
		openGMenu.on('click', function (e) { e.preventDefault(); e.stopPropagation(); toggleGMenu($(this)); toggleMainMenu($('#btnMMenu'), $('#mainMenu'), 'close'); });
		$('.GMenu').on('click', function (e) { e.stopPropagation() });
		$('body,html').on('click', function (e) { toggleGMenu(openGMenu, 'close') });
	}
}
function toggleGMenu(btn, evento) {
	var elemActive = $('.GMenu.mGactive, .openGMenu.mGactive'), clase = "mGactive", nextMenu = $('#' + btn.data('menu'));
	if (btn.hasClass(clase) || evento == 'close') { elemActive.removeClass(clase); }
	else { elemActive.removeClass(clase); btn.addClass(clase); nextMenu.addClass(clase); }
}

// Toggle detalle tabla general
function loadBtnTOtable() {
	var btnTOtable = $('.btnTOtable');
	if (btnTOtable.length) {
		btnTOtable.on('click', function (e) { e.preventDefault(); toggleDGTable($(this)); });
	}
}
function toggleDGTable(btn) {
	var element = btn.parents('tr'), clase = "trOpen";
	if (btn.hasClass(clase)) { element.removeClass(clase); btn.removeClass(clase); }
	else { element.addClass(clase); btn.addClass(clase); }
}

// General select
function blurGeneralSelects() {
	var selects = $('select');
	if (selects.length) { selects.on('change', function () { $(this).blur(); }); }
}

// General calendar
function loadICalendar(div) {
	var iCalendar = $('.iCalendar'), dayNames = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], dayNamesMin = ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthNamesShort = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
	if (div) { iCalendar = div.find('.iCalendar'); }
	if (iCalendar.length) {
		iCalendar.each(function () {
			var thisCalendar = $(this), thisYearRange = thisCalendar.data('range'), yearRange = "c-10:c+10";
			if (thisYearRange !== undefined) { yearRange = thisYearRange; }
			thisCalendar.datepicker({
				dayNames: dayNames, dayNamesMin: dayNamesMin, monthNames: monthNames, monthNamesShort: monthNamesShort,
				changeMonth: true, changeYear: true, yearRange: yearRange, dateFormat: "yy-mm-dd", showButtonPanel: false, currentText: 'Hoy', closeText: 'Cerrar',
				onChangeMonthYear: function (year, month, obj) {
					var fecha = obj.selectedYear + "/" + (obj.selectedMonth + 1) + "/" + obj.selectedDay;
					fecha = new Date(fecha);
					$(this).datepicker("setDate", fecha);
				},
				onClose: function () { $(this).blur(); }
			});
			thisCalendar.on('focus', function () { $(this).blur(); });
		});
	}
}

// General spinner input
function loadGSpinner() {
	var gSpinner = $('.gSpinner');
	if (gSpinner.length) {
		gSpinner.each(function () {
			$(this).spinner();
			var dis = $(this).prop('disabled');
			if (dis == true) { $(this).spinner("option", "disabled", true); }
		});
	}
}

// General select multiple
function loadSelectMultiple() {
	var sMultiple = $('.sMultiple');
	if (sMultiple.length) {
		sMultiple.multiSelect({
			selectableOptgroup: true, keepOrder: true,
			afterSelect: function (values) { sMultiple.blur(); },
			afterDeselect: function (values) { sMultiple.blur(); }
		});
	}
}

// General TinyMCE
function loadGTinyMCE() {
	var editorHTML = $('.editorHTML');
	if (editorHTML.length) {
		tinymce.init({
			selector: '.editorHTML', theme_url: 'gm-js/tinymce.theme.min.js', skin_url: 'gm-css/lightgray', height: 350, language_url: 'gm-js/tinymce.es_MX.js',
			menu: {
				edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall' },
				format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat' },
				table: { title: 'Table', items: 'inserttable tableprops deletetable | cell row column' },
				tools: { title: 'Tools', items: 'code' }
			},
			plugins: 'link table wordcount code',
			setup: function (editor) {
				editor.on('change', function (e) { tinymce.triggerSave(); editorHTML.blur(); });
			}
		});
	}
}

// Fancy texto general
function loadFancyContent() {
	var openFancy = $('.openFancy');
	if (openFancy.length) {
		openFancy.colorbox({
			width: '100%', height: '100%', className: 'fContent', initialWidth: '100px', initialHeight: '100px', fixed: true, opacity: 0.75, transition: 'fade', speed: 200, fadeOut: 200, returnFocus: false, overlayClose: false, escKey: true, closeButton: false, current: false, title: false, rel: getRelFancy,
			onOpen: function () { },
			onComplete: function () {
				loadBtnsFancy('open'); resizeFancy(); loadMSelect($('#cboxLoadedContent'));
				loadCodeInFancy();
			},
			onClosed: function () { loadBtnsFancy('close'); }
		});
	}
}
function resizeFancy() {
	var fancyText = $('#colorbox.fContent');
	if (fancyText.length) {
		$.colorbox.resize({ width: '100%', height: '100%' });
	}
}
function loadBtnsFancy(event) {
	var btnCF = $('#cboxLoadedContent .btnCF'), btnClose = $('#cboxClose'), btnPF = $('#cboxLoadedContent .btnPF'), btnNF = $('#cboxLoadedContent .btnNF'); classShow = "show";
	if (btnCF.length) { btnCF.on('click', function (e) { e.preventDefault(); $.colorbox.close(); }); }
	if (btnPF.length) { btnPF.on('click', function (e) { e.preventDefault(); $.colorbox.prev(); }); }
	if (btnNF.length) { btnNF.on('click', function (e) { e.preventDefault(); $.colorbox.next(); }); }
	if (event == "open") { btnClose.addClass(classShow); $('body').css('overflow', 'hidden'); }
	else { btnClose.removeClass(classShow); $('body').css('overflow', 'auto'); }
}
function getRelFancy() {
	var rel = $(this).data('rel');
	if (rel !== undefined) { return rel; }
	else { return false; }
}
function closeAlert() {
	$.colorbox.close();
}

// Crear alertas
(function ($) {
	$.createAlert = function (opt_user) {
		var opt_default = {
			title: 'Titulo Alerta', content: 'Texto Alerta', closeButton: true, acceptButton: true, labelAccept: 'Aceptar', cancelButton: true, labelCancel: 'Cancelar',
			onAccept: function () { }, onCancel: function () { }, onClosed: function () { }
		}
		var options = $.extend(opt_default, opt_user), conBtnClose = '', conTitulo = '', conButtons = '';
		if (options.closeButton === true) { conBtnClose = '<button class="cboxCF btnCF">cerrar</button>'; }
		if (options.title !== false) { conTitulo = '<h3>' + options.title + '</h3>'; }
		if (options.cancelButton === true || options.acceptButton === true) {
			conButtons = '<div class="contBtns">';
			if (options.cancelButton === true) {
				conButtons = conButtons + '<button id="btnCancel" class="btn" type="button"><i class="fa fa-times-circle-o" aria-hidden="true"></i> ' + options.labelCancel + '</button>';
			}
			if (options.acceptButton === true) {
				conButtons = conButtons + '<button id="btnAccept" class="btn" type="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ' + options.labelAccept + '</button>';
			}
			conButtons = conButtons + '</div>';
		}
		function loadBtnFunctions() {
			var btnA = $('#btnAccept'), btnC = $('#btnCancel');
			if (btnA.length) { btnA.on('click', function () { options.onAccept(); /*$.colorbox.close();*/ }); }
			if (btnC.length) { btnC.on('click', function () { options.onCancel(); $.colorbox.close(); }); }
		}
		var htmlAlert = '<div class="gFancyT"><div class="gAlert">' + conBtnClose + conTitulo + '<div class="desc">' + options.content + '</div>' + conButtons + '</div></div>';
		$.colorbox({
			html: htmlAlert, width: '100%', height: '100%', className: 'fContent', initialWidth: '100px', initialHeight: '100px', fixed: true, opacity: 0.75, transition: 'none', speed: 200, fadeOut: 200, returnFocus: false, overlayClose: false, escKey: false, closeButton: false, current: false, rel: false, title: false,
			onComplete: function () {
				loadBtnsFancy('open'); resizeFancy(); toggleLoading('close'); loadBtnFunctions();
			},
			onClosed: function () {
				loadBtnsFancy('close'); options.onClosed();
			}
		});
	};
})(jQuery);

// Tabs forms
function loadTabsForm() {
	var gTabs = $('.gTabs');
	if (gTabs.length) { gTabs.tabs({ heightStyle: 'content' }); }
}

// Order table
function loadOrderTable() {
	var orderTable = $('.orderTable');
	if (orderTable.length) {
		orderTable.tablesorter({ cancelSelection: false }).bind('sortStart', function () { toggleLoading('open'); }).bind('sortEnd', function () { toggleLoading('close'); });
	}
}

// Upload imgs
function loadFiler() {
	var inputFiles = $('.simpleFile, .dragDropFile');
	if (inputFiles.length) {
		inputFiles.each(function () {
			var sFile = $(this), maxFileSize = $(this).data('jfiler-filemaxsize'), styleInnput = true, dragdrop = null, pDisabled = $(this).prop('disabled'), nameTheme = null;
			if (pDisabled == true) { nameTheme = 'disabled'; $($(this).data('append')).addClass('disabled'); }
			if ($(this).hasClass('dragDropFile')) {
				styleInnput = '<div class="jFiler-input-dragDrop"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text">Arrastrar y soltar archivos aquí <span>o</span></div><a class="jFiler-input-choose-btn blue">Seleccionar archivos</a></div>';
				dragdrop = { dragEnter: null, dragLeave: null, drop: null };
			}
			$(this).filer({
				addMore: false, showThumbs: true, fileMaxSize: maxFileSize, maxSize: null, changeInput: styleInnput, theme: nameTheme,
				templates: {
					box: '<div class="listIDoc"></div>',
					item: '<div class="itemIDoc"><div class="cThumb">{{fi-image}}<div class="descIDoc"><div><span class="iDname">{{fi-name}}</span> <span class="iDsize">{{fi-size2}}</span></div></div></div><div class="cOptions"><div class="textCO">{{fi-progressBar}}</div><button type="button" class="btnEliIDoc"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div></div>',
					itemAppend: '<div class="itemIDoc"><div class="cThumb">{{fi-image}}<div class="descIDoc"><div><span class="iDname">{{fi-name}}</span> <span class="iDsize">{{fi-size2}}</span></div></div></div><div class="cOptions"><div class="textCO"><span class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completado</span></div><button type="button" class="btnEliIDoc"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div></div>',
					progressBar: '<div class="bar"></div>',
					itemAppendToEnd: true, canvasImage: true, removeConfirmation: true, _selectors: { list: '.listIDoc', item: '.itemIDoc', progressBar: '.bar', remove: '.btnEliIDoc' }
				},
				dragDrop: dragdrop,
				uploadFile: {
					url: "gm-ajax/upload-simplefile.php", data: null, type: 'POST', enctype: 'multipart/form-data', synchron: true,
					beforeSend: function () { },
					success: function (data, itemEl, listEl, boxEl, newInputEl, inputEl, id) {
						var dataJson = JSON.parse(data), error = dataJson[0].errors;
						if (error == true) { changeStateUpload(itemEl, 'error'); }
						else {
							var newName = dataJson[0].name, codImg = dataJson[0].cod, urlImg = dataJson[0].urldir, filerKit = inputEl.prop("jFiler");
							filerKit.files_list[id].file.ref = newName; filerKit.files_list[id].file.cod = codImg; filerKit.files_list[id].file.urldir = urlImg;
							changeStateUpload(itemEl, 'success'); changeInputTextFile(inputEl, filerKit.files_list); createEditImage(itemEl, filerKit.files_list[id].file);
						}
					},
					error: function (el) { changeStateUpload(el, 'error'); },
					statusCode: null, onProgress: null, onComplete: null
				},
				onSelect: function () { sFile.blur(); },
				onRemove: function (itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
					var filerKit = inputEl.prop("jFiler"), file_name = filerKit.files_list[id].file.ref, file_cod = filerKit.files_list[id].file.cod, file_url = filerKit.files_list[id].file.urldir;
					$.post('gm-ajax/remove-file.php', { file: file_name, cod: file_cod, dir: file_url }, function (data) {
						changeInputTextFile(inputEl, filerKit.files_list);
					});
				},
				captions: {
					button: "<i class='fa fa-upload' aria-hidden='true'></i>", feedback: "Seleccionar archivos", feedback2: "archivos selecionados", drop: "Arrastre archivos aquí", removeConfirmation: "¿Desea remover este archivo?",
					errors: { filesLimit: "Máximo {{fi-limit}} archivos para subir.", filesType: "Formato de archivo no permitido.", filesSize: "{{fi-name}} es muy grande, por favor subir archivo de máximo {{fi-fileMaxSize}} MB.", filesSizeAll: "Los archivos que ha elegido son demasiado grandes! Por favor, subir archivos de máximo {{fi-maxSize}} MB.", folderUpload: "No tiene permitido subir carpetas." }
				},
				dialogs: {
					alert: function (text) {
						$.createAlert({ title: 'Notificación', content: text, closeButton: false, acceptButton: true, cancelButton: false, onAccept: function () { closeAlert(); } });
					},
					confirm: function (text, callback) {
						$.createAlert({ title: 'Notificación', content: text, closeButton: false, acceptButton: true, cancelButton: true, onAccept: function () { callback(); closeAlert(); } });
					}
				}
			});
		});
	}
}
function loadDocImgs() {
	var gCDocs = $('.gCDocs');
	if (gCDocs.length) {
		gCDocs.each(function () {
			var itemIDoc = $(this).find('.itemIDoc');
			if (itemIDoc.length) {
				var inputF = $('input[data-append="#' + $(this).attr('id') + '"]'), filerKit = inputF.prop("jFiler");;
				itemIDoc.each(function (index) { createEditImage($(this), filerKit.files_list[index].file); });
			}
		});
	}
}
function changeStateUpload(element, state) {
	var text, parent = element.find(".jFiler-jProgressBar").parents('.textCO');
	if (state == 'success') { text = $('<span class="text-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completado</span>'); }
	else { text = $('<span class="text-error"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> Error</span>'); }
	element.find(".jFiler-jProgressBar").fadeOut("slow", function () { text.hide().appendTo(parent).fadeIn("slow"); });
}
function changeInputTextFile(input, list) {
	var iText = $(input.data('itext')), values = '', separator = '';
	$.each(list, function (index) {
		if (index != 0) { separator = '|'; }
		values = values + separator + list[index].file.cod;
	});
	iText.val(values).blur();
}
function createEditImage(element, file) {
	var cThumb = element.find('.cThumb'), link, type = file.type.split('/', 1);
	if (type[0] == "image") {
		var cod = file.cod, rel = element.parents('.gCDocs').attr('id');
		link = $('<a href="editar-img.php?img=' + cod + '" class="linkF openFancy" data-rel="' + rel + '">Enlace</a>');
	}
	else {
		var ruta = file.urldir, nameFile = file.ref;
		link = $('<a href="' + ruta + nameFile + '" target="_blank" class="linkF">Enlace</a>');
	}
	element.find('.iDname').html(file.ref); link.appendTo(cThumb);
	loadFancyContent();
}

// Function general loading
function toggleGLoading(evento) {
	var gPLoading = $('.gPLoading');
	if (gPLoading.length) {
		if (evento == "open") { gPLoading.fadeIn(500); }
		else { gPLoading.fadeOut(500); }
	}
}

// Loading general
function toggleLoading(event) {
	var body = $('body');
	if (event == "open") {
		var loadExist = body.find('.gLoading');
		if (!loadExist.length) { var div = "<div class='gLoading'><span></span></div>"; body.append(div); }
	}
	else {
		var loadExist = body.find('.gLoading');
		if (loadExist.length) { loadExist.remove(); }
	}
}

// Multiselect
function loadMSelect(div) {
	var contMSelect = $('.contMSelect');
	if (div) { contMSelect = div.find('.contMSelect'); }
	if (contMSelect.length) {
		contMSelect.each(function () {
			var wrapper = $(this), idOrder = wrapper.data('idorder'), timer = wrapper.data('timer');
			wrapper.removeAttr('data-idorder');
			toggleLoading('open');
			setTimeout(function () {
				if (idOrder != undefined && idOrder != '') {
					var listB = wrapper.find('.listB');
					$.each(idOrder, function (index, value) {
						var itemA = $('.listA .iMSelect.selected[data-id="' + value + '"]').clone(true);
						listB.append(itemA);
					});
					getValueMSelect(wrapper);
				}
				loadBtnMSelect(wrapper); /*loadSortableMSelect(wrapper);*/ loadBtnUpDownMSelect(wrapper);
				loadSearchIMS(wrapper, '.listA', '.fsA'); loadSearchIMS(wrapper, '.listB', '.fsB');
				toggleLoading('close');
			}, timer);
		});
	}
}
function loadBtnMSelect(div) {
	var btnAction = div.find('.iMSelect .btnAction');
	if (btnAction.length) {
		btnAction.on('click', function (e) {
			e.preventDefault();
			var parent = $(this).parents('.listIMSelect');
			if (parent.hasClass('listA')) { changeItemsMSelect($(this), 'add'); loadSearchIMS(div, '.listB', '.fsB'); }
			if (parent.hasClass('listB')) { changeItemsMSelect($(this), 'remove'); }
		});
	}
}
function changeItemsMSelect(btnAction, action) {
	var contMSelect = btnAction.parents('.contMSelect'), listA = contMSelect.find('.listA'), listB = contMSelect.find('.listB'), iMSelect = btnAction.parents('.iMSelect'), classSelected = 'selected';
	if (action == 'add') {
		listB.append(iMSelect.clone(true).addClass(classSelected));
		iMSelect.addClass(classSelected);
	}
	else {
		var btnId = iMSelect.data('id'), itemActive = listA.find('.iMSelect[data-id="' + btnId + '"]');
		itemActive.removeClass(classSelected); iMSelect.remove();
	}
	getValueMSelect(contMSelect);
}
function loadSortableMSelect(div) {
	var divSortable = div.find('.listIMSelect');
	if (divSortable.length) {
		divSortable.sortable({
			axis: 'y', handle: '.btnMove.sort', cancel: 'input, textarea, select, option',
			update(event, ui) { getValueMSelect(div); }
		});
	}
}
function loadBtnUpDownMSelect(div) {
	var btnMUpDown = div.find('.btnMove.up, .btnMove.down');
	if (btnMUpDown.length) {
		btnMUpDown.on('click', function (e) {
			e.preventDefault();
			var itemMove = $(this).parents('.iMSelect');
			if ($(this).hasClass('up')) { itemMove.prevAll('.selected:first').before(itemMove); }
			else { itemMove.nextAll('.selected:first').after(itemMove); }
			getValueMSelect(div);
		});
	}
}
function loadSearchIMS(div, list, input) {
	var inputS = div.find('.searchSM' + input);
	if (inputS.length) {
		var selector = div.find(list + ' .iMSelect');
		inputS.quicksearch(selector).on('keydown', function (e) { if (e.which == 13) { return false; } });
	}
}
function setHtmlMSelect(obj1, obj2) {
	if (obj1.length && obj2.length) {
		var wrap1 = obj1.parents('.contMSelect'), wrap2 = obj2.parents('.contSMSelect'), listB = wrap2.find('.listIMSelect'), itemsClone = wrap1.find('.listB .iMSelect').clone();
		if (itemsClone.length) {
			itemsClone.removeClass('selected').addClass('readOnly');
			itemsClone.find('.btnMove').remove(); itemsClone.find('.btnAction').removeClass('btnAction');
			listB.html(itemsClone);
			obj2.val(obj1.val()).blur();
		}
	}
}
function getValueMSelect(div) {
	var items = div.find('.listB .iMSelect.selected'), textMSelect = div.find('.textMSelect'), value = '';
	if (items.length) {
		items.each(function (index) {
			if (index != 0) { value = value + ','; }
			value = value + '{' + $(this).data('id') + ':' + $(this).data('value') + '}';
		});
	}
	textMSelect.val(value).blur();
}

// Formato general errores
$.validator.setDefaults({
	ignore: "input[type=hidden]",
	errorElement: 'span',
	errorPlacement: function (error, element) {
		var parent = element.parents('p, .contMSelect, .contSMSelect');
		error.appendTo(parent);
	}
});

// Validar tamaño archivos (sizeFile:2097152)
$.validator.addMethod("sizeFile", function (val, element, param) {
	var size = element.files[0].size;
	if (size > param) { return false } else { return true; }
}, "* Tamaño máximo 2MB.");

// Mensajes generales validacion
$.extend($.validator.messages, {
	required: "* Campo obligatorio.",
	remote: "* Captcha no válido.",
	email: "* E-mail no válido.",
	url: "* URL no válida.",
	date: "* Fecha no válida.",
	dateISO: "* Fecha (ISO) válida.",
	number: "* Sólo números.",
	digits: "* Sólo dígitos.",
	creditcard: "* Número de tarjeta no válido.",
	equalTo: "* Valores no iguales.",
	extension: "* Extensión no válida.",
	maxlength: $.validator.format("* Máximo {0}."),
	minlength: $.validator.format("* Mínimo {0}."),
	rangelength: $.validator.format("* Valor entre {0} y {1} caracteres."),
	range: $.validator.format("* Valor entre {0} y {1}."),
	max: $.validator.format("* Valor menor o igual a {0}."),
	min: $.validator.format("* Valor mayor o igual a {0}."),
	nifES: "* NIF no válido.",
	nieES: "* NIE no válido.",
	cifES: "* CIF no válido."
});