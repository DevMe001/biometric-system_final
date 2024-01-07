// Function to generate barcode using JsBarcode and create an SVG element
function generateBarcode(code) {
	var svg = document.getElementById('barcodeSVG');

	JsBarcode(svg, code, {
		format: 'CODE128',
		displayValue: false,
	});
}

// let genNumber = $('#refNumber').val();
// // Example usage
// generateBarcode(genNumber);

$('#typeStudent').on('change', function () {
	console.log(this.value, 'get value of useer');
	let value = this.value;

	if (value === 'regular') {
		$('#next-button__1').addClass('hidden');
		$('#oldUserModal').click();
	}
	if (value === 'new') {
		$('#next-button__1').removeClass('hidden');
	} else {
		$('#next-button__1').addClass('hidden');
	}
});

// get type

$('#typeEnroll').on('change', function () {
	$('#level').find('option').remove();
	// call query
	const data = {
		type: this.value,
	};

	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', 'src/function/controller.php?action=getYrType', true);

	xhttp.onreadystatechange = function () {
		if (this.readyState === 4) {
			if (this.status === 200) {
				let response = JSON.parse(this.responseText);

				let listitems = '<option value=""></option>';
				response.forEach((item) => {
					listitems += '<option value="' + item.id + '" data-qualify="' + item.qualify_age + '">' + item.name + '</option>';
				});

				console.log(response, 'get errror');

				$('#level').append(listitems);

				$('#typeYearLevel').removeClass('hidden');
			} else {
			}
		}
	};

	$('#typeYearLevel').on('change', function () {
		$('#newDivSection').removeClass('hidden');
	});

	let payload = `data=${JSON.stringify(data)}`;

	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhttp.send(payload);
});

$('#level').on('change', function () {
	// const getGrade = $('#studentRecTitle').text($('#level option:selected').text());
	let getSelectedLevel = $('#level option:selected').text();
	$('#studentRecTitle').text(`Registration form ( ${getSelectedLevel} )`);
});

// $('#credentialType').on('change', function () {
// 	let credential = this.value;

// 	console.log(credential, 'get value');

// 	switch (credential) {
// 		case 'local':
// 			$('#local').removeClass('hidden');
// 			$('#foreign').addClass('hidden');

// 			// Uncheck all foreign checkboxes
// 			$('.foreign:checked').each(function () {
// 				$(this).prop('checked', 1);
// 			});

// 			break;
// 		case 'foreign':
// 			$('#local').addClass('hidden');
// 			$('#foreign').removeClass('hidden');

// 			// Uncheck all local checkboxes
// 			$('.local:checked').each(function () {
// 				$(this).prop('checked', 1);
// 			});
// 			break;
// 		default:
// 			$('#local').addClass('hidden');
// 			$('#foreign').addClass('hidden');
// 			$('.local').each(function () {
// 				$(this).prop('checked', false);
// 			});
// 			$('.foreign').each(function () {
// 				$(this).prop('checked', false);
// 			});
// 			break;
// 	}
// });

$('#credentialType').on('change', function () {
	let credential = this.value;

	console.log(credential, 'get value');

	switch (credential) {
		case 'local':
			$('#local').removeClass('hidden');
			$('#foreign').addClass('hidden');

			// Uncheck all foreign checkboxes
			$('.foreign:checked').each(function () {
				$(this).prop('checked', false);
			});

			break;
		case 'foreign':
			$('#local').addClass('hidden');
			$('#foreign').removeClass('hidden');

			// Uncheck all local checkboxes
			$('.local:checked').each(function () {
				$(this).prop('checked', false);
			});
			break;
		default:
			$('#local').addClass('hidden');
			$('#foreign').addClass('hidden');
			$('.local').each(function () {
				$(this).prop('checked', false);
			});
			$('.foreign').each(function () {
				$(this).prop('checked', false);
			});
			break;
	}
});

// !!!!!!!!!!!!!!!!!LOCAL!!!!!!!!!!!!!


