let preloader = `
<div class="jumping-dots-loader my-5">
    <span></span>
    <span></span>
    <span></span>
</div>`;

let base_url          = $(`body`).attr("base_url");
let differentInputArr = ["input", "select", "textarea"];
let differentInputStr = differentInputArr.join(", ");


// ----- CLOSE MODALS -----
const closeModals = () => {
	$(".modal").modal("hide");
};
// ----- END CLOSE MODALS -----


// ---- GET DOM ELEMENT -----
const getElement = (element = null, defaultElement = null) => {
	let elem = element
		? element.indexOf(".") != "-1"
			? element
			: element.indexOf("#") != "-1"
			? element
			: "#" + element
		: defaultElement;
	return elem;
};
// ---- END GET DOM ELEMENT -----


// ----- INIT DATERANGE -----
function initDateRangePicker(element = null, otherOption = false) {
	let elem = getElement(element, ".daterange");
	let options = otherOption
		? otherOption
		: {
				autoUpdateInput: false,
				singleDatePicker: true,
				showDropdowns: true,
				autoApply: true,
				locale: {
					format: "MMMM DD, YYYY",
				},
				// maxDate: moment(new Date).format("MMMM DD, YYYY"),
		  };
	$(elem).daterangepicker(options, function (data) {
		if (data) {
			const validated = $(elem).hasClass("validated");
			let invalidFeedback =
				$(elem).parent().find(".invalid-feedback").length > 0
					? $(elem).parent().find(".invalid-feedback")
					: $(elem).parent().parent().find(".invalid-feedback").length > 0
					? $(elem).parent().parent().find(".invalid-feedback")
					: $(elem).parent().parent().parent().find(".invalid-feedback");
			validated
				? $(elem).removeClass("is-invalid").addClass("is-valid")
				: $(elem).removeClass("is-invalid").removeClass("is-valid");
			invalidFeedback.text("");
			$(elem).val(moment(data).format("MMMM DD, YYYY"));
		}
	});
};
// ----- END INIT DATERANGE -----


// ----- GENERATE ID -----
function generateInputsID(elementID = "") {
    if (elementID) {
        const inputs = $(elementID).find(differentInputStr, (item) => item);
		for (let i = 0; i < inputs.length; i++) {
            let name   = inputs[i].name;
            let tempID = name+i;
            $(`[name="${name}"]`).attr("id", `${tempID}`);
            $(`[name="${name}"]`).closest(`.form-group`).find(`.invalid-feedback`).attr("id", `invalid-${tempID}`);
        }
    }
}
// ----- END GENERATE ID -----


