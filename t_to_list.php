<?php $title = "Travel Order List For Teachers" ?>
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
			<h3>Travel Order List For Teachers</h3>
			<span class="pull-right"><a href="t_to_add.php" class="btn btn-success"><i class="fa fa-plus-circle"></i> Issue Travel Order</a></span>
		</div>
		<div class="box-body">
			
		</div>
		<table id="datatable1" class="table table-striped table-bordered">
			<thead style="background-color: #222d32;color: white">
				<tr>
					<th>Name</th>
					<th>Designation</th>
					<th>Destination</th>
					<th>Departure</th>
					<th>Return</th>
					<th>Purpose</th>
					<th width="15%">Status</th>
					<th>Date Issued</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT t_travel_order.id,teacher.firstname,teacher.lastname,teacher.position,teacher.department,t_travel_order.destination,t_travel_order.departure,t_travel_order.dreturn,t_travel_order.purpose,t_travel_order.status,t_travel_order.created_at FROM t_travel_order LEFT JOIN teacher ON t_travel_order.teacher_id = teacher.id;";
					$qry = $connection->prepare($sql);
					$qry->execute();
					$qry->bind_result($id,$dbf,$dbl, $dbp, $dbd,$dbdes,$dbdep,$dbret, $dbpor,$dbstat,$dbcre);
					$qry->store_result();
					while($qry->fetch ()) {
						echo"<tr>";
						echo"<td>";
						echo 'Mr/Mrs.'.$dbf.' '.$dbl;
						echo"</td>";
						echo"<td>";
						echo $dbp.', '.$dbd;
						echo"</td>";
						echo"<td>";
						echo $dbdes;
						echo"</td>";
						echo"<td>";
						echo $dbdep;
						echo"</td>";
						echo"<td>";
						echo $dbret;
						echo"</td>";
						echo"<td>";
						echo $dbpor;
						echo"</td>";
						echo"<td>";
						if($dbstat == ''){
							echo '<div class="btn-group">
				                  <form action="#" method="POST">
				                  <input type="hidden" name="id" value="'.$id.'">
				                  	<button type="button" class="btn btn-secondary">Pending</button>
				                  	<button type="button" class="btn  btn-secondary dropdown-toggle" data-toggle="dropdown">
				                  	  <span class="caret"></span>
				                  	  <span class="sr-only">Toggle Dropdown</span>
				                  	</button>
				                  	<ul class="dropdown-menu" role="menu">
				                  	  <li><button name="btnStatusApproved" class="btn-block" >Approve</button></li>
				                  	  <li><button name="btnStatusDisapproved" class="btn-block" >Disapprove</button></li>
				                  	</ul>
				                  </form>
				                </div>';
						
						}if($dbstat == 'Approved'){
							echo '<div class="btn-group">
								<form action="#" method="POST">
								<input type="hidden" name="id" value="'.$id.'">
				                  <button type="button" style="background-color:green;color:white" class="btn  btn-Success">Approved</button>
				                  <button type="button" style="background-color:green;color:white" class="btn  btn-Success dropdown-toggle" data-toggle="dropdown">
				                    <span class="caret"></span>
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <ul class="dropdown-menu" role="menu">
				                    <li><button name="btnStatusApproved" class="btn-block" >Approve</button></li>
				                  	  <li><button name="btnStatusDisapproved" class="btn-block" >Disapprove</button></li>
				                  </ul>
				                 </form>
				                </div>';
						}if($dbstat == 'Disapproved'){
							echo '<div class="btn-group">
								<form action="#" method="POST">
								<input type="hidden" name="id" value="'.$id.'">
				                  <button type="button" style="background-color:#ca0303;color:white" class="btn  btn-Success">Disapproved</button>
				                  <button type="button" style="background-color:#ca0303;color:white" class="btn  btn-Success dropdown-toggle" data-toggle="dropdown">
				                    <span class="caret"></span>
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <ul class="dropdown-menu" role="menu">
				                    <li><button name="btnStatusApproved" class="btn-block" >Approve</button></li>
				                  	  <li><button name="btnStatusDisapproved" class="btn-block" >Disapprove</button></li>
				                  </ul>
				                 </form>
				                </div>';
						}
						
						echo"</td>";
						echo"<td>";
						$dformat = date_create($dbcre);
						echo date_format($dformat,"Y/m/d");
						echo"</td>";
						echo"<td>";
						if($dbstat == "Approved"){
							echo '<a title="View Itinerary" class="btn btn-success btn-sm" href="t_it.php?id='.$id.'"><i class="fa fa-file-text"></i></a> ';
						}
						?><a title="Print" class="btn btn-warning btn-sm" onclick="window.open('t_to_print.php?id=<?php echo $id ?>', 
                         'newwindow', 
                         'width=500,height=500'); 
              return false;" ><i class="fa fa-print"></i></a> <?php
						echo '<a title="Edit" class="btn btn-info btn-sm" href="t_to_edit.php?id='.$id.'"><i class="fa fa-edit"></i></a>
							<a title="Delete" href="t_to_delete.php?id='.$id.'" ';?>onclick="return confirm('Are you sure?')"<?php echo 'class="btn btn-danger btn-sm" ><i class="fa fa-remove"></i></a>';
						echo"</td>";
						echo"</tr>";
					}

				?>
			</tbody>
		</table>
	</div>
<?php 
	if(isset($_POST['btnStatusApproved'])){
		$status ="Approved";
		$sql = "UPDATE t_travel_order SET status=? WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param("si",$status,$_POST['id']);
		$qry->execute();

		echo '<meta http-equiv="refresh" content="0; URL=t_to_list.php">';

	}if(isset($_POST['btnStatusDisapproved'])){
		$status ="Disapproved";
		$sql = "UPDATE t_travel_order SET status=? WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param("si",$status,$_POST['id']);

		$qry->execute();
		echo '<meta http-equiv="refresh" content="0; URL=t_to_list.php">';

	}
?>

</section>

<?php include('footer.php'); ?>

