<?php $title = "Teacher Itinerary" ?>
<?php include('header.php'); ?>

<?php 
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM t_travel_order WHERE id=?";
		$qry = $connection->prepare($sql);
		$qry->bind_param("i",$_GET['id']);
		$qry->execute();
		$qry->bind_result($id,$dbteacher_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks,$totalamount);
		$qry->store_result();
		$qry->fetch ();
	}
	$dformatdep = date_create($dbdeparture);
?>
<?php 
    $sql = "SELECT id,firstname,lastname,position,department,middlename,salutation FROM teacher WHERE id=?";
    $qry = $connection->prepare($sql);
     $qry->bind_param("i",$dbteacher_id);
    $qry->execute();
    $qry->bind_result($id,$dbf,$dbl, $dbp, $dbd,$dbm,$dbs);
    $qry->store_result();
    $qry->fetch();

    $fullname = $dbf." ".$dbm[0].". ".$dbl." ".$dbs;
    $fullposition = $dbp.", ".$dbd;
?>
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
<!-- Main content -->
<section class="content">
	
	<div class="box">
		<h3 class="box-header text-right"><a onclick="window.open('t_it_print.php?id=<?php echo $_GET['id'] ?>', 
                         'newwindow', 
                         'width=500,height=500'); 
              return false;"  class="btn btn-primary"><i class="fa fa-print"></i> Print Itinerary</a></h3>
		<div class="box-body">
			<p style="text-align: center;">Republic of the Philippines</p>
			<p style="text-align: center;"><strong>NORTHERN NEGROS STATE COLLE</strong><strong>GE OF SCIENCE AND TECHNOLOGY</strong></p>
			<p style="text-align: center;">Old Sagay, Sagay City, Negros Occidental</p>
			<center><h3>ITINERARY OF TRAVEL</h3></center>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="" class="form-control" value="<?php echo $fullname ?>">
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Position:</label>
						<input type="text" name="" class="form-control" value="<?php echo $fullposition ?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Purpose of Travel:</label>
						<input type="text" name="" class="form-control" value="<?php echo $dbpurpose ?>">
					</div>
				</div>

			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>DATE</th>
						<th>PLACES TO BE VISITED</th>
						<th>DEPARTURE</th>
						<th>ARRIVAL</th>
						<th>Means of Trans.</th>
						<th>Transportation Allowed</th>
						<th>Per Diem</th>
						<th>Total</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM t_iterinary WHERE t_tv_id=?";
						$qry = $connection->prepare($sql);
						$qry->bind_param('i',$_GET['id']);
						$qry->execute();
						$qry->bind_result($id,$t_tv_id,$placestovisit,$departure,$arrival,$meansoftravel,$allowed,$total);
						$qry->store_result();
						$cnt=0;
						$sum = 0;
						while($qry->fetch ()) {
							$cnt++;
							echo "<form method='POST' action='#'>";
							echo "<tr>";
							echo "<td>";
							echo "<input type='hidden' name='id' value='".$id."'> ";
							if($cnt == 	1){
								echo date_format($dformatdep,"Y/m/d");
							}else{
								echo "";
							}
							echo "</td>";
							echo "<td>";
							echo "<input required name='placestovisitupdate' type='text' value='".$placestovisit."' class='form-control'>";
							echo "</td>";
							echo "<td>";
							echo "<input required name='departureupdate' type='text' value='".$departure."' class='form-control timepicker'>";
							echo "</td>";
							echo "<td>";
							echo "<input required name='arrivalupdate' type='text' value='".$arrival."' class='form-control timepicker'>";
							echo "</td>";
							echo "<td>";
							echo "<input required name='meansoftravelupdate' type='text' value='".$meansoftravel."' class='form-control'>";
							echo "</td>";
							echo "<td class='text-right'>";
							echo "<input required name='allowedupdate' type='number' value='".$allowed."' class='form-control allowed'>";
							echo "</td>";
							echo "<td class='text-right'>";
							echo "";
							echo "</td>";
							echo "<td class='text-right'>";
							echo number_format($total,2);
							echo "</td>";
							echo "<td>";
							echo '<button type="submit" name="btnUpdate" class="btn btn-info btn-sm "><i class="fa fa-edit"></i></button> ';
							echo '<a href="t_ti_delete.php?id='.$id.'&t_tv_id='.$_GET['id'].'" ';?>onclick="return confirm('Are you sure?')"<?php echo 'class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>';
							echo "</td>";
							echo "</tr>";
							echo "</form>";

							$sum = $sum + $total;
						}
						$sum = $sum + $diem;
						$updatetotal = "UPDATE t_travel_order SET total=? WHERE id=?";
						$qry2 = $connection->prepare($updatetotal);
						$qry2->bind_param("si",$sum,$_GET['id']);
						$qry2->execute();
					?>
					<tr>
						<tr>
							<td >
								<?php 
								if($cnt==0){
									echo date_format($dformatdep,"Y/m/d");
								}
								 ?>
								
							</td>
							<td colspan="5">
								
							</td>
							<td >
								<?php echo number_format($diem,2); ?>
							</td>
							<td>
								<?php echo number_format($diem,2); ?>
							</td>
						</tr>
					</tr>
					<form method="POST" action="#">
						<tr>
							<td><input type="hidden" name="t_tv_idadd" value="<?php echo $_GET['id'] ?>"></td>
							<td><input required placeholder="Enter Places to be visited" type="text" class="form-control" name="placestovisitadd"></td>
							<td><input required placeholder="Enter Departure" value="departure" type="text" class="form-control timepicker" name="departureadd"></td>
							<td><input required placeholder="Enter Arrival" value="departure" type="text" class="form-control timepicker" name="arrivaladd"></td>
							<td><input required placeholder="Enter Means of travel" type="text" class="form-control" name="meansoftraveladd"></td>
							<td><input required placeholder="Enter Trans. Allowed" type="number" class="form-control" name="transallowedadd"></td>
							<td></td>
							<td></td>
							<td><button type="submit" name="btnAdd" class="btn btn-success btn-sm btn-block"><i class="fa fa-check"></i></button></td>
						</tr>
					</form>
					<tr>
						<td colspan="6">
							
						</td>
						<td>
							<strong>Total:</strong>
						</td>
						<td class="text-right"><?php echo number_format($sum,2) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php 

