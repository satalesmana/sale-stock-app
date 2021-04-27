
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

<div class="modal fade" id="formProdukModal" tabindex="-1" role="dialog" aria-labelledby="formProdukModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formProdukModalLabel">Form Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_produk" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control"  placeholder="Nama Produk">
                <small id="msg_nama_produk" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" id="cmb_kategori" name="kategori_id" >
                    <option value="">--Pilih Kategori--</option>
                </select>
                <small id="msg_ketegori" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control"  placeholder="Harga">
                <small id="msg_harga" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control"  placeholder="Gambar">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <div id="#pesan_holder"></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_data">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var tbl_produk= $('#produk_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/produk'); ?>",
        "columns":[
            {   "data" : null,
                "render": function ( data, type, full, meta ) {
                    if(data.gambar)
                        return "<img src='"+data.gambar+"' width='30px'/>"
                    else
                        return "-"
                }
            },
            { "data" : "nama_produk" },
            { "data" : "kategori.nama_kategori" },
            { "data" : "harga" },
            { "data" : null, defaultContent: '<button class="btn btn-warning btn-edit btn-sm"><i class="fa fa-pencil"></i> Edit </button> <button class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i> delete </button>' },
        ]
    });


    //ajax untuk mendapatkan dropdown kategori
    $.ajax({
        url:"<?php echo site_url('/api/getcmb-produk'); ?>",
        method:"GET",
        data:{},
        success:function(data){
            let cmb_option='<option option="value">--Pilih Kategori--</option>';
            data.map((d)=>{
                cmb_option +="<option value='"+d.id+"'>"+d.nama_kategori+"</option>"
            })  

            $("#cmb_kategori").html(cmb_option);
        }
    })

    $.fn.clearForm = function(){
        $("#msg_nama_produk").html(" ");
        $("#msg_harga").html(" ");
        $("#msg_ketegori").html(" ");

        $('input').val("");
        $('#cmb_kategori').val("");

    }

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

    $("#btn_add_new").click(function(){
        $("#formProdukModal").modal('toggle')
    })

    $("#save_data").click(function(){
        var form = $('#form_produk')[0];
        var data = new FormData(form);

        $.ajax({
            url:'<?php echo site_url("api/produk/add"); ?>',
            type:'POST',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend:function(){
                $("#pesan_holder").html("Loading....")
            },
            success:function(res){
                $('#formProdukModal').modal('toggle')
                tbl_produk.ajax.reload();

                $(this).clearForm();
            },error:function(err){
                $("#msg_nama_produk").html(" ");
                $("#msg_harga").html(" ");
                $("#msg_ketegori").html(" ");

                if(err.status === 422){
                    $("#msg_nama_produk").html(err.responseJSON[0]?.nama_produk)
                    $("#msg_harga").html(err.responseJSON[0]?.harga)
                    $("#msg_ketegori").html(err.responseJSON[0]?.kategori_id)
                }
            }
        }).done(function(){
            $("#pesan_holder").html("")
        })
    })
});
</script>