
<?php include('header.php'); ?>


<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM teacher WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param("i",$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbf, $dbl, $dbp, $dbd,$dbm,$dbs);
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
						<label>Middle Name <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbm ?>"  class="form-control" placeholder="Enter Middlename" name="middlename">
					</div>
					
					<div class="form-group">
						<label>Last Name <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbp ?>" class="form-control" name="lastname">
					</div>

					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Extension <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbs ?>" class="form-control" name="salutation">
					</div>
					<div class="form-group">
						<label>Position <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbl ?>" class="form-control" name="position">
					</div>
					
					
					<div class="form-group">
						<label>Department <span style="color:red">*</span></label>
						<input required type="text" value="<?php echo $dbd ?>" class="form-control" name="department">
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
 	 		$sql = "UPDATE teacher SET firstname=?,lastname=?,position=?,department=?,middlename=?,salutation=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ssssssi",$_POST['firstname'],$_POST['lastname'],$_POST['position'],$_POST['department'],$_POST['middlename'],$_POST['salutation'],$_GET['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=teacher_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=teacher_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

