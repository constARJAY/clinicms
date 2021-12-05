<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">    
                    <h4 class="mb-0">Records</h4>
                </div>      
                <div class="card-body" id="pageContent"></div>
            </div>
        </div>
    </div>

</div>


<script>


    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let serviceList     = getTableData(`services WHERE is_deleted = 0`);
        let patientTypeList = getTableData(`patient_type WHERE is_deleted = 0`);
        let checkupList     = getTableData(
            `check_ups AS cu
                LEFT JOIN patients AS p USING(patient_id)
                LEFT JOIN courses AS c USING(course_id)
            WHERE cu.is_deleted = 0`,
            `cu.*, p.firstname AS p_firstname, p.middlename AS p_middlename, p.lastname AS p_lastname, p.suffix AS p_suffix, p.gender AS p_gender, p.age AS p_age, p.year AS p_year, p.section AS p_section, c.name AS c_name, p.patient_type_id AS p_patient_type_id`);
        let medicineTransactionList = getTableData(
            `medicine_transactions AS mt
                LEFT JOIN check_ups AS cu USING(check_up_id)
                LEFT JOIN medicines AS m USING(medicine_id)
                LEFT JOIN patients AS p ON cu.patient_id = p.patient_id`,
            `mt.*, m.name AS m_name, m.brand AS m_brand, p.firstname, p.middlename, p.lastname, p.suffix, p.patient_type_id AS p_patient_type_id`
        );
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMedical")) {
                $("#tableMedical").DataTable().destroy();
            }
            
            var table = $("#tableMedical")
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
        function tableContent(serviceID = 0, patientTypeID = 0) {
            let html = '';
            if (serviceID == 1 || serviceID == 2) {
                let tbodyHTML = '';
                let data = checkupList.filter(check => check.service_id == serviceID && (patientTypeID == 0 || check.p_patient_type_id == patientTypeID));
                if (data && data.length > 0) {
                    data.map(check => {
                        let {
                            check_up_id           = "",
                            clinic_appointment_id = "",
                            service_id            = "",
                            patient_id            = "",
                            temperature           = "",
                            pulse_rate            = "",
                            respiratory_rate      = "",
                            blood_pressure        = "",
                            random_blood_sugar    = "",
                            others                = "",
                            recommendation        = "",
                            created_at            = "",
                            p_firstname           = "",
                            p_middlename          = "",
                            p_lastname            = "",
                            p_suffix              = "",
                            p_gender              = "",
                            p_age                 = "",
                            p_year                = "",
                            p_section             = "",
                            c_name                = "",
                        } = check;
    
                        let fullname = `${p_firstname} ${p_middlename} ${p_lastname} ${p_suffix}`;
    
                        tbodyHTML += `
                        <tr>
                            <td>${moment(created_at).format("MMMM DD, YYYY")}</td>
                            <td>${fullname}</td>
                            <td>${p_gender}</td>
                            <td>${p_age}</td>
                            <td>${c_name || "-"}</td>
                            <td>${p_year}</td>
                            <td>${p_section}</td>
                        </tr>`;
    
                    })

                    html = `
                    <table class="table table-bordered" id="tableMedical">
                        <thead>
                            <tr class="text-center">
                                <th class="thSm">Date</th>
                                <th class="thMd">Full Name</th>
                                <th class="thSm">Gender</th>
                                <th class="thSm">Age</th>
                                <th class="thSm">Course</th>
                                <th class="thSm">Year</th>
                                <th class="thSm">Section</th>
                            </tr>
                        </thead>
                        <tbody id="tableMedicalTbody">
                            ${tbodyHTML}
                        </tbody>
                    </table>`;
                } else {
                    html = `
                    <div class="w-100 py-5 text-center">
                        <img src="${base_url}assets/images/modal/nodata.svg"
                            width="200" height="200" alt="Select Service">
                        <h4 class="mt-3">No data found</h4>
                    </div>`;
                }
            } else if (serviceID == 3) {
                let tbodyHTML = '';
                let data = medicineTransactionList.filter(medtran => patientTypeID == 0 || medtran.p_patient_type_id == patientTypeID);
                if (data && data.length > 0) {
                    data.map(check => {
                        let {
                            medicine_transaction_id = "",
                            check_up_id = "",
                            quantity    = "",
                            m_name      = "",
                            m_brand     = "",
                            firstname   = "",
                            middlename  = "",
                            lastname    = "",
                            suffix      = "",
                            created_at  = "",
                        } = check;
    
                        let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;
    
                        tbodyHTML += `
                        <tr>
                            <td>${moment(created_at).format("MMMM DD, YYYY")}</td>
                            <td>${fullname}</td>
                            <td>${m_name}</td>
                            <td>${quantity}</td>
                        </tr>`;
                    })

                    html = `
                    <table class="table table-bordered" id="tableMedical">
                        <thead>
                            <tr class="text-center">
                                <th class="thSm">Date</th>
                                <th class="thMd">Full Name</th>
                                <th class="thSm">Medicine</th>
                                <th class="thSm">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="tableMedicalTbody">
                            ${tbodyHTML}
                        </tbody>
                    </table>`;
                } else {
                    html = `
                    <div class="w-100 py-5 text-center">
                        <img src="${base_url}assets/images/modal/nodata.svg"
                            width="200" height="200" alt="Select Service">
                        <h4 class="mt-3">No data found</h4>
                    </div>`;
                }
            } else {
                html = `
                <div class="w-100 py-5 text-center">
                    <img src="${base_url}assets/images/modal/select.svg"
                        width="200" height="200" alt="Select Service">
                    <h4 class="mt-3">Please select service</h4>
                </div>`;
            }
            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            $("#tableContent").html(preloader);
            let serviceID     = $(`[name="filter_service"]`).val();
            let patientTypeID = $(`[name="filter_patient_type"]`).val();
            setTimeout(() => {
                let content = tableContent(serviceID, patientTypeID);
                $("#tableContent").html(content);
                initDataTables();
            }, 100);
        }
        // ----- END REFRESH TABLE CONTENT -----


        // ----- SERVICE OPTION DISPLAY -----
        function getServiceOptionDisplay() {
            let html = `<option value="" selected disabled>Select service</option>`;
            serviceList.map(service => {
                let {
                    service_id = "",
                    name       = "",
                } = service;

                html += `<option value="${service_id}">${name}</option>`
            })
            return html;
        }
        // ----- END SERVICE OPTION DISPLAY -----


        // ----- PATIENT TYPE OPTION DISPLAY -----
        function getPatientTypeOptionDisplay() {
            let html = `<option value="0" selected>All</option>`;
            patientTypeList.map(patient => {
                let {
                    patient_type_id = "",
                    name            = "",
                } = patient;

                html += `<option value="${patient_type_id}">${name}</option>`
            })
            return html;
        }
        // ----- END PATIENT TYPE OPTION DISPLAY -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent">
                    <div class="row mb-4">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" 
                                    name="filter_service">
                                    ${getServiceOptionDisplay()}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <select class="form-control" 
                                    name="filter_patient_type">
                                    ${getPatientTypeOptionDisplay()}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tableContent">${tableContent(0)}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                first_aid_kit_id = "",
                measurement_id   = "",
                name             = "",
                quantity         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                firstAidKitID="${first_aid_kit_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                firstAidKitID="${first_aid_kit_id}">Update</button>`;

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
            </div>
            <div class="modal-footer">
                ${buttonSaveUpdate}
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>`;

            return html;
        }
        // ----- END FORM CONTENT -----


        // ----- SELECT SERVICE -----
        $(document).on("change", `[name="filter_service"], [name="filter_patient_type"]`, function() {
            refreshTableContent();
        })
        // ----- END SELECT SERVICE -----

    })

</script>
    