<?php 

if(isset($_GET['id'])){
	include('includes/autoload.php');
	$sql = "DELETE FROM s_iterinary WHERE id=?";
	$qry = $connection->prepare ($sql);
	$qry->bind_param("i",$_GET['id']);
	if($qry->execute()){
		header('location:s_it.php?id='.$_GET['s_tv_id'].'&status=deleted');
	}
}

 ?>