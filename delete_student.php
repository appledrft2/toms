<?php 

if(isset($_GET['id'])){
	include('includes/autoload.php');
	$sql = "DELETE FROM student WHERE id=?";
	$qry = $connection->prepare ($sql);
	$qry->bind_param("i",$_GET['id']);
	if($qry->execute()){
		header('location:student_list.php?status=deleted');
	}
}

 ?>