// ----- VALIDATE INPUTS -----
const validateInput = (elementID) => {
	$(elementID).addClass("validated");
	let fuelConsumption = $(elementID).hasClass("input-fuel");
	let currency = $(elementID).hasClass("amount");
	let number   = $(elementID).hasClass("number");
	let quantity = $(elementID).hasClass("input-quantity");
	let numberLength = $(elementID).hasClass("input-numberLength");
	let hours    = $(elementID).hasClass("input-hours");
	let hoursLimit    = $(elementID).hasClass("input-hoursLimit");
	let required = $(elementID).attr("required");
	let disabled = $(elementID).attr("disabled");
	let value =
		$(`select${elementID}`).length > 0
			? $(elementID).val()
			: $(elementID).val().trim();
	let valLength = value ? value.length : 0;
	let invalidFeedback =
		$(elementID).parent().find(".invalid-feedback").length > 0
			? $(elementID).parent().find(".invalid-feedback")
			: $(elementID).parent().parent().find(".invalid-feedback").length > 0
			? $(elementID).parent().parent().find(".invalid-feedback")
			: $(elementID).parent().parent().parent().find(".invalid-feedback");

	let isInputSelect = $("select" + elementID).length;
	let isInputButton =
		$("button" + elementID).length > 0
			? $("button" + elementID).length
			: $("[type=button]" + elementID).length;
	if (disabled == "undefined" || disabled == undefined) {
        if (required != undefined && required != "undefined") {
            if (valLength <= 0) {
                $(elementID).removeClass("is-valid").addClass("is-invalid").removeClass("no-error").addClass("has-error");
                invalidFeedback.text("This field is required.");
            } else {
                $(elementID).removeClass("is-invalid").addClass("is-valid").removeClass("has-error").addClass("no-error");
                invalidFeedback.text("");
            }
        }

		// if (isInputSelect > 0) {
		// 	let value = $("select" + elementID).val();
		// 	let isSelect2 = $("select" + elementID + ".select2").length;
		// 	if (required != undefined && required != "undefined") {
		// 		if (isSelect2) {
		// 			if (
		// 				value == "" ||
		// 				value == "undefined" ||
		// 				value == undefined ||
		// 				value == "null" ||
		// 				value == null
		// 			) {
		// 				$(elementID)
		// 					.parent()
		// 					.find(".selection")
		// 					.children()
		// 					.removeClass("is-invalid")
		// 					.removeClass("is-valid")
		// 					.removeClass("no-error")
		// 					.addClass("has-error");
		// 				$(elementID).removeClass("is-valid").addClass("is-invalid");
		// 				invalidFeedback.text("This field is required.");
		// 			} else {
		// 				$(elementID)
		// 					.parent()
		// 					.find(".selection")
		// 					.children()
		// 					.removeClass("is-invalid")
		// 					.removeClass("is-valid")
		// 					.removeClass("has-error")
		// 					.addClass("no-error");
		// 				$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 				invalidFeedback.text("");
		// 				checkExists(elementID, invalidFeedback);
		// 			}
		// 		} else {
		// 			if (
		// 				value == "" ||
		// 				value == "undefined" ||
		// 				value == undefined ||
		// 				value == "null" ||
		// 				value == null
		// 			) {
		// 				$(elementID)
		// 					.parent()
		// 					.find(".selection")
		// 					.children()
		// 					.removeClass("is-invalid")
		// 					.removeClass("is-valid")
		// 					.removeClass("no-error")
		// 					.addClass("has-error");
		// 				invalidFeedback.text("This field is required.");
		// 			} else {
		// 				$(elementID)
		// 					.parent()
		// 					.find(".selection")
		// 					.children()
		// 					.removeClass("is-invalid")
		// 					.removeClass("is-valid")
		// 					.removeClass("has-error")
		// 					.addClass("no-error");
		// 				invalidFeedback.text("");
		// 				checkExists(elementID, invalidFeedback);
		// 			}
		// 		}
		// 	} else {
		// 		$(elementID)
		// 			.parent()
		// 			.removeClass("is-invalid")
		// 			.removeClass("is-valid")
		// 			.removeClass("has-error")
		// 			.addClass("no-error");
		// 		$(elementID)
		// 			.parent()
		// 			.find(".selection")
		// 			.children()
		// 			.removeClass("is-invalid")
		// 			.removeClass("is-valid")
		// 			.removeClass("has-error")
		// 			.addClass("no-error");
		// 		$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 		invalidFeedback.text("");
		// 		checkExists(elementID, invalidFeedback);
		// 	}
		// } else if (isInputButton > 0) {
		// 	let value = $("[type=button]" + elementID).val()
		// 		? $("[type=button]" + elementID).val()
		// 		: $("button" + elementID).val();
		// 	if (required != undefined && required != "undefined") {
		// 		if (value != "" && value != undefined && value != null) {
		// 			$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 			invalidFeedback.text("");
		// 			checkExists(elementID, invalidFeedback);
		// 		} else {
		// 			$(elementID).removeClass("is-valid").addClass("is-invalid");
		// 			invalidFeedback.text("This field is required.");
		// 			checkExists(elementID, invalidFeedback);
		// 		}
		// 	} else {
		// 		$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 		invalidFeedback.text("");
		// 	}
		// } else {
		// 	if (required != undefined && required != "undefined") {
		// 		if (valLength <= 0) {
		// 			$(elementID).removeClass("is-valid").addClass("is-invalid");
		// 			invalidFeedback.text("This field is required.");
		// 		} else {
		// 			$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 			invalidFeedback.text("");
		// 			checkLength(elementID, invalidFeedback);
		// 			number && checkNumber(elementID, invalidFeedback, value);
		// 			currency && checkAmount(elementID, invalidFeedback, value);
		// 			fuelConsumption && checkFuel(elementID, invalidFeedback, value);
		// 			quantity && checkQuantity(elementID, invalidFeedback, value);
		// 			numberLength && checkNumberLength(elementID, invalidFeedback, value);
		// 			hours && checkHours(elementID, invalidFeedback, value);
		// 			hoursLimit && checkHoursLimit(elementID, invalidFeedback, value);
		// 			checkEmail(elementID, invalidFeedback, value);
		// 			checkURL(elementID, invalidFeedback, value);
		// 			checkExists(elementID, invalidFeedback);
		// 		}
		// 	} else {
		// 		$(elementID).removeClass("is-invalid").addClass("is-valid");
		// 		valLength > 0 && checkLength(elementID, invalidFeedback);
		// 		number && checkNumber(elementID, invalidFeedback, value);
		// 		currency && checkAmount(elementID, invalidFeedback, value);
		// 		fuelConsumption && checkFuel(elementID, invalidFeedback, value);
		// 		quantity && checkQuantity(elementID, invalidFeedback, value);
		// 		numberLength && checkNumberLength(elementID, invalidFeedback, value);
		// 		hours && checkHours(elementID, invalidFeedback, value);
		// 		hoursLimit && checkHoursLimit(elementID, invalidFeedback, value);
		// 		checkEmail(elementID, invalidFeedback, value);
		// 		checkURL(elementID, invalidFeedback, value);
		// 		checkExists(elementID, invalidFeedback);
		// 	}
		// }
	}
};
// ----- END VALIDATE INPUTS -----


