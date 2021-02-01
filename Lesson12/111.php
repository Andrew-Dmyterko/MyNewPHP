<?php


$text = '50';
$text1 = '50';
$text = trim($text);

//echo strcasecmp($text, $text1), PHP_EOL;

function mb_strcasecmp($str1, $str2, $encoding = null)
{
    if (null === $encoding) {
        $encoding = mb_internal_encoding();
    }
    return strcmp(mb_strtolower($str1, $encoding), mb_strtolower($str2, $encoding));
}

function utf8_strrev($str)
{
    preg_match_all('/./us', $str, $matches);
    return join('', array_reverse($matches[0]));
}

echo mb_strcasecmp($text, $text1);