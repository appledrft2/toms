<?php include('header.php'); ?>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3>Generate Reports</h3>
		</div>
		<div class="box-body">
			

			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="pull-right">
						<div class="form-group">
							<label>Select Date:</label>
							<select class="form-control" name="date_select">
								<?php 

								$sql = "SELECT DISTINCT YEAR(created_at) FROM t_travel_order";
								$qry = $connection->prepare($sql);
								$qry->execute();
								$qry->bind_result($year);
								$qry->store_result();
								if($qry->fetch()){
									echo "<option>".$year."</option>";
								}
								?>
							
							</select>
						</div>
					</div>
				</div>
				<a href="#" class="col-lg-3 col-xs-6" onclick="generateReport('Daily')">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h4>Daily Report</h4>

		              <p> &nbsp;</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-stats-bars"></i>
		            </div>
		           
		          </div>
		        </a>
		        <a href="#" class="col-lg-3 col-xs-6" onclick="generateReport('Weekly')">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h4>Weekly Report</h4>

		              <p> &nbsp;</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-stats-bars"></i>
		            </div>
		           
		          </div>
		        </a>
		        <a href="#" class="col-lg-3 col-xs-6" onclick="generateReport('Monthly')">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h4>Monthly Report</h4>

		              <p> &nbsp;</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-stats-bars"></i>
		            </div>
		           
		          </div>
		        </a>
		        <a href="#" class="col-lg-3 col-xs-6" onclick="generateReport('Annual')">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h4>Annual Report</h4>

		              <p> &nbsp;</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-stats-bars"></i>
		            </div>
		           
		          </div>
		        </a>
			</div>
		</div>
	</div>
</section>




<?php include('footer.php'); ?>
<script type="text/javascript">


	function generateReport(mode){
		let date = $('select[name=date_select]').val();
		window.open('print_report.php?mode='+mode+'&date='+date,'newwindow', 'width=500,height=500')
		
	}

</script>

