<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="memberLabel">Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button class="btn btn-primary mb-3" id="btn_reload_member_cmp">Reload</button>
        <table id="member_componet_tbl" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA MEMBER</th>
                    <th>EMAIL</th>
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
    var tbl_member_comp= $('#member_componet_tbl').DataTable( {
        "ajax": "<?php echo site_url('/api/member'); ?>",
        "columns":[
            { "data" : "id" },
            { "data" : "nama_member" },
            { "data" : "email" },
            { "data" : null, defaultContent: '<button class="btn btn-add btn-primary btn-sm"><i class="fa fa-pencil"></i> select </button>' },
        ]
    });

    $('#btn_reload_member_cmp').click(function(){
      tbl_member_comp.ajax.reload()
    });

    $( "#member_componet_tbl" ).on('click','tr button', function() {
        let add = $(this).hasClass('btn-add')
        let data = tbl_member_comp.row($(this).parents('tr') ).data();
        $("#nama_pemesan").val(data.id+'-'+data.nama_member);
        $('#memberModal').modal('toggle');
    });
  });
</script>