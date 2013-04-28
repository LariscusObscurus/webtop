var programsOpen = false;
var pictureTarget = "";
// fancybox
$(document).ready(function (event) {
	// icons
	addListenerInfo($("#icon_1"));
	addListenerBluescreen($("#icon_2"));
	addListenerInfo($("#icon_3"));
	addListenerAccount($("#icon_4"));
	addListenerPhoto($("#icon_5"));
	addListenerRss($("#icon_6"));
	// window logout
	$("#logout").click(function (event) {
		var xhr = new XMLHttpRequest();
		var formdata = new FormData();
		
		formdata.append("logout", 1);
		xhr.open("POST", "scripts/handling.php", true);
		xhr.send(formdata);
		closePrograms();
	});
	// window move
	$("#windowInfo").draggable();
	$("#windowAccount").draggable();
	$("#windowPhoto").draggable();
	$("#windowRss").draggable();
	$("#windowInfo").mousedown(function (event) {
		noopHandler(event);
		$('#menu').hide();
		windowInfoZ();
	});
	$("#windowAccount").mousedown(function (event) {
		noopHandler(event);
		$('#menu').hide();
		windowAccountZ();
	});
	$("#windowPhoto").mousedown(function (event) {
		noopHandler(event);
		$('#menu').hide();
		windowPhotoZ();
	});
	$("#windowRss").mousedown(function (event) {
		noopHandler(event);
		$('#menu').hide();
		windowRssZ();
	});
	$("#closeRegister").click(function (event) {
		$("#windowRegister").hide();
	});
	windowEvents("#windowInfo");
	windowEvents("#windowAccount");
	windowEvents("#windowPhoto");
	windowEvents("#windowRss");
	windowCloseEvents("#windowInfo", "#closeInfo");
	windowCloseEvents("#windowAccount", "#closeAccount");
	windowCloseEvents("#windowPhoto", "#closePhoto");
	windowCloseEvents("#windowRss", "#closeRss");
	$(".windowContent").mousedown(function (event) {
		$('#menu').hide();
		noopHandler(event);
	});
	$(".windowContent").mouseup(function (event) {
		$('#menu').hide();
		noopHandler(event);
	});
	// start menu
	$("#start").click(function (event) {
		noopHandler(event);
		$('#menu').hide();
		handlePrograms();
	});
	// window content
	$("#infoContent").load("scripts/php_info.php");
	$("#accountContent").load("apps/account_info.php");
	$("#photoContent").load("apps/photo_app.php");
	$("#rssContent").load("apps/rss.php");
	$("#programs").load("scripts/programs.php");
	$("#registerContent").load("apps/register_app.php");
	// hide menu
	$(document).bind("click", function (event) {
		var id = event.target.id;
		$('#menu').hide();
		if (id != "programs" && id != "logout" && id != "username") {
			closePrograms();
		}
	});
	// fancybox
	$(".fancybox-thumb").fancybox({
		openEffect : 'elastic',
		closeEffect : 'elastic',
		prevEffect : 'fade',
		nextEffect : 'fade',
		helpers : {
			title :  {
				type: 'float'
			},
			thumbs : {
				width : 50,
				height : 50
			}
		}
	});
	// set timer
	window.setInterval(function () {
		var date = new Date();
		$("#time").html(date.toLocaleTimeString());
	}, 1000);
});

function windowEvents (id) {
	$(id).mouseup(function (event) {
		var formdata = new FormData();
		formdata.append("x_{0}".format(id.substr(1, id.length-1)), $(id).offset().left);
		formdata.append("y_{0}".format(id.substr(1, id.length-1)), $(id).offset().top);
		sendHandling(formdata);
	});
}

function windowCloseEvents (id, closeId) {
	$(closeId).click(function (event) {
		noopHandler(event);
		$(id).hide();
		$(id).css("z-index", "0");
		$('#menu').hide();
		var formdata = new FormData();
		formdata.append(id.substr(1, id.length), "close");
		sendHandling(formdata);
	});
}

function windowInfoZ () {
	$("#windowInfo").css("z-index", "2");
	$("#windowAccount").css("z-index", "1");
	$("#windowPhoto").css("z-index", "1");
	$("#windowRss").css("z-index", "1");
}

function windowAccountZ () {
	$("#windowAccount").css("z-index", "2");
	$("#windowInfo").css("z-index", "1");
	$("#windowPhoto").css("z-index", "1");
	$("#windowRss").css("z-index", "1");
}

function windowPhotoZ () {
	$("#windowPhoto").css("z-index", "2");
	$("#windowInfo").css("z-index", "1");
	$("#windowAccount").css("z-index", "1");
	$("#windowRss").css("z-index", "1");
}

