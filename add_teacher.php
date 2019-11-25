
<?php include('header.php'); ?>



 
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
						<input required type="text" class="form-control" placeholder="Enter Firstname" name="firstname">
					</div>
					<div class="form-group">
						<label>Middle Name <span style="color:red">*</span></label>
						<input required type="text" class="form-control" placeholder="Enter Middlename" name="middlename">
					</div>
					<div class="form-group">
						<label>Last Name <span style="color:red">*</span></label>
						<input required type="text" class="form-control" placeholder="Enter Lastname" name="lastname">
					</div>
					
					

					
				</div>
				<div class="col-md-6">
					
					<div class="form-group">
						<label>Extension </label>
						<input  type="text" class="form-control" placeholder="Enter Sr.,Jr.III,PhD,MIT,etc" name="salutation">
					</div>
					<div class="form-group">
						<label>Position <span style="color:red">*</span></label>
						<input required type="text" class="form-control" placeholder="Enter Position" name="position">
					</div>
					<div class="form-group">
						<label>Department <span style="color:red">*</span></label>
						<input required type="text" class="form-control" placeholder="Enter Department" name="department">
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
 	 		$sql = "INSERT INTO teacher(firstname,lastname,position,department,middlename,salutation) VALUES(?,?,?,?,?,?)";
 	 		$qry = $connection->prepare($sql);
 	 		$qry->bind_param("ssssss",$_POST['firstname'],$_POST['lastname'],$_POST['position'],$_POST['department'],$_POST['middlename'],$_POST['salutation']);

 	 		if($qry->execute()) {
 	 		
 	 			echo '<meta http-equiv="refresh" content="0; URL=teacher_list.php?status=created">';
 	 		}else{
 	 			
 	 			echo '<meta http-equiv="refresh" content="0; URL=teacher_list.php?status=error">';

 	 		}
 	}
 	?>

</section>



<?php include('footer.php'); ?>

