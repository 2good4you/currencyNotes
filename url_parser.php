<?php

function mainMovie(string $url) : void
{
    $parsedUrl = parse_url($url);
    parse_str($parsedUrl['host'], $parsedHost);

    echo json_encode($parsedUrl, JSON_PRETTY_PRINT) . PHP_EOL;

    if ( isset( $parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $parsedQuery);
        echo ('{' . PHP_EOL . 'parsedQuery;' .
            json_encode($parsedQuery, JSON_PRETTY_PRINT) . PHP_EOL .
        '}' . PHP_EOL);
    }
}

$shortopts = "u:";
$longopts = ['url:'];
$argv;

$options = getopt($shortopts, $longopts);

switch (TRUE) {
    case isset($options['u']):
        filter_var($options['u'], FILTER_VALIDATE_URL) ? mainMovie($options['u']) : NULL;
        break;
    case isset($options['url']):
        filter_var($options['url'], FILTER_VALIDATE_URL) ? mainMovie($options['url']) : NULL;
        break;
    case isset($argv[1]):
        filter_var($argv[1], FILTER_VALIDATE_URL) ? mainMovie($argv[1]) : NULL;
        break;
}
