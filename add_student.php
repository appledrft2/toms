
<?php include('header.php'); ?>



 
<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3>New Student</h3>
		</div>
		<div class="box-body">
			<form action="#" method="POST">
			<div class="row" >
				
				<div class="col-md-6 ">
					<div class="form-group">
						<label>First Name <span style="color:red">*</span></label>
						<input required type="text" class="form-control" name="firstname">
					</div>
					
					
					<div class="form-group">
						<label>Department <span style="color:red">*</span></label>
						<input required type="text" class="form-control" name="department">
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Last Name <span style="color:red">*</span></label>
						<input required type="text" class="form-control" name="lastname">
					</div>
					
					
				</div>
			</div>


		</div>
		<div class="pull-right" style="margin-top:5px">
			<button onclick="history.back()" class="btn btn-danger"> Go Back</button>
			<button name="btnAdd" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
			
		</div>
		
	</div>
 	</form>

 	<?php 

 	if(isset($_POST['btnAdd'])){
 	 		$sql = "INSERT INTO student(firstname,lastname,department) VALUES(?,?,?)";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("sss",$_POST['firstname'],$_POST['lastname'],$_POST['department']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=student_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=student_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

