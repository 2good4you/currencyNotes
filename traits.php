<?php

function url_information($pageurl, $getwhat, $outputformat)
{

    $full_url = $pageurl;

    $pieces = parse_url($full_url);

    if (isset($pieces['host'])) {

        $host_pieces = $pieces['host'];
        $break_host_pieces = explode(".", $host_pieces);

        $full_path = $pieces['path'];
    } else {

        $host_pieces = $pieces['path'];

        $break_path_pieces = explode("/", $host_pieces);
        $path_total_length = count($break_path_pieces) - 1;

        $break_host_pieces = explode(".", $break_path_pieces[0]);
    }

    $url_total_length = count($break_host_pieces) - 1;

    $generic_tld = array(
        'aero', 'asia', 'biz', 'cat', 'com', 'coop', 'info', 'int', 'jobs', 'mobi', 'museum', 'name', 'net',
        'org', 'pro', 'tel', 'travel', 'xxx', 'edu', 'gov', 'mil', 'co'
    );

    $country_tld = array(
        'ac', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as', 'at', 'au', 'aw', 'ax',
        'az', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv',
        'bw', 'by', 'bz', 'ca', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'cr', 'cs',
        'cu', 'cv', 'cx', 'cy', 'cz', 'dd', 'de', 'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'er',
        'es', 'et', 'eu', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr', 'ga', 'gb', 'gd', 'ge', 'gf', 'gg', 'gh', 'gi',
        'gl', 'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn', 'hr', 'ht', 'hu',
        'id', 'ie', 'il', 'im', 'in', 'io', 'iq', 'ir', 'is', 'it', 'je', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh',
        'ki', 'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu',
        'lv', 'ly', 'ma', 'mc', 'md', 'me', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms',
        'mt', 'mu', 'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr',
        'nu', 'nz', 'om', 'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py',
        'qa', 're', 'ro', 'rs', 'ru', 'rw', 'sa', 'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl',
        'sm', 'sn', 'so', 'sr', 'ss', 'st', 'su', 'sv', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk',
        'tl', 'tm', 'tn', 'to', 'tp', 'tr', 'tt', 'tv', 'tw', 'tz', 'ua', 'ug', 'uk', 'us', 'uy', 'uz', 'va',
        'vc', 've', 'vg', 'vi', 'vn', 'vu', 'wf', 'ws', 'ye', 'yt', 'yu', 'za', 'zm', 'zw'
    );

    for ($j = 1; $j <= $path_total_length; $j++) {

        $full_path .= "/" . $break_path_pieces[$j];
    }

    for ($i = 0; $i <= $url_total_length; $i++) {

        if (in_array($break_host_pieces[$i], $generic_tld)) {

            $tld = $break_host_pieces[$i];
            $tld_pos = $i;
        } else if (in_array($break_host_pieces[$i], $country_tld)) {

            $ctld = $break_host_pieces[$i];
            $ctld_pos = $i;
        }
    }

    if ($break_host_pieces[0] == 'www') {


        if ($tld_pos == 2) {
            if ($ctld_pos == 3) {

                $sub_domain = "";
                $domain = $break_host_pieces[1];
                $tld = $break_host_pieces[2];
                $ctld = $break_host_pieces[3];
            } else {

                $sub_domain = "";
                $domain = $break_host_pieces[1];
                $tld = $break_host_pieces[2];
                $ctld = "";
            }
        } else if ($tld_pos == 3) {
            if ($ctld_pos == 4) {

                $sub_domain = $break_host_pieces[1];
                $domain = $break_host_pieces[2];
                $tld = $break_host_pieces[3];
                $ctld = $break_host_pieces[4];
            } else {

                $sub_domain = $break_host_pieces[1];
                $domain = $break_host_pieces[2];
                $tld = $break_host_pieces[3];
                $ctld = "";
            }
        }
    } else {

        if ($tld_pos == 1) {
            if ($ctld_pos == 2) {

                $sub_domain = "";
                $domain = $break_host_pieces[0];
                $tld = $break_host_pieces[1];
                $ctld = $break_host_pieces[2];
            } else {

                $sub_domain = "";
                $domain = $break_host_pieces[0];
                $tld = $break_host_pieces[1];
                $ctld = "";
            }
        } else if ($tld_pos == 2) {
            if ($ctld_pos == 3) {

                $sub_domain = $break_host_pieces[0];
                $domain = $break_host_pieces[1];
                $tld = $break_host_pieces[2];
                $ctld = $break_host_pieces[3];
            } else {

                $sub_domain = $break_host_pieces[0];
                $domain = $break_host_pieces[1];
                $tld = $break_host_pieces[2];
                $ctld = "";
            }
        }
    }

    switch ($getwhat) {

        case "subdomain":

            return json_encode(array('Sub Domain' => $sub_domain));

            break;

        case "domain":

            return json_encode(array('Domain' => $domain));

            break;

        case "tld":

            return json_encode(array('TLD' => $tld));

            break;

        case "country":
            return json_encode(array('CTLD' => $ctld));

            break;

        case "path":
            return json_encode(array('Path' => $full_path));
            break;

        default:
            return json_encode(array('Sub Domain' => $sub_domain, 'Domain' => $domain, 'TLD' => $tld, 'CTLD' => $ctld, 'Path' => $full_path));

    }
}
