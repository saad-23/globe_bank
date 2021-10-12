<?php require_once('../../../private/initialize.php'); ?>

<?php
	$id = $_GET['id'] ?? '1'; // In PHP > 7.0 

	list($query_result,$page) = find_single("pages",$id);

	list($query_result,$subject) = find_single("subjects",$page['subject_id']);

	$query_result->free_result();

?>


<?php $page_title = 'Show page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<a class="back-link" href="<?php echo url_for("/staff/pages/index.php"); ?>">&laquo; Back to List</a>
	<div class="page show">
		<h1>Page Title: <?php echo $page['menu_name']; ?></h1>
		<div class="attributes">
			<dl>
				<dt>Page:</dt>
				<dd><?php echo $page['menu_name']; ?></dd>
			</dl>
			<dl>
				<dt>Position:</dt>
				<dd><?php echo $page['position']; ?></dd>
			</dl>
			<dl>
				<dt>Subject Name:</dt>
				<dd><?php echo $subject['menu_name']; ?></dd>
			</dl>
			<dl>
				<dt>Visible:</dt>
				<dd><?php echo $page['visible']; ?></dd>
			</dl>
		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>