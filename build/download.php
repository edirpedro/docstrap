<?php

// Source
$docstrap = file_get_contents('index.php');

/* Brand
------------------------------------------------------------*/
if(!empty($_POST['brand']))
	$docstrap = str_replace('$brand = \'Docstrap\';', '$brand = \'' . $_POST['brand'] . '\';', $docstrap);


/* Language
------------------------------------------------------------*/
$lang = str_replace(array('..', '/'), '', $_POST['lang']);
$lang = file_get_contents('source/lang/' . $lang . '.json');
$docstrap = str_replace('{LANG}', base64_encode($lang), $docstrap);


/* CSS
------------------------------------------------------------*/
if(empty($_POST['theme']))
	$theme = 'bootstrap.default.min.css';
else
	$theme = str_replace(array('..', '/'), '', $_POST['theme']);

$css = array(
	"source/themes/$theme",
	'source/css/bootstrap-responsive.min.css',
	'source/css/prettify.min.css',
	'source/css/docstrap.min.css'
);

$css_string = null;
foreach($css as $file) {
	$string = file_get_contents($file);
	$css_string	.= "$string \n\n";
}

$docstrap = str_replace('{CSS}', base64_encode($css_string), $docstrap);


/* JavaScript
------------------------------------------------------------*/
$js = array(
	'source/js/jquery.min.js',
	'source/js/jquery-appear.min.js',
	'source/js/prettify.min.js',
	'source/js/docstrap.min.js'
);

$js_string = null;
foreach($js as $file) {
	$string = file_get_contents($file);
	$js_string	.= "$string \n\n";
}

$docstrap = str_replace('{JS}', base64_encode($js_string), $docstrap);
	

/* Send to developer
------------------------------------------------------------*/
header("Cache-Control: public, must-revalidate");
header("Pragma: hack");
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename="index.php"');
header("Content-Transfer-Encoding: binary\n");

echo $docstrap;
