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
        let patientList = getTableData(`patients WHERE is_deleted = 0`);
        let serviceList = getTableData(`services WHERE is_deleted = 0`);
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
                    LEFT JOIN patients AS p USING(patient_id) 
                    LEFT JOIN services AS s USING(service_id) 
                WHERE ca.is_deleted = 0`,
                `ca.*, p.firstname AS p_firstname, p.middlename AS p_middlename, p.lastname AS p_lastname, p.suffix AS p_suffix, s.name AS s_name`);
            data.map((item, index) => {
                let {
                    clinic_appointment_id = "",
                    patient_id            = "",
                    purpose               = "",
                    date_appointment      = "",
                    is_done               = "",
                    p_firstname           = "",
                    p_middlename          = "",
                    p_lastname            = "",
                    p_suffix              = "",
                    s_name                = "",
                } = item;

                const statusStyle = (is_done = 0) => {
                    if (is_done == 0) {
                        return `<div class="badge badge-warning">Pending</div>`;
                    } else if (is_done == 1) {
                        return `<div class="badge badge-success">Done</div>`;
                    } else {
                        return `<div class="badge badge-danger">Cancelled</div>`;
                    }
                }

                tbodyHTML += `
                <tr>
                    <td>${index+1}</td>
                    <td>${p_firstname} ${p_middlename} ${p_lastname} ${p_suffix}</td>
                    <td>${s_name}</td>
                    <td>${date_appointment ? moment(date_appointment).format("MMMM DD, YYYY") : "-"}</td>
                    <td>${purpose}</td>
                    <td>${statusStyle(is_done)}</td>
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
                        <th class="thSm">Appointment Type</th>
                        <th class="thSm">Date Appointment</th>
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


        // ----- PATIENT OPTION DISPLAY -----
        function getPatientOptionDisplay(patientID = 0) {
            let html = `<option value="" selected>Select patient</option>`;
            patientList.map(patient => {
                let {
                    patient_id = "",
                    firstname  = "",
                    middlename = "",
                    lastname   = "",
                    suffix     = "",
                } = patient;

                let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;

                html += `
                <option value="${patient_id}"
                    ${patient_id == patientID ? "selected" : ""}>${fullname}</option>`;
            })
            return html;
        }
        // ----- END PATIENT OPTION DISPLAY -----


        // ----- SERVICE OPTION DISPLAY -----
        function getServiceOptionDisplay(serviceID = 0) {
            let html = `<option value="" selected>Select service</option>`;
            serviceList.map(service => {
                let {
                    service_id = "",
                    name       = "",
                } = service;

                html += `
                <option value="${service_id}"
                    ${service_id == serviceID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END SERVICE OPTION DISPLAY -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                clinic_appointment_id = "",
                patient_id            = "",
                service_id            = "",
                purpose               = "",
                is_done               = "",
                date_appointment      = "",
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
                        <label>Patient <code>*</code></label>
                        <select class="form-control validate"
                            name="patient_id"
                            required>
                            ${getPatientOptionDisplay(patient_id)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Service Type <code>*</code></label>
                        <select class="form-control validate"
                            name="service_id"
                            required>
                            ${getServiceOptionDisplay(service_id)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Date Appointment</label>
                        <input type="date"
                            class="form-control validate"
                            name="date_appointment"
                            value="${date_appointment}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Purpose <code>*</code></label>
                        <textarea class="form-control validate"
                            name="purpose"
                            minlength="2"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${purpose}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control validate"
                            name="is_done"
                            required>
                            <option value="0" selected>Pending</option>
                            <option value="1" ${is_done == 1 ? "selected" : ""}>Done</option>
                            <option value="2" ${is_done == 2 ? "selected" : ""}>Cancelled</option>
                        </select>
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
            $("#modal .page-title").text("ADD APPOINTENT");
            $("#modal").modal('show');
            generateInputsID("#modal");
            initDateRangePicker();
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let clinicAppointmentID = $(this).attr("clinicAppointmentID");
            let data = getTableData(`clinic_appointments WHERE clinic_appointment_id = ${clinicAppointmentID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT APPOINTENT");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
                initDateRangePicker();
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
                    data["feedback"]  = "Appointment";
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
                    data["feedback"]    = "Appointment";
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
                feedback:    "Appointment",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Appointment", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    