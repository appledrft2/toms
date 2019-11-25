<?php 

if(isset($_GET['id'])){
	include('includes/autoload.php');
	$sql = "DELETE FROM s_travel_order WHERE id=?";
	$qry = $connection->prepare ($sql);
	$qry->bind_param("i",$_GET['id']);
	if($qry->execute()){
		header('location:s_to_list.php?status=deleted');
	}
}

 ?>