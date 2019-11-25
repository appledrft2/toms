<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
</head>
<body onload="window.print()">
  <?php 
    if(isset($_GET['id'])){
      include('includes/autoload.php');
      $sql = "SELECT * FROM t_travel_order WHERE id=?";
      $qry = $connection->prepare($sql);
      $qry->bind_param("i",$_GET['id']);
      $qry->execute();
      $qry->bind_result($id,$dbteacher_id, $dbdestination, $dbdeparture, $dbreturn,$dbpurpose,$status,$created_at,$diem,$remarks,$totalam);
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
  ?>
  <p style="text-align: center;">
    <br>
  </p>
  <p style="text-align: center;"><strong>NORTHERN NEGROS STATE COLLE</strong><strong>GE OF&nbsp;</strong></p>
  <p style="text-align: center;"><strong>SCIENCE AND TECHNOLOGY</strong></p>
  <p style="text-align: center;">Old Sagay, Sagay City, Negros Occidental</p>
  <p style="text-align: right;margin-right:100px;">Date: <strong><?php echo date_format($dformat,"Y/m/d") ?></strong></p>
  <table align="center" border="1" style="width: 50%;">
    <tbody>
      <tr>
        <td style="width: 50%;">
          <div style="text-align: center;"><strong>TRAVEL ORDER</strong></div>
        </td>
      </tr>
    </tbody>
  </table>
  <p>1. Name: <strong><?php echo $dbf.' '.$dbm[0].'. '.$dbl.', '.$dbs ?></strong></p>
  <p>2. Designation: <strong><?php echo $dbp.', '.$dbd ?></strong>&nbsp;</p>
  <p>3. Destination: <strong><?php echo $dbdestination ?></strong>&nbsp;</p>
  <p>4. Departure: <strong><?php echo date_format($dformatdep,"Y/m/d") ?></strong></p>
  <p>5. Date of Return: <strong><?php echo date_format($dformatret,"Y/m/d")?></strong>&nbsp;</p>
  <p>6. Purpose: <strong><?php echo $dbpurpose ?></strong></p>
  <p>
    <br>
  </p>
  <p>7. Per Diem: <strong><?php echo number_format($diem,2) ?></strong></p>
  <p>8. Remarks: <strong><?php echo $remarks ?></strong>&nbsp;</p>

    <br>

  <p>OK AS TO APPROPRIATION:</p>

    <br>

  <div style="text-align:right">
    <p style="margin-right:130px">Recommending Approval:</p>
    <u>RENANTE A. EGCAS, PhD</u><br>
    <span style="margin-right: 20px">Immediate Supervisor</span>
  </div>

    <br>

  <u>MA. CHRISTINA B, DELOS REYES</u>
  <br ><span style="margin-left: 60px">Budget Officer III</span>

    <br>

  <div style="text-align: right">
    <u style="margin-right: 20px">SAMSON M. LAUSA, PhD</u><br>
    <span >Vice President for Admin &amp; Finance</span>
  </div>

    <br>

  <center >
    <p style="margin-right: 180px" >Approved:</p>
    <u>ROMULO T. SISNO., PhD</u><br>
    <span>SUC President II</span>
  </center>
</body>
</html>