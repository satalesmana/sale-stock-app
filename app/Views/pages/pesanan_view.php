
<h1 class="mt-4">Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        <?php echo anchor('/',"Dashboard"); ?>
    </li>
    <li class="breadcrumb-item active">Pesanan Open</li>
</ol>
<div style="padding-bottom: 15px;">
    <button id="btn_reload" class="btn btn-primary">Reload</button>
    <button id="btn_add_new" class="btn btn-success">Add New Produk</button>
</div>

<table id="pesanan_tbl" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pemesan</th>
            <th>Tanggal Pesanan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Nama Pemesan</th>
            <th>Tanggal Pemesan</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    var tbl_pesanan= $('#pesanan_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/pesanan'); ?>",
        "columns":[
            { "data" : "id" },
            { "data" : "nama" },
            { "data" : "tgl_pesanan" },
            { "data" : null, defaultContent: '<button class="btn btn-warning btn-edit btn-sm"><i class="fa fa-pencil"></i> Edit </button> <button class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i> delete </button>' },
        ]
    });
});
</script>