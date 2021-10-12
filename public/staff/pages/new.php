<?php
 ob_start(); // Output buffering is turned on

 require_once('../../../private/initialize.php');

    list($query_result,$pages) = find_all("pages");
    list($query_result,$subjects) = find_all("subjects");
    $total_pages = $query_result->num_rows + 1;
    $page = [];
    $page['position'] = $total_pages;
    $query_result->free_result();
  

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/pages/index.php"); ?>">&laquo; Back to list</a>
  <div class="subject new">
    <h1>Create Page</h1>
    <form action="<?php echo url_for("/staff/pages/create.php"); ?>" method="POST">
      <dl>
        <dt>Page Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo ($menu_name)?? ''; ?>"></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              $selected = '';
              for($i=1; $i <= $total_pages; $i++) 
              { 
                if ($page['position'] == $i) 
                {
                    $selected = 'selected';
                }
                else{
                  $selected = '';
                }  
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
            <option disabled selected>select subject</option>
            <?php  
              foreach ($subjects as $subject) 
              {
                echo "<option value='{$subject['id']}'>
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
          <textarea name="content" rows="5"></textarea>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo (isset($visible) && $visible == 1) ? 'checked' : ''; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
