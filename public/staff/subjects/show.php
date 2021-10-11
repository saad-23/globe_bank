<?php require_once('../../../private/initialize.php'); 

	$id = $_GET['id'] ?? '1';

	list($query_result,$subject) = find_single("subjects",$id);

	$query_result->free_result();

?>


<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<a class="back-link" href="<?php echo url_for("/staff/subjects/index.php"); ?>">&laquo; Back to List</a>
	<div class="subject show">
		<h1>Subject Title: <?php echo $subject['menu_name']; ?></h1>
		<div class="attributes">
			<dl>
				<dt>Subject:</dt>
				<dd><?php echo $subject['menu_name']; ?></dd>
			</dl>
			<dl>
				<dt>Position:</dt>
				<dd><?php echo $subject['position']; ?></dd>
			</dl>
			<dl>
				<dt>Visible:</dt>
				<dd><?php echo $subject['visible']; ?></dd>
			</dl>
		</div>
	</div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>