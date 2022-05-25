<?php
session_start();
if (!isset($_SESSION['apriori_tncs_id'])) {
    header("location:index.php?menu=forbidden");
}

// require_once('fetch_data.php');
// include_once 'menus/fetch_data.php';
// var_dump($sql);
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
                            <!-- <h3 class="card-title">data menus</h3> -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-menu">
                                Tambah Menu
                            </button>
                            <button type="button" class="btn btn-primary anehbtn">
                                Tambah Menu
                            </button>
                            <a href="#" data-id="7" class="btn btn-info btn-sm editbtn" id="editbtn">Edit</a>
                        </div>
                        <div class="card-body">
                            <table id="tablemenus" class="table">
                                <thead>
                                    <th>no</th>
                                    <th>nama_menu</th>
                                    <th>harga</th>
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

<div class="modal fade" id="tambah-menu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahMenusForm" action="javascript:void();" method="POST">
                    <div class="form-group">
                        <label for="tambah_nama_menu">Nama Menu</label>
                        <input type="text" class="form-control" id="tambah_nama_menu" placeholder="Nama Menu" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="tambah_harga">Harga</label>
                        <input type="text" class="form-control" id="tambah_harga" placeholder="Harga">
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-menu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">edit Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMenuForm" action="javascript:void();" method="POST">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="trid" name="trid" value="">
                    <div class="form-group">
                        <label for="_nama_menu">Nama Menu</label>
                        <input type="text" class="form-control" id="_nama_menu" placeholder="Nama Menu" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="_harga">Harga</label>
                        <input type="text" class="form-control" id="_harga" placeholder="Harga" value="">
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>