<?php if ($this->session->flashdata('message')) { ?>
<script>
 setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
                    // positionClass: "toast-top-left"
        };
        toastr.success('<?php echo $this->session->flashdata('message') ?>', 'Success');

    }, 1300);
</script>
<!--<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php //echo $this->session->flashdata('message') ?>
</div>-->
<?php } ?>
<?php if ($this->session->flashdata('exception')) { ?>
<script>
 setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
                    // positionClass: "toast-top-left"
        };
        toastr.error('<?php echo $this->session->flashdata('exception') ?>', 'Something Wrong');

    }, 1300);
</script>
<!--<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php //echo $this->session->flashdata('exception') ?>
</div>-->
<?php } ?>
<?php if (validation_errors()) { ?>
<script>
 ///*setTimeout(function () {
 //       toastr.options = {
 //           closeButton: true,
 //           progressBar: true,
 //           showMethod: 'slideDown',
 //           timeOut: 4000
 //                   // positionClass: "toast-top-left"
 //       };
 //       toastr.error('<?php //echo validation_errors() ?>//', 'Validation Error');
 //
 //   }, 1300);*/
</script>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo validation_errors() ?>
</div>
<?php } ?>