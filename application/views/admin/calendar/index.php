<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Calendar</h4>
                </div>
                <div class="card-body" id="pageContent"></div>
            </div>
        </div>
    </div>

</div>


<script>

    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let appointmentList = getTableData(`
            clinic_appointments AS a
                LEFT JOIN patients AS p USING(patient_id)
                LEFT JOIN services AS s USING(service_id) 
            WHERE a.is_deleted = 0 AND a.date_appointment IS NOT NULL`,
            `a.*, firstname, middlename, lastname, suffix, s.name as s_name`);
        // ----- END GLOBAL VARIABLES -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            $("#pageContent").html(preloader);

            let data = [];
            appointmentList.map(appointment => {
                let {
                    clinic_appointment_id = "",
                    patient_id            = "",
                    service_id            = "",
                    purpose               = "",
                    date_appointment      = "",
                    is_done               = "",
                    firstname             = "",
                    middlename            = "",
                    lastname              = "",
                    suffix                = "",
                    s_name                = "",
                } = appointment;

                const getClassName = (is_done = 0) => {
                    if (is_done == 0) return `bg-warning`;
                    else if (is_done == 1) return `bg-success`;
                    else return `bg-danger`;
                }

                data.push({
                    title:     `${s_name} | ${firstname} ${middlename} ${lastname} ${suffix}`,
                    start:     date_appointment,
                    className: getClassName(is_done)
                });
            })

            let html = `
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="fc-external-events">
                        <div class='fc-event bg-warning' style="border-color: transparent;">
                            <p class="mb-0 text-white">Pending</p>
                        </div>
                        <div class='fc-event bg-success' style="border-color: transparent;">
                            <p class="mb-0 text-white">Done</p>
                        </div>
                        <div class='fc-event bg-danger' style="border-color: transparent;">
                            <p class="mb-0 text-white">Cancelled</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div id="calendar" class="full-calendar"></div>
                </div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                if ($('#calendar').length) {
                    $('#calendar').fullCalendar({
                        header: {
                            left:   'prev,next today',
                            center: 'title',
                            right:  'month,basicWeek,basicDay'
                        },
                        // defaultDate: '2017-07-12',
                        navLinks:     true, // can click day/week names to navigate views
                        editable:     false,
                        eventLimit:   true, // allow "more" link when too many events
                        events:       data
                    })
                }
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


    })

</script>