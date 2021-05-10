<?php #UD
include "static/header.php";

if(!isset($_POST["submit"])){
    header("Location: user.php");
    exit;  
}

$process = $_POST["submit"];
$comment_text = $_POST["comment"];

session_start();
$commentor_position = $_SESSION["user_position"];
$commentor_id = $_SESSION["id"];
$application_id = $_SESSION["application_id"];

#Comment added by User
if(!empty($comment_text))
{
    $query_to_add_comment = "SELECT insertComment($application_id,'$commentor_id','$commentor_position','$comment_text')";
    pg_query($db_connection,$query_to_add_comment);
}


if($process=="approve"){
    $query_to_update_application = "SELECT updateApplicationStatus($application_id,'$commentor_position','approve')";
    $query_to_add_comment = "SELECT insertComment($application_id,'$commentor_id','$commentor_position','SYSTEM GENERATED COMMENT : Approved by $commentor_position')";
}
elseif($process=="reject"){
    $query_to_update_application = "SELECT updateApplicationStatus($application_id,'$commentor_position','reject')";
    $query_to_add_comment = "SELECT insertComment($application_id,'$commentor_id','$commentor_position','SYSTEM GENERATED COMMENT : Rejected by $commentor_position')";
}
elseif($process=="return"){
    $query_to_update_application = "SELECT updateApplicationStatus($application_id,'$commentor_position','return')";
    $query_to_add_comment = "SELECT insertComment($application_id,'$commentor_id','$commentor_position','SYSTEM GENERATED COMMENT : Returned by $commentor_position for more information')";
}

$results = pg_query($db_connection,$query_to_update_application);
$update_results = pg_query($db_connection,$query_to_add_comment);

header("Location: manage_applications.php");
exit;

?>