<?php 
session_start();
include('connection.php');

$output= array();
$sql = "SELECT * FROM menus ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'nama_menu',
	2 => 'harga',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nama_menu like '%".$search_value."%'";
	$sql .= " OR harga like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();

 
function tambah_nol_didepan($value, $threshold = null)
{
	return sprintf("M"."%0". $threshold . "s",$value);
}

while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	// $sub_array[] = sprintf("M"."%0". 5 . "s",$row['id']);
	$sub_array[] = tambah_nol_didepan($row['id'],5);
	$sub_array[] = $row['nama_menu'];
	$sub_array[] = $row['harga'];
	$sub_array[] = '<button  onclick=editForm(`'.$row["id"].'`); data-id="'.$row["id"].'" class="btn btn-info btn-sm editbtn" id=`"editbtn"`>Edit</button> <button  onclick=deletemenu(`'.$row["id"].'`); data-id="'.$row["id"].'" class="btn btn-danger btn-sm deletebtnMenu" id=`"deletebtnMenu"`>delete</button>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
