KeepCalm Generator
==================

A simple php class using GD library to make simple KeepCalm style images.

Simply use a '*' after a word if you want a new line.

###Basic usage examples

Create a new KeepCalm image:
```php
$kc = new KeepCalm("your text*here!");
```

Export image as a png file:
```php
$kc->save();
```

Return image as stream (for example in a web page):
```php
$kc->show();
```

#### Save file in the same directory of the script:
```php
<?php
// Require the class with the correct path
require('keepcalm.class.php');

// Initialize
$kc = new KeepCalm("hello*world!");
// Output in a file
$kc->save();

```

Example output:

![hello world](examples/helloworld.png)

***

#### Embed image directly to your html output:
```php
<?php
// Require the class with the correct path
require('keepcalm.class.php');

echo "Hey you!\n";

// Initialize
$kc = new KeepCalm("have a*nice day");
// Output in the page
$kc->show();

```
