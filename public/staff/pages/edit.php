<?php
 ob_start(); // Output buffering is turned on

 require_once('../../../private/initialize.php');
 
 if (!isset($_GET['id'])) 
 {
   redirect_to(url_for("/staff/pages/index.php"));
 }
 
    $id = $_GET['id'];
    $page_name = '';
    $position = '';
    $visible = '';
 if(is_post_request())
  {
    $page_name = $_POST['page_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Page Name: {$page_name} <br>";
    echo "Position: {$position} <br>";
    echo "Visible: {$visible} <br>";
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
        <dd><input type="text" name="page_name" value="<?php echo $page_name; ?>"></dd>
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
        <input type="submit" value="Edit Page" />
      </div>
    </form>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
