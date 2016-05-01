<?php
// Require the class with the correct path
require('keepcalm.class.php');

echo "Hey you!\n";

// Initialize
$kc = new KeepCalm("have a*nice day");
// Output in the page
$kc->show();