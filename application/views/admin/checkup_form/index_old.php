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
        let courseList      = getTableData(`courses WHERE is_deleted = 0`);
        let patientTypeList = getTableData('patient_type WHERE is_deleted = 0');
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableCheckupForm")) {
                $("#tableCheckupForm").DataTable().destroy();
            }
            
            var table = $("#tableCheckupForm")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        // { targets: "thXs", width: 50  },	
                        // { targets: "thSm", width: 150 },	
                        // { targets: "thMd", width: 250 },	
                        // { targets: "thLg", width: 350 },	
                        // { targets: "thXl", width: 450 },	
                        { targets: 0, width: '250px' },
                        { targets: 1, width: '250px' },
                        { targets: 2, width: '250px' },
                        { targets: 3, width: '250px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- MEDICINE TYPE OPTIONS DISPLAY -----
        function getMedicineTypeOptionDisplay(patientTypeID = 0, isAll = false) {
            let html = isAll ? `<option value="0">All</option>` : `<option value="" selected>Select patient type</option>`;
            patientTypeList.map(type => {
                let {
                    patient_type_id,
                    name
                } = type;

                html += `
                <option value="${patient_type_id}"
                    ${patient_type_id == patientTypeID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END MEDICINE TYPE OPTIONS DISPLAY -----


        // ----- COURSE OPTIONS DISPLAY -----
        function getCourseOptionDisplay(courseID = 0) {
            let html = `<option value="" selected>Select course</option>`;
            courseList.map(course => {
                let {
                    course_id,
                    name
                } = course;

                html += `
                <option value="${course_id}"
                    ${course_id == courseID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END COURSE OPTIONS DISPLAY -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(`medicines WHERE is_deleted = 0`);
            data.map(item => {
                let {
                    medicine_id = "",
                    name        = "",
                    brand       = "",
                    quantity    = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${name}</td>
                    <td>${brand}</td>
                    <td>${quantity}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                medicineID="${medicine_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                medicineID="${medicine_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableCheckupForm">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableCheckupFormTbody">
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
                            <a class="btn btn-primary"
                                href="checkup_form/add"
                                id="btnAdd"><i class="fas fa-plus"></i> Add Check-up Form</a>
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
                medicine_id = "",
                name        = "",
                brand       = "",
                quantity    = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                medicineID="${medicine_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                medicineID="${medicine_id}">Update</button>`;

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
        // $(document).on("click", "#btnAdd", function() {
        //     let html = formContent();
        //     $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
        //     $("#modal_content").html(html);
        //     $("#modal .page-title").text("ADD MEDICINE");
        //     $("#modal").modal('show');
        //     generateInputsID("#modal");
        // });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let medicineID = $(this).attr("medicineID");
            let data = getTableData(`medicines WHERE medicine_id = ${medicineID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT MEDICINE");
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
            let medicineID = $(this).attr("medicineID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "medicines";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Medicine", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let medicineID = $(this).attr("medicineID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "medicines";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `medicine_id=${medicineID}`;
    
                sweetAlertConfirmation("update", "Medicine", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let medicineID = $(this).attr("medicineID");

            let data = {
                tableName: 'medicines',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `medicine_id=${medicineID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Medicine", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    