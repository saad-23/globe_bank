<?php
 ob_start(); // Output buffering is turned on

 require_once('../../../private/initialize.php');
 

 $menu_name = '';
 $position = '';
 $visible = '';

 if(is_post_request())
  {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Menu Name: {$menu_name} <br>";
    echo "Position: {$position} <br>";
    echo "Visible: {$visible} <br>";
  }
  

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/subjects/index.php"); ?>">&laquo; Back to list</a>
  <div class="subject new">
    <h1>Create Subject</h1>
    <form action="<?php echo url_for("/staff/subjects/create.php"); ?>" method="POST">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $menu_name; ?>"></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1" <?php echo ($position == 1) ? 'selected' : ''; ?>>1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo ($visible == 1) ? 'checked' : ''; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
