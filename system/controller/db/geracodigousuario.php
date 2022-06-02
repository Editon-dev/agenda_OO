<?php
    $none = $_POST['none'];
    $upper = implode('', range('A', 'Z'));
    $lower = implode('', range('a', 'z'));
    $nums = implode('', range(0, 9));

    $alphaNumeric = $upper.$lower.$nums;
    $string = '';
    $len = 6;
    for($i = 0; $i < $len; $i++) {
        $string .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
    }
    $codigo = strval($string);

    echo $codigo;
?>