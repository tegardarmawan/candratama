<footer class="footer">
    © 2024 Candratama Group
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->

<!-- fontawesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery  -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?= base_url() ?>assets/js/detect.js"></script>
<script src="<?= base_url() ?>assets/js/fastclick.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url() ?>assets/js/waves.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.scrollTo.min.js"></script>
<!-- plugins js -->
<script src="<?= base_url() ?>assets/plugins/timepicker/moment.js"></script>
<script src="<?= base_url() ?>assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
<script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/alertify/js/alertify.js"></script>
<script src="<?= base_url() ?>assets/plugins/tiny-editable/mindmup-editabletable.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>assets/js/app.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- jss fixed header tabel -->
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<!-- editable table -->
<script src="<?= base_url() ?>assets/plugins/tabledit/jquery.tabledit.js"></script>


<!-- select2 -->
<script>
    $(".select2").select2({
        width: "100%",
    });
</script>

<!-- Responsive examples -->
<script src="<?= base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js" type="text/javascript"></script>

<script>
    $('#datatable-buttons').DataTable({
        "dom": 'Bfrtip', // Hanya menampilkan tombol yang terkait dengan fitur (b = buttons)
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollY: 270,
        scrollX: 320,
        responsive: true,
    });
</script>
<script>
    $('#editable-table').editableTableWidget({
        scrollY: 270,
        scrollX: 320,
        responsive: true,
    }).find('td:first').focus();
</script>

<!-- plugins init js -->

<!-- Sweet-Alert  -->
<script src="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/pages/sweet-alert.init.js"></script>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>
</body>

</html>