<?php
include 'base_url.php';
?>



<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo $base_url?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo $base_url?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo $base_url?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo $base_url?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo $base_url?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="<?php echo $base_url?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <!-- Main JS -->
    <script src="<?php echo $base_url?>/assets/js/main.js"></script>
    <!-- Page JS -->
    <script src="<?php echo $base_url?>/assets/js/dashboards-analytics.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- /Core JS -->

<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <script>
       $(document).ready( function () {
       $('#table').DataTable();
      } );
    </script>