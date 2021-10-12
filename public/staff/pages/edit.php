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
      $page_name = $_POST['page_name'] ?? '';
      $position = $_POST['position'] ?? '';
      $visible = $_POST['visible'] ?? '';

    }
    else{
      // Fetch all subjects for subject dropdown
       list($query_result,$subjects) = find_all("subjects");
      // fetch specific page w.r.t id
       list($query_result,$page) = find_single("pages",$id);

    }

  

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/pages/index.php"); ?>">&laquo; Back to list</a>
  <div class="page edit">
    <h1>Edit Page</h1>
    <form action="<?php echo url_for("/staff/pages/edit.php?id=".htmlspecialchars(u($id))); ?>" method="POST">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="page_name" value="<?php echo $page['menu_name']; ?>"></dd>
      </dl>
      <dl>
        <dt>Position:</dt>
        <dd>
          <select name="position">
            
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
                if ($page['subject_id'] == $subject['id']) 
                {
                  $selected = 'selected';
                }
                else
                {
                  $selected = '';
                }
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
          <input type="checkbox" name="visible" value="1" <?php echo ($page['visible'] == 1) ? 'checked' : ''; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
