<!-- /.container-fluid -->
<footer class="footer text-center">Copyright &copy; Lottie café <?= date('Y'); ?></footer>
</div>
<!-- End Page Content -->

</div>

<script src="../assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="../assets/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="../assets/js/waves.js"></script>
<!--Counter js -->
<script src="../assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!-- chartist chart -->
<script src="../assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="../assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="../assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../assets/js/dashboard1.js"></script>
<script src="../assets/js/custom.min.js"></script>
<script src="../assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Ingin keluar?</h4>
            </div>
            <div class="modal-body">Pilih tombol "Logout" jika Anda ingin mengakhiri sesi</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<style>
    .dataTables_filter {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var t = $('#table').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ],
            "language": {
                "sProcessing": "Sedang memproses ...",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecord": "Maaf data tidak tersedia",
                "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "sSearch": "Cari",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
    });

    $('#btn-refresh').on('click', () => {
        $('#ic-refresh').addClass('fa-spin');
        var oldURL = window.location.href;
        var index = 0;
        var newURL = oldURL;
        index = oldURL.indexOf('?');
        if (index == -1) {
            window.location = window.location.href;

        }
        if (index != -1) {
            window.location = oldURL.substring(0, index)
        }

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#id_menu").change(function() {
            var idMenu = $(this).val();
            $.ajax({
                url: 'menu-harga.php',
                type: 'post',
                data: {
                    id_menu: idMenu
                },
                async: true,
                dataType: 'json',
                success: function(response) {
                    var len = response.length;
                    $("#nm_menu").empty();
                    $("#harga").empty();
                    for (var i = 0; i < len; i++) {
                        var nm_menu = response[i]['nm_menu'];
                        var harga = response[i]['harga'];
                        $("#nm_menu").append("<option value='" + nm_menu + "'></option>");
                        $("#harga").append("<option value='" + harga + "'> Rp " + harga + "</option>");
                    }
                }
            });
        });
    });
</script>

</body>

</html>