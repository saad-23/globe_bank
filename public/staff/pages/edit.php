<?php
 ob_start(); // Output buffering is turned on

 require_once('../../../private/initialize.php');
 
   if (!isset($_GET['id'])) 
   {
     redirect_to(url_for("/staff/pages/index.php"));
   }
 
   $id = $_GET['id'];
   if(is_post_request())
    {
      $page = [];
      $page['id'] = $id;
      $page['menu_name'] = $_POST['menu_name'] ?? '';
      $page['position'] = $_POST['position'] ?? '';
      $page['subject_id'] = $_POST['subject_id'] ?? '';
      $page['visible'] = $_POST['visible'] ?? '';
      $page['content'] = $_POST['content'] ?? '';

      $result = update_record("pages",$page);
      if ($result === true) 
      {
        redirect_to(url_for("/staff/pages/index.php")); 
      }
      else
      {
        $errors = $result;
      }

    }
    else{
      
      // fetch specific page w.r.t id
       list($pgsq_result,$page) = find_single("pages",$id);
       $pgsq_result->free_result();

    }
    // Fetch all subjects for subject dropdown
       list($sq_result,$subjects) = find_all("subjects");
      // Fetch all subjects for subject dropdown
       list($pq_result,$pages) = find_all("pages");
       $total_pages = $pq_result->num_rows;

        $sq_result->free_result();
       $pq_result->free_result();
  

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/pages/index.php"); ?>">&laquo; Back to list</a>
  <div class="page edit">
    <h1>Edit Page</h1>
    <?php echo display_errors($errors);  ?>
    <form action="<?php echo url_for("/staff/pages/edit.php?id=".htmlspecialchars(u($id))); ?>" method="POST">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo get_field_value('menu_name',$page); ?>"></dd>
      </dl>
      <dl>
        <dt>Position:</dt>
        <dd>
          <select name="position">
            <?php
              $selected = '';
              for($i=1; $i <= $total_pages; $i++) 
              { 
                $selected = get_field_value("position",$page) == $i ? 'selected' : '';
                echo "<option value='{$i}' $selected>{$i}</option>";
              }

            ?>
          </select>
        </dd>
      </dl>
       <dl>
        <dt>Subject:</dt>
        <dd>
          <select name="subject_id">
            <option disabled>select subject</option>
            <?php 
              $selected = ''; 
              foreach ($subjects as $subject) 
              {
                $selected = get_field_value("subject_id",$page) == $subject['id'] ? 'selected' : ''; 
                
                echo "<option value='{$subject['id']}' $selected>
                        {$subject['menu_name']}
                      </option>";
              }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Page Description</dt>
        <dd>
          <textarea name="content" rows="5">
            <?php echo $page['content']; ?> 
          </textarea>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo get_field_value("visible",$page) == 1 ? 'checked' : ''; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
