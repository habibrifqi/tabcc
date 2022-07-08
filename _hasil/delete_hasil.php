<?php 
include('connection.php');

$id = $_POST['id'];
// echo "<pre>";print_r($id);die;


$sql1 = "DELETE FROM itemset3 WHERE id_process='$id'";
$query1 = mysqli_query($con,$sql1);

$sql2 = "DELETE FROM itemset2 WHERE id_process='$id'";
$query2 = mysqli_query($con,$sql2);

$sql3 = "DELETE FROM itemset1 WHERE id_process='$id'";
$query3 = mysqli_query($con,$sql3);

$sql4 = "DELETE FROM confidence WHERE id_process='$id'";
$query4 = mysqli_query($con,$sql4);

$sql = "DELETE FROM process_log WHERE id='$id'";
$query = mysqli_query($con,$sql);

    // header('location:../index.php?menu=hasil');
    $data = array(
        'status' => 'true',
        'result' => 1,
    );

    echo json_encode($data);

?>