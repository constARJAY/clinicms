                <!-- ----- FOOTER ----- -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date('Y') ?> <a href="#" target="_blank" class="text-muted">Clinicms</a>. All rights reserved.</span>
                    </div>
                </footer>
                <!-- ----- END FOOTER ----- -->
            </div>
            <!-- ----- END MAIN CONTENT ----- -->


            <!-- ----- MODAL ----- -->
            <div id="modal" class="modal custom-modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog modal-md mt-5" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h4 class="page-title font-weight-bold"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-light" aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div id="modal_content"></div>
                    </div>
                </div>
            </div>
            <!-- ----- END MODAL ----- -->
        

        </div>
        <!-- ----- END CONTENT ----- -->


    <!-- base:js -->
    <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.pie.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.world.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/peity/jquery.peity.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.flot.dashes.js') ?>"></script>
    <!-- End plugin js for this page-->

    <!-- inject:js -->
    <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
    <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
    <script src="<?= base_url('assets/js/template.js') ?>"></script>
    <script src="<?= base_url('assets/js/settings.js') ?>"></script>
    <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/toastDemo.js') ?>"></script>
    <script src="<?= base_url('assets/js/desktop-notification.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.redirect.js') ?>"></script>
    <!-- endinject -->

    <!-- DataTables -->
    <script src="<?= base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
    <!-- End DataTables -->

    <!-- Font Awesome -->
    <script defer src="<?= base_url('assets/js/brands.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/solid.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/fontawesome.js') ?>"></script>

    <script src="<?= base_url('assets/js/system-operations.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom-general.js') ?>"></script>
</body>
</html>