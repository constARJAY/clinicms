<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Announcement</h4>
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
            if ($.fn.DataTable.isDataTable("#tableAnnouncement")) {
                $("#tableAnnouncement").DataTable().destroy();
            }
            
            var table = $("#tableAnnouncement")
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
            let data = getTableData(`announcements WHERE is_deleted = 0`);
            data.map((item, index) => {
                let {
                    announcement_id = "",
                    title           = "",
                    description     = "",
                    date            = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${title}</td>
                    <td>${description}</td>
                    <td>${date ? moment(date).format("MMMM DD, YYYY") : "-"}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                announcementID="${announcement_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                announcementID="${announcement_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>   
                </tr>`;
            });

            let html = `
            <table class="table table-bordered" id="tableAnnouncement">
                <thead>
                    <tr class="text-center">
                        <th class="thSm">Title</th>
                        <th class="thLg">Description</th>
                        <th class="thXs">Date</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableAnnouncementTbody">
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add Announcement</button>
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
                announcement_id = "",
                title           = "",
                description     = "",
                date            = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                announcementID="${announcement_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                announcementID="${announcement_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Title <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="title"
                            minlength="2"
                            maxlength="50"
                            value="${title}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description <code>*</code></label>
                        <textarea class="form-control validate"
                            name="description"
                            minlength="2"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${description}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Date <code>*</code></label>
                        <input type="button"
                            class="form-control validate daterange text-left"
                            name="date"
                            value="${date ? moment(date).format("MMMM DD, YYYY") : ""}"
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
            $("#modal .page-title").text("ADD ANNOUNCEMENT");
            $("#modal").modal('show');
            generateInputsID("#modal");
            initDateRangePicker();
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let announcementID = $(this).attr("announcementID");
            let data = getTableData(`announcements WHERE announcement_id = ${announcementID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT ANNOUNCEMENT");
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
            let announcementID = $(this).attr("announcementID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "announcements";
                    data["feedback"]  = "Announcement";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Announcement", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let announcementID = $(this).attr("announcementID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "announcements";
                    data["feedback"]    = "Announcement";
                    data["method"]      = "update";
                    data["whereFilter"] = `announcement_id=${announcementID}`;
    
                sweetAlertConfirmation("update", "Announcement", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let announcementID = $(this).attr("announcementID");

            let data = {
                tableName: 'announcements',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `announcement_id=${announcementID}`,
                feedback:    "Announcement",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Announcement", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    