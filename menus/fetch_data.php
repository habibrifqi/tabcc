<?php 

include('connection.php');
// $con = mysqli_connect('localhost','root','','tncs_db');

$sql = "SELECT * FROM menus ";
$query = mysqli_query($con,$sql);
$count_all_rows = mysqli_num_rows($query);


// $columns = array(
// 	0 => 'id',
// 	1 => 'nama_menu',
// 	2 => 'password',
// );

if (isset($_POST['search']['value'])) 
{
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE nama_menu like '%".$search_value."%' ";
}

if (isset($_POST['order'])) 
{
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY '".$columns[$column_name]."' ".$order;
}
else{
    $sql .= " ORDER BY id ASC";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}

    $data = array();

    $run_query = mysqli_query($con, $sql);
    $filtered_rows = mysqli_num_rows($run_query);
    while ($row = mysqli_fetch_assoc($run_query)) {
        $subarray = array();
        $subarray[] = $row['id'];
        $subarray[] = $row['nama_menu'];
        $subarray[] = $row['harga'];
        $subarray[] = '<a href="javascript:void();" class="btn btn-sm btn-info">Edit</a><a href="javascript:void();" class="btn btn-sm btn-danger">delete</a>';
        $data[] = $subarray;
    }

    $output = array(
        'draw'=>intval($_POST['draw']),
        'recordsTotal'=> $count_all_rows ,
        'recordsFiltered' => $filtered_rows,
        'data'=>$data
    );
    
    echo json_encode($output);
    // return $data;

?>