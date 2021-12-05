<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">   
                    <h4>Dental Certificate</h4>
                </div>
                <div class="card-body" id="pageContent"></div>
            </div>
        </div>
    </div>

</div>


<script>


    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let patientList = getTableData(`patients WHERE is_deleted = 0`);
        let checkupList = [
            {key: "sign1", value: "Routine check-up and Mouth Examination"},
            {key: "sign2", value: "Surgical removal or tooth extraction of Tooth"},
            {key: "sign3", value: "Restorations of Tooth"},
            {key: "sign4", value: "Oral Prophylaxis󠇯"},
            {key: "sign5", value: "Others"},
        ];
        let commentList = [
            {key: "comment1", value: "Fit to engage university academic and non- academic activity"},
            {key: "comment2", value: "Rest and Medication for"},
            {key: "comment3", value: "Others"},
        ];
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableDentalCertificate")) {
                $("#tableDentalCertificate").DataTable().destroy();
            }
            
            var table = $("#tableDentalCertificate")
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
            let data = getTableData(
                `dental_certificates AS dc
                    LEFT JOIN patients AS p USING(patient_id)
                WHERE dc.is_deleted = 0`,
                `dc.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname, age, gender`);
            data.map(item => {
                let {
                    dental_certificate_id = "",
                    fullname              = "",
                    address               = "",
                    date_header           = "",
                    date_given            = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${fullname}</td>
                    <td>${address}</td>
                    <td>${moment(date_header).format("MMMM DD, YYYY")}</td>
                    <td>${moment(date_given).format("MMMM DD, YYYY")}</td>
                    <td>
                        <div class="text-center">
                            <a class="btn btn-primary text-white"
                                href="dental_certificate/print?id=${dental_certificate_id}"
                                target="_blank">
                                <i class="fas fa-print"></i> Print
                            </a>
                            <button class="btn btn-outline-info btnEdit"
                                dentalCertificateID="${dental_certificate_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                dentalCertificateID="${dental_certificate_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableDentalCertificate">
                <thead>
                    <tr class="text-center">
                        <th class="thSm">Full Name</th>
                        <th class="thSm">Address</th>
                        <th class="thXs">Date Issued</th>
                        <th class="thXs">Date Given</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableDentalCertificateTbody">
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add Dental Certificate</button>
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


        // ----- PATIENT OPTIONS DISPLAY -----
        function getPatientOptionDisplay(patientID = 0) {
            let html = `<option value="" selected>Select patient</option>`;
            patientList.map(patient => {
                let {
                    patient_id,
                    firstname,
                    middlename,
                    lastname,
                    suffix
                } = patient;

                let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;

                html += `
                <option value="${patient_id}"
                    ${patient_id == patientID ? "selected" : ""}>${fullname}</option>`;
            })
            return html;
        }
        // ----- END PATIENT OPTIONS DISPLAY -----


        // ----- SIGN OPTIONS DISPLAY -----
        function getSignOptionDisplay(keyID = 0) {
            let html = `<option value="" selected>Select checkup</option>`;
            checkupList.map(checkup => {
                let {
                    key,
                    value
                } = checkup;

                html += `
                <option value="${key}"
                    ${key == keyID ? "selected" : ""}>${value}</option>`;
            })
            return html;
        }
        // ----- END SIGN OPTIONS DISPLAY -----


        // ----- COMMENT OPTIONS DISPLAY -----
        function getCommentOptionDisplay(keyID = 0) {
            let html = `<option value="" selected>Select comment/recommendation</option>`;
            commentList.map(comment => {
                let {
                    key,
                    value
                } = comment;

                html += `
                <option value="${key}"
                    ${key == keyID ? "selected" : ""}>${value}</option>`;
            })
            return html;
        }
        // ----- END COMMENT OPTIONS DISPLAY -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                dental_certificate_id = "",
                patient_id            = "",
                date_header           = "",
                address               = "",
                sign_name             = "",
                sign_note             = "",
                comment_name          = "",
                comment_note          = "",
                date_given            = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                dentalCertificateID="${dental_certificate_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                dentalCertificateID="${dental_certificate_id}">Update</button>`;

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
                        <label>Address <code>*</code></label>
                        <input type="text"
                            class="form-control validate"
                            name="address"
                            value="${address}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Check-up <code>*</code></label>
                        <select class="form-control validate"
                            name="sign_name"
                            required>
                            ${getSignOptionDisplay(sign_name)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text"
                            class="form-control validate"
                            name="sign_note"
                            value="${sign_note}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Comment/Recommendation <code>*</code></label>
                        <select class="form-control validate"
                            name="comment_name"
                            required>
                            ${getCommentOptionDisplay(comment_name)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text"
                            class="form-control validate"
                            name="comment_note"
                            value="${comment_note}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Date Issued</label>
                        <input type="date"
                            class="form-control validate"
                            name="date_header"
                            value="${date_header}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Date Given</label>
                        <input type="date"
                            class="form-control validate"
                            name="date_given"
                            value="${date_given}"
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


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD CERTIFICATE");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let dentalCertificateID = $(this).attr("dentalCertificateID");
            let data = getTableData(`dental_certificates WHERE dental_certificate_id = ${dentalCertificateID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT CERTIFICATE");
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
            let dentalCertificateID = $(this).attr("dentalCertificateID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "dental_certificates";
                    data["feedback"]  = "Certificate";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Dental Certificate", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let dentalCertificateID = $(this).attr("dentalCertificateID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "dental_certificates";
                    data["feedback"]    = "Certificate";
                    data["method"]      = "update";
                    data["whereFilter"] = `dental_certificate_id=${dentalCertificateID}`;
    
                sweetAlertConfirmation("update", "Dental Certificate", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let dentalCertificateID = $(this).attr("dentalCertificateID");

            let data = {
                tableName: 'dental_certificates',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `dental_certificate_id=${dentalCertificateID}`,
                feedback:    "Certificate",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Dental Certificate", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    