$('#selectForm37').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-local1', '#form37');
});

$('#selectBcert').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-local2', '#bcert');
});

$('#selectgmoral').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-local3', '#gmoral');
});

$('#select_rec_letter').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-local4', '#rec_letter');
});

$('#select_med_cert').on('change', function () {
	let formSelect = this.value;
	uploadSelectCondition(formSelect, '.form-local5', '#med_cert');
});



$('#selectForm38').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-local6', '#form38');
});


// form 137 preview handler

$('#form37').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#formImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#form37-error', '#form37');
	});
});

$('#bcert').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#bcertImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#bcertImgPreview-error', '#bcert');
	});
});

$('#gmoral').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#gmoralImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#gmoral-error', '#gmoral');
	});
});

$('#rec_letter').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#recLetterImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#rec_letter-error', '#rec_letter');
	});
});

$('#med_cert').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#medCertImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#medCertImgPreview-error', '#med_cert');
	});
});

$('#form38').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#form38ImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#form38-error', '#form38');
	});
});



//  !!!!!!!!!!!!!!!!!!!END LOCAL !!!!!!!!!!!!!!!!!!!!!!!!

//!!!!!!!!!!!!!!!!!!!! FOREIGN !!!!!!!!!!!!!!!!!!!!

$('#select_stud_permit').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-foreign1', '#stud_permit');
});

$('#select_alien_cert').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-foreign2', '#alien_cert');
});

$('#select_passport_copy').on('change', function () {
	let formSelect = this.value;

	uploadSelectCondition(formSelect, '.form-foreign3', '#passport_copy');
});

$('#select_auth_rec').on('change', function () {
	let formSelect = this.value;
	uploadSelectCondition(formSelect, '.form-foreign4', '#auth_rec');
});

$('#stud_permit').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#studImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#stud_permit-error', '#stud_permit');
	});
});

$('#alien_cert').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#alienImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#alienImgPreview-error', '#alien_cert');
	});
});

$('#passport_copy').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#passportImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#passport_copy-error', '#passport_copy');
	});
});

$('#auth_rec').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#authImgPreview', file, '.default-img', (id, file, defaultHide) => {
		onUploadFile(id, file, defaultHide, '#auth_rec-error', '#auth_rec');
	});
});

// emd foreign

function uploadSelectCondition(formSelect, className, fileId) {
	if (formSelect == 'upload') {
		$('.default-img').removeClass('hidden');
		$(className).removeClass('hidden');
	} else {
		$(className).addClass('hidden');

		$(fileId).val('');
		$(fileId).removeAttr('required');
	}
}

function onUploadFile(id, file, defaultHide, classError, fileId) {
	let previewImgId = $(id);

	const ctvUrl = URL.createObjectURL(file);

	// Set the background-image and background-size CSS properties
	$(defaultHide).addClass('hidden');

	previewImgId.addClass('border-2 rounded');
	previewImgId.css('background', `url('${ctvUrl}') no-repeat`);
	previewImgId.css('background-size', 'contain');
	previewImgId.css('background-position', 'center center');
	previewImgId.css('object-fit', 'contain');
	previewImgId.css('padding', '80px');

	$(classError).addClass('hidden');
	$(fileId).removeAttr('required');

	// Revoke the object URL when the image is loaded
	img.onload = () => {
		URL.revokeObjectURL(ctvUrl);
	};
}

// end

$('#profile').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandler('#previewImgDiv', file, '.default-img', (id, file, defaultHide) => {
		faceDetector(id, file, defaultHide);
	});
});

function filePreviHandler(id, file, defaultHide, cb) {
	if (file.size > 1048576) {
		Swal.fire({
			icon: 'error',
			title: 'File is not supported',
			text: 'File size is less than 1Mb',
			footer: null,
		});
	} else {
		if (file.type.startsWith('image')) {
			console.log('ok begin uploads');

			cb(id, file, defaultHide);
		} else {
			Swal.fire({
				icon: 'error',
				title: 'File is not supported',
				text: 'Only images allowed',
				footer: null,
			});
		}
	}
}

