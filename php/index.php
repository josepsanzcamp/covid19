<?php

if(!file_exists("index.html")) {
	console_debug("index.html");
	$html=implode("\n",array(
		"<script>",
		"var lang=navigator.language || navigator.systemLanguage;",
		"lang=lang.toLowerCase();",
		"lang=lang.substr(0,2);",
		"if(lang=='ca') window.location.href='index.ca.html';",
		"else if(lang=='es') window.location.href='index.es.html';",
		"else if(lang=='en') window.location.href='index.en.html';",
		"else window.location.href='index.ca.html';",
		"</script>",
	))."\n";
	file_put_contents("index.html",$html);
	console_debug();
}

?>