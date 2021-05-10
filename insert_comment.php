<?php 
    session_start();
    include "static/header.php"
?>

<?php
echo $_POST['submit'];
if(isset($_POST["submit"]))
{
    $comment_text = $_POST["comment"];

    $application_status = $_SESSION["status_of_application"];
    $user_id = $_SESSION["id"];
    $application_id = $_SESSION["application_id"];
    $user_position = $_SESSION["user_position"];
    $query_to_add_comment = "SELECT insertComment($application_id,'$user_id','$user_position','$comment_text')";
    pg_query($db_connection,$query_to_add_comment);

    $send_to_position = substr($application_status,12,strlen($application_status)-12);
    $query_to_update_status = "UPDATE applications SET status='$send_to_position' WHERE appid=$application_id";
    pg_query($db_connection,$query_to_update_status);

    header("Location: applications.php");
    exit;
}
else
{
    header("Location: applications.php");
    exit;
}

?>

