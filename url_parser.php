<?php

$shortopts = "u:";
$longopts = ['url:'];

$options = getopt($shortopts, $longopts);
$argv;

print_r($options);
print_r($argv);
$result = filter_var($options, FILTER_VALIDATE_URL);

print_r($result);
