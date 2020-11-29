              <footer class="col-sm-12">
                <p class="pull-right">ECS TEAM</p>
              </footer>
            </div><!-- close div id wrapper -->
          </div><!-- close div id page-wrapper -->

          <script type='text/javascript' src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/js/responsive.bootstrap.min.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/toastr/build/toastr.min.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/js/calendar.js"></script>
          <script type='text/javascript' src="<?php echo base_url();?>assets/datepicker/js/bootstrap-datepicker.js"></script>


          <script>
          $(document).ready(function() {
           $('#myTable').DataTable();
         } );
          </script>

          <!-- Success notification  -->
          <?php if($this->session->flashdata('success')): ?>
          <script type="text/javascript">
          toastr.success("<?=$this->session->flashdata('success');?>","Success");
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          </script>
        <?php endif ?>


        <!-- error notification  array-->
        <?php if(isset($validation_errors)) {
          if(count($validation_errors)) {
            foreach ($validation_errors as $key => $validation_error) {
              ?>
              <script type="text/javascript">
              toastr.error("<?=$validation_error?>" ,"Warning");

              toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              </script>

              <?php
            }
          }
        }
        ?>


        <!-- Errors notification  -->
        <?php if($this->session->flashdata('errors')): ?>
        <script type="text/javascript">
        toastr.error("<?=$this->session->flashdata('errors');?>","Warning");
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        </script>
      <?php endif ?>

      <?php if($this->session->flashdata('warning')): ?>
      <script type="text/javascript">
      toastr.warning("<?=$this->session->flashdata('warning');?>","Warning");
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      </script>
    <?php endif ?>

    <script type="text/javascript">
      $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
         return this.href == url;
       }).parent().addClass('active');
      });
    </script> 

  </body>
  </html>
