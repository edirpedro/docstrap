Getting started
===============

> To start using Docstrap to write your documentation, first download a copy and then learn how to organize your files and read about how to write your documents.

Download a copy
-----------

Customize your copy filling with your project name and choosing the options below. You will get a single PHP file to use in your process to document your project. 

<form class="form-horizontal" action="download.php" method="post">	
	<div class="control-group">
		<label class="control-label" for="field-brand">Project Name</label>
		<div class="controls">
			<input type="text" id="field-brand" name="brand">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="field-theme">Theme</label>
		<div class="controls">
			<select id="field-theme" name="theme">
				<option>bootstrap.default.min.css</option>
				<option>bootstrap.amelia.min.css</option>
				<option>bootstrap.cerulean.min.css</option>
				<option>bootstrap.cosmo.min.css</option>
				<option>bootstrap.cyborg.min.css</option>
				<option>bootstrap.journal.min.css</option>
				<option>bootstrap.readable.min.css</option>
				<option>bootstrap.simplex.min.css</option>
				<option>bootstrap.slate.min.css</option>
				<option>bootstrap.spacelab.min.css</option>
				<option>bootstrap.spruce.min.css</option>
				<option>bootstrap.superhero.min.css</option>
				<option>bootstrap.united.min.css</option>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="field-lang">Language</label>
		<div class="controls">
			<select id="field-lang" name="lang">
				<option value="en">English</option>
				<option value="pt-br">Português do Brasil</option>
			</select>
		</div>
	</div>
	
	<div class="form-actions">
		<button class="btn btn-primary" type="submit" onclick="_gaq.push(['_trackEvent', 'Docstrap', 'Download']);">Download</button>
	</div>
</form>


Organize your files
-------------------

This is a sample of how you can organize the files in your documentation, I suggest to use a folder `/doc` inside your project and then you can separate the document files into some folders as a section of your documentation. This folder use the title inside `index.md` file just to get a better name of your section on menu, if you do not provide one, the folder name will be used to.

<span class="label label-important">Important!</span> The file `index.php` is the tool you downloaded here and just need to be on the root of your documentation folder `/doc`.

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
	└── index.php
~~~
