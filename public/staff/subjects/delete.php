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
     
      $result = delete_record("subjects",$id);  
      redirect_to(url_for("/staff/subjects/index.php"));
 
    }
    else{
      list($query_result,$subject) = find_single("subjects",$id);

    }
    


?>


<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/subjects/index.php"); ?>">&laquo; Back to list</a>
  <div class="subject delete">
      <h1>Delete Subject</h1>
      <h2>Menu Name: <?php echo ($subject['menu_name']) ?? ''; ?></h2>
      <p>Are you sure to delete this subject???</p>
      <form action="<?php echo url_for("/staff/subjects/delete.php?id=".htmlspecialchars(u($id))); ?>" method="POST">
        <div id="operations">
          <input type="submit" value="Delete Subject" />
        </div>
      </form>  
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
