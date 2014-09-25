<?php

/*
Docstrap is a PHP parse documentation that generates a template 
on top of Twitter Bootstrap, reading files written using Markdown language.
 
@website http://github.com/edirpedro/docstrap
@version 3.0
@copyright 2013
@license MIT
*/

class Docstrap {

	// Brand name
	private $brand = 'Docstrap';
	
	// Document base URL
	private $base = '/manual/';
	
	// Document directory
	private $docs = '/docs';
	
	// Application directory
	private $app = '/docstrap';
	
	// List of documents
	private $documents = array();

	// Constructor
	function __construct() {
		$root = dirname(dirname(__FILE__));
		
		$this->docs = $root . $this->docs;
		$this->app = $root . $this->app;

		$this->documents = $this->get_documents($this->docs);
		//print_r($this->documents);
		
		$this->render();
	}
	
	// Get .MD files into an array
	function get_documents($dir, $last_dir = null) {
		$files = array();
		$scan = scandir($dir);

		foreach($scan as $name) {
			if (substr($name, 0, 1) == '.')
				continue;
			
			if ($name == 'index.md')
				continue;
					
			if (substr($name, -3, 3) == '.md')
				array_push($files, array(
					'url' => $this->get_url($name, $last_dir),
					'path' => "$dir/$name",
					'title' => $this->get_title($name)
				));
				
			if (is_dir("$dir/$name"))
				$files[] = array(
					'title' => $this->get_title($name),
					'folder' => $this->get_documents("$dir/$name", $this->filter_path("$dir/$name"))
				);
		}
			
		return $files;
	}

	// Get file or folder title
	function get_title($filename) {	
		$title = preg_replace('/^[\d]+[_|-]/', '', $filename);
		$title = str_replace('.md', '', $title);
		$title = str_replace(array('-', '_'), ' ', $title);
		return $title;
	}
	
	// Get file or folder path to URL
	function get_url($filename, $path) {
		$output = '';
		$url = explode('/', substr("$path/$filename", 1));
		foreach($url as $item) {
			$item = preg_replace('/^[\d]+[_|-]/', '', $item);
			$item = str_replace('.md', '', $item);
			$output .= "/$item";
		}
		$output = $this->base . substr($output, 1);
		$output = strtolower($output);
		return $output;
	}

	// Show on sidebar the list of documents
	function the_menu($documents = array(), $html = null) {
		$request_uri = urldecode($_SERVER['REQUEST_URI']);
		
		if (empty($documents))
			$documents = $this->documents;
												
		foreach($documents as $file) {
			// Dropdown
			if (array_key_exists('folder', $file)) {
				$html .= '<li><a class="sub">' . $file['title'] . ' <span>+</span></a><ul>';
				$html = $this->the_menu($file['folder'], $html);				
				$html .= '</ul></li>';

			// Document
			} else {
				$html .= '<li' . ($file['url'] == $request_uri ? ' class="active"' : null) . '><a href="' . $file['url'] . '">' . $file['title'] . '</a></li>';
			}
		}
		
		return $html;
	}
	
	// Show menu for smartphones
	function the_mobile_menu($documents = array(), $html = null) {
		$html = $this->the_menu();
		$replace = array(
			'<li><a class="sub">' => '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">',
			'<span>+</span></a><ul>' => '<span class="caret"></span></a><ul class="dropdown-menu">'
		);
		$html = str_replace(array_keys($replace), array_values($replace), $html);
				
		return $html;
	}
	
	// Show the content
	function the_content() {
		$request_uri = urldecode($_SERVER['REQUEST_URI']);
		
		if ($request_uri == $this->base) {
			if (file_exists($this->docs . '/index.md')) {
				$document = array(
					'path' => $this->docs . '/index.md',
					'title' => $this->brand
					);
			} else {
				$document = false;
			}
		} else {
			$document = $this->get_document($request_uri);
		}
						
		if ($document) {
			$content = file_get_contents($document['path']);
			$this->document_title = $document['title'];
			$output = Markdown($content);
		} else {
			$this->document_title = 'Page Not Found';
			$output = Markdown('# Page Not Found');
		}
			
		return $output;
	}
		
	// Eliminate Docs directory or another path from a string
	function filter_path($path, $pathname = null) {
		if (!$pathname)
			$pathname = $this->docs;
		
		return str_replace($pathname, '', $path);
	}
	
	// Try to get the document
	function get_document($path, $documents = array()) {
		if (empty($documents))
			$documents = $this->documents;
			
		foreach($documents as $file) {
			if (array_key_exists('folder', $file)) {
				$output = $this->get_document($path, $file['folder']);
				if ($output)
					break;
			} elseif ($file['url'] == $path) {
				$output = $file;
				break;
			} else
				$output = false;
		}
		
		return $output;
	}
	
	// Render the entire template
	function render() {
		$tags = array(
			'{brand}' => $this->brand,
			'{base}' => $this->base,
			'{menu}' => $this->the_menu(),
			'{mobile_menu}' => $this->the_mobile_menu(),
			'{document}' => $this->the_content(),
			'{title}' => $this->document_title
		);
		
		$document = file_get_contents($this->app . '/templates/document.tpl');
		$document = str_replace(array_keys($tags), array_values($tags), $document);
		
		echo $document;
	}

}

// Markdown
include 'markdown.php';

// Init
new Docstrap;
