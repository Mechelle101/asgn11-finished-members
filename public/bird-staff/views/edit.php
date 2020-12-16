<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/bird-staff/views/index.php'));
}

$id = $_GET['id'];
$bird = Bird::find_by_id($id);
if($bird == false) {
  redirect_to(url_for('/bird-staff/views/index.php'));
}

if(is_post_request()) {
  // Save record using post parameters
  $args = $_POST['bird'];

  //this will update the records with the form values
  $bird->merge_attributes($args);
  //saves the values back to the database
  $result = $bird->save();

  if($result == true) {
    $session->message('The bird was updated successfully.');
    redirect_to(url_for('/bird-staff/views/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit Bird'; ?>
<?php include(SHARED_PATH . '/bird-staff-header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/bird-staff/views/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Bird</h1>

    <?php echo display_errors($bird->errors); ?>

    <form action="<?php echo url_for('/bird-staff/views/edit.php?id=' . h(u($id))); ?>" method="post">
      <!-- all the forms we are using are in this file -->
      <?php include('form_fields.php'); ?>
      
      <div id="operations">
        <input type="submit" value="Edit Bird" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/bird-staff-footer.php'); ?>
