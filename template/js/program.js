
'use strict';

$(document).on('click', '[data-toggle2="lightbox"]', function(event) {
	event.preventDefault();
	var toggle=$(this).attr("data-toggle2");
	var gallery=$(this).attr("data-gallery2");
	$('[data-toggle="'+toggle+'"][data-gallery="'+gallery+'"]:first').ekkoLightbox();
});

$(function() {
	var hash=window.location.hash;
	if(hash.substr(0,1)=="#") hash=hash.substr(1);
	$('[data-toggle="lightbox"][data-gallery="'+hash+'"]:first').ekkoLightbox();
});

var lang=window.location.href.split("/").pop().split(".")[1];
$.cookie("lang",lang,{expires:365,path:"/"});

