<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="w-100" id="tableContent"></div>            
                </div>
            </div>
        </div>
    </div>

</div>


<script>

    $(document).ready(function() {

        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tablePatient")) {
                $("#tablePatient").DataTable().destroy();
            }
            
            var table = $("#tablePatient")
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


        // ----- GET TABLE PATIENT DATA -----
        function getTablePatientData() {
            let result = [];
            $.ajax({
                method: "POST",
                url: "patient/getTablePatientData",
                async: false,
                dataType: 'json',
                success: function(data) {
                    result = data;
                }
            })
            return result;
        }
        // ----- END GET TABLE PATIENT DATA -----


        // ----- TABLE CONTENT -----
        function tableContent() {
            $("#tableContent").html(preloader);

            let tbodyHTML = '';
            let data = getTablePatientData();
            data.map(item => {
                let {
                    patient_id,
                    email,
                    password,
                    firstname,
                    middlename,
                    lastname,
                    suffix,
                    year,
                    age,
                    gender,
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${patient_id}</td>
                    <td>${firstname} ${lastname}</td>
                    <td></td>
                    <td>${email}</td>
                    <td>${age}</td>
                    <td>${gender}</td>
                    <td></td>
                    <td>${year}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                patientID="${patient_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                patientID="${patient_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <div class="row mb-4">
                <div class="col-md-3 col-sm-12">
                    <select class="form-control" name="type">
                        <option>Select Type</option>
                    </select>
                </div>
                <div class="col-md-9 col-sm-12 text-right">
                    <button class="btn btn-primary"
                        id="btnAdd"><i class="fas fa-plus"></i> Add Patient</button>
                    <button class="btn btn-warning"
                        id="btnAdd">Import Patient</button>
                </div>
            </div>

            <table class="table table-responsive table-bordered" id="tablePatient">
                <thead>
                    <tr>
                        <th class="thXs">#</th>
                        <th class="thSm">Full Name</th>
                        <th class="thSm">Type</th>
                        <th class="thSm">Email</th>
                        <th class="thSm">Age</th>
                        <th class="thSm">Gender</th>
                        <th class="thMd">Course</th>
                        <th class="thSm">Year</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tablePatientTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            setTimeout(() => {
                $("#tableContent").html(html);
                initDataTables();
            }, 100);
        }
        tableContent();
        // ----- END TABLE CONTENT -----
        

    })

</script>
    