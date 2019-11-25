<?php 
session_start();
include('includes/autoload.php'); 
?> 
<?php

      if(isset($_POST['btnLogin'])){
          $username = $_POST['username'];
          $password = $_POST['password'];
          $sql = "SELECT * FROM user WHERE username=? AND password=?";
          $qry = $connection->prepare($sql);
          $qry->bind_param('ss', $username,$password);
          $qry->execute();
          $qry->bind_result($id,$dbu, $dbpass, $dbrole,$dbfname,$dblname);
          $qry->store_result();
          $qry->fetch();
          if($qry->num_rows() == 0) {

             header('location:login.php?error=true');

          }else {
            
              $_SESSION['dbu'] = $dbu;
              $_SESSION['dbfname'] = $dbfname;
              $_SESSION['dblname'] = $dblname;
              $_SESSION['dbrole'] = $dbrole;
              header('location:index.php');
           
          }
        }
    ?>