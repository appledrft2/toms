
<?php include('header.php'); ?>

<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM t_travel_order WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param("i",$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbteacher_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks);
		$qry->store_result();
		$qry->fetch ();
	}

?>

 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Update Travel Order</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Teacher Name <span style="color:red">*</span></label>
						<select required name="teacher_id" class="form-control select2" style="width: 100%;">
							<option selected disabled value="">Select Teacher</option>
							<?php 
									$sql = "SELECT id,firstname,lastname,position,department,middlename FROM teacher";
									$qry = $connection->prepare($sql);
									$qry->execute();
									$qry->bind_result($id,$dbf,$dbl, $dbp, $dbd,$dbm);
									$qry->store_result();
									while($qry->fetch ()) {
										if($dbteacher_id == $id){
											echo"<option selected value='".$id."'>";
											echo $dbf." ".$dbm[0].". ".$dbl." - ".$dbp." , ".$dbd;
											echo"</option>";
										}else{
											echo"<option  value='".$id."'>";
											echo $dbf." ".$dbm[0].". ".$dbl." - ".$dbp." , ".$dbd;
											echo"</option>";
										}
										
									};
							?>
						</select>
				</div>
				<div class="form-group">
					<label>Per Diem </label>
					<input value="<?php echo $diem?>" type="number" class="form-control" name="diem">
				</div>
				<div class="form-group">
					<label>Remarks </label>
					<textarea class="form-control" style="height: 20vh" name="remarks" placeholder="Enter Remarks"><?php echo $remarks?></textarea>
				</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Destination <span style="color:red">*</span></label>
						<input value="<?php echo $dbdestination?>" required type="text" class="form-control" name="destination">
					</div>
					<div class="form-group">
						<label>Departure <span style="color:red">*</span></label>
						<input value="<?php echo $dbdeparture?>" required type="date" class="form-control" name="departure">
					</div>
					
					<div class="form-group">
						<label>Return <span style="color:red">*</span></label>
						<input value="<?php echo $dbreturn?>" required type="date" class="form-control" name="return" >
					</div>
					<div class="form-group">
						<label>Purpose</label>
						<textarea  class="form-control" style="height: 20vh" name="purpose" placeholder="Enter Purpose"><?php echo $dbpurpose?></textarea>
					</div>
				</div>
			</div>


		</div>
		<div class="pull-right" style="margin-top:5px">
			<a href="s_to_list.php"  class="btn btn-danger"> Go Back</a>
			<button name="btnUpdate" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnUpdate'])){
 	 		$sql = "UPDATE t_travel_order SET teacher_id=?,destination=?,dreturn=?,departure=?,purpose=?,diem=?,remarks=? WHERE id=?";
 	 		$qry = $connection->prepare($sql);

 	 		$qry->bind_param("issssssi",$_POST['teacher_id'],$_POST['destination'],$_POST['return'],$_POST['departure'],$_POST['purpose'],$_POST['diem'],$_POST['remarks'],$_POST['id']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=t_to_list.php?status=updated">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=t_to_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

