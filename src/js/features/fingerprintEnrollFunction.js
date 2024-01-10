const fingerprintTable = '.fingerprint-table';


const fingerprintNoTesult = 'fingerprintNoResult';


document.addEventListener('DOMContentLoaded', function () {
	showPage(fingerprintTable, fingerprintNoTesult);
});













// menu
const fingerprintMenu = '#fingerprintDropdownMenu';
const fingerprintDropdownBtn = '#fingerprintDropdownBtn';

// filter
const fingerprintSearchId = 'fingerprintSearchEl';
const fingerprintToggle = '#onModalfingerprintToggle';

// search

const fingerprintPrint = 'fingerprintPrint';
const fingerprintPageArea = '.fingerprint-printable';

// getMenu(fingerprintMenu, fingerprintTable);

// showPage(fingerprintTable, fingerprintNoTesult);
// tableSorting(fingerprintMenu, fingerprintTable, fingerprintNoTesult);

let fingerprintSearchEl = document.getElementById(fingerprintSearchId);

fingerprintSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(fingerprintTable, fingerprintNoTesult, searchValue);
});

$('#' + fingerprintPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(fingerprintPageArea).removeClass('hidden');

	$(fingerprintPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(fingerprintPageArea).addClass('hidden');
		}),
	});
});

function editfingerprint(data) {
	modal = 'edit';


	console.log(data,'getData')

	$('#fingerprintPrevBtn__1').hide();

	$('.fingerprint_enroll').hide();
	$('.fingerprint_enroll:eq(1)').show();
	

	$('#fingerprintNameEdit').val(data.id);
	// console.log(data);

	// $('#yrName').val(data.name);
	// $('#type').val(data.type);
	// $('#yrId').val(data.id);

	// $('[id*="-error"]').hide();
	$(fingerprintToggle).click();

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}

function fingerPrintMoveToArchive(data) {

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
				id: 'attendance_id',
				selectedId: data.attendance_id,
				table: 'fingerprint_enroll',
				archiveName: 'attendance_record',
			};

			httpJSONReq('moveToArchive', dataRes, (res) => {
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab10', action: 'update', message: res.message }));
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








$(document).ready(function () {
	$('#fingerprintForm').validate({
		rules: {},
		messages: {},
	});

	const prevIndex = [1, 2, 3];
	const nextIndex = [1, 3];

	prevIndex.forEach((id) => {
		prevFingerprintBtn(`#fingerprintPrevBtn__${id}`);
	});

	nextIndex.forEach((id) => {
		nextFingerprintBtn(`#fingerprintNextBtn__${id}`);
	});

	$('.fingerprint_enroll').hide();
	$('.fingerprint_enroll:first').show();

	let submitForms = false;

	$('#fingerprintNextBtn__2').on('click', function () {
				deviceCheck((check)=>{
						console.log(check,'checking')
						if(check){
								$('.fingerprint_enroll').hide();
									$('.fingerprint_enroll:eq(2)').show();

									
							submitForms = true;
						}
				});
	});

	$('#fingerprintForm').submit(function (e) {
		e.preventDefault();

		let valid = $('#fingerprintForm').valid();
		let form = document.getElementById('fingerprintForm');

		if (valid === true && submitForms == true) {
			let formData = new FormData(form);
				

			let data = {};

			for (let pair of formData.entries()) {
				data[pair[0]] = pair[1];
			}


			console.log('data listed here');
			console.log(data);


			if(modal == 'edit'){
			 readytoPost(parseInt(data.fingerprintNameEdit), listSampleFormat, modal, 'src/function/core/enroll.php', 'User  updated successfully', 'register');

			}
			else{
			 readytoPost(parseInt(data.fingerprintName), listSampleFormat, '', 'src/function/core/enroll.php', 'User  enrolled successfully', 'register');
			}


			
		} else {
			console.log('forbidden response');
		}
	});
});

function prevFingerprintBtn(id) {
	$(id).click(function () {
		if ($('#fingerprintForm').valid()) {
			let currentFieldset = $('.fingerprint_enroll:visible');
			let prevFieldset = currentFieldset.prev('.fingerprint_enroll');

			if (prevFieldset.length > 0) {
				currentFieldset.hide();
				prevFieldset.show();
			}
		}
	});
}

// Function to navigate to the next fieldset
function nextFingerprintBtn(id) {
	$(id).click(function () {
		if ($('#fingerprintForm').valid()) {
			let currentFieldset = $('.fingerprint_enroll:visible');
			let nextFieldset = currentFieldset.next('.fingerprint_enroll');

			if (nextFieldset.length > 0) {
				currentFieldset.hide();
				nextFieldset.show();
			}
		}
	});
}







function readytoPost(input, sample,type, url, msg) {
	const dataaRec = {
		input,
		sample,
		type,
	};


	let payload = `data=${JSON.stringify(dataaRec)}`;

	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
		
				// if not existed and success

				if (this.responseText !== 'existed' && this.response === 'success') {
					// showMessage(msg, 'success');

				listSampleFormat = [];

				location.href = '?page=dashboard';

				let msgRes =  type == 'edit' ? 'updated' : 'enrolled';

				localStorage.setItem('data', JSON.stringify({ id: '#tab9', action: 'add', message: `Fingerprint ${msgRes} successfully` }));

			

		

				} else {
					let msgErr = this.responseText == 'existed' ? 'Duplicated fingerprint is forbidden' : 'Please contact your administrator';

					showMessage(msgErr, 'error');

					console.log(`${this.responseText}`);
				}
			
		
		}
	};

	xhttp.open('POST', url, true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(payload);
}



	function showMessage(msg, type) {
		if (type === 'error') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: `Something went wrong!,${msg}`,
				footer: '',
			});
		} else {
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: msg,
				showConfirmButton: false,
				timer: 1500,
			});
		}
	}