function windowRssZ () {
	$("#windowRss").css("z-index", "2");
	$("#windowInfo").css("z-index", "1");
	$("#windowAccount").css("z-index", "1");
	$("#windowPhoto").css("z-index", "1");
}

function sendHandling (formdata) {
	$.ajax({
		type: "POST",
		data: formdata,
		url: "scripts/handling.php",
		cache: false,
		contentType: false,
		processData: false
	});
}

function openInfo () {
	$("#windowInfo").show();
	closePrograms();
	windowInfoZ();
	var formdata = new FormData();
	formdata.append("windowInfo", "open");
	sendHandling(formdata);
}

function openAccount () {
	$("#windowAccount").show();
	closePrograms();
	windowAccountZ();
	var formdata = new FormData();
	formdata.append("windowAccount", "open");
	sendHandling(formdata);
}

function openPhoto () {
	$("#windowPhoto").show();
	closePrograms();
	windowPhotoZ();
	var formdata = new FormData();
	formdata.append("windowPhoto", "open");
	sendHandling(formdata);
}

function openRss () {
	$("#windowRss").show();
	closePrograms();
	windowRssZ();
	var formdata = new FormData();
	formdata.append("windowRss", "open");
	sendHandling(formdata);
}

function addListenerInfo (element) {
	element.dblclick(function () {
		openInfo();
	});
	addListenerMove(element);
}

function addListenerBluescreen (element) {
	element.dblclick(function () {
		document.location.href = "pages/bluescreen.php";
	});
	addListenerMove(element);
}

function addListenerAccount (element) {
	element.dblclick(function () {
		openAccount();
	});
	addListenerMove(element);
}

function addListenerPhoto (element) {
	element.dblclick(function () {
		openPhoto();
	});
	addListenerMove(element);
}

function addListenerRss (element) {
	element.dblclick(function () {
		openRss();
	});
	addListenerMove(element);
}

function addListenerMove (element) {
	element.draggable();
	element.mouseup(function (event) {
		var target = event.target;
		var x = target.offsetLeft;
		var y = target.offsetTop;
		var xhr = new XMLHttpRequest();
		var formdata = new FormData();
		formdata.append("x"+target.id, x);
		formdata.append("y"+target.id, y);
		xhr.open("POST", "scripts/handling.php", true);
		xhr.send(formdata);
	});
}

function handlePrograms () {
	if (programsOpen) {
		closePrograms();
	} else {
		openPrograms();
	}
}

function closePrograms () {
	$("#start").css("background", "url('img/start.png') no-repeat left top transparent");
	$("#programs").hide();
	programsOpen = false;
}

function openPrograms () {
	$("#start").css("background", "url('img/start_active.png') no-repeat left top transparent");
	$("#programs").show();
	programsOpen = true;
}

function transferComplete (response, error) {
	console.log(response);
	if (checkFileName(response)) {
		addPhoto(response);
	} else {
		window.alert("invalid file type");
	}
}

function onFileChange (event) {
	noopHandler(event);
	var filelist = event.target.files;
	if (!filelist || !filelist.length) {
		return;
	}
	$.each(filelist, function (index, value) {
		var formdata = new FormData();
		formdata.append("file", value);
		upload(formdata);
	});
}

function onFileDrop (event) {
	noopHandler(event);
	var files = event.dataTransfer.files;
	var count = files.length; 
	for (i = 0; i < count; i++) {
		var formdata = new FormData();
		formdata.append("file", files[i]);
		upload(formdata);
	}
}

function noopHandler (event) {
	event.stopPropagation();
	event.preventDefault();   
}

function upload (formdata) {
	$.ajax({
		type: "POST",
		data: formdata,
		url: "scripts/upload.php",
		cache: false,
		contentType: false,
		processData: false,
		success: transferComplete
	});
}

function checkFileName (filename) {
	var content = filename.split(".");
	var extension = content[content.length - 1];
	return checkExtension(extension);
}

function checkExtension (extension) {
	var result = false;
	
	switch (extension) {
		case "jpg":
		case "jpeg":
		case "png":
		case "gif":
			result = true;
			break;
	};
	
	return result;
}

function addPhoto (filename) {
	var content = filename.split(".");
	var extension = content[content.length - 1];
	var name = content[0];
	
	var element = $("#photoList");
	element.html(element.html() + "<li><a class='fancybox-thumb' rel='fancybox-thumb' href='./photos/{0}' title='{0}'>".format(filename) +
		"<img class='photo' src='./photos/{0}_thumb.{1}' alt='{0}_thumb.{1}' oncontextmenu='onContextMenu(event)'></img></a></li>".format(name, extension));
}

