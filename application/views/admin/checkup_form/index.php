<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Check-up Form</h4>
                        <div><?= date("M d, Y") ?></div>
                    </div>
                </div>
                <div class="card-body" id="pageContent"></div>
            </div>
        </div>
    </div>

</div>


<script>


    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let startDate = moment().format("YYYY-MM-DD 00:00:00");
        let endDate   = moment().format("YYYY-MM-DD 23:59:59");
        let patientList = getTableData(
            `clinic_appointments AS ca 
                LEFT JOIN patients AS p USING(patient_id)
                LEFT JOIN courses AS c ON p.course_id = c.course_id
            WHERE date_appointment BETWEEN '${startDate}' AND '${endDate}' 
                AND ca.is_deleted = 0
                AND p.is_deleted = 0
            GROUP BY ca.patient_id`,
            `p.*, clinic_appointment_id, service_id, c.name AS c_name`);

        let serviceList = getTableData(`services WHERE is_deleted = 0`);
        let medicineList = getTableData(`medicines WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATERANGEPICKER -----
        function dateTimeRangePicker(element = null) {
            $(element).daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                locale: {
                    format: 'MMMM DD, YYYY hh:mm A'
                }
            });
        }
        // ----- END DATERANGEPICKER -----


        // ----- PATIENT OPTION DISPLAY -----
        function getPatientOptionDisplay(serviceID = 0, patientID = 0) {
            let html = `<option value="" selected disabled>Select patient name</option>`;
            patientList.map(patient => {
                let {
                    clinic_appointment_id = "",
                    patient_id            = "",
                    patient_code          = "",
                    patient_type_id       = "",
                    course_id             = "",
                    email                 = "",
                    password              = "",
                    firstname             = "",
                    middlename            = "",
                    lastname              = "",
                    suffix                = "",
                    age                   = "",
                    gender                = "",
                    year                  = "",
                    section               = "",
                    c_name                = "",
                    service_id            = "",
                } = patient;

                let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;

                if (serviceID == service_id) {
                    html += `
                    <option value="${patient_id}"
                        clinic_appointment_id = "${clinic_appointment_id}"
                        course_id = "${course_id}"
                        age       = "${age}"
                        gender    = "${gender}"
                        year      = "${year}"
                        section   = "${section}"
                        c_name    = "${c_name || ""}"
                        ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
                }
            });

            return html;
        }
        // ----- END PATIENT OPTION DISPLAY -----


        // ----- SERVICE OPTION DISPLAY -----
        function getServiceOptionDisplay(serviceID = 0) {
            let html = `<option selected disabled>Select service</option>`;
            serviceList.map(service => {
                let {
                    service_id = "",
                    name       = "",
                } = service;
                html += `
                <option value="${service_id}"
                    ${serviceID == service_id ? "selected" : ""}>${name}</option>`;
            });

            return html;
        }
        // ----- END SERVICE OPTION DISPLAY -----


        // ----- TREATMENT ROW -----
        function getTreatmentRow() {
            let toothArray = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32];
            let toothNumberOptionDisplay = '';
            toothArray.map(no => {
                toothNumberOptionDisplay += `<option value="${no}">${no}</option>`;
            })

            let html = `
            <tr>
                <td>
                    <button class="btn btn-danger btn-sm btnDeleteRow">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <select class="form-control validate"
                            name="tooth_number"
                            required>
                            <option value="" selected disabled>Select tooth no.</option>    
                            ${toothNumberOptionDisplay}   
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="text"
                            class="form-control validate"
                            name="tooth_status"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END TREATMENT ROW -----


        // ----- TREATMENT DISPLAY -----
        function getTreatmentDisplay() {
            let html = `
            <div class="row">
                <div class="col-12 mb-3"><hr></div>
                <div class="col-12 pb-4">
                    <h4>Treatment</h4>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 p-3">
                            <img class="img-fluid border"
                                src="${base_url}assets/images/modules/dental-chart.jpg"
                                style="width: 100%;
                                    min-height: 30vh;
                                    height: auto;
                                    max-height: 100%;"
                                alt="dental chart">
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <button class="btn btn-primary mb-3"
                                id="btnAddTreatment">Add</button>
                            <div class="table-responsive" style="height: 70vh; overflow-y: auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="80"></th>
                                            <th>Tooth No.</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableTbodyTreatment">
                                        ${getTreatmentRow()}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            return html;
        }
        // ----- END TREATMENT DISPLAY -----


        // ----- MEDICINE OPTION DISPLAY -----
        function getMedicineOptionDisplay() {
            let html = `<option value="" selected disabled>Select medicine</option>`;
            medicineList.map(medicine => {
                let {
                    medicine_id,
                    name,
                } = medicine;

                html += `<option value="${medicine_id}">${name}</option>`;
            })
            return html;
        }
        // ----- END MEDICINE OPTION DISPLAY -----


        // ----- MEDICINE ROW -----
        function getMedicineRow() {
            let html = `
            <tr>
                <td>
                    <button class="btn btn-danger btn-sm btnDeleteRow">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <select class="form-control validate"
                            name="medicine_id"
                            required>
                            ${getMedicineOptionDisplay()}  
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-0">
                        <input type="number"
                            class="form-control validate"
                            name="medicine_quantity"
                            min="0"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </td>
            </tr>`;
            return html;
        }
        // ----- END MEDICINE ROW -----


       // ----- PAGE CONTENT -----
       function pageContent() {
            $("#pageContent").html(preloader);

            let html = `
            <div class="row" id="checkupForm">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Service <code>*</code></label>
                                <select class="form-control validate"
                                    name="service_id"
                                    required>
                                    ${getServiceOptionDisplay()}
                                </select>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Patient Name <code>*</code></label>
                                <select class="form-control validate"
                                    name="patient_id"
                                    required>
                                    ${getPatientOptionDisplay()}
                                </select>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text"
                                    class="form-control"
                                    name="gender"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text"
                                    class="form-control"
                                    name="age"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text"
                                    class="form-control"
                                    name="course"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text"
                                    class="form-control"
                                    name="year"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text"
                                    class="form-control"
                                    name="section"
                                    value=""
                                    disabled>
                            </div>
                        </div>
                        <div class="col-12 mb-3"><hr></div>
                        <div class="col-12">
                            <h5>Chief Complain</h5>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Temperature</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="temperature"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Pulse rate</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="pulse_rate"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Respiratory Rate</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="respiratory_rate"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Blood Pressure</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="blood_pressure"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Random Blood Sugar</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="random_blood_sugar"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Others</label>
                                <input type="text"
                                    class="form-control validate"
                                    name="others"
                                    value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="treatmentDisplay"></div>
                <div class="col-12 mb-3"><hr></div>
                <div class="col-12 pb-4">
                    <h4>Medicine</h4>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <button class="btn btn-primary mb-3"
                                        id="btnAddMedicine">Add</button>
                                </th>
                            </tr>
                            <tr>
                                <th width="80"></th>
                                <th>Medicine</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="tableTbodyMedicine">
                            ${getMedicineRow()}
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label>Recommendation <code>*</code></label>
                        <textarea class="form-control validate"
                            name="recommendation"
                            rows="5"
                            style="resize: none"
                            required></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" id="btnSave">Save</button>
                <button class="btn btn-danger" id="btnCancel">Cancel</button>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                generateInputsID("#pageContent");
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- SELECT PATIENT NAME -----
        $(document).on("change", `[name="patient_id"]`, function() {
            let gender  = $(`option:selected`, this).attr("gender") || "-";
            let age     = $(`option:selected`, this).attr("age") || "-";
            let course  = $(`option:selected`, this).attr("c_name") || "-";
            let year    = $(`option:selected`, this).attr("year") || "-";
            let section = $(`option:selected`, this).attr("section") || "-";

            $(`[name="gender"]`).val(gender);
            $(`[name="age"]`).val(age);
            $(`[name="course"]`).val(course);
            $(`[name="year"]`).val(year);
            $(`[name="section"]`).val(section);
        })
        // ----- END SELECT PATIENT NAME -----


        // ----- SELECT SERVICE -----
        $(document).on("change", `[name="service_id"]`, function() {
            let serviceID = $(this).val();
            if (serviceID == 2) {
                $("#treatmentDisplay").html(getTreatmentDisplay());
            } else {
                $("#treatmentDisplay").empty();
            }
            $(`[name="patient_id"]`).html(getPatientOptionDisplay(serviceID));
            generateInputsID("#pageContent");

            $(`[name="patient_id"]`).trigger("change");
        })
        // ----- END SELECT SERVICE -----


        // ----- BUTTON ADD TREATMENT -----
        $(document).on("click", `#btnAddTreatment`, function() {
            let row = getTreatmentRow();
            $("#tableTbodyTreatment").append(row);
            generateInputsID("#tableTbodyTreatment");
        })
        // ----- END BUTTON ADD TREATMENT -----


        // ----- BUTTON ADD TREATMENT -----
        $(document).on("click", `#btnAddMedicine`, function() {
            let row = getMedicineRow();
            $("#tableTbodyMedicine").append(row);
            generateInputsID("#tableTbodyMedicine");
        })
        // ----- END BUTTON ADD TREATMENT -----


        // ----- BUTTON DELETE ROW -----
        $(document).on("click", `.btnDeleteRow`, function() {
            $(this).closest('tr').remove();
        })
        // ----- END BUTTON DELETE ROW -----


        // ----- BUTTON SAVE -----
        $(document).on("click", "#btnSave", function() {
            let validate = validateForm("checkupForm");

            const getTreatmentInputData = () => {
                let data = [];
                if ($("#tableTbodyTreatment tr").length > 0) {
                    $("#tableTbodyTreatment tr").each(function() {
                        let tooth_number = $(`[name="tooth_number"]`, this).val();
                        let tooth_status = $(`[name="tooth_status"]`, this).val();
                        data.push({tooth_number, status: tooth_status});
                    })   
                }
                return data;
            }

            const getMedicineInputData = () => {
                let data = [];
                if ($("#tableTbodyMedicine tr").length > 0) {
                    $("#tableTbodyMedicine tr").each(function() {
                        let medicine_id       = $(`[name="medicine_id"]`, this).val();
                        let medicine_quantity = $(`[name="medicine_quantity"]`, this).val();
                        data.push({medicine_id, quantity: medicine_quantity});
                    })   
                }
                return data;
            }

            if (validate) {
                let data = {
                    service_id:            $(`[name="service_id"]`).val(),
                    clinic_appointment_id: $(`[name="patient_id"] option:selected`).attr("clinic_appointment_id"),
                    patient_id:            $(`[name="patient_id"]`).val(),
                    temperature:           $(`[name="temperature"]`).val(),
                    pulse_rate:            $(`[name="pulse_rate"]`).val(),
                    respiratory_rate:      $(`[name="respiratory_rate"]`).val(),
                    blood_pressure:        $(`[name="blood_pressure"]`).val(),
                    random_blood_sugar:    $(`[name="random_blood_sugar"]`).val(),
                    others:                $(`[name="others"]`).val(),
                    treatment:             getTreatmentInputData(),
                    medicine:              getMedicineInputData(),
                    recommendation:        $(`[name="recommendation"]`).val().trim()
                };

                sweetAlertConfirmation("add", "Check-up Form", "", "", data);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- SWEET ALERT -----
        function sweetAlertConfirmation(
                condition   = "add",            // add|update|cancel
                moduleName  = "Another Data",   // Title
                modalID     = null,             // Modal ID 
                containerID = null,             // ContainerID - if not modal
                data        = null,             // data - object or formData
                isObject    = true,             // if the data is object or not
                callback    = false             // Function to be called after execution
            ) {

            let lowerCase 	= moduleName.toLowerCase();
            let upperCase	= moduleName.toUpperCase();
            let capitalCase = moduleName;
            let title 		      =  "";
            let text 		      =  ""
            let success_title     =  "";
            let swalImg           =  "";
            switch(condition) {
                case "add":
                    title 		  +=  "ADD " + upperCase;
                    text 		  +=  "Are you sure that you want to add a new "+ lowerCase +"?"
                    success_title +=  "Add new "+capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/add.svg`;
                    break;
                case "update":
                    title 		  +=  "UPDATE " + upperCase;
                    text 		  +=  "Are you sure that you want to update the "+ lowerCase +"?"
                    success_title +=  "Update "+ capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/update.svg`;
                    break;
                case "delete":
                    title 		  +=  "DELETE " + upperCase;
                    text 		  +=  "Are you sure that you want to update the "+ lowerCase +"?"
                    success_title +=  "Delete "+ capitalCase + " successfully saved!";
                    swalImg       +=  `${base_url}assets/images/modal/delete.svg`;
                    break;
                default:
                    title         +=  "DISCARD CHANGES";
                    text          +=  "Are you sure that you want to cancel this process?"
                    success_title +=  "Process successfully discarded!";
                    swalImg       +=  `${base_url}assets/images/modal/cancel.svg`;
                }
                Swal.fire({
                    title, 
                    text,
                    imageUrl: swalImg,
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#1a1a1a',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let swalTitle = success_title.toUpperCase();

                        if (condition != "cancel") {
                            if (condition.toLowerCase() == "add") {
                                $.ajax({
                                    method: "POST",
                                    url: `checkup_form/insertCheckupForm`,
                                    dataType: 'json',
                                    async: true,
                                    data,
                                    success: function(data) {
                                        let result = data.split("|");
                                        if (result[0] == "true") {
                                            Swal.fire({
                                                icon:  'success',
                                                title: "Successfully saved",
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(function() {
                                                pageContent();
                                            });
                                        } 
                                    }
                                })
                            }
                        } else {
                            Swal.fire({
                                icon:  'success',
                                title: swalTitle,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    } else {
                        // if (condition != "delete") $("#"+modalID).modal("show");
                    }
                });
            }
        // ----- END SWEET ALERT -----

    })

</script>
    