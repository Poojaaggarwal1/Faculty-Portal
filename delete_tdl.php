<!-- 
    TDL denotes mongoDB documents with [Title, Description, Link] structure.
    Currently, "Researches" and "Achievements" follow this structure.
    This file deals with with deletion of these elements in the faculty profile.
 -->

<?php include "static/header.php"?>

<?php

require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->facultyProfileDB->profile;

if(isset($_POST["Researches"])){
    $to_update = 'Researches';
    $title = $_POST["Researches"];
}
elseif(isset($_POST["Achievements"])){
    $to_update = 'Achievements';
    $title = $_POST["Achievements"];
}
else{
    header("Location: profile.php");
}

session_start();
$user_id = $_SESSION['id'];

$collection->updateOne( 
    ["userid" => $user_id],
    ['$pull' => 
        [ $to_update => ["Title" => $title] ]
    ]
);

header("Location: profile.php");
exit;

?>