let sendFile;

function faceDetector(id, file, defaultHide) {
	const imageFile = file;
	const img = new Image();
	const canvas = document.createElement('canvas');
	const ctx = canvas.getContext('2d');
	const ctv = URL.createObjectURL(imageFile);

	img.src = ctv;

	img.onload = async () => {
		canvas.width = img.width;
		canvas.height = img.height;
		ctx.drawImage(img, 0, 0, img.width, img.height);

		const MODEL_URL = 'src/js/weights';
		// Load the face-api.js models
		await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
		await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
		await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

		const faceDetectionOptions = new faceapi.TinyFaceDetectorOptions();
		const detections = await faceapi.detectAllFaces(canvas, faceDetectionOptions).withFaceLandmarks().withFaceDescriptors();

		let previewImgId = $(id);
		// Handle Blob URL errors
		img.onerror = () => {
			displayErrorOnScreen(previewImgId, defaultHide, 'Failed to load image.');
		};

		// Set the background-image and background-size CSS properties
		$(defaultHide).addClass('hidden');

		previewImgId.addClass('border-2 rounded');
		previewImgId.css('background', `url('src/images/loader.gif') no-repeat`);
		previewImgId.css('background-size', 'contain');
		previewImgId.css('background-position', 'center center');
		previewImgId.css('object-fit', 'contain');

		console.log(detections.length, 'get detection');

		if (detections.length > 0) {
			setTimeout(() => {
				const ctvUrl = URL.createObjectURL(file);

				// Set the background-image and background-size CSS properties
				$(defaultHide).addClass('hidden');

				previewImgId.addClass('border-2 rounded');
				previewImgId.css('background', `url('${ctvUrl}') no-repeat`);
				previewImgId.css('background-size', 'contain');
				previewImgId.css('background-position', 'center center');
				previewImgId.css('object-fit', 'contain');

				sendFile = file;
				$('#profile-error').addClass('hidden');
				$('#profile').removeAttr('required');

				// Revoke the object URL when the image is loaded
				img.onload = () => {
					URL.revokeObjectURL(ctvUrl);
				};
			}, 3000);
		} else {
			$('#profile-error').removeClass('hidden');
			$('#profile-error').text('Upload consise,clear face image');

			// Handle the case where no faces are detected
			displayErrorOnScreen(previewImgId, defaultHide, 'Upload consise,clear face image');
		}
	};
}

function displayErrorOnScreen(previewImgId, defaultHide, errorMessage) {
	previewImgId.css('background', 'transparent');
	$(defaultHide).removeClass('hidden');

	setTimeout(() => {
		Swal.fire({
			icon: 'error',
			text: 'Face verification denied',
			title: errorMessage,
			footer: null,
		});
	}, 2000);
}

$('#profile-error').removeClass('hidden');

// end multiple form

// retrict users inputs

$('#birthdate').on('change', function () {
	const qualifyAge = $('#level option:selected').data('qualify');
	const qualifyLevel = $('#level option:selected').text();

	console.log(qualifyAge);

	const birthdate = new Date(this.value);
	const currDate = new Date();

	const bdayYear = birthdate.getFullYear();
	const currDateYear = currDate.getFullYear();

	let age = currDateYear - bdayYear;

	if (currDate.getMonth() < birthdate.getMonth() || (currDate.getMonth() === birthdate.getMonth() && currDate.getDate < birthdate.getDate())) {
		age--;
	}

	if (age > 0) {
		$('#ageReveal').removeClass('hidden');
		$('#guestmyAge').text(age);
		$('#age').val(age);
	} else {
		this.value = '';
		Swal.fire({
			icon: 'error',
			text: `Age cannot be equal to zero`,
			title: 'Age not allowed',
			footer: null,
		});

		$('#ageReveal').addClass('hidden');
		$('#guestmyAge').text('');
		$('#guestmyAge').val('');
	}
});


