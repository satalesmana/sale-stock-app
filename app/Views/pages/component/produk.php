<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="produkLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkLabel">Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button class="btn btn-primary mb-3" id="btn_reload_produk_cmp">Reload</button>
        <table id="produk_componet_tbl" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA PRODUK</th>
                    <th>HARGA</th>
                    <th>AKSI</th>
                </tr>
            </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    var tbl_produk_comp= $('#produk_componet_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/produk'); ?>",
        "columns":[
            { "data" : "id" },
            { "data" : "nama_produk" },
            { "data" : "harga" },
            { "data" : null, defaultContent: '<button class="btn btn-add btn-primary btn-sm"><i class="fa fa-pencil"></i> select </button>' },
        ]
    });

    $('#btn_reload_produk_cmp').click(function(){
      tbl_produk_comp.ajax.reload()
    });

    $( "#produk_componet_tbl" ).on('click','tr button', function() {
        let add = $(this).hasClass('btn-add')
        let data = tbl_produk_comp.row($(this).parents('tr') ).data();
        $("#nama_produk").val(data.id+'-'+data.nama_produk);
        $('#produkModal').modal('toggle');
    });
  });
</script>