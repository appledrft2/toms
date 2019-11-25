
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM student ORDER BY department ASC";
		$qry = $connection->prepare($sql);
		$qry->execute();
		$qry->bind_result($id,$dbf, $dbl, $dbd);
		$qry->store_result();
		$qry->fetch ();
	}

?>
 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>New Teacher</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>First Name <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbf ?>" class="form-control" name="firstname">
					</div>
					
		
					<div class="form-group">
						<label>Department <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbd ?>" class="form-control" name="department">
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Last Name <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbl ?>" class="form-control" name="lastname">
					</div>
					
					
				</div>
			</div>


		</div>
		<div class="pull-right" style="margin-top:5px">
			<a href="teacher_list.php" class="btn btn-danger"> Go Back</a>
			<button name="btnUpdate" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE student SET firstname=?,lastname=?,department=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sssi",$_POST['firstname'],$_POST['lastname'],$_POST['department'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=student_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=student_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

