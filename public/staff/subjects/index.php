<?php require_once('../../../private/initialize.php'); 
  
// find_all() method will return mysqli_query_result and also original data from db table
    list($result_set,$subject_records) = find_all("subjects"); 
    
?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Subjects</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for("/staff/subjects/new.php"); ?>">Create New Subject</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th colspan="3">Actions</th>
  	  </tr>

      <?php foreach($subject_records as $subject) { ?>
        <tr>
          <td><?php echo $subject['id']; ?></td>
          <td><?php echo $subject['position']; ?></td>
          <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo $subject['menu_name']; ?></td>
          <td><a class="action" href="<?php echo url_for("/staff/subjects/show.php?id=".$subject['id']); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for("/staff/subjects/edit.php?id=".$subject['id']); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for("/staff/subjects/delete.php?id=".$subject['id']); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php $result_set->free_result(); ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
