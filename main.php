<?php

echo "Name of your file: ";
$txtFile = readline();

if (is_dir("sounds") === false) {
    echo "Creating folder for sounds...";
    mkdir("sounds");
    mkdir("sounds/us/");
    mkdir("sounds/uk/");
    echo " Ok!\n";
}
echo "What pronunciation do u want? [us]/[uk]";
$choice = readline();

if ( preg_match_all('/([a-zA-Z]+)/i', file_get_contents("./$txtFile"), $customWord) )
    foreach ($customWord[0] as $match) {
        $data = file_get_contents("https://dictionary.cambridge.org/dictionary/english/$match");
        $html = htmlspecialchars($data);

        if ( $choice == "us" )
            preg_match('/https.*.us_pron.*.mp3/i', $html, $mp3);
        else
            preg_match('/https.*.uk_pron.*.mp3/i', $html, $mp3);

        if ($mp3[0])
            echo "Downloading $match...";
        else
            continue;

        file_put_contents("sounds/$choice/$match.mp3",
            fopen("$mp3[0]", 'r'));

        echo("\nDone!\n");
    }
else
    echo "$txtFile not found. Exit.";
