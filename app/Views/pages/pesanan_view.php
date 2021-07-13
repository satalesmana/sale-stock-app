
<h1 class="mt-4">Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        <?php echo anchor('/',"Dashboard"); ?>
    </li>
    <li class="breadcrumb-item active">Pesanan Open</li>
</ol>
<div style="padding-bottom: 15px;">
    <button id="btn_reload" class="btn btn-primary">Reload</button>
    <button id="btn_add_new" class="btn btn-success">Add New Order</button>
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


<div class="modal fade" id="newOrder" tabindex="-1" aria-labelledby="newOrderLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newOrderLabel">Form Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_pemesanan">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="text-align: right;">Nama Pemesan</label>
                <div class="col-sm-9">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" placeholder="Nama Pemesan" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="brs_pemesan">Browse</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" style="text-align: right;" class="col-sm-3 col-form-label">Tgl Pesan</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_pesan">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="text-align: right;">Nama Produk</label>
                <div class="col-sm-9">
                    <div class="input-group mb-3">
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" readonly placeholder="Nama Produk">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="brs_produk">Browse</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label style="text-align: right;" class="col-sm-3 col-form-label">Jumlah Pesanan</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="number" name="qty" id="qty" class="form-control" name="qty">
                        </div>
                        <div class="col-sm-5">
                            <button type="button" id="btn_add_item" class="btn btn-primary">Add Item</button>
                            <button type="button" id="btn_reload_item" class="btn btn-warning">Reload</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label style="text-align: right;" class="col-sm-3 col-form-label">&nbsp;</label>
                <div class="col-sm-9">
                    <table id="order_item_tbl" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA PRODUK</th>
                                <th>QTY</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>NAMA PRODUK</th>
                                <th>QTY</th>
                                <th>AKSI</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?= view('pages/component/produk'); ?>
<?= view('pages/component/member'); ?>

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

    var tbl_pesanan_detail= $('#order_item_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/keranjang'); ?>",
        "columns":[
            { "data" : "id" },
            { "data" : "nama_produk" },
            { "data" : "qty" },
            { "data" : null, defaultContent: '<button type="button" class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i> delete </button>' },
        ]
    });

    $("#btn_add_new").click(function(){
        $('#newOrder').modal('toggle')
    });

    $("#brs_produk").click(function(){
        $('#produkModal').modal('toggle')
    })

    $("#brs_pemesan").click(function(){
        $('#memberModal').modal('toggle')
    });

    $("#btn_reload_item").click(function(){
        tbl_pesanan_detail.ajax.reload();
    })

    $("#btn_add_item").click(function(){

        $.ajax({
            url:'<?php echo site_url('api/keranjang'); ?>',
            data: $('#form_pemesanan').serialize(),
            dataType:'json',
            method:'POST',
            success:function(){
                $("#nama_produk").val("");
                $("#qty").val("");
                tbl_pesanan_detail.ajax.reload();
            }
        })
    });

    $( "#order_item_tbl" ).on('click','tr button', function() {
        let delte = $(this).hasClass('btn-delete')
        let data = tbl_pesanan_detail.row($(this).parents('tr') ).data();

        $.ajax({
            url:'<?php echo site_url('api/keranjang'); ?>/'+data.id,
            dataType:'json',
            method:'DELETE',
            success:function(){
                tbl_pesanan_detail.ajax.reload();
            }
        })

    })
});
</script>