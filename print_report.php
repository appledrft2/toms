<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body onload="window.print()">
	
	
		<p style="text-align: center;">Republic of the Philippines</p>
		<p style="text-align: center;"><strong>NORTHERN NEGROS STATE COLLE</strong><strong>GE OF SCIENCE AND TECHNOLOGY</strong></p>
		<p style="text-align: center;">Old Sagay, Sagay City, Negros Occidental</p>
		<p style="text-align: center;">TRAVEL ORDER MONITORING SYSTEM</p>

		

		<?php 

		if(isset($_GET['mode']) && isset($_GET['date'])){
			include('includes/autoload.php');
			$date = $_GET['date'];
			$mode = $_GET['mode'];
			$punchline = '';
			$week = strtotime('-7 Days');
			$lastweek = date('Y-m-d',$week);
			$sql="";
			$sql2="";
			$sql3="";

			if($mode =='Daily'){
				$sql = "SELECT * FROM t_travel_order WHERE DAY(created_at) = DAY(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$sql3 = "SELECT * FROM s_travel_order WHERE DAY(created_at) = DAY(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$punchline = "DAILY REPORT<br> FOR<br> ".date('M d, Y');
			}if($mode =='Weekly'){
				$sql = "SELECT * FROM t_travel_order WHERE DATE(created_at) BETWEEN ".$lastweek." AND DATE(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$sql3 = "SELECT * FROM s_travel_order WHERE DATE(created_at) BETWEEN ".$lastweek." AND DATE(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$punchline = "WEEKLY REPORT <br>FOR <br>".$lastweek." TO ".date('Y-m-d');
			}
			if($mode =='Monthly'){
				$sql = "SELECT * FROM t_travel_order WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$sql3 = "SELECT * FROM s_travel_order WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = ? AND status = 'Approved'";
				$punchline = "MONTHLY REPORT<br> FOR<br> ".date('F').", ".$date;
			}if($mode =='Annual'){
				$sql = "SELECT * FROM t_travel_order WHERE YEAR(created_at) = ? AND status = 'Approved'";
				$sql3 = "SELECT * FROM s_travel_order WHERE YEAR(created_at) = ? AND status = 'Approved'";
				$punchline = $date." ANNUAL REPORT ";
			}

			echo '<p style="text-align: center;"><strong style="text-transform: uppercase;">'.$punchline.'</strong></p>';

		}
		?>
		<table border="1" align="center" width="100%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Designation</th>
					<th>Destination</th>
					<th>Departure</th>
					<th>Return</th>
					<th>Purpose</th>
					<th>Date Issued</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 

				    $qry = $connection->prepare($sql);
				    $qry->bind_param("s",$date);
				    $qry->execute();
				    $qry->bind_result($id,$dbteacher_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks,$totalamount);
				    $qry->store_result();
				    
				    while($qry->fetch ()){

				    	$dformat = date_create($created_at);
				    	$dformatdep = date_create($dbdeparture);
				    	$dformatret = date_create($dbreturn);

				    	$sql2 = "SELECT id,firstname,lastname,position,department,middlename,salutation FROM teacher WHERE id=?";
				    	$qry2 = $connection->prepare($sql2);
				    	 $qry2->bind_param("i",$dbteacher_id);
				    	$qry2->execute();
				    	$qry2->bind_result($id,$dbf,$dbl, $dbp, $dbd,$dbm,$dbs);
				    	$qry2->store_result();
				    	$qry2->fetch();
				    	$fullname = $dbf." ".$dbm[0].". ".$dbl." ".$dbs;
						$fullposition = $dbp.", ".$dbd;
						echo "<tr>";
				    	
						echo "<td>".$fullname."</td>";
						echo "<td>".$dbp.", ".$dbd."</td>";
						echo "<td>".$dbdestination."</td>";
						echo "<td>".$dbdeparture."</td>";
						echo "<td>".$dbreturn."</td>";
						echo "<td>".$dbpurpose."</td>";
						echo "<td>".date_format($dformat,"Y/m/d")."</td>";
						echo "<td>".$totalamount."</td>";
					

						
				    	 echo "</tr>";

				    	

				    }

				 ?>
				 <?php 

				     $qry = $connection->prepare($sql3);
				     $qry->bind_param("s",$date);
				     $qry->execute();
				     $qry->bind_result($id,$dbstudent_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks,$totalamount);
				     $qry->store_result();
				     
				     while($qry->fetch ()){

				     	$dformat = date_create($created_at);
				     	$dformatdep = date_create($dbdeparture);
				     	$dformatret = date_create($dbreturn);

				     	$sql2 = "SELECT id,firstname,lastname,department FROM student WHERE id=?";
				     	$qry2 = $connection->prepare($sql2);
				     	 $qry2->bind_param("i",$dbstudent_id);
				     	$qry2->execute();
				     	$qry2->bind_result($id,$dbf,$dbl, $dbd);
				     	$qry2->store_result();
				     	$qry2->fetch();
				     	$fullname = $dbf." ".$dbl;
				 		$fullposition = "Student, ".$dbd;
				 		echo "<tr>";
				     	
				 		echo "<td>".$fullname."</td>";
				 		echo "<td>".$fullposition."</td>";
				 		echo "<td>".$dbdestination."</td>";
				 		echo "<td>".$dbdeparture."</td>";
				 		echo "<td>".$dbreturn."</td>";
				 		echo "<td>".$dbpurpose."</td>";
				 		echo "<td>".date_format($dformat,"Y/m/d")."</td>";
				 		echo "<td>".$totalamount."</td>";
				 	

				 		
				     	 echo "</tr>";

				     	

				     }

				  ?>
			</tbody>
		</table>
</body>
</html>