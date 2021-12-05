<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard</h4>
                        <div><?= date("F d, Y") ?></div>
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


        // ----- PIE CHART -----
        function patientTypePieChart(patientType = []) {
            if ($("#patientTypePieChart").length && patientType.length) {

                let data   = patientType.map(p => +p.count);
                let labels = patientType.map(p => p.name);

                var doughnutPieData = {
                    datasets: [{
                        data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                    }],
                    labels
                };

                var doughnutPieOptions = {
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                };

                var patientTypePieChartCanvas = $("#patientTypePieChart").get(0).getContext("2d");
                var patientTypePieChart = new Chart(patientTypePieChartCanvas, {
                    type: 'pie',
                    data: doughnutPieData,
                    options: doughnutPieOptions
                });
            }
        }
        // ----- END PIE CHART -----


        // ----- CUSTOMER SATISFACTORY BAR CHART -----
        function customerSatisfactoryBarChart(customerSatisfactory = []) {
            if ($("#customerSatisfactoryBarChart").length) {
                var options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                        },
                        elements: {
                        point: {
                            radius: 0
                        }
                    }

                };

                let {
                    q1, q2, q3, q4, q5, q6, q7, q8, q9, q10
                } = customerSatisfactory;

                let labels  = [
                    'Question 1',
                    'Question 2',
                    'Question 3',
                    'Question 4',
                    'Question 5',
                    'Question 6',
                    'Question 7',
                    'Question 8',
                    'Question 9',
                    'Question 10',
                ];
                let barData = [q1, q2, q3, q4, q5, q6, q7, q8, q9, q10];

                var data = {
                    labels,
                    datasets: [{
                        label: 'Total Ratings',
                        data: barData,
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 1,
                        fill: false
                    }]
                };

                var customerSatisfactoryBarChartCanvas = $("#customerSatisfactoryBarChart").get(0).getContext("2d");
                // This will get the first returned node in the jQuery collection.
                var customerSatisfactoryBarChart = new Chart(customerSatisfactoryBarChartCanvas, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            }
        }
        // ----- END CUSTOMER SATISFACTORY BAR CHART -----


        // ----- MONTHLY SURVEY AREA CHART -----
        function monthlySurveyAreaChart(monthlySurveyResult = []) {
            console.log(monthlySurveyResult)
            if ($("#monthlySurveyResult").length && monthlySurveyResult.length) {

                let labels = monthlySurveyResult.map(i => i.month);
                let data   = monthlySurveyResult.map(i => i.total);

                var areaData = {
                    labels,
                    datasets: [{
                        label: 'Average Rating',
                        backgroundColor: [
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                        ],
                        borderColor: [
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                            'rgb(81 76 247)',
                        ],
                        data,
                        borderWidth: 1,
                        fill: true, // 3: no fill
                    }]
                };

                var areaOptions = {
                    plugins: {
                        filler: {
                            propagate: true
                        }
                    }
                }

                var areaChartCanvas = $("#monthlySurveyResult").get(0).getContext("2d");
                var areaChart = new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions
                });
            }
        }
        // ----- END MONTHLY SURVEY AREA CHART -----


        // ----- MEDICINE BAR CHART -----
        function medicineBarChart(medicine = []) {
            if ($("#medicineBarChart").length && medicine.length) {
                var options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                        },
                        elements: {
                        point: {
                            radius: 0
                        }
                    }

                };

                let labels  = medicine.map(m => m.name);
                let barData = medicine.map(m => +m.quantity);

                var data = {
                    labels,
                    datasets: [{
                        label: 'Stocks',
                        data: barData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: false
                    }]
                };

                var medicineBarChartCanvas = $("#medicineBarChart").get(0).getContext("2d");
                // This will get the first returned node in the jQuery collection.
                var medicineBarChart = new Chart(medicineBarChartCanvas, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            }
        }
        // ----- END MEDICINE BAR CHART -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            $("#pageContent").html(preloader);

            let data = getDashboardData();
            let {
                totalPatient = 0,
                totalMedicalAppointment = 0,
                totalDentalAppointment  = 0,
                totalAppointment        = 0,
                patientType             = [],
                medicine                = [],
                customerSatisfactory    = {},
                monthlySurveyResult     = [],
                rater                   = []
            } = data;
            
            let maxCapacity = 1000;

            let raterHTML = '';
            rater.map(rate => {
                let { name, total } = rate;
                raterHTML += `
                <tr>
                    <td>${name}</td>
                    <th>${total}</th>
                </tr>`;
            })

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
                <div class="col-md-6 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Patient Type</h4>
                            <canvas id="patientTypePieChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Medicine</h4>
                            <canvas id="medicineBarChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Legend</h4>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>5</th>
                                    <td>Absolutely Satisfied</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Highly Satisfied</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Moderately Satisfied</td>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <td>Fairly Satisfied</td>
                                </tr>
                                <tr>
                                    <th>1</th>
                                    <td>Not Satisfied</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Customer Satisfactory</h4>
                            <canvas id="customerSatisfactoryBarChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Monthly Survey Result</h4>
                            <canvas id="monthlySurveyResult"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rater</h4>
                            <table class="table table-bordered table-striped">
                                ${raterHTML}
                            </table>
                        </div>
                    </div>
                </div>


            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                patientTypePieChart(patientType);
                medicineBarChart(medicine);
                customerSatisfactoryBarChart(customerSatisfactory);
                monthlySurveyAreaChart(monthlySurveyResult);
            }, 100)
        }
        pageContent();
        // ----- END PAGE CONTENT -----

    })

</script>
    