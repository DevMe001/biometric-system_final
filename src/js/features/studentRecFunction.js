const studentRecTable = '.student-table';
const studentRecNoTesult = 'studentRecNoResult';

// enrollment table

const enrollmenttRecTable = '.enroll-table';
const enrollRecNoTesult = 'enrollRecNoResult';
const enrollRecSearchId = 'enrollListRecSearchEl';

// menu
const studentMenu = '#studentRecDropdownMenu';
const studentDropdownBtn = '#studentRecDropdownBtn';

// filter
const studentRecSearchId = 'masterListRecSearchEl';
const studentRecToggle = '#onModalStudentRecToggle';

// search

const studentRecPrint = 'studentRecPrint';
const studentRecPageArea = '.student-printable';


const studentReciept = 'printReceipt';
const studentReceiptArea = '.receipt-print';


const studentRegReciept = 'printRegReceipt';
const studentRegReceiptArea = '.receipt-print';



// getMenu(studentMenu, studentRecTable);
showPage(enrollmenttRecTable, enrollRecNoTesult);
showPage(studentRecTable, studentRecNoTesult);
// tableSorting(studentMenu, studentRecTable, studentRecNoTesult);

// msater listable 

let studentRecSearchEl = document.getElementById(studentRecSearchId);

studentRecSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(studentRecTable, studentRecNoTesult, searchValue);
});



let enrollRecSearchEl = document.getElementById(enrollRecSearchId);

enrollRecSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');


	if (searchValue.length > 0) {
		filterTable(enrollmenttRecTable, enrollRecNoTesult, searchValue);
	} else {
		$('#' + enrollRecNoTesult).addClass('hidden');
		showPage(enrollmenttRecTable, enrollRecNoTesult);
	}
});

$('#' + studentRecPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(studentRecPageArea).removeClass('hidden');

	$(studentRecPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentRecPageArea).addClass('hidden');
		}),
	});
});



// print student masterlist

$('#printRegisterForm').on('click', (e) => {


	$('#editMasterForm').print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentRecPageArea).addClass('hidden');
		}),
	});
});


// student masterlist eevent
$('#getRoutePath').on('click', function () {
	alert('click me');
	console.log('click registration route')
});






$('#' + studentReciept).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	
	$(studentReceiptArea).removeClass('hidden');
 	// document.querySelector('body > div[modal-backdrop]')?.remove();
	$(studentReceiptArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentReceiptArea).addClass('hidden');
			// After printing, add the 'modal-backdrop' element back
			const newModalBackdrop = document.createElement('div');
			newModalBackdrop.setAttribute('modal-backdrop', '');
			document.body.appendChild(newModalBackdrop);
		}),
	});
});



// filter oer year


$(document).ready(function () {
	var schoolYearInput = $('#getRecentYear');
	var yearDropdown = $('#getRecYearly');


	// Event listener for dropdown change
	yearDropdown.change(function () {
		location.href = `?page=dashboard&filteredYear=${this.value}`;
			localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: ''}));

	});
});

// $('#getRecYearly').on('change',function(){
// 		var schoolYearInput = document.getElementById('getRecentYear');

// 		schoolYearInput.val('2024');

// })




$('#' + studentRegReciept).on('click', (e) => {
	$('.custom-table').addClass('hidden');

	$(studentReceiptArea).removeClass('hidden');
	// document.querySelector('body > div[modal-backdrop]')?.remove();
	$(studentReceiptArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentReceiptArea).addClass('hidden');
			// After printing, add the 'modal-backdrop' element back
			const newModalBackdrop = document.createElement('div');
			newModalBackdrop.setAttribute('modal-backdrop', '');
			document.body.appendChild(newModalBackdrop);
		}),
	});
});



function deleteStudentRec(data) {
	const id = data.enrollment_id;

	console.log(data, 'getId');

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',
	}).then((result) => {
		if (result.isConfirmed) {
			// req

			let xhttp = new XMLHttpRequest();

			xhttp.open('POST', 'src/function/controller.php?action=deleteStudentRec', true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status === 200) {
						let response = JSON.parse(this.responseText);

						console.log(response, 'get response');

						if (response.success == true) {
							location.href = '?page=dashboard';
							localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'delete', message: 'Student has been deleted' }));
						}
					}
				}
			};

			const data = {
				enrollmentId: id,
			};
			// payload
			let payload = `data=${JSON.stringify(data)}`;

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.send(payload);
		}
	});
}



function studentMasterListMoveToArchive(data) {
	Swal.fire({
		title: 'Are you sure?',
		text: 'You want to move the file to archive',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, move it!',
	}).then((result) => {
		if (result.isConfirmed) {
			const dataRes = {
				id: 'id',
				selectedId: data.id,
				table: 'student_record',
				archiveName: 'student_record',
			};

			httpJSONReq('moveToArchive', dataRes, (res) => {
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'update', message: res.message }));
				} else {
					Swal.fire({
						icon: 'success',
						title: 'Forbidden request',
						text: res.message,
					});
				}
			});
		}
	});
}

function enrollmentMoveToArchive(data) {
	Swal.fire({
		title: 'Are you sure?',
		text: 'You want to move the file to archive',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, move it!',
	}).then((result) => {
		if (result.isConfirmed) {
			const dataRes = {
				id: 'id',
				selectedId: data.enrollment_id,
				table: 'enrollment_records',
				archiveName: 'enrollment_record',
			};

			httpJSONReq('moveToArchive', dataRes, (res) => {
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'update', message: res.message }));
				} else {
					Swal.fire({
						icon: 'success',
						title: 'Forbidden request',
						text: res.message,
					});
				}
			});
		}
	});
}


