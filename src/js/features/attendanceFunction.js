const attendanceTable = '.attendance-table';


const attendanceNoTesult = 'attendanceNoResult';


document.addEventListener('DOMContentLoaded', function () {
	showPage(attendanceTable, attendanceNoResult);
});













// menu
const attendanceMenu = '#attendanceDropdownMenu';
const attendanceDropdownBtn = '#attendanceDropdownBtn';

// filter
const attendanceSearchId = 'attendanceSearchEl';
const attendanceToggle = '#onModalattendanceToggle';

// search

const attendancePrint = 'attendancePrint';
const attendancePageArea = '.attendance-printable';

// getMenu(attendanceMenu, attendanceTable);

// showPage(attendanceTable, attendanceNoTesult);
// tableSorting(attendanceMenu, attendanceTable, attendanceNoTesult);

let attendanceSearchEl = document.getElementById(attendanceSearchId);

attendanceSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(attendanceTable, attendanceNoTesult, searchValue);
});

$('#' + attendancePrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(attendancePageArea).removeClass('hidden');

	$(attendancePageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(attendancePageArea).addClass('hidden');
		}),
	});
});

function editattendance(data) {
	modal = 'edit';

	// console.log(data);

	// $('#yrName').val(data.name);
	// $('#type').val(data.type);
	// $('#yrId').val(data.id);

	// $('[id*="-error"]').hide();
	$(attendanceToggle).click();

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}

function deleteattendance(data) {
	const id = data.id;

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

			xhttp.open('POST', 'src/function/controller.php?action=deleteattendance', true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status === 200) {
						let response = JSON.parse(this.responseText);

						console.log(response, 'get response');

						if (response.success == true) {
							location.href = '?page=dashboard';
							localStorage.setItem('data', JSON.stringify({ id: '#tab8', action: 'delete', message: 'attendance has been deleted' }));
						}
					}
				}
			};

			const data = {
				yrId: id,
			};
			// payload
			let payload = `data=${JSON.stringify(data)}`;

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.send(payload);
		}
	});
}







$(document).ready(function () {
	$('#attendanceForm').validate({
		rules: {},
		messages: {},
	});

	const prevIndex = [1, 2, 3];
	const nextIndex = [1, 3];

	prevIndex.forEach((id) => {
		prevAttendanceBtn(`#attendancePrevBtn__${id}`);
	});

	nextIndex.forEach((id) => {
		nextAttendanceBtn(`#attendanceNextBtn__${id}`);
	});

	$('.attendance_enroll').hide();
	$('.attendance_enroll:first').show();

	let submitForms = false;

	$('#attendanceNextBtn__2').on('click', function () {
				deviceCheck((check)=>{
						console.log(check,'checking')
						if(check){
								$('.attendance_enroll').hide();
									$('.attendance_enroll:eq(2)').show();

									
							submitForms = true;
						}
				});
	});

	$('#attendanceForm').submit(function (e) {
		e.preventDefault();

		let valid = $('#attendanceForm').valid();
		let form = document.getElementById('attendanceForm');

		if (valid === true && submitForms == true) {
			let formData = new FormData(form);
				

			let data = {};

			for (let pair of formData.entries()) {
				data[pair[0]] = pair[1];
			}


			console.log('data listed here');
			console.log(data);

          readytoPost(parseInt(data.attendanceName), listSampleFormat, 'src/function/core/enroll.php', 'User  enrolled successfully', 'register');


			
		} else {
			console.log('forbidden response');
		}
	});
});

function prevAttendanceBtn(id) {
	$(id).click(function () {
		if ($('#attendanceForm').valid()) {
			let currentFieldset = $('.attendance_enroll:visible');
			let prevFieldset = currentFieldset.prev('.attendance_enroll');

			if (prevFieldset.length > 0) {
				currentFieldset.hide();
				prevFieldset.show();
			}
		}
	});
}

// Function to navigate to the next fieldset
function nextAttendanceBtn(id) {
	$(id).click(function () {
		if ($('#attendanceForm').valid()) {
			let currentFieldset = $('.attendance_enroll:visible');
			let nextFieldset = currentFieldset.next('.attendance_enroll');

			if (nextFieldset.length > 0) {
				currentFieldset.hide();
				nextFieldset.show();
			}
		}
	});
}







function readytoPost(input, sample, url, msg) {
	const dataaRec = {
		input,
		sample,
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

				localStorage.setItem('data', JSON.stringify({ id: '#tab9', action: 'add', message: 'User  enrolled successfully' }));

			

		

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
