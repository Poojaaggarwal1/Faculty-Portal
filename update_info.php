<?php include "static/header.php"?>
<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->facultyProfileDB->profile;
session_start();
$user_id = $_SESSION["id"];

if(isset($_POST["confirm"])){
    $updateResult = $collection->updateOne(
        [ 'userid' => $user_id ],
        [ '$set' => [
                'Name' => $_POST["Name"],
                'Email' => $_POST["Email"],
                'Position' => $_POST["Position"],
                'Department' => $_POST["Department"],
                'ResearchInterests' => $_POST["ResearchInterests"],
                'PictureLink' => $_POST["PictureLink"]
            ],
        ],
        ['upsert' => true]
    );
    header('Location: profile.php');
    exit;
}


if(!isset($_POST["edit"])){
    header("Location: profile.php");
    exit;
}

$document_info = $collection->findOne(
    ['userid' => $user_id],
    ['projection' => [    
        'userid' => 1,
        'Name' => 1,
        'Email' => 1,
        'Position' => 1,
        'Department' => 1,
        'ResearchInterests' => 1,
        'PictureLink' => 1
        ]
    ]
);

?>
<div class="container border shadow mt-5 px-5 py-5">
    <form action="update_info.php" method="post">
        <div class="form-group">
            <label for="Name"><strong>Name</strong></label>
            <textarea class="form-control" id="Name" name="Name" rows="1"><?php echo $document_info['Name'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="Email"><strong>Email</strong></label>
            <textarea class="form-control" id="Email" name="Email" rows="1"><?php echo $document_info['Email'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="Position"><strong>Position</strong></label>
            <textarea class="form-control" id="Position" name="Position" rows="1"><?php echo $document_info['Position'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="Department"><strong>Department</strong></label>
            <textarea class="form-control" id="Department" name="Department" rows="1"><?php echo $document_info['Department'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="ResearchInterests"><strong>ResearchInterests</strong></label>
            <textarea class="form-control" id="ResearchInterests" name="ResearchInterests" rows="3"><?php echo $document_info['ResearchInterests'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="PictureLink"><strong>PictureLink</strong></label>
            <textarea class="form-control" id="PictureLink" name="PictureLink" rows="1"><?php echo $document_info['PictureLink'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-dark" name="confirm">Confirm</button>
    </form>
</div>