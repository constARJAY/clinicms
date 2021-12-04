<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">    
                    <h4 class="mb-0">Users</h4>
                </div>      
                <div class="card-body" id="pageContent"></div>
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
            if ($.fn.DataTable.isDataTable("#tableUsers")) {
                $("#tableUsers").DataTable().destroy();
            }
            
            var table = $("#tableUsers")
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
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent(patientTypeID = 0) {
            let tbodyHTML = '';
            let data = getTableData(`users WHERE is_deleted = 0`);
            data.map(item => {
                let {
                    user_id    = "",
                    user_code  = "",
                    role_id    = "",
                    firstname  = "",
                    middlename = "",
                    lastname   = "",
                    suffix     = "",
                    gender     = "",
                    age        = "",
                    email      = "",
                    password   = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${firstname} ${middlename} ${lastname} ${suffix}</td>
                    <td>${email}</td>
                    <td>${age}</td>
                    <td>${gender}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                userID="${user_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                userID="${user_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableUsers">
                <thead>
                    <tr class="text-center">
                        <th class="thSm">Full Name</th>
                        <th class="thSm">Email</th>
                        <th class="thSm">Age</th>
                        <th class="thSm">Gender</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableUsersTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            let patientTypeID = $(`[name="filter_patient_type"]`).val();
            $("#tableContent").html(preloader);
            
            setTimeout(() => {
                let content = tableContent(patientTypeID);
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
                        <div class="col-md-12 col-sm-12 text-right">
                            <button class="btn btn-primary"
                                id="btnAdd"><i class="fas fa-plus"></i> Add User</button>
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
                user_id      = "",
                patient_code    = "",
                patient_type_id = "",
                course_id       = "",
                email           = "",
                password        = "",
                firstname       = "",
                middlename      = "",
                lastname        = "",
                suffix          = "",
                age             = "",
                gender          = "",
                year            = "",
                section         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                userID="${user_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                userID="${user_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>First Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="firstname"
                            minlength="2"
                            maxlength="20"
                            value="${firstname}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" 
                            class="form-control validate"
                            name="middlename"
                            minlength="2"
                            maxlength="20"
                            value="${middlename}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Last Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="lastname"
                            minlength="2"
                            maxlength="20"
                            value="${lastname}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Suffix</label>
                        <select class="form-control validate"
                            name="suffix">
                            <option value="" selected>Select suffix</option>    
                            <option value="Jr." ${suffix == "Jr."  ? "selected" : ""}>Jr.</option>
                            <option value="Sr." ${suffix == "Sr."  ? "selected" : ""}>Sr.</option>
                            <option value="I"   ${suffix == "I."   ? "selected" : ""}>I</option>
                            <option value="II"  ${suffix == "II."  ? "selected" : ""}>II</option>
                            <option value="III" ${suffix == "III." ? "selected" : ""}>III</option>
                            <option value="IV"  ${suffix == "IV"   ? "selected" : ""}>IV</option>
                            <option value="V"   ${suffix == "V"    ? "selected" : ""}>V</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Age <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="age"
                            min="1"
                            minlength="2"
                            maxlength="50"
                            value="${age}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Gender <code>*</code></label>
                        <select class="form-control validate"
                            name="gender"
                            required>
                            <option value="" selected>Select gender</option>    
                            <option value="Male"   ${gender == "Male"   ? "selected" : ""}>Male</option>
                            <option value="Female" ${gender == "Female" ? "selected" : ""}>Female</option>
                            <option value="Others" ${gender == "Others" ? "selected" : ""}>Others</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Email <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="email"
                            minlength="2"
                            maxlength="50"
                            value="${email}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Password <code>*</code></label>
                        <div class="input-group">
                            <input type="password" 
                                class="form-control validate"
                                name="password"
                                minlength="2"
                                maxlength="50"
                                value="${password}"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="password-icon mdi mdi-eye" style="cursor: pointer;" display="true"></i>
                                </span>
                            </div>
                        </div>
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
            $("#modal .page-title").text("ADD USER");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let userID = $(this).attr("userID");
            let data = getTableData(`users WHERE user_id = ${userID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT USER");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- TOGGLE PASSWORD -----
        $(document).on("click", ".password-icon", function() {
            let isDisplay = $(this).attr("display") == "true";
            if (isDisplay) {
                $(this).removeClass("mdi-eye").addClass("mdi-eye-off");
                $(`[name="password"]`).attr("type", "text");
            } else {
                $(this).removeClass("mdi-eye-off").addClass("mdi-eye");
                $(`[name="password"]`).attr("type", "password");
            }
            $(this).attr("display", !isDisplay);
        })
        // ----- END TOGGLE PASSWORD -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let userID = $(this).attr("userID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "users";
                    data["feedback"]  = $(`[name="firstname"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "User", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let userID = $(this).attr("userID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "users";
                    data["feedback"]    = $(`[name="firstname"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `user_id=${userID}`;
    
                sweetAlertConfirmation("update", "User", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let userID = $(this).attr("userID");

            let data = {
                tableName: 'users',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `user_id=${userID}`,
                feedback:    $(`[name="firstname"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "User", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    