$('#editMasterList').on('click', function () {
	 $('#editMasterForm input').each((index, element) => {
			$(element).prop('readonly', false);
		$(element).prop('required', true);
		});
		$('#viewRelationship').prop('disabled',false);

		$('#viewSection').prop('disabled', false);
		$('#viewSection').prop('required', true);
		$('#viewGradeLevel').prop('disabled', false);
		$('#viewGradeLevel').prop('required', true);
		$('#viewGender').prop('disabled', false);
		$('#viewGender').prop('required', true);
		$('#approveChangeInput').prop('disabled', false);
		$('#approveChangeInput').prop('required', true);
		$('#approveChangeInput').removeClass(['hidden']);
	

	 

});




	function viewStudentMasterList(details) {

		$('.master-view').removeClass('hidden');
		$('.master-default').addClass('hidden');
		$('#studentTabs').addClass('hidden');

		// $('#getSelectedYearLevelLabel').text(data.yearName);

		const data = details.data;

		console.log(details);

		$('#viewStudentId').val(data.id);

		$('#viewReferenceNumber').text(data.ref_number);
		$('#viewLrn').text(data.lrn);
		$('#viewAge').val(data.age);
		$('#viewGradeLevel').val(data.yearId).change();
		$('#viewDateRegistered').text(details.dateRegistered);

		$('#studentId').val(data.id);
		$('#submitId').val(data.submitdoc_id);
		$('#yearId').val(data.yearId);

		$('#viewFullName').val(`${data.fname} ${data.mname} ${data.lname}`);
		$('#viewBdate').val(data.birthdate);
		$('#viewGender').val(data.gender);
		$('#viewPlace').val(data.pbirth);
		$('#viewAddress').val(data.currentAddress);
		$('#viewNationality').val(data.nationality);
		$('#viewStudentNumber').val(data.studentNumber);
		$('#viewStudentEmail').val(data.email);

		let geFolderName = window.location.href.split('/')[3];
		let rootUrl = window.location.origin + '/' + geFolderName;
		let imageUrl = rootUrl + '/src/images/uploads/profile/' + data.profile;

		// profile
		$('#viewProfile').attr('src', imageUrl);

		// father details
		$('#viewFatherName').val(data.fatherName);
		$('#viewFatherOccupation').val(data.fatherOccupation);
		$('#viewFatherEmail').val(data.fatherEmail);
		$('#viewFatherNumber').val(data.fatherNumber);
		$('#viewFatherAddress').val(data.fatherAddress);

		// end father details

		// mother details

		// father details
		$('#viewMotherName').val(data.motherName);
		$('#viewMotherOccupation').val(data.motherOccupation);
		$('#viewMotherEmail').val(data.motherEmail);
		$('#viewMotherNumber').val(data.motherNumber);
		$('#viewMotherAddress').val(data.motherAddress);

		// end father details

		// guardian  details
		$('#viewGuardiansName').val(data.guardianName);
		$('#viewGuardiansOccupation').val(data.guardianAddress);
		$('#viewGuardiansEmail').val(data.guardianEmail);
		$('#viewGuardiansNumber').val(data.guardianNumber);
		$('#viewGuardiansAddress').val(data.guardianAddress);

		// end guardian details

		// emergency contact
		$('#viewContactName').val(data.contactName);

		$('#viewRelationship').val(data.relationship);
		$('#viewContactNumber').val(data.phone);

		if (data.relationship == 'parents') {
			$('#viewParentDetails').removeClass('hidden');
			$('#guardianDetails').addClass('hidden');
		}
		if (data.relationship == 'guardians') {
			$('#guardianDetails').removeClass('hidden');
			$('#viewParentDetails').addClass('hidden');
		}

		// end emergency contact

		// submitted document

		$('#viewTypeSubmittedDocument').text(data.type);


		console.log(data.type,'get local');


		let selectedDocId = [];

		if (data.type == 'local') {
			let docs1 = [
				{ label: 'Form 138', value: data.report_card, href: '/src/images/uploads/documents/local/report-card/', directory: '../images/uploads/documents/local/report-card/', renameFile: `card_${data.lrn}`, columnId: 'report_card' },
				{ label: 'Form 137', value: data.formSf10, href: '/src/images/uploads/documents/local/form-sf10/', directory: '../images/uploads/documents/local/form-sf10/', renameFile: `sf10_${data.lrn}`, columnId: 'formSf10' },
				{ label: 'Birth certificate', value: data.birthCertificate, href: '/src/images/uploads/documents/local/birth-cert/', directory: '../images/uploads/documents/local/birth-cert/', renameFile: `bcert_${data.lrn}`, columnId: 'birthCertificate' },
				{ label: 'Good moral certificate', value: data.good_moral, href: '/src/images/uploads/documents/local/good-moral/', directory: '../images/uploads/documents/local/good-moral/', renameFile: `gmoral_${data.lrn}`, columnId: 'good_moral' },
				{ label: 'Letter of Recommendation', value: data.rec_letter, href: '/src/images/uploads/documents/local/rec-letter/', directory: '../images/uploads/documents/local/rec-letter/', renameFile: `recletter_${data.lrn}`, columnId: 'rec_letter' },
				{ label: 'Medical certificate', value: data.medical_cert, href: '/src/images/uploads/documents/local/med-cert/', directory: '../images/uploads/documents/local/med-cert/', renameFile: `med_cert_${data.lrn}`, columnId: 'medical_cert' },
			];


			console.log(docs1,'get docs 1');
	
			docs1.forEach((item) => {
				let localUrl = rootUrl + item.href + item.value;
				console.log('item get', item);

				let lowerLocalUrl = item.value.toLowerCase();
				let docsLocalId = item.label.toLowerCase().replaceAll(' ', '');
				let editableLocal = `<label for='document_${docsLocalId}' class="ml-4 text-indigo-500"><ion-icon name="create-outline"></ion-icon></label><input class='hidden' type='file' id='document_${docsLocalId}' accept='image/*' /> `;
				let selectedValue = lowerLocalUrl.includes('to follow') ? `<span>to follow</span>${editableLocal}` : `<a  onclick="previewImage('${localUrl}')" class="text-center px-2 text-indigo-500"><ion-icon name="eye-outline"></ion-icon></a>${editableLocal}`;

				console.log('item get', selectedValue);

				let divLocal = `
                        <div class="flex justify-start items-center">
                            <p><span class="font-medium">${item.label}:</span></p>
                            <p id='imgSrc_${docsLocalId}' class="text-center px-2">${selectedValue}</p>
                        </div>
                  `;

				$('#viewLocalType').append(divLocal);
				$('#viewForeignType').addClass('hidden');

				selectedDocId.push({
					id: `document_${docsLocalId}`,
					src: item.value,
					type: data.type,
					renameFile: item.renameFile,
					path: item.directory,
					studentId: data.id,
					columnName: item.columnId,
					imgId: `imgSrc_${docsLocalId}`,
					hrefLink: item.href,
				});

			     
				

			});
		} else if (data.type == 'foreign') {
		
			let docs2 = [
				{ label: 'Student permit', value: data.study_permit, href: '/src/images/uploads/documents/foreign/stud-permit/', directory: '../images/uploads/documents/foreign/stud-permit/', renameFile: `studpermit_${data.lrn}`, columnId: 'study_permit' },
				{ label: 'Alien Certification of REG. ACR', value: data.alien_regcard, href: '/src/images/uploads/documents/foreign/alien_cert/', directory: '../images/uploads/documents/foreign/alien_cert/', renameFile: `aliencert_${data.lrn}`, columnId: 'alien_regcard' },
				{ label: 'Passport Photocopy', value: data.passport_copy, href: '/src/images/uploads/documents/foreign/passport/', directory: '../images/uploads/documents/foreign/passport/', renameFile: `passport_${data.lrn}`, columnId: 'passport_copy' },
				{ label: 'Authenticated School Records', value: data.auth_school_record, href: '/src/images/uploads/documents/foreign/auth-rec/', directory: '../images/uploads/documents/foreign/auth-rec/', renameFile: `auth_${data.lrn}`, columnId: 'auth_school_record' },
			];

			docs2.forEach((item) => {
				let foreignUrl = rootUrl + item.href + item.value;
				let lowerForeignUrl = item.value.toLowerCase();
				let docForeignId = item.label.toLowerCase().replace('.', '').replaceAll(' ','');
				let editableForeign = `<label for='document_${docForeignId}' class="ml-4 text-indigo-500"><ion-icon name="create-outline"></ion-icon></label><input class='hidden' type='file' id='document_${docForeignId}' accept='image/*' />`;
				let selectedValue = lowerForeignUrl.toLowerCase().includes('to follow') ? `<span>to follow</span> ${editableForeign}` : `<a  onclick="previewImage('${foreignUrl}')" class="text-center px-2 text-indigo-500"><ion-icon name="eye-outline"></ion-icon></a>${editableForeign}`;

				let divForeign = `<div class="flex row justify-between gap-4 flex-wrap">
                        <div class="flex justify-start">
                            <p><span class="font-medium">${item.label}:</span></p>
                            <p id='imgSrc_${docForeignId}' class="text-center px-2  cursor-pointer">${selectedValue}</p>
                        </div>
                    </div>`;

				$('#viewLocalType').addClass('hidden');
				$('#viewForeignType').append(divForeign);
			
		
				selectedDocId.push({
					id: `document_${docForeignId}`,
					src: item.value,
					type: data.type,
					renameFile: item.renameFile,
					path: item.directory,
					studentId: data.id,
					columnName: item.columnId,
					imgId: `imgSrc_${docForeignId}`,
					hrefLink: item.href,
				});


			});
		}


			localStorage.setItem('listSelectDocument', JSON.stringify(selectedDocId));



// section by class details 

				let listClassDetails = JSON.parse($('#getClassDetails').val());

				let validate =false;

					if (listClassDetails.length > 0) {
						let gradeLevel = '<option value=""></option>';
					
						listClassDetails.forEach((item) => {
							let details = JSON.parse(item);

							console.log(details, 'get item');
							console.log(data.yearId, 'get item');

							if (details.year_level == data.yearId) {
								validate = true;
								gradeLevel += '<option selected value="' + details.yearId + '" >' + details.yearName + '</option>';
							}
					 else {
							gradeLevel += '<option  value="' + details.yearId + '" >' + details.yearName + '</option>';
						
						}
						});

						if (validate == false) {
							gradeLevel = '<option value="0" selected >No section found</option>';
							$('#msgSection').text(`No section defined ${data.yearName} in classes page`);

							$('#viewGradeLevel').hide();
							
							

						Swal.fire({
							icon: 'error',
							title: 'Level not found in classes',
							text: `Create ${data.yearName} class  before to proceed`,
							showCancelButton: false,
							confirmButtonText: 'Go to classes now',
							confirmButtonColor: '#3085d6',
							allowOutsideClick: false,
						}).then((result) => {
							if (result.isConfirmed) {
								// Redirect to the specified page
								window.location.href = '?page=dashboard';
								localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: '', message: '' }));
							}
						});

						} else {
							$('#viewGradeLevel').show();
							$('#msgSection').hide();
						}

						$('#viewGradeLevel').append(gradeLevel);
					









					}



					// get enrollement status

					let getEnrollmentDetails = JSON.parse($('#getEnrollmentValue').val());

					let status = '( Pending )'

					if(getEnrollmentDetails.length > 0){

							let sectionList = '<option value=""></option>';
							let validateSection= false;
							let getSectionId = '';

								getEnrollmentDetails.forEach((enroll) =>{
									let item = JSON.parse(enroll);

									if(item.student_id == data.id){
										status = '( Enrolled )';


										console.log(item,'enrollment section');


										getSectionId = item.sectionId;
						
									}
							

								});


						listClassDetails.forEach((item) => {
							let details = JSON.parse(item);


							if (details.year_level == data.yearId) {

								console.log(getSectionId,'get section');
								console.log(details,'class section');
             
								validateSection = true;

									if (details.sectionId == getSectionId) {
										sectionList += '<option selected  value="' + details.sectionId + '" >' + details.sectionName + '</option>';

									}else{
									sectionList += '<option  value="' + details.sectionId + '" >' + details.sectionName + '</option>';

									}



							} 
						});

						if (validateSection) {
					
								if (status == '( Pending )') {
									$('#showSectionWhenEnrolled').addClass('hidden');
								} else {
									$('#showSectionWhenEnrolled').removeClass('hidden');
									$('#viewSection').empty().append(sectionList);
								}
						}

					
					}

			 	$('#viewStatus').text(status);

					



	}


