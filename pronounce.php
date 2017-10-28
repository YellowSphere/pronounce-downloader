<?php

    $customWord = readline("Enter a word: ");
    $data = file_get_contents('https://dictionary.cambridge.org/dictionary/english/'.$customWord);

    /*
    example for word kebab:

    listen to American pronunciation
    https://dictionary.cambridge.org/media/english/us_pron/u/usk/uskab/uskabuk025.mp3

    listen to British pronunciation
    https://dictionary.cambridge.org/media/english/uk_pron/u/ukk/ukkaz/ukkazak005.mp3
    */

    $html = htmlspecialchars($data);
    $pos = strpos($html, "listen to American pronunciation");

    if ($pos === false) {
        echo "Entered wrong word: ".$customWord."\n";
    } else {
        echo $pos;
    }
