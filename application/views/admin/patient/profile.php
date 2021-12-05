<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Patient Profile</h4>
                </div>
                <div class="card-body" id="pageContent">          
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Patient ID</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->patient_code ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->pt_name ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->fullname ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->email ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->gender ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->age ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->c_name ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->year ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text"
                                    class="form-control"
                                    value="<?= $information->section ?? '-' ?>"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <div style="margin: 20px 0; background: black; height: 2px"></div>
                        </div>

                        <div class="col-12">
                            <h4>Check-up History</h4>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($checkups AS $cu) : ?>
                                        <tr>
                                            <td><?= $cu['check_up_date'] ?></td>
                                            <td><?= $cu['service_name'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-outline-primary btnView"
                                                    checkUpID="<?= $cu['check_up_id'] ?>">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- /row -->
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    $(document).ready(function() {

        function getCheckupData(checkUpID = 0) {
            let result = [];
            $.ajax({
                method: "POST",
                url: "getCheckupData",
                data: { checkUpID },
                async: false,
                dataType: 'json',
                success: function(data) {
                    result = data;
                }
            })
            return result;
        }


        function formContent(checkUpID = 0) {

            let data = getCheckupData(checkUpID);

            let {
                temperature        = "",
                pulse_rate         = "",
                respiratory_rate   = "",
                blood_pressure     = "",
                random_blood_sugar = "",
                others             = "",
                recommendation     = "",
            } = data && data.checkup;

            let treatmentHTML = '';
            if (data.treatment && data.treatment.length > 0) {
                let treatmentTbody = '';
                data.treatment.map(treat => {
                    let {
                        tooth_number = "",
                        status       = "",
                    } = treat;

                    treatmentTbody += `
                    <tr>
                        <td>${tooth_number}</td>
                        <td>${status}</td>
                    </tr>`;
                });

                treatmentHTML = `
                <div class="col-12">
                    <div style="margin: 20px 0; background: black; height: 2px"></div>
                </div>
                <div class="col-12">
                    <h4>Treatment</h4>
                </div>
                <div class="col-12">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Tooth No.</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${treatmentTbody}
                        </tbody>
                    </table>
                </div>`;
            }

            let medicineHTML = '';
            if (data.medicine && data.medicine.length > 0) {
                let medicineTbody = '';
                data.medicine.map(treat => {
                    let {
                        medicine_name = "",
                        quantity      = "",
                    } = treat;

                    medicineTbody += `
                    <tr>
                        <td>${medicine_name}</td>
                        <td>${quantity}</td>
                    </tr>`;
                });

                medicineHTML = `
                <div class="col-12">
                    <div style="margin: 20px 0; background: black; height: 2px"></div>
                </div>
                <div class="col-12">
                    <h4>Medicine</h4>
                </div>
                <div class="col-12">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${medicineTbody}
                        </tbody>
                    </table>
                </div>`;
            }

            let html = `
            <div class="row p-4">
                <div class="col-12">
                    <h4>Chief Complain</h4>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Temperature</label>
                        <input type="text" 
                            class="form-control" 
                            value="${temperature}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Pulse Rate</label>
                        <input type="text" 
                            class="form-control" 
                            value="${pulse_rate}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Respiratory Rate</label>
                        <input type="text" 
                            class="form-control" 
                            value="${respiratory_rate}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Blood Pressure</label>
                        <input type="text" 
                            class="form-control" 
                            value="${blood_pressure}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Random Blood Sugar</label>
                        <input type="text" 
                            class="form-control" 
                            value="${random_blood_sugar}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Others</label>
                        <input type="text" 
                            class="form-control" 
                            value="${others}"
                            disabled>
                    </div>
                </div>

                ${treatmentHTML}
                ${medicineHTML}

                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label>Recommendation</label>
                        <textarea class="form-control"
                            rows="3"
                            disabled>${recommendation}</textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>`;
            return html;
        }

        $(document).on("click", ".btnView", function() {
            let checkUpID = $(this).attr("checkUpID");
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-lg");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("VIEW CHECK-UP");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(checkUpID);
                $("#modal_content").html(html);
            }, 100);
        })

    })

</script>