function onContextMenu (event) {
	noopHandler(event);
	$('#menu').css({
		top: event.pageY + 'px',
		left: event.pageX + 'px'
	}).show();
	var arr = getFileName($(event.target).attr("src"));
	pictureTarget = "{0}.{1}".format(arr[0], arr[1]);
	return false;
}

function sendPictureRequest (formdata) {
	$.ajax({
		type: "POST",
		data: formdata,
		url: "scripts/picture.php",
		cache: false,
		contentType: false,
		processData: false,
		success: pictureComplete
	});
}

function getFileName (filename) {
	var content = filename.split(".");
	var extension = content[content.length - 1];
	content = filename.split("_");
	var name = content[0];
	var result = new Array(2);
	result[0] = name;
	result[1] = extension;
	return result;
}

function onClickDelete (event) {
	if (pictureTarget != "") {
		var formdata = new FormData();
		formdata.append("filename", pictureTarget);
		$.ajax({
			type: "POST",
			data: formdata,
			url: "scripts/delete.php",
			cache: false,
			contentType: false,
			processData: false,
			success: deletionComplete
		});
	}
	$('#menu').hide();
}

function onClickUndo (event) {
	sendPictureRequest(new FormData());
}

function onClickPicture (event, action) {
	if (pictureTarget != "") {
		var formdata = new FormData();
		formdata.append("action", action);
		formdata.append("filename", pictureTarget);
		sendPictureRequest(formdata);
	}
	$('#menu').hide();
}

function onClickRename (event) {
	var arr = getFileName(pictureTarget);
	var newName = prompt("Enter a new name for file '{0}'".format(arr[0]), "");
	var formdata = new FormData();
	formdata.append("newname", "./photos/{0}.{1}".format(newName, arr[1]));
	formdata.append("oldname", pictureTarget);
	$.ajax({
		type: "POST",
		data: formdata,
		url: "scripts/change_name.php",
		cache: false,
		contentType: false,
		processData: false,
		success: pictureComplete
	});
	$('#menu').hide();
}

function onClickDownload (event) {
	var url = "./scripts/download.php?filename={0}".format(pictureTarget);
	$("#downloadFrame").attr("src", url);
	$('#menu').hide();
}

function deletionComplete (response, error) {
	if (response.search("success") >= 0) {
		var filename = response.substr(response.search(";") + 1);
		$("img").each(function (index, value) {
			if ($(value).attr("src") == filename) {
				$(value).parent().parent().remove();
				return;
			}
		});
		console.log("file successfull deleted");
	} else {
		console.log("file not deleted");
	}
}

function pictureComplete (response, error) {
	console.log(response);
}

function onClickSubmit (event) {
	if ($("#checkCookie").prop("checked")) {
		var value = $("#userSubmit").prop("value");
		setCookie("username", value, 365);
	} else {
		setCookie("username", "", -1);
	}
	setCookie("play", "true", 365);
}

function onClickRegister (event) {
	$("#windowRegister").show();
}

function logout () {
	setCookie("username", "", -1);
	setCookie("play", "", -1);
}

function onClickRssText (event) {
	$(event.target).focus();
}

function onClickRssSend (event) {
	noopHandler(event);
	var content = $("#rssLink").val();
	
	if (content && content.length > 0) {
		var formdata = new FormData();
		formdata.append("link", content);
		// TODO: add radio buttons for option
		formdata.append("option", 1);
		$.ajax({
			type: "POST",
			data: formdata,
			url: "scripts/fetch_rss.php",
			cache: false,
			contentType: false,
			processData: false,
			success: rssComplete
		});
	}
}

function rssComplete (response, error) {
	console.log(response);
	$("#rssContent").load("apps/rss.php");
}

function setCookie (name, value, exdays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var cookie = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	document.cookie = name + "=" + cookie;
}

function getCookie (name) {
	var i, x, y;
	var ARRcookies = document.cookie.split(";");
	
	for (i = 0; i < ARRcookies.length; i++) {
		x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
		x = x.replace(/^\s+|\s+$/g,"");
		
		if (x == name) {
			return unescape(y);
		}
	}
	
	return null;
}

function checkCookie() {
	var username = getCookie("username");
	
	if (username != null && username != "") {
		alert("Welcome again " + username);
	} else {
		username = prompt("Please enter your name:","");
		
		if (username != null && username != "") {
			setCookie("username", username, 365);
		}
	}
}
	
String.prototype.format = function () {
	var args = arguments;

	return this.replace(
		/{(\d+)}/g, // {i} where i stands for argument number, starting with 0
		function (match, number) {
			return typeof args[number] != "undefined" ? args[number] : match;
		}
	);
};