$('#typeStudent').on('change', function () {
	console.log(this.value, 'get value of useer');
	let value = this.value;

	if (value === 'regular') {
		$('#next-button__1').addClass('hidden');
		$('#oldUserModal').click();
	} 
	if(value === 'new'){
			$('#next-button__1').removeClass('hidden');
		
	}
	
	else {
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

		if(this.readyState === 4){
			if(this.status === 200){

			let response = JSON.parse(this.responseText);

					let listitems = '<option value=""></option>';
					response.forEach(item => {
							  listitems += '<option value="' + item.id + '" data-qualify="'+item.qualify_age+'">' + item.name + '</option>';

					});


							console.log(response,'get errror')

							$('#level').append(listitems);

							$('#typeYearLevel').removeClass('hidden');
							
			}
			else{

			}
		}
		
		
	}










	$('#typeYearLevel').on('change', function () {
		$('#newDivSection').removeClass('hidden');
	});




let payload = `data=${JSON.stringify(data)}`;

xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhttp.send(payload)

	


});


$('#level').on('change',function(){
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




$('#profile').on('change',function(e){

	let file  = e.target.files[0];

		filePreviHandler('#previewImgDiv',file,'.default-img');

	

	});
	

	function filePreviHandler(id,file,defaultHide){

		if(file.size > 1048576){
			Swal.fire({
			icon:'error',
			title:'File is not supported',
			text:'File size is less than 1Mb',
			footer:null
		});
		}
		else{
			if (file.type.startsWith('image')) {
				console.log('ok begin uploads');
				faceDetector(id, file, defaultHide);

			}
			else{
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
			displayErrorOnScreen(previewImgId, defaultHide,'Failed to load image.');
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


	

				// Revoke the object URL when the image is loaded
				img.onload = () => {
					URL.revokeObjectURL(ctvUrl);
				};
			}, 3000);
		} else {
			// Handle the case where no faces are detected
			displayErrorOnScreen(previewImgId, defaultHide,'Upload consise,clear face image');
		}
	};
}



