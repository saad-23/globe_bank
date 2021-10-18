<?php
 ob_start(); // Output buffering is turned on

 require_once('../../../private/initialize.php');
 
 // Make sure that session must be start before using any session variable
  session_start();
  $errors = ($_SESSION['errors']) ?? "";
  
 list($query_result,$subjects) = find_all("subjects");
  $total_subjects = $query_result->num_rows + 1; 
  $subject = [];
  $subject['position'] = $total_subjects; 
  $query_result->free_result();
  $sub = [];

  
?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/subjects/index.php"); ?>">&laquo; Back to list</a>
  <div class="subject new">
    <h1>Create Subject</h1>
    <?php echo display_errors($errors);  ?>
    <form action="<?php echo url_for("/staff/subjects/create.php"); ?>" method="POST">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php $_POST['menu_name'] ?? ''; ?>"></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              // $selected = '';
              for($i=1;$i<=$total_subjects;$i++) {
                 $selected = get_field_value("position",$sub) == $i ? 'selected' : '';
                 echo "<option value='{$i}' {$selected}>
                          {$i}
                       </option>"; 
              }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo get_field_value("visible",$sub) == 1 ? 'checked' : ''; ?>/>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>
    
  </div>

</div>
<?php  session_destroy(); ?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
