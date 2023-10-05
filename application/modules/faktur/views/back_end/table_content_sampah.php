<link rel="stylesheet" href="<?php echo base_url('assets/template/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/') ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">          
   
  <div class="card">
  <div class="card-body">
   
  <a href="#" class="btn btn-sm btn-secondary" onclick="content();"> <i class="fa fa-arrow-left"></i> Kembali</a> <hr>
               
  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>No</th>
                    <th>Tgl Faktur</th>
                    <th>Tgl Input</th>
                    <th>Nomor Faktur</th>
                    <th>Distributor</th>
                    <th>Sumber Dana</th>
                    <th>PJ</th>
                     <th>Tools</th>
                  </tr>
                  </thead>
                <tbody>
                  <?php $i =0; foreach ($data as $k) { $i++;
                  ?>
                 
                  <tr>
                      <td><?= $i; ?></td>
                      <td><?= $k->tgl_faktur?></td>
                      <td><?= $k->tgl_input?></td>
                      <td><?= $k->nomor_faktur?></td>
                      <td><?= $k->nama_distributor?></td>
                      <td><?= $k->nama_sumber_dana?></td>
                      <td> <span class="badge badge-success"><?= $k->nama_pengguna?></span> </td>
                     <td>
                    <a class="btn btn-sm btn-primary"  onclick='restore("<?= $k->id_faktur; ?>");'> <i class="fa fa-spin fa-cog"></i> Restore</a>
                
                    </td>

                  </tr>

                  <?php
                  } ?>
                </tbody>
                  <tfoot>
                  <tr>
                  <th>No</th>
                    <th>Tgl Faktur</th>
                    <th>Tgl Input</th>
                    <th>Nomor Faktur</th>
                    <th>Distributor</th>
                    <th>Sumber Dana</th>
                    <th>PJ</th>
                     <th>Tools</th>
                  </tr>
                  </tfoot>
                </table>

                
              </div>
              <!-- /.card-body -->



  </div>
</div>
          
     
<script src="<?php echo base_url('assets/template/') ?>plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <script>

$("#example1").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });



      </script>