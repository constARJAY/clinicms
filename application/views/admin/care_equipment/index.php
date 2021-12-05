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
            if ($.fn.DataTable.isDataTable("#tableCareEquipment")) {
                $("#tableCareEquipment").DataTable().destroy();
            }
            
            var table = $("#tableCareEquipment")
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
            let data = getTableData(`care_equipments WHERE is_deleted = 0`);
            data.map(item => {
                let {
                    care_equipment_id = "",
                    name              = "",
                    quantity          = "",
                    condition         = "",
                    measurement       = "",
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
                    <td>${measurement}</td>
                    <td>${quantity}</td>
                    <td>${condition}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                careEquipmentID="${care_equipment_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                careEquipmentID="${care_equipment_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableCareEquipment">
                <thead>
                    <tr class="text-center">
                        <th class="thMd">Percentage</th>
                        <th class="thSm">Equipment Name</th>
                        <th class="thSm">Measurement</th>
                        <th class="thXs">Quantity</th>
                        <th class="thMd">Condition</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableCareEquipmentTbody">
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add Care Equipment</button>
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
                care_equipment_id = "",
                measurement       = "",
                name              = "",
                quantity          = "",
                condition         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                careEquipmentID="${care_equipment_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                careEquipmentID="${care_equipment_id}">Update</button>`;

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
                        <input type="text"
                            class="form-control validate"
                            name="measurement"
                            value="${measurement}"
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
            let careEquipmentID = $(this).attr("careEquipmentID");
            let data = getTableData(`care_equipments WHERE care_equipment_id = ${careEquipmentID}`);

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
            let careEquipmentID = $(this).attr("careEquipmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "care_equipments";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Care Equipment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let careEquipmentID = $(this).attr("careEquipmentID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "care_equipments";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `care_equipment_id=${careEquipmentID}`;
    
                sweetAlertConfirmation("update", "Care Equipment", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let careEquipmentID = $(this).attr("careEquipmentID");

            let data = {
                tableName: 'care_equipments',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `care_equipment_id=${careEquipmentID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Care Equipment", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    