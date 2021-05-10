<?php #UD
include "static/header.php"?>

<?php
    if(isset($_POST['view']))
    {
      $application_id = $_POST['view'];
    }
    else{
      header('Location: manage_applications.php');
    }
    
    session_start();
    $id = $_SESSION["id"];
    $user_position = $_SESSION["user_position"];
    $_SESSION["application_id"] = $application_id;
    $query_for_comments = "SELECT commentid,commentorid,commentorposition,appid,comment,timing from comments where appid = '$application_id' ";
  	$results = pg_query($db_connection,$query_for_comments);

    $query_to_get_application_status = "SELECT getApplicationStatus($application_id)";
    $status = pg_fetch_row(pg_query($db_connection,$query_to_get_application_status))[0];
?>
<div class=jumbotron>
    <h4>Status of Application : <strong><?php echo $status?></strong></h4>
</div>

<?php
	while($comment_row = pg_fetch_row($results))
    {
        $comment_id = $comment_row[0];
        $commentor_id = strtoupper($comment_row[1]);
        $commentor_position = $comment_row[2];
        $comment_text = $comment_row[4];
        $timing = $comment_row[5];
?>

<div class="card w-75 mx-auto">
  <div class="card-header">
    <?php echo $commentor_position ?> wrote
  </div>
  <div class="card-body">
    <h6 class="card-title">Name of commentor: <?php echo $commentor_id ?></h6>
    <p class="card-text"><?php echo "$comment_text" ?></p>
  </div>
  <div class="card-footer text-muted">
    Date: <?php echo (substr($timing,0,10))?> Time: <?php echo substr($timing,11,8)?>
  </div>
</div>

<?php
    }

 if($status == $user_position)
 {

?>

  <div class="container border shadow mt-5">
    <form action="update_application.php" method="post">
      <div class="form-group">
          <label for="comment">Enter comment</label>
          <textarea maxlength="1000" class="form-control" id="comment" name="comment" rows="5"></textarea>
      </div>

      <button type="submit" class="btn btn-danger" name="submit" value="reject">Reject the Application</button>
      <button type="submit" class="btn btn-primary" name="submit" value="return">Return back to the Applicant</button>
      <button type="submit" class="btn btn-success" name="submit" value="approve">Approve the Application</button>
    </form>
  </div>

<?php
 } ?>

<?php include "static/footer.php"?>

