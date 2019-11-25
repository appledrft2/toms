<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
</head>
<?php 
  if(isset($_GET['id'])){
    include('includes/autoload.php');
    $sql = "SELECT * FROM t_travel_order WHERE id=?";
    $qry = $connection->prepare($sql);
    $qry->bind_param("i",$_GET['id']);
    $qry->execute();
    $qry->bind_result($id,$dbteacher_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks,$totalamount);
    $qry->store_result();
    $qry->fetch ();
  }
  $dformat = date_create($created_at);
  $dformatdep = date_create($dbdeparture);
  $dformatret = date_create($dbreturn);

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
<body onload="window.print()">
  <p style="text-align: center;">Republic of the Philippines</p>
  <p style="text-align: center;"><strong>NORTHERN NEGROS STATE COLLE</strong><strong>GE OF SCIENCE AND TECHNOLOGY</strong></p>
  <p style="text-align: center;">Old Sagay, Sagay City, Negros Occidental</p>
  <p style="text-align: center;"><strong>ITENERARY OF TRAVEL</strong></p>
  <table width="100%">
    <tr>
      <td>
        <p style="text-align: left;">Name: <strong><?php echo $fullname ?></strong></p>
    
      </td>
      <td>
        <p style="text-align: right;">Position: <strong><?php echo $fullposition ?></strong></p>
      </td>
    </tr>
  </table>
  <p style="text-align: left;">Purpose of Travel : <strong><?php echo $dbpurpose ?></strong></p>
  <table border="1" style="width: 100%;">
    <tr style="text-align: center;" >
      <th style="width: 12.5000%;">DATE</th>
      <th style="width: 12.5000%;">PLACES TO BE VISITED</th>
      <th style="width: 12.5000%;">DEPARTURE</th>
      <th style="width: 12.5000%;">ARRIVAL</th>
      <th style="width: 11.1876%;">Means of Trans.</th>
      <th style="width: 16.179%;">Transportation Allowed</th>
      <th style="width: 12.5000%;">Per Diem</th>
      <th style="width: 12.5000%;">TOTAL</th>
    </tr>
  </table>
  <table border="0" style="width: 100%;">
    
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
      echo "<tr style='text-align:center'>";
      echo  "<td style='width: 12.5000%;'><br>";
      if($cnt ==  1){
        echo date_format($dformatdep,"Y/m/d");
      }else{
        echo "";
      }
      echo "<br><br></td>";
      echo  "<td style='width: 12.5000%;'>";
      echo $placestovisit;
      echo "</td>";
      echo  "<td style='width: 12.5000%;'>";
      echo $departure;    
      echo "</td>";
      echo  "<td style='width: 12.5000%;'>";
      echo $arrival;
      echo "</td>";
      echo  "<td style='width: 11.1876%;'>";
      echo $meansoftravel;
      echo "</td>";
      echo  "<td style='width: 16.179%;text-align:right'>";
      echo $allowed;
      echo "</td>";
      echo  "<td style='width: 12.5000%;'>";
     
      echo "</td>";
      echo  "<td style='width: 12.5000%;text-align:right'>";
       echo $total;
      echo "</td>";
      echo "</tr>";
      $sum = $sum + $total;
    }
    $sum = $sum + $diem;
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
                  <td style="text-align:right">
                    <?php echo number_format($diem,2); ?>
                  </td>
                  <td style="text-align:right">
                    <?php echo number_format($diem,2); ?>
                  </td>
                </tr>
              </tr>
              <tr>
                <td colspan="6">
                  
                </td>
                <td style="text-align:right">
                  <strong>TOTAL:</strong>
                </td>
                <td style="text-align:right"><strong><?php echo number_format($sum,2) ?></strong></td>
              </tr>
      <tr>
        <td colspan="8" style="width: 99.8279%;"><br>&nbsp;&nbsp;&nbsp;I certify that (1) I have reviewed the forgoing<br>
          itinerary; (2) the travel is necessary to the service, <br>(3) the period covered is reasonable and (4) <br>the expenses claimed are proper.
          <br>
          <div style="text-align: right">
            <br><u ><span style="text-transform: uppercase;"><?php echo $dbf." ".$dbm[0].". ".$dbl.", "; ?></span><?php echo $dbs; ?></u>
            <br><span style="margin-right:50px">Signature</span>
          </div>
          <br>
          <br><u>RENANTE A. EGCAS, Ph.D</u>
          <div style="margin-left:15px;">Immediate Supervisor</div>
          <p>
            <br>
          </p>
          <div style="text-align:right">
            <p style="margin-right:130px">Approved By:</p>
            <u>ROMULO T. SISNO, Ph.D.</u>
            <br><span style="margin-right:30px">SUC II President</span>
          </div>
          <br>
          <br>
        </td>
      </tr>
    </tbody>
  </table>
  <p style="text-align: center;">
    <br>
  </p>
</body>
</html>