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
     
      $result = delete_record("pages",$id);  
      redirect_to(url_for("/staff/pages/index.php"));
 
    }
    else{
      list($query_result,$page) = find_single("pages",$id);

    }
    


?>


<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for("/staff/pages/index.php"); ?>">&laquo; Back to list</a>
  <div class="page delete">
      <h1>Delete Page</h1>
      <h2>Menu Name: <?php echo ($page['menu_name']) ?? ''; ?></h2>
      <p>Are you sure to delete this Page???</p>
      <form action="<?php echo url_for("/staff/pages/delete.php?id=".htmlspecialchars(u($id))); ?>" method="POST">
        <div id="operations">
          <input type="submit" value="Delete Page" />
        </div>
      </form>  
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
