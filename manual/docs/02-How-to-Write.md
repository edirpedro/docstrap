How to Write
==================================================
 
Titles
--------------------------------------------------

~~~
Document title (level 1)
========================

Section title (level 2)
-----------------------

### Section sub-title (level 3)

#### Title (level 4)

##### Title (level 5)

###### Title (level 6)
~~~

The result is like you see in this page


Text
--------------------------------------------------

~~~
Lorem ipsum dolor sit amet, consectetur **bold** adipiscing elit. Praesent sed tellus lacus, a eleifend nisl. Sed blandit auctor metus. Nullam at dolor sit amet sapien suscipit tristique a at diam. Donec neque tortor, vehicula sed _italic_ facilisis.

Integer fringilla turpis sit amet `code in line` velit blandit pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.
~~~

Lorem ipsum dolor sit amet, consectetur **bold** adipiscing elit. Praesent sed tellus lacus, a eleifend nisl. Sed blandit auctor metus. Nullam at dolor sit amet sapien suscipit tristique a at diam. Donec neque tortor, vehicula sed _italic_ facilisis.

Integer fringilla turpis sit amet `code` velit blandit pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.


### Text Options

- `**bold**` **Bold** 
- `_italic_` _Italic_
- <code>\`code\`</code> `Code`


Link
--------------------------------------------------

~~~
[Text link](http://www.example.com)
~~~

Or you can use in HTML where `target="_blank"` is used to open the link in a new window, remove it if  you don't need this.

~~~
<a href="http://www.example.com" target="_blank">Text link</a>
~~~

[Text link](#)


Images
--------------------------------------------------

~~~
![Alt text](img/images.png)
~~~

Or you use in HTML

~~~
<img src="img/images.png">
~~~

![picture](img/images.png)


Quotes
--------------------------------------------------

~~~
> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
~~~

> Lorem ipsum dolor sit amet, consectetur adipiscing elit.


Code block
--------------------------------------------------

<pre>
~~~
function name(value) {
	return value;
}
~~~
</pre>


Lists
--------------------------------------------------

### Simple List

~~~
* With an asterisk
- With a minus signal
+ Or with a plus signal
~~~

* With an asterisk
- With a minus signal
+ Or with a plus signal, you choose!

### Numeric List

~~~
1. Lorem ipsum
2. Doler sit
3. Amet
~~~

1. Lorem ipsum
2. Doler sit
3. Amet

### Cascade List

~~~
1. First
	- Lorem ipsum
	- Doler sit
2. Second
	- Amet
~~~

1. First
	- Lorem ipsum
	- Doler sit
2. Second
	- Amet
	

Definition List
--------------------------------------------------

<pre>
First
: Lorem ipsum doler sit amet

Second
: Lorem ipsum doler sit amet

	Content with multiple lines.
	
	~~~
	And a piece of code
	~~~
</pre>

First
: Lorem ipsum doler sit amet

Second
: Lorem ipsum doler sit amet

	Content with multiple lines.
	
	~~~
	And a piece of code
	~~~
	

Tables
--------------------------------------------------

You can write tables using Markdown or using the regular HTML tag `<table>` if you thinks is more confortable.

### Model 1

~~~
| Field   | Type         | Sample           |
| ------- | ------------ | ---------------- |
| Name    | varchar(40)  | John Doe         |
| Email   | varchar(255) | johndoe@site.com |
~~~

| Field   | Type         | Sample           |
| ------- | ------------ | ---------------- |
| Name    | varchar(40)  | John Doe         |
| Email   | varchar(255) | johndoe@site.com |

### Model 2

~~~
|           | Type         | Sample           |
| --------- | ------------ | ---------------- |
| **Name**  | varchar(40)  | John Doe         |
| **Email** | varchar(255) | johndoe@site.com |
~~~

|           | Type         | Sample           |
| --------- | ------------ | ---------------- |
| **Name**  | varchar(40)  | John Doe         |
| **Email** | varchar(255) | johndoe@site.com |

### Model 3

~~~
| Function name | Description                    |
| ------------- | ------------------------------ |
| `help()`      | Display the help window.       |
| `destroy()`   | **Destroy your computer!**     |
~~~

| Function name | Description                    |
| ------------- | ------------------------------ |
| `help()`      | Display the help window.       |
| `destroy()`   | **Destroy your computer!**     |


