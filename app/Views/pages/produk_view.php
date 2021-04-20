
<h1 class="mt-4">Master Produk</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        <?php echo anchor('/',"Dashboard"); ?>
    </li>
    <li class="breadcrumb-item active">Produk</li>
</ol>
<div style="padding-bottom: 15px;">
    <button id="btn_reload" class="btn btn-primary">Reload</button>
    <button id="btn_add_new" class="btn btn-success">Add New Produk</button>
</div>

<table id="produk_tbl" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    var tbl_produk= $('#produk_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/produk'); ?>",
        "columns":[
            {   "data" : null,
                "render": function ( data, type, full, meta ) {
                    return "<img src='"+data.gambar+"' width='30px'/>"
                }
            },
            { "data" : "nama_produk" },
            { "data" : "kategori.nama_kategori" },
            { "data" : "harga" },
            { "data" : null, defaultContent: '<button class="btn btn-warning btn-edit btn-sm"><i class="fa fa-pencil"></i> Edit </button> <button class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i> delete </button>' },
        ]
    });


    $( "#produk_tbl" ).on('click','tr button', function() {
        let editBtn = $(this).hasClass('btn-edit')
        let deletBtn = $(this).hasClass('btn-delete')
        let data = tbl_produk.row($(this).parents('tr') ).data();

        if(editBtn){
            alert("ini action on edit")
        }

        if(deletBtn){
            $.ajax({
                url:"<?php echo site_url('/api/produk/'); ?>"+data.id,
                method:"POST",
                data:{},
                success:function(data){
                    tbl_produk.ajax.reload(); 
                }
            })
        }
    });

    $("#btn_reload").click(function(){
        tbl_produk.ajax.reload(); 
    })
});
</script>