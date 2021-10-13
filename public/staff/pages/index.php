<?php require_once('../../../private/initialize.php'); ?>

<?php

// find_all() method will return mysqli_query_result and also original data from db table
  list($result_set,$page_records) = find_all("pages"); 
  
?>

<?php $page_title = 'pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Pages</h1>
    <div class="actions">
      <a class="action" href="<?php echo url_for("/staff/pages/new.php"); ?>">Create New Page</a>
    </div>
  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Subject</th>
        <th>Visible</th>
  	    <th>Name</th>
        <th>Content</th>
  	    <th colspan="3">Actions</th>
  	  </tr>

      <?php foreach($page_records as $page) 
            { 
              list($sq_result,$subject) = find_single("subjects",$page['subject_id']); 

        ?>
        <tr>
          <td><?php echo htmlspecialchars($page['id']); ?></td>
          <td><?php echo htmlspecialchars($page['position']); ?></td>
          <td><?php echo ($subject['menu_name']) ?? ''; ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
          <td><?php echo htmlspecialchars($page['menu_name']); ?></td>
    	    <td><?php echo htmlspecialchars($page['content']); ?></td>
          <td><a class="action" href="<?php echo url_for("/staff/pages/show.php?id=".htmlspecialchars(u($page['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for("/staff/pages/edit.php?id=".htmlspecialchars(u($page['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/staff/pages/delete.php?id=".htmlspecialchars(u($page['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
    <?php
      $result_set->free_result();
      $sq_result->free_result();

    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
