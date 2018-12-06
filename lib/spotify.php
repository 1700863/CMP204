<?php

// include_once "./../config.php";

/**
 * Here I am returning an imitation reply from a Spotify API
 * request that has been cleaned so that only relevant data is
 * sent to the front end
 */
$dummyData = '{
    "tracks": [
        "4Y2glvLjQGOb4dXnwm1hQf",
        "5ami95W9OOWQPwrBb5tud5",
        "1Thv8uCYzyOFC7PME9J936",
        "6tC2iHfUlzB2W4ntXXL2BH",
        "6hzwfFKrTabeUsW5SWti17"
    ]
}';

// $response = array();

header('Content-type: application/json');
// echo json_encode(file_get_contents('./../content/data/tracksReply.json'));
// echo json_encode($dumm);
echo $dummyData;
            
?>