$('#copyText').on('click',function(){
	// get the value of text
	let refNumber = $('#refLabel').text();

	// Use the Clipboard API to copy the text to the clipboard
	navigator.clipboard
		.writeText(refNumber)
		.then(function () {
			$('#copyText').text('Copied');
		})
		.catch(function (err) {
			console.error('Unable to copy to clipboard', err);
		});
});

$('#barcodeSVG').on('click', function () {
		downloadSvg();
		downloadPng();
});

$('#downloadFile').on('click', function () {
	downloadSvg();
	downloadPng();
});


function downloadPng() {
	var svgElement = document.getElementById('barcodeSVG');
	let refNumber = $('#refLabel').text();
	let fileGen = `${refNumber}.png`;

	html2canvas(svgElement, {
		scale: 2, // Increase the scale for better resolution
	}).then(function (canvas) {
		// Convert the canvas to PNG
		canvas.toBlob(function (blob) {
			// Create a download link
			var downloadLink = document.createElement('a');
			downloadLink.href = URL.createObjectURL(blob);
			downloadLink.download = fileGen;

			// Append the link to the document and trigger the download
			document.body.appendChild(downloadLink);
			downloadLink.click();

			// Remove the link from the document
			document.body.removeChild(downloadLink);
		}, 'image/png');
	});
}

$('#reloadPage').on('click', function () {
	location.reload();
});



function downloadSvg(){
	// Get the SVG element as a string
	var svgContent = new XMLSerializer().serializeToString(document.getElementById('barcodeSVG'));

	// Create a Blob from the SVG string
	var blob = new Blob([svgContent], { type: 'image/svg+xml' });

	let refNumber = $('#refLabel').text();

	let fileGen = `${refNumber}.svg`;

	// Create a download link
	var downloadLink = document.createElement('a');
	downloadLink.href = URL.createObjectURL(blob);
	downloadLink.download = fileGen;

	// Append the link to the document and trigger the download
	document.body.appendChild(downloadLink);
	downloadLink.click();

	// Remove the link from the document
	document.body.removeChild(downloadLink);
}

$('#reloadPage').on('click',function(){
	location.reload();
});

