<?php
    $us_pron = "https://dictionary.cambridge.org/media/english/us_pron/";
    $uk_pron = "https://dictionary.cambridge.org/media/english/uk_pron/";

    $customWord = readline("Enter a word: ");
    $data = file_get_contents("https://dictionary.cambridge.org/dictionary/english/$customWord");
    $html = htmlspecialchars($data);
    /*
    example for word kebab:

    listen to American pronunciation
    https://dictionary.cambridge.org/media/english/us_pron/u/usk/uskab/uskabuk025.mp3

    listen to British pronunciation
    https://dictionary.cambridge.org/media/english/uk_pron/u/ukk/ukkaz/ukkazak005.mp3
    */

    preg_match('/https:.*.mp3/i', $html, $mp3) or die("Word doesn't exist\n");
    //echo $mp3[0];

    if (is_dir("sounds") === false) {
        mkdir("sounds");
    }

    file_put_contents("sounds/$customWord.mp3",
                fopen("$mp3[0]", 'r'));

    echo("\nDone!\n");
