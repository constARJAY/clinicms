<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard</h4>
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

        // ----- GLOBAL VARIABLE -----
        let getPercentage = (value = 0, divider = 0) => (value / divider) * 100;
        // ----- END GLOBAL VARIABLE -----


        // ----- DASHBOARD DATA -----
        function getDashboardData() {
            let result = [];
            $.ajax({
                method: "POST",
                url: "dashboard/getDashboardData",
                async: false,
                dataType: "json",
                success: function(data) {
                    result = data;
                }
            })
            return result;
        }
        // ----- END DASHBOARD DATA -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            $("#pageContent").html(preloader);

            let data = getDashboardData();
            let {
                totalPatient = 0,
                totalMedicalAppointment = 0,
                totalDentalAppointment  = 0,
                totalAppointment        = 0
            } = data;
            
            let maxCapacity = 1000;

            let html = `
            <div class="row p-2">
                <div class="col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Patient</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">Current: ${totalPatient}</p>
                                <p class="text-muted">Max: ${maxCapacity}</p>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-success" 
                                    style="width: ${getPercentage(totalPatient, maxCapacity)}%" 
                                    role="progressbar" 
                                    aria-valuenow="${getPercentage(totalPatient, maxCapacity)}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="${maxCapacity}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Appointment</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">Current: ${totalAppointment}</p>
                                <p class="text-muted">Max: ${maxCapacity}</p>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-danger" 
                                    style="width: ${getPercentage(totalAppointment, maxCapacity)}%" 
                                    role="progressbar" 
                                    aria-valuenow="${getPercentage(totalAppointment, maxCapacity)}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="${maxCapacity}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Medical Appointment</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">Current: ${totalMedicalAppointment}</p>
                                <p class="text-muted">Max: ${maxCapacity}</p>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-info" 
                                    style="width: ${getPercentage(totalMedicalAppointment, maxCapacity)}%" 
                                    role="progressbar" 
                                    aria-valuenow="${getPercentage(totalMedicalAppointment, maxCapacity)}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="${maxCapacity}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Dental Appointment</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">Current: ${totalDentalAppointment}</p>
                                <p class="text-muted">Max: ${maxCapacity}</p>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-warning" 
                                    style="width: ${getPercentage(totalDentalAppointment, maxCapacity)}%" 
                                    role="progressbar" 
                                    aria-valuenow="${getPercentage(totalDentalAppointment, maxCapacity)}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="${maxCapacity}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
            }, 100)
        }
        pageContent();
        // ----- END PAGE CONTENT -----

    })

</script>
    