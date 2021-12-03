// ----- GET DATABASE TABLE DATA -----
function getTableData(
	tableName = null,
	columnName = "",
	searchFilter = "",
	orderBy = "",
	groupBy = "",
	others = ""
) {
	let path = `${base_url}system_operations/getTableData`;
	let data = {
		tableName,
		columnName,
		searchFilter,
		orderBy,
		groupBy,
		others,
	};
	let result = [];
	if (tableName) {
		$.ajax({
			method: "POST",
			url: path,
			data,
			async: false,
			dataType: "json",
			success: function (data) {
				if (data) {
					data.map((item) => {
						result.push(item);
					});
				}
			},
			error: function (err) {
				showNotification(
					"danger",
					"System error: Please contact the system administrator for assistance!"
				);
			},
		});
	}
	return result;
};
// ----- END GET DATABASE TABLE DATA -----


// ----- SAVE/UPDATE/DELETE TABLE DATA -----
const saveUpdateDeleteDatabaseFormData = async (
	data,
	path,
	feedback = false,
	swalTitle,
	overrideSuccessConfirmation
) => {
	let result = await $.ajax({
		method: "POST",
		url: path,
		data,
		processData: false,
		contentType: false,
		global: false,
		cache: false,
		async: false,
		dataType: "json",
		beforeSend: function () {
			$("#loader").show();
		},
		success: function (data) {
			let result = data.split("|");
			let isSuccess = result[0],
				message = result[1],
				id = result[2] ? result[2] : null;

			if (isSuccess == "true") {
				if (feedback) {
					feedback = feedback.split("|");
					feedbackClass = feedback[0];
					feedbackMsg = feedback[1];
					setTimeout(() => {
						$("#loader").hide();
						closeModals();
						if (swalTitle) {
							Swal.fire({
								icon: feedbackClass,
								title: swalTitle,
								text: feedbackMsg,
								showConfirmButton: false,
								timer: 2000,
							});
						} else {
							Swal.fire({
								icon: feedbackClass,
								title: feedbackMsg,
								showConfirmButton: false,
								timer: 2000,
							});
						}
					}, 500);
				} else {
					setTimeout(() => {
						$("#loader").hide();
						closeModals();
						Swal.fire({
							icon: "success",
							title: message,
							showConfirmButton: false,
							timer: 2000,
						});
					}, 500);
				}
			} else {
				$("#loader").hide();
				Swal.fire({
					icon: "danger",
					title: message,
					showConfirmButton: false,
					timer: 2000,
				});
			}
		},
		error: function (err) {
			showNotification(
				"danger",
				"System error: Please contact the system administrator for assistance!"
			);
			$("#loader").hide();
		},
	});
	return (await result) ? result : false;
};

const saveUpdateDeleteDatabaseObject = async (
	data,
	path,
	feedback = false,
	swalTitle,
	condition = "update"
) => {
	let result = await $.ajax({
		method: "POST",
		url: path,
		data,
		async: false,
		dataType: "json",
		beforeSend: function () {
			$("#loader").show();
		},
		success: function (data) {
			let result = data.split("|");
			let isSuccess = result[0],
				message   = result[1],
				id        = result[2] ? result[2] : null;

			if (isSuccess == "true") {
				if (feedback) {
					feedback      = feedback.split("|");
					feedbackClass = feedback[0];
					feedbackMsg   = feedback[1];
					setTimeout(() => {
						$("#loader").hide();
						closeModals();
						if (swalTitle) {
							Swal.fire({
								icon: feedbackClass,
								title: swalTitle,
								text: feedbackMsg,
								showConfirmButton: false,
								timer: 2000,
							});
						} else {

                            feedbackMsg = condition == "delete" ? "Deleted successfully!" : feedbackMsg;

							Swal.fire({
								icon: feedbackClass,
								title: feedbackMsg,
								showConfirmButton: false,
								timer: 2000,
							});
						}

					}, 500);
				} else {

                    setTimeout(() => {
                        $("#loader").hide();
                        closeModals();

                        message = condition == "delete" ? "Deleted successfully!" : message;

                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }, 500);
					
				}
			} else {
				$("#loader").hide();
				Swal.fire({
					icon: "danger",
					title: message,
					showConfirmButton: false,
					timer: 2000,
				});
			}
		},
		error: function (err) {
			showNotification(
				"danger",
				"System error: Please contact the system administrator for assistance!"
			);
			$("#loader").hide();
		},
	});
	return (await result) ? result : false;
};



// ----- INSERT TABLE DATA -----
const insertTableData = async (
	data,
	object = false,
	feedback = false,
	swalTitle = false
) => {
	let path = `${base_url}system_operations/insertTableData`;
	return !object
		? await saveUpdateDeleteDatabaseFormData(data, path, feedback, swalTitle)
		: await saveUpdateDeleteDatabaseObject(data, path, feedback, swalTitle);
};
// ----- END INSERT TABLE DATA -----


// ----- UPDATE TABLE DATA -----
const updateTableData = async (
	data,
	object = false,
	feedback = false,
	swalTitle = false,
    condition = "update"
) => {
	let path = `${base_url}system_operations/updateTableData`;
	return !object
		? await saveUpdateDeleteDatabaseFormData(data, path, feedback, swalTitle)
		: await saveUpdateDeleteDatabaseObject(data, path, feedback, swalTitle, condition);
};
// ----- END UPDATE TABLE DATA -----



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

    $("#"+modalID).modal("hide");

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

                    let saveData = condition.toLowerCase() == "add" ? insertTableData(data, isObject, false, swalTitle) : updateTableData(data, isObject, false, swalTitle, condition.toLowerCase());
                    saveData.then(res => {  
                        if (res) { 
                            callback && callback();
                        } else {
                            Swal.fire({
                                icon: 'danger',
                                title: "Failed!",
                                text: result[1],
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        icon:  'success',
                        title: swalTitle,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            } else {
				if (condition != "delete") $("#"+modalID).modal("show");
            }
        });
    }
// ----- END SWEET ALERT -----