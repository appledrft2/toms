<?php 

if(isset($_GET['id'])){
	include('includes/autoload.php');
	$sql = "DELETE FROM teacher WHERE id=?";
	$qry = $connection->prepare ($sql);
	$qry->bind_param("i",$_GET['id']);
	if($qry->execute()){
		header('location:teacher_list.php?status=deleted');
	}
}

 ?>