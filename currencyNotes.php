<?php


function givenCashMount(array $currencyNotes, int $balance, $index = 0)
{
    $balance / current($currencyNotes) >= 1
        ? printf("%d: %d\n", current($currencyNotes), $balance / current($currencyNotes))
        : NULL;

    if ($balance % current($currencyNotes) == 0) {
        return NULL;
    } else {
        $balance %= current($currencyNotes);
        next($currencyNotes);
        $index++;
        return $index != count($currencyNotes) ? givenCashMount($currencyNotes, $balance, $index) : NULL;
    }
}

if ($input = $argv) {

    $cash = $input[1];
    $currencyNotes = [
        500,
        200,
        100,
        50,
        20,
        10,
        5,
        2,
        1,
    ];

    switch ($cash) {
        case !is_numeric($cash) ;
            echo "Введите целое число" . PHP_EOL;
            break;
        case $cash > 100000 :
            echo 'В банкомате можно получить сумму от 1 - 100 000 грн. Приносим свои извинения' . PHP_EOL;
            break;
        case $cash > 0 && $cash <= 100000 :
            givenCashMount($currencyNotes, $cash);
            break;
        default:
            echo 'Задано неверное значение' . PHP_EOL;
    }

} else {
    echo 'Введите значение! -f ' . PHP_EOL;
}