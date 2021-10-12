<?php
   ob_start(); // Output buffering is turned on

   require_once('../../../private/initialize.php');

   if (!isset($_GET['id'])) 
   {
     redirect_to(url_for("/staff/subjects/index.php"));
   }

   
   $id = $_GET['id'];

   if(is_post_request())
    {
      $subject = [];
      $subject['id'] = $id;
      $subject['menu_name'] = $_POST['menu_name'] ?? '';
      $subject['position'] = $_POST['position'] ?? '';
      $subject['visible'] = $_POST['visible'] ?? '';
      $result = update_record("subjects",$subject);  
      redirect_to(url_for("/staff/subjects/show.php?id={$subject['id']}"));
 
    }
    else{
      list($query_result,$sub) = find_single("subjects",$id);
      list($query_result,$subjects) = find_all("subjects");
      // print_r($sub);exit();
      $total_subjects = $query_result->num_rows; 
      $query_result->free_result();
    }
    


?>


<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/subjects/index.php"); ?>">&laquo; Back to list</a>
  <div class="subject edit">
    <h1>Edit Subject</h1>
    <form action="<?php echo url_for("/staff/subjects/edit.php?id=".htmlspecialchars(u($id))); ?>" method="POST">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $sub['menu_name']; ?>"></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
             <?php
              $selected = '';
              for($i=1; $i<=$total_subjects;$i++) 
              {
                  if ($sub['position'] == $i) 
                  {
                    $selected = 'selected';
                  }
                  else
                  {
                    $selected = '';

                  }
                  echo "<option value='{$i}' {$selected}>{$i}</option>"; 
                
              }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo ($sub['visible'] == 1) ? 'checked' : ''; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Subject" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
