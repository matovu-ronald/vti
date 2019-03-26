<?php

function mini_logo($sentence)
{
    //Separate words by spaces
    $words = preg_split("/\s+/", $sentence);

    $miniLogo = '';

    foreach ($words as $word) {
        $miniLogo .= $word[0];
    }

    return $miniLogo;
}