function displayErrorOnScreen(previewImgId, defaultHide,errorMessage) {
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

		


		$('#birthdate').on('change',function(){


			const qualifyAge = $('#level option:selected').data('qualify');
			const qualifyLevel = $('#level option:selected').text();
		

			console.log(qualifyAge);


			const birthdate =  new Date(this.value);
			const currDate =  new Date();

			const bdayYear = birthdate.getFullYear();
			const currDateYear = currDate.getFullYear();

			let age =  currDateYear - bdayYear;

			if(currDate.getMonth() < birthdate.getMonth() || (currDate.getMonth() === birthdate.getMonth() && currDate.getDate < birthdate.getDate())){
				age--; 
			}





		if (age >= qualifyAge) {
			$('#ageReveal').removeClass('hidden');
			$('#guestmyAge').text(age);
			$('#age').val(age);
		} else {
			this.value = '';
			Swal.fire({
				icon: 'error',
				text: `Age ${age} doesn't qualify to  ${qualifyLevel} level at least age ${qualifyAge} required`,
				title: 'Age not allowed',
				footer: null,
			});

			$('#ageReveal').addClass('hidden');
			$('#guestmyAge').text('');
			$('#guestmyAge').val('');
		}

			


	})


let editable = false;

	function editStudentRec(data) {
	
	
		$('fieldset').hide(); // Hide all fieldsets
	
		$('fieldset:eq(1)').show(); // Show the second fieldset

		$('#getSelectedYearLevel').text(data.yearLevel);

		$('#next-button__1').addClass('hidden');

		$('#ediTable').removeClass('hidden');

		$('#studentId').val(data.enrollment_id);

		
		console.log(data,'get details');
		

		let getClassSectionByYearLvl = JSON.parse($('#getListSections').val());

		let validate = false;



		if(getClassSectionByYearLvl.length > 0){
		
			let optionItem = '<option value=""></option>';

			getClassSectionByYearLvl.forEach((item) => {
				let parseItem = JSON.parse(item);

				console.log(parseItem,'ger parsing');

				if (parseItem.year_level == data.yearLevelId) {
					validate = true;

					if(parseItem.sectionId == data.sectionId){
						optionItem += '<option selected value="' + parseItem.sectionId + '" >' + parseItem.sectionName + '</option>';
					}
					else{
					optionItem += '<option  value="' + parseItem.sectionId + '" >' + parseItem.sectionName + '</option>';

					}

				} 
			});

			if(validate == false){
						optionItem = '<option value="0" selected >No section found</option>';
						$('#msgSection').text(`No section defined ${data.yearLevel} in classes page`);
			
						Swal.fire({
							icon: 'error',
							title: 'Level not found in classes', 
							text: `Create ${data.yearLevel} class  before to proceed`,
							showCancelButton: false,
							confirmButtonText: 'Go to classes now',
							confirmButtonColor: '#3085d6',
							allowOutsideClick: false,
						}).then((result) => {
							if (result.isConfirmed) {
								// Redirect to the specified page
								window.location.href = '?page=dashboard';
								localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: '', message: '' }));
							}
						});
			}else{
						$('#newSection').show();
						$('#msgSection').hide();
			}

			$('#newSection').empty().append(optionItem);
		}

				
		$(studentRecToggle).click();

		editable = true;
	}




	$(document).ready(function() {


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
		$('#studentRecordForm').validate({
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
					accept: 'image/*',
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
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				fatherNumber: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},

					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},
				fatherOccupation: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				motherName: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				motherOccupation: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
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
			errorPlacement: function (error, element) {
				// Display the error message in a separate div with the ID "profile-error"
				if (element.attr('name') === 'profile') {
					error.appendTo('#profile-error');
				} else {
					error.insertAfter(element);
				}
			},
		});

	

		
			$('fieldset:first').show();



		


		// end restriction

		// show

			let currentStep = 0;
			// nextFieldSet(`#next-button__1`);
				const prevIndex = [1, 2, 3];
				const nextIndex = [1,2, 3];

				prevIndex.forEach((id) => {
					prevFieldset(`#prev-button__${id}`);
				});

				nextIndex.forEach((id) => {
					nextFieldSet(`#next-button__${id}`);


					
					

				});


				let submitForm =false;

			
				


				$('#next-button__9').on('click', function () {
					// get the level,name
					$('#modal-container').addClass('max-w-[650px]');


		
				
				
					let getDefaultSchooYear = $('#schoolYear').val();

					const presentYear = new Date().getFullYear();
					const nextYear = new Date().getFullYear() + 1;

					const syear = getDefaultSchooYear ?? `SY:${presentYear}-${nextYear}`;

					let getSelectedLevel = $('#level option:selected').text();

					const preSchool = ['nursery', 'kinder'];
					const grade1 = ['grade 1'];
					const primary = ['grade 2', 'grade 3'];
					const intermidiate = ['grade 4', 'grade 5', 'grade 6'];
					const jrHigh = ['grade 7', 'grade 8', 'grade 9', 'grade 10'];
					const srHigh = ['grade 11', 'grade 12'];

					let selectedLevel = '';
					let miscelanious = '';
					let booksModule = '';
					let tuitionFee = '';
					let total = '';
					let fullPayment = '';

					if (preSchool.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱10,045.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱15,000.00';
						total = '₱30,950.00';
						fullPayment = '₱29,450.00';
					}
					if (grade1.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱14,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱30,105.00';
						fullPayment = '₱29,170.00';
					}
					if (primary.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRIMARY';
						miscelanious = '₱12,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,105.00';
						fullPayment = '27,170.00';
					}

					if (intermidiate.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'INTERMIDIATE';
						miscelanious = '₱12,850.00';
						booksModule = '₱6,750.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,950.00';
						fullPayment = '₱28,015.00';
					}
					if (jrHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'JR HIGH SCHOOL';
						miscelanious = '₱13,050.00';
						booksModule = '₱8,325.00';
						tuitionFee = '₱10,450.00';
						total = '₱31,925.00';
						fullPayment = '₱30,880.00';
					}
					if (srHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'SENIOR HIGH SCHOOL';
						miscelanious = '₱7,670.00';
						booksModule = '0.00';
						tuitionFee = '17,500.00';
						total = '25,170.00';
						fullPayment = '25,170.00';
					}

					let fname = $('#fname').val();
					let lname = $('#lname').val();
					let fullName = `${fname} ${lname}`;
					let getDateString = new Date().toLocaleDateString();

			
			if (localStorage.getItem('modify') !== 'true') {
					$('#syYear').text(syear);
					$('#fLName').text(fullName);
					$('#typeFee').text(`(${selectedLevel})`);
					$('#getSelectedSection').text(getSelectedLevel);
					$('#getDateIssued').text(getDateString);
					$('#misc').text(miscelanious);
					$('#books').text(booksModule);
					$('#tuition').text(tuitionFee);
					$('#total').text(total);
					$('#full').text(fullPayment);
					$('#typeAvail').text('(New)');
					// print
					$('#syYearPrint').text(syear);
					$('#fLNamePrint').text(fullName);
					$('#typeFeePrint').text(`(${selectedLevel})`);
					$('#getSelectedSectionPrint').text(getSelectedLevel);
					$('#getDateIssuedPrint').text(getDateString);
					$('#miscPrint').text(miscelanious);
					$('#booksPrint').text(booksModule);
					$('#tuitionPrint').text(tuitionFee);
					$('#totalPrint').text(total);
					$('#fullPrint').text(fullPayment);
			}
			else{
							$('.skipFieldset').hide();
							$('.proceedFieldset').show();
			}


			
				
				});
				
				$('#prev-button__3').on('click', function () {
					$('#modal-container1').addClass('max-w-md');
					$('#modal-container1').removeClass('max-w-[64rem]');
					$('#studentRecord-modal').addClass('items-center');
					$('#studentRecord-modal').removeClass('items-start');
				});

				$('#next-button__2').on('click', function () {
		
					$('#modal-container1').removeClass('max-w-md');
					$('#modal-container1').addClass('max-w-[64rem]');
					$('#studentRecord-modal').removeClass('items-center');
					$('#studentRecord-modal').addClass('items-start');



			
					// get section
					$('#getSection').text($('#newSection option:selected').text());

					if ($('#newSection option:selected').val() == 0){
						$('#getSection').text('TBA');

					} 
					
					console.log($('#newSection option:selected').text());

				

				});


				$('#next-button__1').on('click',function(){
						
						let section = $('#newSection').val();


						console.log(section,'get sections')

			
						if (section == '0') {
							submitForm = false;
						}
				});


				$('#next-button__3').on('click', function () {
				
						let valid = $('#studentRecordForm').valid();

	
						if (valid) {
							submitForm = true;
						}
				});

				let isValidToEdit = false;
	

				$('#ediTable').on('click',function(){
					if(editable == true){
			
						submitForm = true;
						isValidToEdit =true;

					}
				});




	

		$('#studentRecordForm').submit(function (event) {

				event.preventDefault();
	

			let hidden = $('fieldset:hidden');
	
			console.log(hidden, 'get hidden');

				console.log(currentStep,'current steps');
			console.log($('fieldset:hidden').length, 'get hidden');
			console.log($('#studentRecordForm').valid());
		  const res = retrieveFiles();
			// const getProfile = renameAndUploadFile('profile',sendFile);
			const getFingerPrint = renameAndUploadFile('fingerprint', res);

					

			let getlength = $('fieldset:hidden').length;
			let valid = $('#studentRecordForm').valid();

		

			

			if (valid === true && submitForm) {
				console.log('Form submitted successfully!');

				const form = document.getElementById('studentRecordForm');

				const formData = new FormData(form);
				formData.append('fingerprint', getFingerPrint);
			 
		

				const data = {};

				for (let pair of formData.entries()) {
					data[pair[0]] = pair[1];
				}

			

					if (isValidToEdit) {
						httpJSONReq('updateEnrollementSection', data, (res) => {
							console.log(res, 'get response');
							if (res.success) {
								localStorage.removeItem('counter');
								localStorage.removeItem('modify');

								location.href = `?page=dashboard`;
								localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
							} else {
								$('#prev-button__10').removeClass('hidden');

								Swal.fire({
									icon: 'error',
									title: 'Forbidden Request',
									text: res.message,
									footer: null,
								});
							}
						});
					} else {
						httpResFormData('enrollStudent', formData, (res) => {
							console.log(res, 'get response');
							if (res.success) {
								localStorage.removeItem('counter');

								location.href = `?page=dashboard`;
								localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
							} else {
								$('#prev-button__10').removeClass('hidden');

								Swal.fire({
									icon: 'error',
									title: 'Forbidden Request',
									text: res.message,
									footer: null,
								});
							}
						});
					}

			} else {
				console.log('Form submission prevented.');
				event.preventDefault();
			}
		});
	});



	

  function renameAndUploadFile(fileName,file) {
		const lrn = $('#getLrn').val();


	

		if (file) {
				const ext = file.name.split('.')[1];

				const newFileName = `${fileName}${lrn}.${ext}`;

			const renamedFile = new File([file], newFileName, { type: file.type });

			return renamedFile;
		} else {
			return 'Please select a file and enter a new file name.';
		}
	}


	function prevFieldset(id) {
		$(id).click(function () {
			if ($('#studentRecordForm').valid()) {
				let currentFieldset = $('fieldset:visible');
				let prevFieldset = currentFieldset.prev('fieldset');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSet(id) {


		


		$(id).click(function () {


			if ($('#studentRecordForm').valid()) {
				let currentFieldset = $('fieldset:visible');
				let nextFieldset = currentFieldset.next('fieldset');

				if (nextFieldset.length > 0) {
					currentFieldset.hide();
					nextFieldset.show();
				}
			}
		});
	}






$('#regCredentialType').on('change', function () {
	let credential = this.value;

	console.log(credential, 'get value');

	switch (credential) {
		case 'local':
			$('#regularLocal').removeClass('hidden');
			$('#regularForeign').addClass('hidden');

			// Uncheck all foreign checkboxes
			$('.regForeign:checked').each(function () {
				$(this).prop('checked', false);
			});

			break;
		case 'foreign':
			$('#regularLocal').addClass('hidden');
			$('#regularForeign').removeClass('hidden');

			// Uncheck all local checkboxes
			$('.regLocal:checked').each(function () {
				$(this).prop('checked', false);
			});
			break;
		default:
			$('#regularLocal').addClass('hidden');
			$('#regularForeign').addClass('hidden');
			$('.regLocal:checked').each(function () {
				$(this).prop('checked', false);
			});
			$('.regForeign:checked').each(function () {
				$(this).prop('checked', false);
			});
			break;
	}
});





$('#searchBtn').on('click', function () {
	const getLrn = $('#searchLrn').val();

	console.log(getLrn,'my lrn value');

	const data = {
		lrn: getLrn,
	};

console.log(data,'get data')

	
	httpJSONReq('findUserLrn', data, (res) => {

			console.log(res,'get message');
		if (res.success === true) {
			console.log(res);
			$('#userRegularId').val(res.userId);
			$('#enrollmentId').val(res.enrollmentId);
			$('#enrollType').val(res.yearType);
			$('#enrollType').val(res.yearType);
			$('#regFullName').val(res.fullName);
			 $('#enrollType').find('option:not(:selected)').prop('disabled', true);

			  var selectElement = $('#regLevel');

				// Create a new option element
				var newOption = $('<option>', {
					value: res.yearId,
					text: res.yearLevel, // You can change the text to whatever you want
				});

				// Append the new option to the select element
				selectElement.append(newOption);

				const getSchoolYear = `SY-${res.start} - ${res.end}`;

				$('#reg_syYear').text(getSchoolYear);



			$('#searchFilterLrn').addClass('hidden');
			// Show the second fieldset initially
				// $('fieldset:eq(1)').show();
					$('.my-fieldset:first').show();
		} else {
			Swal.fire({
				icon: 'error',
				title: 'Forbidden Request',
				text: res.message,
				footer: null,
			});
		}
	});
});

function previewImage(path) {
	window.open(path, '_blank');
}



$('#searchBtnRefNumber').on('click', function () {
	const ref_number = $('#searchRegNumber').val();

	console.log(ref_number, 'my ref value');

	const data = {
		ref_number: ref_number,
	};

	console.log(data, 'get data');

	httpJSONReq('findRefNumber', data, (res) => {
		console.log(res, 'get message');
		if (res.success == true) {
			$('fieldset').hide();
			$('fieldset:eq(1)').show();

			const data = res.data;
			// get registration
			
			$('#getSelectedYearLevel').text(data.yearName);
			// $('#getSelectedYearLevelLabel').text(data.yearName);

			
			
			$('#getRefNumber').text(data.ref_number);
			$('#getLrn').text(data.lrn);
			$('#getGradeLevel').text(data.yearName);
			$('#getDateRegistered').text(res.dateRegistered);

			$('#studentId').val(data.id);
			$('#submitId').val(data.submitdoc_id);
			$('#yearId').val(data.yearId);


			$('#getFullName').text(`${data.fname} ${data.mname} ${data.lname}`);
			$('#getBdate').text(data.birthdate);
			$('#getGender').text(data.gender);
			$('#getPlace').text(data.pbirth);
			$('#getAddress').text(data.currentAddress);
			$('#getNationality').text(data.nationality);
			$('#getStudentnNumber').text(data.studentNumber);
			$('#getStudentEmail').text(data.email);

			var geFolderName = window.location.href.split('/')[3];
			var rootUrl = window.location.origin + '/' + geFolderName;
			var imageUrl = rootUrl + '/src/images/uploads/profile/' + data.profile;

			// profile
			$('#getProfile').attr('src', imageUrl);

			// father details
			$('#getFatherName').text(data.fatherName);
			$('#getFatherOccupation').text(data.fatherOccupation);
			$('#getFatherEmail').text(data.fatherEmail);
			$('#getFatherNumber').text(data.fatherNumber);
			$('#getFatherAddress').text(data.fatherAddress);

			// end father details

			// mother details

			// father details
			$('#getMotherName').text(data.motherName);
			$('#getMotherOccupation').text(data.motherOccupation);
			$('#getMotherEmail').text(data.motherEmail);
			$('#getMotherNumber').text(data.motherNumber);
			$('#getMotherAddress').text(data.motherAddress);

			// end father details

			// guardian  details
			$('#getGuardiansName').text(data.guardianName);
			$('#getGuardiansOccupation').text(data.guardianAddress);
			$('#getGuardiansEmail').text(data.guardianEmail);
			$('#getGuardiansNumber').text(data.guardianNumber);
			$('#getGuardiansAddress').text(data.guardianAddress);

			// end guardian details


			// emergency contact
			$('#getContactName').text(data.contactName);
			$('#getRelationship').text(data.relationship);
			$('#getContactNumber').text(data.phone);


			
		if (data.relationship == 'parents') {
			$('#getParentDetails').removeClass('hidden');
			$('#guardianDetails').addClass('hidden');

		}
		if (data.relationship == 'guardians'){
			$('#guardianDetails').removeClass('hidden');
			$('#getParentDetails').addClass('hidden');

		}
			// end emergency contact

			// submitted document

			$('#getTypeSubmittedDocument').text(data.type);



		if (data.type == 'local') {
			
			

			let docs1 = [
				{ label: 'Form 138', value: data.report_card, href: '/src/images/uploads/documents/local/report-card/' },
				{ label: 'Form 137', value: data.formSf10, href: '/src/images/uploads/documents/local/form-sf10/' },
				{ label: 'Birth certificate', value: data.birthCertificate, href: '/src/images/uploads/documents/local/birth-cert/' },
				{ label: 'Good moral certificate', value: data.good_moral, href: '/src/images/uploads/documents/local/good-moral/' },
				{ label: 'Letter of Recommendation', value: data.rec_letter, href: '/src/images/uploads/documents/local/rec-letter/' },
				{ label: 'Medical certificate', value: data.medical_cert, href: '/src/images/uploads/documents/local/med-cert/' },
			];

				

			docs1.forEach((item) => {
				let localUrl = rootUrl + item.href+ item.value;
				console.log('item get',item)
		let selectedValue = item.value.toLowerCase().includes('to follow') ? 'to follow' : `<a onclick="previewImage('${localUrl}')" class="text-center px-2 text-indigo-500"><ion-icon name="eye-outline"></ion-icon></a>`;



				console.log('item get', selectedValue);
			

				let divLocal = `
                        <div class="flex justify-start items-center">
                            <p><span class="font-medium">${item.label}:</span></p>
                            <p class="text-center px-2">${selectedValue}</p>
                        </div>
                  `;

				$('#getLocalType').append(divLocal);
			});


		}


		


		

		else if (data.type == 'foreign') {



			let docs2 = [
				{ label: 'Student permit', value: data.study_permit, href: '/src/images/uploads/documents/foreign/stud-permit/' },
				{ label: 'Alien Certification of REG. ACR', value: data.alien_regcard, href: '/src/images/uploads/documents/foreign/alien_cert/' },
				{ label: 'Passport Photocopy', value: data.passport_copy, href: '/src/images/uploads/documents/foreign/passport/' },
				{ label: 'Authenticated School Records', value: data.auth_school_record, href: '/src/images/uploads/documents/foreign/auth-rec/' }
			];



			docs2.forEach((item) => {

					let foreignUrl = rootUrl + item.href + item.value;
				let selectedValue = item.value.toLowerCase().includes('to follow') ? 'to follow' : `<a onclick="previewImage('${foreignUrl}')" class="text-center px-2 text-indigo-500"><ion-icon name="eye-outline"></ion-icon></a>`;

				let divForeign = `<div class="flex row justify-between gap-4 flex-wrap">
                        <div class="flex justify-start">
                            <p><span class="font-medium">${item.label}:</span></p>
                            <p class="text-center px-2  cursor-pointer">${selectedValue}</p>
                        </div>
                    </div>`;

				$('#getForeignType').append(divForeign);
			});
		}

				let listSection = JSON.parse($('#getListSections').val());

				let validate =false;

					if(listSection.length > 0){
						let listitems = '<option value=""></option>';
						listSection.forEach((item) => {


							let details = JSON.parse(item);

							console.log(details.year_level, 'get item');

							if (details.year_level == data.yearId) {

								validate =true;
								listitems += '<option value="' + details.sectionId + '" >' + details.sectionName + '</option>';
							} 
							
						});

						if(validate == false){
								listitems = '<option value="0" selected >No section found</option>';
								$('#msgSection').text(`No section defined ${data.yearName} in classes page`);

								$('#newSection').hide();

								Swal.fire({
									icon: 'error',
									title: 'Section not found',
									text: `Create ${data.yearName} class before to proceed`,
									showCancelButton: false,
									confirmButtonText: 'Go to classes now',
									confirmButtonColor: '#3085d6',
									allowOutsideClick: false,
								}).then((result) => {
									if (result.isConfirmed) {
										// Redirect to the specified page
										window.location.href = '?page=dashboard';
										localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: '', message: '' }));
									}
								});


						}else{
								$('#newSection').show();
								$('#msgSection').hide();

						}

						$('#newSection').append(listitems);

				}


					

			

		
			// end submitted document



			// payment fees
			
					let getSelectedLevel = data.yearName.toLowerCase();

					const preSchool = ['nursery', 'kinder'];
					const grade1 = ['grade 1'];
					const primary = ['grade 2', 'grade 3'];
					const intermidiate = ['grade 4', 'grade 5', 'grade 6'];
					const jrHigh = ['grade 7', 'grade 8', 'grade 9', 'grade 10'];
					const srHigh = ['grade 11', 'grade 12'];

					let selectedLevel = '';
					let miscelanious = '';
					let booksModule = '';
					let tuitionFee = '';
					let total = '';
					let fullPayment = '';

					if (preSchool.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱10,045.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱15,000.00';
						total = '₱30,950.00';
						fullPayment = '₱29,450.00';
					}
					if (grade1.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱14,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱30,105.00';
						fullPayment = '₱29,170.00';
					}
					if (primary.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRIMARY';
						miscelanious = '₱12,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,105.00';
						fullPayment = '27,170.00';
					}

					if (intermidiate.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'INTERMIDIATE';
						miscelanious = '₱12,850.00';
						booksModule = '₱6,750.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,950.00';
						fullPayment = '₱28,015.00';
					}
					if (jrHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'JR HIGH SCHOOL';
						miscelanious = '₱13,050.00';
						booksModule = '₱8,325.00';
						tuitionFee = '₱10,450.00';
						total = '₱31,925.00';
						fullPayment = '₱30,880.00';
					}
					if (srHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'SENIOR HIGH SCHOOL';
						miscelanious = '₱7,670.00';
						booksModule = '0.00';
						tuitionFee = '17,500.00';
						total = '25,170.00';
						fullPayment = '25,170.00';
					}

						$('#getMiscellanious').text(miscelanious);
						$('#getBooks').text(booksModule);
						$('#getTuition').text(tuitionFee);
						$('#getTotal').text(total);
						$('#getFullPayment').text(fullPayment);


						const paymentFee = {
							typeFee: selectedLevel.replaceAll('₱', ' '),
							misc: miscelanious.replaceAll('₱', ' '),
							booksModule: booksModule.replaceAll('₱', ' '),
							tuitionFee: tuitionFee.replaceAll('₱', ' '),
							totalFee: total.replaceAll('₱', ' '),
							fullCash: fullPayment.replaceAll('₱', ' '),
						};
		
						$('#paymentFee').val(JSON.stringify(paymentFee));

					
			// end mother details
			// $('#modal-container1').removeClass('max-w-md');
			// $('#modal-container1').addClass('max-w-[64rem]');
			// $('#studentRecord-modal').removeClass('items-center');
			// $('#studentRecord-modal').addClass('items-start');

			// registratopn #
			// profile
			// lrn
			// level
			//legal name
		} else {
			Swal.fire({
				icon: 'error',
				title: 'Forbidden Request',
				text: res.message,
				footer: null,
			});
		}
	});
});





// $(document).ready(function () {
// 	// Create form validation
// 	$('#studentRegularForm').validate({
// 		rules: {
// 			enrollType: {
// 				required: true,
// 			},
// 			regLevel: {
// 				required: true,
// 			},
// 			gwa: {
// 				required: true,
// 				number: true,
// 				range: [75, 100],
// 			},
// 		},
// 		messages: {
// 			enrollType: {
// 				required: 'Field cannot be empty.',
// 			},
// 			regLevel: {
// 				required: 'Field cannot be empty.',
// 			},
// 			gwa: {
// 				required: 'This field is required',
// 				number: 'Please enter a valid number',
// 				range: 'Please enter a number between 75 and 100',
// 			},
// 		},
// 	});

// 	$('.my-fieldset').hide();


// 	// Bind the click events for previous and next buttons
// 	prevFieldsetReg('#prvBtn__1');
// 	nextFieldSetReg('#nxtBtn__1');
// 	prevFieldsetReg('#prvBtn__2');
// 	nextFieldSetReg('#nxtBtn__2');
// 	prevFieldsetReg('#prvBtn__3');
// 	nextFieldSetReg('#nxtBtn__3');
// 	prevFieldsetReg('#prvBtn__4');
// 	nextFieldSetReg('#nxtBtn__4');
// 	prevFieldsetReg('#prvBtn__5');
// 	nextFieldSetReg('#nxtBtn__5');



// 			$('#nxtBtn__4').on('click', function () {
// 				// get the level,name
// 				$('#modal_reg-container').addClass('max-w-[650px]');

// 				const presentYear = new Date().getFullYear();
// 				const prevYear = new Date().getFullYear() - 1;

// 				const syear = `SY:${prevYear}-${presentYear}`;

// 				let getSelectedLevel = $('#regLevel option:selected').text();

// 				console.log(getSelectedLevel, 'getSelected');

// 				const preSchool = ['nursery', 'kinder'];
// 				const grade1 = ['grade 1'];
// 				const primary = ['grade 2', 'grade 3'];
// 				const intermidiate = ['grade 4', 'grade 5', 'grade 6'];
// 				const jrHigh = ['grade 7', 'grade 8', 'grade 9', 'grade 10'];
// 				const srHigh = ['grade 11', 'grade 12'];

// 				let selectedLevel = '';
// 				let miscelanious = '';
// 				let booksModule = '';
// 				let tuitionFee = '';
// 				let total = '';
// 				let fullPayment = '';

// 				if (preSchool.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'PRESCHOOL';
// 					miscelanious = '₱10,045.00';
// 					booksModule = '₱5,905.00';
// 					tuitionFee = '₱15,000.00';
// 					total = '₱30,950.00';
// 					fullPayment = '₱29,450.00';
// 				}
// 				if (grade1.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'PRESCHOOL';
// 					miscelanious = '₱14,850.00';
// 					booksModule = '₱5,905.00';
// 					tuitionFee = '₱9,350.00';
// 					total = '₱30,105.00';
// 					fullPayment = '₱29,170.00';
// 				}
// 				if (primary.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'PRIMARY';
// 					miscelanious = '₱12,850.00';
// 					booksModule = '₱5,905.00';
// 					tuitionFee = '₱9,350.00';
// 					total = '₱28,105.00';
// 					fullPayment = '27,170.00';
// 				}

// 				if (intermidiate.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'INTERMIDIATE';
// 					miscelanious = '₱12,850.00';
// 					booksModule = '₱6,750.00';
// 					tuitionFee = '₱9,350.00';
// 					total = '₱28,950.00';
// 					fullPayment = '₱28,015.00';
// 				}
// 				if (jrHigh.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'JR HIGH SCHOOL';
// 					miscelanious = '₱13,050.00';
// 					booksModule = '₱8,325.00';
// 					tuitionFee = '₱10,450.00';
// 					total = '₱31,925.00';
// 					fullPayment = '₱30,880.00';
// 				}
// 				if (srHigh.includes(getSelectedLevel.toLowerCase())) {
// 					selectedLevel = 'SENIOR HIGH SCHOOL';
// 					miscelanious = '₱7,670.00';
// 					booksModule = '0.00';
// 					tuitionFee = '17,500.00';
// 					total = '25,170.00';
// 					fullPayment = '25,170.00';
// 				}

			
// 				let fullName = $('#regFullName').val().toUpperCase();
// 				let getDateString = new Date().toLocaleDateString();

		
// 				$('#reg_fLName').text(fullName);
// 				$('#reg_typeFee').text(`(${selectedLevel})`);
// 				$('#reg_getSelectedSection').text(getSelectedLevel);
// 				$('#reg_getDateIssued').text(getDateString);
// 				$('#reg_misc').text(miscelanious);
// 				$('#reg_books').text(booksModule);
// 				$('#reg_tuition').text(tuitionFee);
// 				$('#reg_total').text(total);
// 				$('#reg_full').text(fullPayment);

// 				// print

// 				$('#syYearPrint').text(syear);
// 				$('#fLNamePrint').text(fullName);
// 				$('#typeFeePrint').text(`(${selectedLevel})`);
// 				$('#getSelectedSectionPrint').text(getSelectedLevel);
// 				$('#getDateIssuedPrint').text(getDateString);
// 				$('#miscPrint').text(miscelanious);
// 				$('#booksPrint').text(booksModule);
// 				$('#tuitionPrint').text(tuitionFee);
// 				$('#totalPrint').text(total);
// 				$('#fullPrint').text(fullPayment);
// 				$('#typeAvail').text('(Regular)');

// 			});

// 		let submitForm = false;
// 		$('#nxtBtn__5').on('click', function () {

			
// 			let valid = $('#studentRegularForm').valid();

// 			console.log(valid, 'get valid');
// 			if (valid) {
// 				submitForm = true;
// 			}
// 		});

			

// 	$('#studentRegularForm').submit(function(e){
	
	
// 			let valid = $('#studentRegularForm').valid();


// 			if (valid === true && submitForm) {
// 				e.preventDefault();
// 				const form = document.getElementById('studentRegularForm');

// 				const typeFee = $('#reg_typeFee').text().replace('₱', '');
// 				const misc = $('#reg_misc').text().replace('₱', '');
// 				const book = $('#reg_books').text().replace('₱', '');
// 				const tuition = $('#reg_tuition').text().replace('₱', '');
// 				const total = $('#reg_total').text().replace('₱', '');
// 				const full = $('#reg_full').text().replace('₱', '');
// 				const year = new Date().getFullYear();

// 				const formData = new FormData(form);
		

// 				const data = {};

// 				for (let pair of formData.entries()) {
// 					data[pair[0]] = pair[1];
// 				}

// 				httpJSONReq('enrollRegularStudents', data, (res) => {
// 					console.log(res, 'get message');
// 					if (res.success === true) {
						
// 						location.href = `?page=dashboard`;
// 						localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
// 					} else {
// 						Swal.fire({
// 							icon: 'error',
// 							title: 'Forbidden Request',
// 							text: res.message,
// 							footer: null,
// 						});
// 					}
// 				});

// 				console.log(data);
// 			} else {
// 				console.log('Form submission prevented.');
// 				e.preventDefault();
// 			}

// 	})

// });


$('#studentRecCloseModal').on('click', function () {
	localStorage.removeItem('modify');
	$('#studentRecordForm')[0].reset();
	$('#studentRegularForm')[0].reset();

	$('fieldset').hide(); // Hide all fieldsets
	$('fieldset:first').show();
	$('#studentRecTitle').text('Registration form');

 // Show the second fieldset
});


	function prevFieldsetReg(id) {
	 $(id).click(function () {
			if ($('#studentRegularForm').valid()) {
				let currentFieldset = $('.my-fieldset:visible');
				let prevFieldset = currentFieldset.prev('.my-fieldset');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSetReg(id) {
 		$(id).click(function () {
		if ($('#studentRegularForm').valid()) {
			let currentFieldset = $('.my-fieldset:visible');
			let nextFieldset = currentFieldset.next('.my-fieldset');

			if (nextFieldset.length > 0) {
				currentFieldset.hide();
				nextFieldset.show();
			}
		}
		});
	}



function httpJSONReq(action,data,cb) {
	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', `src/function/controller.php?action=${action}`, true);

	xhttp.onreadystatechange = function() {

		if(this.readyState === 4){
			 if(this.status === 200){
					let response = JSON.parse(this.responseText);
					cb(response);
			 }
			 else{
				cb(response);
			 }
		}
		
	}

let payload = `data=${JSON.stringify(data)}`;
xhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

xhttp.send(payload);

}





	// barcode logic

// Create FileReader instance outside the event handler
const fileReader = new FileReader();

$('#scanBarcode').on('change', function (e) {
    let file = e.target.files[0];

    const html5QrCode = new Html5Qrcode('reader');
    let isScannerRunning = false; // Track the scanner's running state

    handleFileInput(html5QrCode, isScannerRunning, file, fileReader);
});

// Function to handle file input change
function handleFileInput(html5QrCode, isScannerRunning, file, reader) {
    const imageFile = file;

    if (!imageFile) {
        console.error('No file selected.');
        return;
    }

    // Use the same FileReader instance for each file
    reader.onload = function (e) {
        const imageDataUrl = e.target.result;

					// Stop the scanner if it's running
					if (isScannerRunning) {
						html5QrCode.stop();
						isScannerRunning = false;
					}

					// Clear the previous QR code
					document.getElementById('reader').innerHTML = '';

					// Start the scanner with the image file
					html5QrCode
						.scanFile(imageFile, true)
						.then((qrCodeMessage) => {
							// Callback when a QR code is detected
							$('#searchRegNumber').val(qrCodeMessage);
						})
						.catch((errorMessage) => {
				
								Swal.fire({
									icon: 'error',
									title: 'Reading barcode image failed',
									text: errorMessage,
									footer: null,
								});
						})
						.finally(() => {
							// Update the scanner's running state
							isScannerRunning = true;
						});
    };

    // Read the selected file as a Data URL
    reader.readAsDataURL(imageFile);
}


const getDocsFile = JSON.parse(localStorage.getItem('listSelectDocument')) ?? null;


console.log(getDocsFile, 'get me filed cos');

if(getDocsFile != null){
	



$(document).ready(function () {
	getDocsFile.forEach((item) => {
			  $(document).on('change', '#' + item.id, function (e) {

				console.log(getDocsFile, 'get me filed cos');
					console.log(item,'get selcted value');
								

					const formData = new FormData();
					formData.append(item.id, e.target.files[0]);
					formData.append('id',item.id);
					formData.append('src', item.src);
					formData.append('credentialType', item.type);
					formData.append('path', item.path);
					formData.append('renameFile', item.renameFile);
					formData.append('studentId', item.studentId);
					formData.append('columnName', item.columnName);
					formData.append('imgId', item.imgId);
					formData.append('hrefLink', item.hrefLink);



					console.log(formData,'get formdata');



						httpResFormData('editProfileDocuments', formData, (res) => {
							if (res.success) {
								// get file


								console.log(res,'get response details man')

								if(res.imgId != ''){

											let geFolderName = window.location.href.split('/')[3];
											let rootUrl = window.location.origin + '/' + geFolderName;
											let imageUrl = rootUrl + res.newSrc;

									let editable = `<label for='${res.getId}' class="ml-4 text-indigo-500"><ion-icon name="create-outline"></ion-icon></label><input class='hidden' type='file' id='${res.getId}' accept='image/*' /> `;

										let selectedValue = `<a  onclick="previewImage('${imageUrl}')" class="text-center px-2 text-indigo-500"><ion-icon name="eye-outline"></ion-icon></a>${editable}`;

								
										 $('#' + res.imgId).html(selectedValue);


										console.log('srcfile', imageUrl);
										console.log('widget', $('#' + res.imgId));
										console.log('widgetDetails', res.imgId);
								}
								else{
									console.log('no id get')
								}

							

								Swal.fire({
									icon: 'success',
									title: 'Accepted request',
									text: res.message,
									footer: null,
								});

										

							} else {
								Swal.fire({
									icon: 'error',
									title: 'Forbidden Request',
									text: res.message,
									footer: null,
								});
							}
						});



				});
	});







// for submission

$('#editMasterForm').validate({
	rules: {},
	message: {},
});

$('#editMasterForm').submit(function (e) {
	e.preventDefault();

	const getFormDetails = document.getElementById('editMasterForm');

	const formData = new FormData(getFormDetails);
	formData.append('ref_number', $('#viewReferenceNumber').text());

	const data = {};

	for (let pair of formData.entries()) {
		data[pair[0]] = pair[1];
	}



	httpJSONReq('editStudentMasterList', data, (res) => {
		if (res.success) {
			location.href = '?page=dashboard';
			localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'update', message: res.message }));
		} else {
			Swal.fire({
				icon: 'success',
				title: 'Forbidden request',
				text: res.message,
			});
		}
	});
});




















});

}