$(document).ready(function () {
	// jQuery.validator.addMethod(
	// 	'validPlus639Number',
	// 	function (value, element) {
	// 		return this.optional(element) || /^\639\d{11}$/.test(value);
	// 	},
	// 	"Phone number must start with '+639' and have a length of 13 characters",
	// );

	// Custom validation method for '09' numbers
	jQuery.validator.addMethod(
		'phNumber',
		function (value, element) {
			return this.optional(element) || /^09\d{9}$/.test(value);
		},
		"Phone number must start with '09' and have a length of 11 digit",
	);

	// create  form validation
	$('#regFormInfo').validate({
		rules: {
			// type of enroll
			typeEnroll: {
				required: true,
			},
			level: {
				required: true,
			},
			gwa: {
				required: true,
				number: true,
				range: [75, 100],
			},
			profile: {
				required: true,
			},
			studentNumber: {
				required: true,
				// validPlus639Number: function (element) {
				// 	// Only apply this rule if the input starts with '+639'
				// 	return /^(\639)/.test($(element).val());
				// },
				phNumber: function (element) {
					// Only apply this rule if the input starts with '09'
					return /^(09)/.test($(element).val());
				},
			},
			fatherName: {
				required: function (element) {
					return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '' && $('#guardianEmail').val() === '');
				},
			},
			fatherNumber: {
				required: function (element) {
					return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '' && $('#guardianEmail').val() === '');
				},

				phNumber: function (element) {
					// Only apply this rule if the input starts with '09'
					return /^(09)/.test($(element).val());
				},
			},
			fatherOccupation: {
				required: function (element) {
					return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '' && $('#guardianEmail').val() === '');
				},
			},
			motherName: {
				required: function (element) {
					return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '' && $('#guardianEmail').val() === '');
				},
			},
			motherOccupation: {
				required: function (element) {
					return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '' && $('#guardianEmail').val() === '');
				},
			},
			motherNumber: {
				required: true,

				phNumber: function (element) {
					// Only apply this rule if the input starts with '09'
					return /^(09)/.test($(element).val());
				},
			},

			guardiansName: {
				required: function (element) {
					return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
				},
			},
			guardianContactNumber: {
				required: function (element) {
					return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
				},

				phNumber: function (element) {
					// Only apply this rule if the input starts with '09'
					return /^(09)/.test($(element).val());
				},
			},
			guardianAddress: {
				required: function (element) {
					return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
				},
			},

			guardianEmail: {
				required: function (element) {
					return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
				},
			},
			contactNumber: {
				required: true,

				phNumber: function (element) {
					// Only apply this rule if the input starts with '09'
					return /^(09)/.test($(element).val());
				},
			},

			// end fiRST FORM
			// personal information
			// emergency
			// birth cerificate
			// biometric
		},
		messages: {
			// type of enroll
			typeEnroll: {
				required: 'Field cannot empty.',
			},
			level: {
				required: 'Field cannot empty.',
			},

			profile: {
				required: 'Please upload a valid file.',
				accept: 'Only image and PDF files are allowed.',
			},
			gwa: {
				required: 'This field is required',
				number: 'Please enter a valid number',
				range: 'Please enter a number between 75 and 100',
			},
			studentNumber: {
				required: 'Phone number is required',
			},
			fatherName: {
				required: 'Field is required if guardian is empty put not applicable if not related',
			},
			fatherOccupation: {
				required: 'Field is required required if guardian is empty',
			},
			fatherNumber: {
				required: 'Phone number is required',
			},
			motherName: {
				required: 'Field is required  if guardian is empty put not applicable if not related',
			},
			motherOccupation: {
				required: 'Field is required  if guardian is empty Not put not applicable if not related',
			},
			motherNumber: {
				required: 'Phone number is required',
			},
			guardiansName: {
				required: 'Phone number is required',
			},
			guardianContactNumber: {
				required: 'Phone number is required',
			},
			guardianAddress: {
				required: 'Field is required when mother and father is empty put not applicable if not related',
			},
			contactNumber: {
				required: 'Phone number is required',
			},

			// end fiRST FORM
			// personal information
			// emergency
			// birth cerificate
			// biometric
		},
	});

	$('.reg_class').hide();
	$('.reg_local').hide();
	$('.reg_foreign').hide();

	$('.reg_local:first').show();
	$('.reg_class:first').show();
	$('.reg_foreign:first').show();

	const prevLocal = [1, 2, 3, 4, 5,6];
	const nexLocal = [1, 2, 3, 4, 5,6];

	prevLocal.forEach((id) => {
		prevFieldset(`#prev-button_local__${id}`, '.reg_local');
	});

	nexLocal.forEach((id) => {
		nextFieldSet(`#next-button_local__${id}`, '.reg_local');
	});

	const prevForeign = [1, 2, 3, 4];
	const nexForeign = [1, 2, 3, 4];

	prevForeign.forEach((id) => {
		prevFieldset(`#prev-button_foreign__${id}`, '.reg_foreign');
	});

	nexForeign.forEach((id) => {
		nextFieldSet(`#next-button_foreign__${id}`, '.reg_foreign');
	});

	// end restriction

	// show

	let currentStep = 0;
	// nextFieldSet(`#next-button__1`);
	const prevIndex = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
	const nextIndex = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

	prevIndex.forEach((id) => {
		prevFieldset(`#prev-button__${id}`, '.reg_class');
	});

	nextIndex.forEach((id) => {
		nextFieldSet(`#next-button__${id}`, '.reg_class');
	});

	let submitForm = false;

	


	$('#next-button_local__6').on('click', function () {

			let valid = $('#regFormInfo').valid();

			let getCredentialType = $('#credentialType').val();

			console.log(valid, 'get valid');
			if (valid && getCredentialType == 'local') {
				submitForm = true;
			
			}

		

			
	});

	$('#next-button_foreign__4').on('click', function () {
	
				let valid = $('#regFormInfo').valid();
				let getCredentialType = $('#credentialType').val();

				console.log(valid, 'get valid');
				if (valid && getCredentialType == 'foreign') {
					submitForm = true;
				
				}
	

	});




	$('#regFormInfo').submit(function (event) {
		event.preventDefault();

		let hidden = $('fieldset:hidden');

		console.log(hidden, 'get hidden');

			console.log(currentStep,'current steps');
		console.log($('fieldset:hidden').length, 'get hidden');
		console.log($('#regFormInfo').valid());




		let getlength = $('.reg_class:hidden').length;
		let valid = $('#regFormInfo').valid();
		const getProfile = renameAndUploadFile('profile', sendFile);

		if (valid === true && submitForm) {
			console.log('Form submitted successfully!');

			const form = document.getElementById('regFormInfo');

			const formData = new FormData(form);
			formData.append('renameProfile', getProfile);
		
						httpResFormData('formRegistration', formData, (res) => {
							console.log(res, 'get response');
							if (res.success) {
								
									// get refference number
								if(res.refNumber !== ''){
											generateBarcode(res.refNumber);

											$('#refLabel').text(res.refNumber);
											$('#pageReload').removeClass('hidden');
												$('.reg_class').hide();
												$('.reg_class:last').show();

											$('#formLabel').addClass('hidden');


									Swal.fire({
										icon: 'success',
										title: 'Accepted request',
										text: res.message,
										footer: null,
									});
								}
								else{
									e.preventDefault();
										Swal.fire({
											icon: 'error',
											title: 'Something went wrong please check your info',
											text: res.message,
											footer: null,
										});
								}

							} else {
								$('#lastCallBtn').removeClass('hidden');

								Swal.fire({
									icon: 'error',
									title: 'Forbidden Request',
									text: res.message,
									footer: null,
								});
							}
						});
			
				

		} else {
			console.log('Form submission prevented.');
			event.preventDefault();
		}
	});
});

