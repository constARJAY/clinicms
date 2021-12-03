<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body" id="pageContent">          
                </div>
            </div>
        </div>
    </div>

</div>


<script>


    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let measurementList = getTableData(`clinic_appointments WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableClinicAppointment")) {
                $("#tableClinicAppointment").DataTable().destroy();
            }
            
            var table = $("#tableClinicAppointment")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [	
                        { targets: "thXs", width: 50  },	
                        { targets: "thSm", width: 150 },	
                        { targets: "thMd", width: 250 },	
                        { targets: "thLg", width: 350 },	
                        { targets: "thXl", width: 450 },	
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(`
                clinic_appointments AS ca
                    LEFT JOIN patients AS p USING(patient_id) WHERE ca.is_deleted = 0`,
                `ca.*, p.firstname AS p_firstname, p.middlename AS p_middlename, p.lastname AS p_lastname, p.suffix AS p_suffix`);
            data.map((item, index) => {
                let {
                    clinic_appointment_id = "",
                    patient_id            = "",
                    purpose               = "",
                    is_confirmed          = "",
                    date_appoint          = "",
                    p_firstname           = "",
                    p_middlename          = "",
                    p_lastname            = "",
                    p_suffix              = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${index+1}</td>
                    <td>${p_firstname} ${p_middlename} ${p_lastname} ${p_suffix}</td>
                    <td>${purpose}</td>
                    <td>${is_confirmed}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                clinicAppointmentID="${clinic_appointment_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                clinicAppointmentID="${clinic_appointment_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>   
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableClinicAppointment">
                <thead>
                    <tr class="text-center">
                        <th class="thXs">#</th>
                        <th class="thSm">Full Name</th>
                        <th class="thMd">Purpose</th>
                        <th class="thXs">Status</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableClinicAppointmentTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            $("#tableContent").html(preloader);
            
            setTimeout(() => {
                let content = tableContent();
                $("#tableContent").html(content);
                initDataTables();
            }, 100);
        }
        // ----- END REFRESH TABLE CONTENT -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent">
                    <div class="row mb-4">
                        <div class="col-md-4 col-sm-12"></div>
                        <div class="col-md-8 col-sm-12 text-right">
                            <button class="btn btn-primary"
                                id="btnAdd"><i class="fas fa-plus"></i> Add Appointment</button>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tableContent">${tableContent()}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- MEASUREMENT OPTIONS DISPLAY -----
        function getMeasurementOptionDisplay(measurementID = 0) {
            let html = `<option value="" selected>Select measurement</option>`;
            measurementList.map(measurement => {
                let {
                    measurement_id,
                    name
                } = measurement;

                html += `
                <option value="${measurement_id}"
                    ${measurement_id == measurementID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END MEASUREMENT OPTIONS DISPLAY -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                clinic_appointment_id = "",
                measurement_id    = "",
                name              = "",
                quantity          = "",
                condition         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                clinicAppointmentID="${clinic_appointment_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                clinicAppointmentID="${clinic_appointment_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Equipment Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="name"
                            minlength="2"
                            maxlength="20"
                            value="${name}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Measurement <code>*</code></label>
                        <select class="form-control validate"
                            name="measurement_id"
                            required>
                            ${getMeasurementOptionDisplay(measurement_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Quantity <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="quantity"
                            minlength="2"
                            maxlength="20"
                            value="${quantity}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Condition <code>*</code></label>
                        <textarea class="form-control validate"
                            name="condition"
                            minlength="2"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${condition}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                ${buttonSaveUpdate}
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>`;

            return html;
        }
        // ----- END FORM CONTENT -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD CARE EQUIPMENT");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let clinicAppointmentID = $(this).attr("clinicAppointmentID");
            let data = getTableData(`clinic_appointments WHERE clinic_appointment_id = ${clinicAppointmentID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT CARE EQUIPMENT");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let clinicAppointmentID = $(this).attr("clinicAppointmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "clinic_appointments";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Appointment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let clinicAppointmentID = $(this).attr("clinicAppointmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "clinic_appointments";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `clinic_appointment_id=${clinicAppointmentID}`;
    
                sweetAlertConfirmation("update", "Appointment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let clinicAppointmentID = $(this).attr("clinicAppointmentID");

            let data = {
                tableName: 'clinic_appointments',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `clinic_appointment_id=${clinicAppointmentID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Appointment", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    