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
        let measurementList = getTableData(`measurements WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableFirstAidKit")) {
                $("#tableFirstAidKit").DataTable().destroy();
            }
            
            var table = $("#tableFirstAidKit")
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
                first_aid_kits AS fak
                    LEFT JOIN measurements AS m USING(measurement_id) WHERE fak.is_deleted = 0`,
                `fak.*, m.name AS m_name`);
            data.map(item => {
                let {
                    first_aid_kit_id = "",
                    name             = "",
                    quantity         = "",
                    m_name           = "",
                } = item;

                let maximumValue = 500;
                let ariaValue  = quantity > maximumValue ? maximumValue : quantity;
                let percentage = ariaValue / maximumValue * 100;
                    percentage = percentage.toFixed(1);

                tbodyHTML += `
                <tr>
                    <td>
                        <div class="progress progress-lg mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: ${percentage}%" aria-valuenow="${ariaValue}" aria-valuemin="0" aria-valuemax="${maximumValue}">${percentage}%</div>
                        </div>
                    </td>
                    <td>${name}</td>
                    <td>${m_name}</td>
                    <td>${quantity}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                firstAidKitID="${first_aid_kit_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                firstAidKitID="${first_aid_kit_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableFirstAidKit">
                <thead>
                    <tr class="text-center">
                        <th class="thMd">Percentage</th>
                        <th class="thSm">Equipment Name</th>
                        <th class="thSm">Measurement</th>
                        <th class="thXs">Quantity</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableFirstAidKitTbody">
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add First-aid Kit</button>
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


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD FIRST-AID KIT");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let firstAidKitID = $(this).attr("firstAidKitID");
            let data = getTableData(`first_aid_kits WHERE first_aid_kit_id = ${firstAidKitID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT FIRST-AID KIT");
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
            let firstAidKitID = $(this).attr("firstAidKitID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "first_aid_kits";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "First-aid Kit", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let firstAidKitID = $(this).attr("firstAidKitID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "first_aid_kits";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `first_aid_kit_id=${firstAidKitID}`;
    
                sweetAlertConfirmation("update", "First-aid Kit", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let firstAidKitID = $(this).attr("firstAidKitID");

            let data = {
                tableName: 'first_aid_kits',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `first_aid_kit_id=${firstAidKitID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "First-aid Kit", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    