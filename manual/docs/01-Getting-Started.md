Getting Started
===============

> To start using Docstrap to write your documentation, first download a copy and then learn how to organize your files and read about how to write your documents.

Download a Copy
-----------

Download a copy of Docstrap and unzip it in the folder you will create your documentation.

<a href="https://github.com/edirpedro/docstrap/archive/master.zip" class="btn btn-primary btn-lg" onclick="_gaq.push(['_trackEvent', 'Docstrap', 'Download']);">Get Docstrap</a>


Organize Your Files
-------------------

This is a sample of how you can organize the files in your documentation. First you have the folder `/manual` that you can rename to your needs. Use the folder `/docs` to create your documents and separate the files into some folders as a section of your documentation. To name pages and folders, type as you read but replace `spaces` to `-` or `_` and use numbers at the begining to define the position like `01-Name`. The file `index.md` is your Homepage.

~~~
Project
├── /manual
	├── /docs
    │	├── index.md
	│	├── 01-Document-Name.md
    │	├── /Section
	│	│	└── Document-Name.md
    ├── /img
	│	└── image.jpg
    ├── /docstrap
    ├── .htaccess
	└── index.php
~~~

Basic Configuration
-------------------

Open `/docstrap/docstrap.php` and replace the variable `$brand` with your Projoect Name, then change `$base` to the Base URL used to access your documentation.