// Wait for the DOM to be ready

//this function will reset the input to blank
//Dont forget, Form must have name but it must be unique (dili puro null)

jQuery.validator.addMethod(
	"lettersonly",
	function(value, element) {
		return this.optional(element) || /^[a-zA-Z_ -]+$/i.test(value);
	},
	"Only alphabetical characters"
);
jQuery.validator.addMethod(
	"alphanumeric",
	function(value, element) {
		return this.optional(element) || /^[,;a-zA-Z0-9()"'._ /-]+$/i.test(value);
	},
	"Only alphanumeric characters"
);
$.validator.addMethod(
	"loginRegex",
	function(value, element) {
		return this.optional(element) || /^[,;a-zA-Z0-9_-]+$/i.test(value);
	},
	"Username must contain only letters, numbers, or dashes."
);

function validate(form) {
	var isExist = $(form).val();
	if (isExist != undefined) {
		var formName = $(form).attr("name");
		console.log(formName + " has been validated");
		//alert(formName);
		// Initialize form validation on the registration form.
		// It has the name attribute "registration"
		$("form[name='" + formName + "']").validate({
			// Specify validation rules
			ignore: ":not(.validate)", //validate hidden fields like select but MUST HAVE a validate class (ignore all inputs except .validate class)
			errorElement: "div",
			errorPlacement: function(error, element) {
				var placement = $(element).data("error");
				if (placement) {
					$(placement).append(error);
				} else {
					error.insertAfter(element);
				}
			},
			errorClass: "error errorlabel"
		});
		$("form[name='" + formName + "'] input.lettersonly").each(function() {
			$(this).rules("add", {
				required: true,
				alphanumeric: true
			});
		});
		$("form[name='" + formName + "'] input[type='text']").each(function() {
			$(this).rules("add", {
				required: true,
				alphanumeric: true
			});
		});
		$("form[name='" + formName + "'] input[type='number']").each(function() {
			$(this).rules("add", {
				required: true,
				number: true
			});
		});
		$("form[name='" + formName + "'] input[type='email']").each(function() {
			$(this).rules("add", {
				required: true,
				email: true
			});
		});
		$("form[name='" + formName + "'] input[type='date']").each(function() {
			$(this).rules("add", {
				required: true
			});
		});
		$("form[name='" + formName + "'] input[type='password']").each(function() {
			$(this).rules("add", {
				required: true
				//loginRegex: true
			});
		});
		$("form[name='" + formName + "'] select.validate").each(function() {
			$(this).rules("add", {
				required: true
			});
		});
	} else {
		console.log("validate this " + form + " not found on this UI");
	}
}

//validate image here
function validateImage(image) {
	$(image).on("change", function() {
		var file = this.files[0];
		if (file.size > 625000) {
			Materialize.toast("Upload size exceed to 5mb", 3000, "rounded red");
		} else {
			$("#btnUpload").removeClass("disabled");
		}
	});
}

//Autocomplete Initialization
$("form").each(function() {
	validate($(this));
	//console.log($(this));
});