function renameAndUploadFile(fileName, file) {
	const lrn = $('#lrn').val();

	if (file) {
		const ext = file.name.split('.')[1];

		const newFileName = `${fileName}${lrn}.${ext}`;

		const renamedFile = new File([file], newFileName, { type: file.type });

		return renamedFile;
	} else {
		return 'Please select a file and enter a new file name.';
	}
}

function prevFieldset(id, className) {
	$(id).click(function () {
		if ($('#regFormInfo').valid()) {
			let currentFieldset = $(`${className}:visible`);
			let prevFieldset = currentFieldset.prev(className);

			if (prevFieldset.length > 0) {
				currentFieldset.hide();
				prevFieldset.show();
			}
		}
	});
}

// Function to navigate to the next fieldset
function nextFieldSet(id, className) {
	$(id).click(function () {
		if ($('#regFormInfo').valid()) {
			let currentFieldset = $(`${className}:visible`);
			let nextFieldset = currentFieldset.next(className);

			if (nextFieldset.length > 0) {
				currentFieldset.hide();
				nextFieldset.show();
			}
		}
	});
}



function httpJSONReq(action, data, cb) {
	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', `src/function/controller.php?action=${action}`, true);

	xhttp.onreadystatechange = function () {
		if (this.readyState === 4) {
			if (this.status === 200) {
				let response = JSON.parse(this.responseText);
				cb(response);
			} else {
				cb(response);
			}
		}
	};

	let payload = `data=${JSON.stringify(data)}`;
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhttp.send(payload);
}
