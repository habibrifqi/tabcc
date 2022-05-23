<?php
//session_start();
if (!isset($_SESSION['apriori_tncs_id'])) {
    header("location:index.php?menu=forbidden");
}

// require_once('fetch_data.php');
// include_once 'fetch_data.php';
// var_dump($data);
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <!-- <div class="page-header">
                <h1>
                    Data Transaksi
                </h1>
            </div>/.page-header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">data menus</h3>
                        </div>
                        <div class="card-body">
                            <table id="tablemenus" class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Options</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


