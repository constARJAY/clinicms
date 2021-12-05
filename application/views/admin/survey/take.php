<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Clinic Management System</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.css') ?>">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">

    <!-- jQuery -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    <!-- End jQuery -->

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">

    <script src="<?=base_url('assets/js/sweetalert2.all.min.js')?>"></script>
    <script src="<?=base_url('assets/js/sweetalert2.min.js')?>"></script>
    <!-- End Sweet Alert -->

    <link rel="stylesheet" href="<?= base_url('assets/css/custom-general.css') ?>">

    <style>
        body {
            font-size: 1.15rem;
        }
    </style>
</head>
<body>
    
    <div class="container my-4" style="height: 90vh" id="pageContent">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center">
                    <div>
                        <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                            height="100" width="100">
                    </div>
                    <div class="ml-4">
                        <div>Republic of the Philippines</div>
                        <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
                        <div>Impig, Sipocot, Camarines Sur - 4408</div>
                        <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
                    </div>
                </div>
                <h4 class="text-center my-2">CUSTOMER SATISFACTION SURVEY</h4>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">Name of Office: </label>
                            <input type="text" class="form-control-plaintext border-bottom">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">Date: </label>
                            <input type="text" class="form-control-plaintext border-bottom" readonly value="<?= date("F d, Y") ?>">
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="12">PLEASE CHECK APPROPRIATE BOX</th>
                    </tr>
                    <tr>
                        <th colspan="3" rowspan="2">RATER</th>
                        <th class="text-center">
                            <input type="checkbox" <?= $information->patient_type_id == 2 ? "checked" : "" ?> disabled>
                        </th>
                        <th colspan="3">Student</th>
                        <th class="text-center">
                            <input type="checkbox" <?= $information->patient_type_id == 3 ? "checked" : "" ?> disabled>
                        </th>
                        <th colspan="4">Non-Teaching</th>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <input type="checkbox" <?= $information->patient_type_id == 1 ? "checked" : "" ?> disabled>
                        </th>
                        <th colspan="3">Faculty</th>
                        <th class="text-center">
                            <input type="checkbox" <?= $information->patient_type_id == 4 ? "checked" : "" ?> disabled>
                        </th>
                        <th colspan="4">External Stakeholders</th>
                    </tr>
                </table>

                <div class="mt-4"><b>Dear Respondent:</b></div>
                <div style="text-indent: 50px">Please take a moment to provide us your assessment and suggestions as we would like to give our clients the best services. Using the code below please encircle the number opposite each item that corresponds to your assessment.</div>

                <table class="table table-bordered mt-4 text-center">
                    <tr>
                        <th>5</th>
                        <th>4</th>
                        <th>3</th>
                        <th>2</th>
                        <th>1</th>
                    </tr>
                    <tr>
                        <th>Absolutely Satisfied</th>
                        <th>Highly Satisfied</th>
                        <th>Moderately Satisfied</th>
                        <th>Fairly Satisfied</th>
                        <th>Not satisfied</th>
                    </tr>
                    <tr>
                        <td>Lubos na Kasiya-siya</td>
                        <td>Lubhang Kasiya-siya</td>
                        <td>Kasiya-siya</td>
                        <td>Di gaanong Kasiya-siya</td>
                        <td>Hindi Kasiya-siya</td>
                    </tr>
                </table>

                <table class="table table-bordered mt-4">
                    <tr>
                        <td colspan="7">
                            <b>1. Served with a smile and appropriately dressed.</b>
                            <div>Nagsilbing nakangiti, disente at agkop ang kasuotan</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q1" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q1" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q1" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q1" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q1" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>2. Observed clean, organized office with appropriate facilites and visible and clear information</b>
                            <div>May malinis, maayos at angkop na pasilidad sa opisina at nakakakitaan ng malinaw na impormasyon</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q2" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q2" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q2" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q2" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q2" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>3. Rendered on time service.</b>
                            <div>Nagbigay ng servisyo sa tamang oras</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q3" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q3" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q3" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q3" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q3" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>4. Delivered accurate service</b>
                            <div>Nagbigay ng tamang serbisyo</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q4" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q4" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q4" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q4" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q4" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>5. Provide quick services.</b>
                            <div>Nagbigay ng mabilis na serbisyo</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q5" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q5" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q5" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q5" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q5" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>6. Handled request, complaints and solution/s to problem with flexibility</b>
                            <div>Natugunan ang mga kahilingan, reklamo at nagbigay ng solusyon ang mga problemang naayon sa sitwasyo</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q6" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q6" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q6" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q6" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q6" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>7. Observed trust and confidentiality</b>
                            <div>Pairalin ang tiwala at pagiging konpidensyal</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q7" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q7" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q7" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q7" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q7" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>8. Demonstrated courtesy and competence</b>
                            <div>Nagpakitang paggalang at kagalingan</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q8" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q8" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q8" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q8" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q8" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>9. Made the client feel important</b>
                            <div>Ipinaramdam ang pagpapahalaga sa kliyente</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q9" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q9" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q9" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q9" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q9" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <b>10. Spoke clearly, and used appropriate langeuage</b>
                            <div>Nakipag-usap ng malinaw at tamang pananalita</div>
                        </td>
                        <td class="text-center">
                            <div>5</div>
                            <input type="radio" name="q10" value="5">
                        </td>
                        <td class="text-center">
                            <div>4</div>
                            <input type="radio" name="q10" value="4">
                        </td>
                        <td class="text-center">
                            <div>3</div>
                            <input type="radio" name="q10" value="3">
                        </td>
                        <td class="text-center">
                            <div>2</div>
                            <input type="radio" name="q10" value="2">
                        </td>
                        <td class="text-center">
                            <div>1</div>
                            <input type="radio" name="q10" value="1">
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    <b>Please give your comments and suggestion/s for the improvement of our services. Thank you very much!</b>
                    <div>Maaaring magbigay ng mungkahi at puna para sa lalong ikabubuti ng aming serbisyo. Maraming salamat po!</div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" id="btnSave" surveyID="<?= $surveyID ?>">Save</button>
            </div>
        </div>

    </div>

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

    <script>

        $(document).ready(function() {

            let questions = ["q1", "q2", "q3", "q4", "q5", "q6", "q7", "q8", "q9", "q10"];

            function displayThankYou() {
                let html = `
                <div class="d-flex justify-content-center align-items-center flex-column h-100">
                    <img src="<?= base_url('assets/images/modal/thank.svg') ?>"
                        height="200" width="200" alt="Thank you">
                    <h3 class="mt-3">THANK YOU FOR THE SURVEY!</h3>
                </div>`;
                $('#pageContent').html(html);
            }

            function validateSurvey() {
                let flag = true;
                questions.map(q => {
                    if (!$(`[name="${q}"]:checked`).val()) flag = false;
                })
                if (!flag) {
                    showNotification("danger", "Please complete the survey.");
                }
                return flag;
            }

            function getSurveyData() {
                let data = [];
                questions.map(q => {
                    data.push({
                        question: q,
                        answer: $(`[name="${q}"]:checked`).val()
                    });
                })
                return data;
            }

            $(document).on("click", "#btnSave", function() {
                let surveyID = $(this).attr("surveyID");
                let validate = validateSurvey();
                if (validate) {
                    let data = {
                        surveyID,
                        data: getSurveyData(),
                    };
                    Swal.fire({
                        title: "SAVE SURVEY", 
                        text: "Are you sure you want to submit this survey?",
                        imageUrl: `<?= base_url() ?>assets/images/modal/add.svg`,
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#1a1a1a',
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes',
                    }).then(function(res) {
                        if (res.isConfirmed) {
                            $.ajax({
                                method: "POST",
                                url: `saveSurvey`,
                                dataType: 'json',
                                async: true,
                                data,
                                success: function(data) {
                                    let result = data.split("|");
                                    if (result[0] == "true") {
                                        Swal.fire({
                                            icon:  'success',
                                            title: "Successfully saved",
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(function() {
                                            displayThankYou();
                                        });
                                    } 
                                }
                            })
                        }
                    })
                }
            })

        })

    </script>

</body>
</html>