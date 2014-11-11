<?php


function config()
{
    // ----- Dailymotion account settings -----//
    $d_apiKey       = 'e3cdd2d4176cfd9a6606';
    $d_apiSecret    = 'eb8bc1f29a895f26f04c9da105acfa90e527066c';
    $d_user         = 'romaincoeur';
    $d_password     = 'azerty1234';
//$videoTestFile = '/path/to/video/test.mp4';


// ----- DB settings -----//
    $db_server      = "parent-nounou.fr";
    $db_username    = "innovedu_comptin";
    $db_password    = "Z%u[fI_iE1T-";
    $db_name        = "innovedu_comptines_DEV";



    return array(
        'dailymotion' => array(
            'apiKey'    => $d_apiKey,
            'apiSecret' => $d_apiSecret,
            'user'      => $d_user,
            'password'  => $d_password,
        ),
        'db' => array(
            'server'    => $db_server,
            'username'  => $db_username,
            'password'  => $db_password,
            'name'      => $db_name,
        )
    );
}