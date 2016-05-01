<?php
// Require the class with the correct path
require('keepcalm.class.php');

// Initialize
$kc = new KeepCalm("hello*world!");
// Output in a file
$kc->save();