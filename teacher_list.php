<?php $title = "Teacher List" ?>
<?php include('header.php'); ?>


 
<!-- Main content -->
<section class="content">
	<?php 
		if(isset($_GET['status'])){
			if($_GET['status'] == 'created'){
				echo '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <p><i class="icon fa fa-check"></i>  Record Successfully Added.</p>
	               
	              </div>';
			}if($_GET['status'] == 'updated'){
				echo '<div class="alert alert-info alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <p><i class="icon fa fa-info"></i>  Record Successfully Updated.</p>
	               
	              </div>';
			}if($_GET['status'] == 'deleted'){
				echo '<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <p><i class="icon fa fa-remove"></i>  Record Successfully Deleted.</p>
	               
	              </div>';
			}
		}
	?>

	<div class="box">
		<div class="box-header">
			<h3>Teacher List</h3>
			<span class="pull-right"><a href="add_teacher.php" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Teacher</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead style="background-color: #222d32;color: white">
				<tr>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Position</th>
					<th>Department</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM teacher ORDER BY department ASC";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbf, $dbl, $dbp, $dbd,$dbm,$dbs);
					$qry->store_result();
					while($qry->fetch ()) {
						echo"<tr>";
						echo"<td>";
						echo $dbf;
						echo"</td>";
						echo"<td>";
						echo $dbl;
						echo"</td>";
						echo"<td>";
						echo $dbp;
						echo"</td>";
						echo"<td>";
						echo $dbd;
						echo"</td>";
						echo"<td>";
						echo '<a class="btn btn-info btn-sm" href="edit_teacher.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a href="delete_teacher.php?id='.$id.'" ';?>onclick="return confirm('Are you sure?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-remove"></i></a>';
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
 

</section>

<?php include('footer.php'); ?>

