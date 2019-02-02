<?php

function mainMovie(string $url): void
{


    $parsedUrl = parse_url($url);
    parse_str($parsedUrl['host'], $parsedHost);
    $hostExploaded = explode('.', $parsedUrl['host']);

//    if (count($hostExploaded) === 4) {
//
//    } else {

        $parsedUrl['tld'] = '.' . array_pop($hostExploaded);

        $tlds = ["com", "co", "org", "in", "us", "gov", "mil", "int", "edu", "net", "biz", "info", "example"];

        in_array(end($hostExploaded), $tlds)
            ? $parsedUrl['sld'] = sprintf(".%s%s", array_pop($hostExploaded), $parsedUrl['tld'])
            : NULL;

        $domainParser = isset($parsedUrl['sld']) ? $parsedUrl['sld'] : $parsedUrl['tld'];
        count($hostExploaded) <= 3
            ? $parsedUrl['domain'] = array_pop($hostExploaded) . $domainParser
            : NULL;

     count($hostExploaded) <= 2
            ?$parsedUrl['subdomain'] = array_pop($hostExploaded). '.'. array_pop($hostExploaded)
            : current($hostExploaded);
//    }
// извлекаем формат прикрепленного документа
    $extensionUrlFileFormat = ('/\.\w*$/');
    isset($parsedUrl['path']) ? preg_match($extensionUrlFileFormat, $parsedUrl['path'], $result) : NULL;
    isset($result[0]) ? $parsedUrl['extension'] = $result[0] : NULL;

    echo json_encode($parsedUrl, JSON_PRETTY_PRINT) . PHP_EOL;
// если значение parsedQuery установленно, то выводим его данные
    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $parsedQuery);
        echo('{' . PHP_EOL . 'parsedQuery;' .
            json_encode($parsedQuery, JSON_PRETTY_PRINT) . PHP_EOL .
            '}' . PHP_EOL);
    }
}

$shortopts = 'u:';
$longopts = ['url:'];
$argv;

$options[] = getopt($shortopts, $longopts);

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
