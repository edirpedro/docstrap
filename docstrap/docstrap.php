<?php

/*
Docstrap is a PHP parse documentation that generates a template 
on top of Twitter Bootstrap, reading files written 
using Markdown language.
 
@website http://github.com/edirpedro/docstrap
@version 2.1
@copyright 2013
@license MIT
*/

class Docstrap {

	// Brand name
	private $brand = 'Docstrap';
	
	// Document Root directory
	private $root = null;
	
	// List of documents
	private $documents = array();

	// Constructor
	function __construct() {
		$this->root = dirname(dirname(__FILE__));

		$this->documents = $this->get_files($this->root);
		
		$this->render();
	}
	
	// Get .MD files into an array
	function get_files($dir) {
		$files = array();
		$scan = scandir($dir);
				
		foreach($scan as $name) {
			if(substr($name, 0, 1) == '.')
				continue;
				
			if(substr($name, -3, 3) == '.md')
				$files = array_merge($files, $this->get_file_data($name, $dir));
					
			if(is_dir("$dir/$name")) {
				$path = $this->filter_path("$dir/$name");
				$return = $this->get_files("$dir/$name");
				if(count($return))
					$files[$path] = $return;
			}
		}
			
		return $files;
	}

	// Set for each .MD a proper title
	function get_file_data($filename, $path) {	
		$f = fopen("$path/$filename", 'r');
		$first_line = fgets($f);
		fclose($f);
	
		$title = htmlentities(utf8_decode(trim(str_replace('#', '', $first_line)))); 
		$path = $this->filter_path("$path/$filename");		
	
		return array($path => $title);
	}

	// Show on sidebar the list of documents
	function the_documents($documents = null, $last_path = null) {
		if(!$documents)
			$documents = $this->documents;
												
		foreach($documents as $path => $title) {
			// Dropdown
			if(is_array($title)) {
				if(array_key_exists("$path/index.md", $title))
					$name = $title["$path/index.md"];
				else
					$name = trim(ucwords(str_replace('/', ' ', $this->filter_path($path, $last_path))));

				echo '<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $name . ' <b class="caret"></b></a>
				<ul class="dropdown-menu">';

				$this->the_documents($title, $path);
				
				echo '</ul></li>';

			// Document
			} elseif(basename($path) != 'index.md') {
				echo '<li';
				
				if($_GET['path'] == $path)
					echo ' class="active"';
				
				echo'><a href="?path=' . $path . '">' . $title . '</a></li>';
			}
		}
	}
	
	// Show the content
	function the_content() {
		$path = empty($_GET['path']) ? '/index.md' : $_GET['path'];
			
		if($this->has_document($path))
			$content = file_get_contents($this->root . $path);

		if($content)
			$output = Markdown($content);
		else
			$output = Markdown('# Page Not Found');
			
		// Append source to page
		if(strstr($content, '<!--[source]-->')) {
			$file_path = str_replace('/index.php', $path, $_SERVER['PHP_SELF']);
			$output = str_replace('<!--[source]-->', '<p>&nbsp;</p><p><a class="btn btn-primary" href="' . $file_path . '" target="_blank">Source Code</a></p>', $output);
		}
		
		echo $output;
	}
		
	// Eliminate Root directory or another path from a string
	function filter_path($path, $pathname = null) {
		if(!$pathname)
			$pathname = $this->root;
		
		return str_replace($pathname, '', $path);
	}
	
	// Check if some document really exists on documents list
	function has_document($path, $documents = null) {
		if(!$documents)
			$documents = $this->documents;
					
		foreach($documents as $key => $title) {
			if(is_array($title)) {
				if($this->has_document($path, $title))
					return true;
			} elseif($path == $key)
				return true;
		}
		
		return false;
	}
	
	// Check if there is more than a single document on the list to show or not the sidebar
	function has_documents() {
		return count($this->documents) > 1;
	}
	
	// Render the entire template
	function render() {
		echo '
		<!DOCTYPE html>
		<html>
		<head>
			<title>' . $this->brand . '</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
			<link rel="stylesheet" href="docstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="docstrap/css/bootstrap-responsive.min.css">
			<link rel="stylesheet" href="docstrap/css/prettify.min.css">
			<link rel="stylesheet" href="docstrap/css/docstrap.css">

			<script type="text/javascript" src="docstrap/js/jquery-1.10.2.min.js"></script>
			<script type="text/javascript" src="docstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="docstrap/js/prettify.min.js"></script>
			<script type="text/javascript" src="docstrap/js/jquery-appear.min.js"></script>
			<script type="text/javascript" src="docstrap/js/docstrap.js"></script>

		</head>
		<body>
		
		<nav id="docstrap-header" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./">' . $this->brand . '</a>
			</div>
		
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">';

		echo $this->the_documents();

		echo '</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

		<div id="docstrap-document" class="container">
			<section class="row">';
			
		if($this->has_documents()) {
			echo '<aside class="col-md-3 sidebar hidden-print" role="complementary">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b id="docstrap-panel-title" class="panel-title"></b>
						</div>
						<div class="panel-body">
							<ul id="docstrap-content-list" class="nav nav-list"></ul>
						</div>
					</div>
					<a id="docstrap-gototop" class="btn btn-default" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
				</aside>';
			echo '<article class="content col-md-9" role="main">';
			$this->the_content();
			echo '</article>';
		} else {
			echo '<article class="content col-md-12" role="main">';
			$this->the_content();
			echo '</article>';
		}
		
		echo '</section>
		</div>

		<div id="docstrap-footer" class="container">
			<div class="navbar-inner">
				<p class="navbar-text pull-right"><em>Powered by <a href="http://hub.edirpedro.com.br/docstrap" target="_blank">Docstrap</a></em></p>
			</div>
		</div>

		</body>
		</html>
		';

	}

}

// Markdown
include 'markdown.php';

// Init
new Docstrap;
