Getting started
===============

> To start using Docstrap to write your documentation, first download a copy and then learn how to organize your files and read about how to write your documents.

Download a copy
-----------

Download a copy of Docstrap and unzip it in the folder you will create your documentation.

<a href="docstrap.zip" class="btn btn-primary btn-lg" onclick="_gaq.push(['_trackEvent', 'Docstrap', 'Download']);">Get Docstrap</a>


Organize your files
-------------------

This is a sample of how you can organize the files in your documentation, I suggest to use a folder `/doc` inside your project and then you can separate the document files into some folders as a section of your documentation. This folder use the title inside `index.md` file just to get a better name of your section on menu, if you do not provide one, the folder name will be used to.

<span class="label label-warning">Warning!</span> The file `index.php` is the tool you downloaded here and just need to be on the root of your documentation folder `/doc`.

~~~
Project
├── /doc
    ├── index.md
    ├── document-name.md
    ├── /section
    │	├── index.md
    │	└── document-name.md
    ├── /img
	│	└── image.jpg
    ├── /docstrap
	└── index.php
~~~
