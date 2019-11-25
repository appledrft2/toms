
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>Issue Travel Order</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>Student Name <span style="color:red">*</span></label>
						<select required name="student_id" class="form-control select2" style="width: 100%;">
							<option selected disabled value="">Select Student</option>
							<?php 
									$sql = "SELECT id,firstname,lastname,department FROM student";
									$qry = $connection->prepare($sql);
									$qry->execute();
									$qry->bind_result($id,$dbf,$dbl, $dbd);
									$qry->store_result();
									while($qry->fetch ()) {
										echo"<option value='".$id."'>";
										echo $dbf." ".$dbl." - Student , ".$dbd;
										echo"</option>";
									};
							?>
						</select>


				</div>
				<div class="form-group">
					<label>Per Diem </label>
					<input  type="number" class="form-control" name="diem">
				</div>
				<div class="form-group">
					<label>Remarks </label>
					<textarea class="form-control" style="height: 20vh" name="remarks" placeholder="Enter Remarks"></textarea>
				</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Destination <span style="color:red">*</span></label>
						<input required type="text" placeholder="Enter Destination" class="form-control" name="destination">
					</div>
					<div class="form-group">
						<label>Departure <span style="color:red">*</span></label>
						<input required type="date" class="form-control" name="departure">
					</div>
					
					<div class="form-group">
						<label>Return <span style="color:red">*</span></label>
						<input required type="date" class="form-control" name="return" >
					</div>
					<div class="form-group">
						<label>Purpose</label>
						<textarea class="form-control" style="height: 20vh" name="purpose" placeholder="Enter Purpose"></textarea>
					</div>
				</div>
			</div>


		</div>
		<div class="pull-right" style="margin-top:5px">
			<a href="s_to_list.php" class="btn btn-danger"> Go Back</a>
			<button name="btnAdd" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnAdd'])){

 			$checkschedule = "SELECT departure,dreturn FROM s_travel_order WHERE student_id=? ";
 			$qry = $connection->prepare($checkschedule);
 			$qry->bind_param("i",$_POST['student_id']);
 			$qry->execute();
 			$qry->bind_result($dbdeparture,$dbreturn);
 			$conflict=0;
 			while($qry->fetch()){
 				if($_POST['departure'] >= date('Y-m-d')){
	 				if($_POST['departure'] >= $dbdeparture && $_POST['departure'] <= $dbreturn){
			 			$conflict++;
			 			if($conflict==1){
				 			echo "<script>
							alert('Unable to issue travel order due to conflicting schedule.');
							</script>";
			 			}
	 				}if($_POST['departure'] <= $dbdeparture){
	 					$conflict++;
			 			if($conflict==1){
				 			echo "<script>
							alert('Unable to issue travel order due to conflicting schedule.');
							</script>";
			 			}
	 				}
 				}else{
 					$conflict++;
		 			echo "<script>
					alert('Unable to issue travel order, departure cannot be set earlier than today.');
					</script>";
 				}
 					
			}if($conflict==0){
				$sql = "INSERT INTO s_travel_order(student_id,destination,dreturn,departure,purpose,status,created_at,diem,remarks) VALUES(?,?,?,?,?,?,NOW(),?,?)";
				$status = "";
				$qry = $connection->prepare($sql);
				$qry->bind_param("isssssss",$_POST['student_id'],$_POST['destination'],$_POST['return'],$_POST['departure'],$_POST['purpose'],$status,$_POST['diem'],$_POST['remarks']);

				if($qry->execute()) {
				
					echo '<meta http-equiv="refresh" content="0; URL=s_to_list.php?status=created">';
				}else{
					
					echo '<meta http-equiv="refresh" content="0; URL=s_to_list.php?status=error">';
				}
			}
	 	 		

	 	 		
 	 		
 	}
 	?>

</section>



<?php include('footer.php'); ?>