// ----- VALIDATE FORMS -----
const validateForm = (formID = null) => {
	if (formID) {
		const inputs = $("#" + formID).find(differentInputStr, (item) => item);
		for (let i = 0; i < inputs.length; i++) {
			if (inputs[i].id) {
				validateInput("#" + inputs[i].id);
			}
		}
		if ($(`#${formID}`).find(".is-invalid").length > 0) {
			$(`#${formID}`).find(".is-invalid")[0].focus();
			return false;
		}
		return true;
	}
};
// ----- END VALIDATE FORMS -----


// ----- GET FORM DATA -----
const getFormData = (formID = null, object = true) => {
	let result = [],
		output = {
			tableData: {},
		};
	let formData = new FormData();
	if (formID) {
		const inputs = $("#" + formID).find(differentInputStr, (item) => item);
		for (let i = 0; i < inputs.length; i++) {
			let flag = true;
			let countFlag = 0;
			let value = inputs[i].value;
			const id = inputs[i].id;
			const name = inputs[i].name;
			if (id && name) {
				if ($("#" + id).is("select") && inputs[i].hasAttribute("multiple")) {
					let temp = $("#" + id).val();
					value = temp.join("|");
				}
				if (inputs[i].type == "radio") {
					if (inputs[i].checked) {
						value = inputs[i].value;
					} else {
						flag = false;
					}
				}
				if (inputs[i].type == "file") {
					let file = document.getElementById(id);
					let fileLength = file.files.length;
					if (fileLength > 0) {
						for (var j = 0; j < fileLength; j++) {
							let file = $("#" + id)[0].files[j];
							let fileType = file.name.split(".");
							let fileName = `${name}.${fileType[1]}`;
							formData.append(`tableData[${name}][]`, file, fileName);
						}
					}
					countFlag++;
				}
				if (inputs[i].type == "checkbox") {
					if ($(`#${id}[name=${name}]`).length > 1) {
						value = [];
						$(`#${id}:checked`).each(function () {
							value.push(this.value);
						});
					} else {
						value = inputs[i].checked ? 1 : 0;
					}
				}
				if (inputs[i].type == "button") {
					let date = moment(value);
					if (date.isValid()) {
						value = date.format("YYYY-MM-DD");
					}
				}
				if (inputs[i].className.indexOf("amount") != -1) {
					value = value.replace(",", "");
				}
				const data = { id, name, value };
				result.length > 0 &&
					result.map((item) => {
						item.name === name && item.id === id && countFlag++;
					});
				if (flag && countFlag == 0) {
					result.push(data);
					if (Array.isArray(value) && inputs[i].type != "file") {
						value = value.join("|");
					}
					output.tableData[name] = value;
					formData.append(`tableData[${name}]`, value);
				}
			}
		}
	}
	return !object ? formData : output;
};
// ----- END GET FORM DATA -----