<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Survey</h4>
                </div>
                <div class="card-body" id="pageContent">          
                </div>
            </div>
        </div>
    </div>

</div>


<script>


    $(document).ready(function() {


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableSurvey")) {
                $("#tableSurvey").DataTable().destroy();
            }
            
            var table = $("#tableSurvey")
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
                `surveys AS s
                    lEFT JOIN check_ups AS cu USING(check_up_id)
                    LEFT JOIN services AS s2 ON cu.service_id = s2.service_id
                    LEFT JOIN patients AS p ON s.patient_id = p.patient_id
                WHERE s.is_deleted = 0`,
                `s.*, firstname, middlename, lastname, suffix, s2.name AS service_name`);
            data.map(item => {
                let {
                    survey_id    = "",
                    check_up_id  = "",
                    patient_id   = "",
                    firstname    = "",
                    middlename   = "",
                    lastname     = "",
                    suffix       = "",
                    created_at   = "",
                    service_name = "",
                    status       = "",
                } = item;

                let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;
                let statusStyle = status == 1 ? `
                <span class="badge badge-success">Done</span>` : `
                <span class="badge badge-warning">Pending</span>`;

                tbodyHTML += `
                <tr>
                    <td>${moment(created_at).format("MMMM DD, YYYY")}</td>
                    <td>${fullname}</td>
                    <td>${service_name}</td>
                    <td>${statusStyle}</td>
                    <td>
                        <div class="text-center">
                            <a class="btn btn-primary text-white btnSurvey"
                                href="survey/take?id=${survey_id}"
                                target="_blank"
                                surveyID="${survey_id}"><i class="fas fa-paper-plane"></i> Take Survey</a>
                            <button class="btn btn-outline-danger btnDelete"
                                surveyID="${survey_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableSurvey">
                <thead>
                    <tr class="text-center">
                        <th>Check-up Date</th>
                        <th>Full Name</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableSurveyTbody">
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


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                survey_id = "",
                name      = "",
                brand     = "",
                quantity  = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                surveyID="${survey_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                surveyID="${survey_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Name <code>*</code></label>
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
                        <label>Brand <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="brand"
                            minlength="2"
                            maxlength="20"
                            value="${brand}"
                            required>
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


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD SURVEY");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let surveyID = $(this).attr("surveyID");
            let data = getTableData(`surveys WHERE survey_id = ${surveyID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT SURVEY");
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
            let surveyID = $(this).attr("surveyID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "surveys";
                    data["feedback"]  = "Survey";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Survey", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let surveyID = $(this).attr("surveyID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "surveys";
                    data["feedback"]    = "Survey";
                    data["method"]      = "update";
                    data["whereFilter"] = `survey_id=${surveyID}`;
    
                sweetAlertConfirmation("update", "Survey", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let surveyID = $(this).attr("surveyID");

            let data = {
                tableName: 'surveys',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `survey_id=${surveyID}`,
                feedback:    "Survey",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Survey", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    