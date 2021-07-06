<h1 class="mt-4">Master Kategori</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        <?php echo anchor('/',"Dashboard"); ?>
    </li>
    <li class="breadcrumb-item active">Kategori</li>
</ol>
<div style="padding-bottom: 15px;">
    <button id="btn_reload" class="btn btn-primary">Reload</button>
    <button id="btn_add_new" class="btn btn-success">Add New Kategori</button>
</div>

<table id="kategori_tbl" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<div class="modal fade" id="KategoriModal" tabindex="-1" role="dialog" aria-labelledby="KategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="KategoriModalLabel">Form Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_produk" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_kategori" class="form-control"  placeholder="Nama">
                <small id="msg_nama_kategori" class="form-text text-muted"></small>
            </div>


            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi"></textarea>
                <small id="msg_deskripsi" class="form-text text-muted"></small>
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
    var tbl_kategori= $('#kategori_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/kategori'); ?>",
        "columns":[
            { "data" : "nama_kategori" },
            { "data" : "deskripsi" },
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
        $("#msg_nama_kategori").html(" ");
        $("#msg_deskripsi").html(" ");
        $("#msg_ketegori").html(" ");

        $('input').val("");
        $('#cmb_kategori').val("");

    }

    $( "#kategori_tbl" ).on('click','tr button', function() {
        let editBtn = $(this).hasClass('btn-edit')
        let deletBtn = $(this).hasClass('btn-delete')
        let data = tbl_kategori.row($(this).parents('tr') ).data();

        if(editBtn){
            alert("ini action on edit")
        }

        if(deletBtn){
            $.ajax({
                url:"<?php echo site_url('/api/produk/'); ?>"+data.id,
                method:"POST",
                data:{},
                success:function(data){
                    tbl_kategori.ajax.reload(); 
                }
            })
        }
    });

    $("#btn_reload").click(function(){
        tbl_kategori.ajax.reload(); 
    })

    $("#btn_add_new").click(function(){
        $("#KategoriModal").modal('toggle')
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
                $('#KategoriModal').modal('toggle')
                tbl_kategori.ajax.reload();

                $(this).clearForm();
            },error:function(err){
                $("#msg_nama_kategori").html(" ");
                $("#msg_deskripsi").html(" ");
                $("#msg_ketegori").html(" ");

                if(err.status === 422){
                    $("#msg_nama_kategori").html(err.responseJSON[0]?.nama_kategori)
                    $("#msg_deskripsi").html(err.responseJSON[0]?.harga)
                    $("#msg_ketegori").html(err.responseJSON[0]?.kategori_id)
                }
            }
        }).done(function(){
            $("#pesan_holder").html("")
        })
    })
});
</script>