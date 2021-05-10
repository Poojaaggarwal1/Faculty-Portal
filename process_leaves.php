<?php include("static/header.php"); ?>

<?php
// Post request after confirming leave application

if(isset($_POST["confirm"])){
    session_start();
    $comment = $_POST["comment"];
    $from_date = $_SESSION["from_date"];
    $to_date = $_SESSION["to_date"];
    $id = $_SESSION["id"];
    $no_of_days = $_SESSION["no_of_days"];
    $retrospective = $_SESSION["retrospective"];
}
else{
    header("Location: apply_leave.php");
    exit;
}

$user_position = $_SESSION["user_position"];

if($user_position == 'Faculty')
{
    $to_be_status = 'HOD';
}
else
{
    $to_be_status = 'Director';
}

$query_to_create_application = "INSERT INTO applications(applicantid,status,startdate,enddate,timing,isretrospective) VALUES ('$id','$to_be_status','$from_date','$to_date',NOW(),$retrospective)";

$query_to_get_application_id = "SELECT appid FROM applications WHERE applicantid='$id' AND status='$to_be_status' AND startdate='$from_date' AND enddate='$to_date' ORDER BY appid DESC";
$result1 = pg_query($db_connection, $query_to_create_application);

if($result1){
    $result2 = pg_query($db_connection, $query_to_get_application_id);
    $row = pg_fetch_row($result2);
    $application_id = $row[0];
}

$query_to_add_comment = "INSERT INTO comments(commentorid,appid,commentorposition,comment,timing) VALUES ('$id','$application_id','Applicant','$comment',NOW())";

$result3 = pg_query($db_connection,$query_to_add_comment);

?>
    <div class="alert alert-success" role="alert">
    Application has been submitted. <a href="applications.php" class="alert-link">Click here to check the Applications section for status.</a>

    </div>

<?php


?>