if(isset($_POST['btnAdd'])){
	$sql = "INSERT INTO t_iterinary(t_tv_id,placetovisit,departure,arrival,meansoftrans,transallowed,total) VALUES(?,?,?,?,?,?,?)";
	$qry = $connection->prepare($sql);
	$qry->bind_param("issssss",$_POST['t_tv_idadd'],$_POST['placestovisitadd'],$_POST['departureadd'],$_POST['arrivaladd'],$_POST['meansoftraveladd'],$_POST['transallowedadd'],$_POST['transallowedadd']);

	if($qry->execute()){
		echo '<meta http-equiv="refresh" content="0; URL=t_it.php?id='.$_POST['t_tv_idadd'].'&status=created">';
	}
}if(isset($_POST['btnUpdate'])){
	$sql = "UPDATE t_iterinary SET placetovisit=?,departure=?,arrival=?,meansoftrans=?,transallowed=?,total=? WHERE id=?";
	$qry = $connection->prepare($sql);
	$qry->bind_param('ssssssi',$_POST['placestovisitupdate'],$_POST['departureupdate'],$_POST['arrivalupdate'],$_POST['meansoftravelupdate'],$_POST['allowedupdate'],$_POST['allowedupdate'],$_POST['id']);
	if($qry->execute()){
		echo '<meta http-equiv="refresh" content="0; URL=t_it.php?id='.$_GET['id'].'&status=updated">';
	}
}

 ?>

<?php include('footer.php'); ?>



