
<?php include('header.php'); ?>

<?php 

$sql = "SELECT count(*) FROM teacher";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($tcount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

 ?>
 <?php 

$sql = "SELECT count(*) FROM student";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($scount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

$sql = "SELECT count(*) FROM t_travel_order";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($ttocount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}
$sql = "SELECT count(*) FROM s_travel_order";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($stocount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

$totalto = $ttocount + $stocount;

$sql = "SELECT count(*) FROM t_travel_order WHERE status = 'Approved'";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($attocount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}
$sql = "SELECT count(*) FROM s_travel_order WHERE status = 'Approved'";
$qry = $connection->prepare($sql);
$qry->execute();
$qry->bind_result($astocount);
$qry->store_result();
$qry->fetch();
if($qry->num_rows() == 0) {
	echo "cannot fetch data";
}

$atotalto = $attocount + $astocount;

 ?>



 
<!-- Main content -->
<section class="content">

	<div class="row">
	        <div class="col-md-3 col-sm-6 col-xs-12">
	          <div class="info-box">
	            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Teacher</span>
	              <span class="info-box-number"><?php echo $tcount ?></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	        <!-- /.col -->
	        <div class="col-md-3 col-sm-6 col-xs-12">
	          <div class="info-box">
	            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Student</span>
	              <span class="info-box-number"><?php echo $scount ?></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	        <!-- /.col -->
	         <div class="col-md-3 col-sm-6 col-xs-12">
	          <div class="info-box">
	            <span class="info-box-icon bg-aqua"><i class="fa fa-list"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Issued TO's</span>
	              <span class="info-box-number"><?php echo $totalto ?></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	        <!-- /.col -->
	        <div class="col-md-3 col-sm-6 col-xs-12">
	          <div class="info-box">
	            <span class="info-box-icon bg-aqua"><i class="fa fa-check"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Approved TO's</span>
	              <span class="info-box-number"><?php echo $atotalto ?></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	        <!-- /.col -->

	        <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /. box -->
            </div>
            <!-- /.col -->

	</div>
 

</section>


<?php include('footer.php'); ?>

<?php include('fullcalendar.php'); ?>

