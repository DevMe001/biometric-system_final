const classSubjectTable = '.classSubject-table';
const classSubjectNoTesult = 'classSubjectNoResult';

// menu
const classSubjectMenu = '#classSubjectDropdownMenu';
const classSubjectDropdownBtn = '#classSubjectDropdownBtn';

// filter
const classSubjectSearchId = 'classSubjectSearchEl';
const classSubjectToggle = '#onModalclassSubjectToggle';

// search

const classSubjectPrint = 'classSubjectPrint';
const classSubjectPageArea = '.classSubject-printable';

// getMenu(classSubjectMenu, classSubjectTable);
document.addEventListener('DOMContentLoaded', function () {
	showPage(classSubjectTable, classSubjectNoTesult);
});

// tableSorting(classSubjectMenu, classSubjectTable, classSubjectNoTesult);

let classSubjectSearchEl = document.getElementById(classSubjectSearchId);

classSubjectSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	if (searchValue.length > 0) {
		filterTable(classSubjectTable, classSubjectNoTesult, searchValue);
	} else {
		$('#' + classSubjectNoTesult).addClass('hidden');
		showPage(classSubjectTable, classSubjectNoTesult);
	}
});

$('#' + classSubjectPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(classSubjectPageArea).removeClass('hidden');

	$(classSubjectPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(classSubjectPageArea).addClass('hidden');
		}),
	});
});

$('#classSubjectCloseModal').on('click', function () {
	$('#classSubjectName').val('');
	localStorage.removeItem('modify');
	$('#classSubjectForm')[0].reset();
});

function editclassSubject(data) {
	// modal = 'edit';

	console.log(data);

	$('#classSubjectTitle').text('Update a');
	$('#subjecBtn').text('Update');
	$('#classSubjectName').val(data.name);
	$('#classSubject_id').val(data.id);
	$(classSubjectToggle).click();

	localStorage.setItem('modify', JSON.stringify(true));
}

function deleteclassSubject(data) {
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

			const dataRes = {
				classSubject_id: data.id,
			};

			httpJSONReq('deleteclassSubject', dataRes, (res) => {
				if (res.success) {
					localStorage.removeItem('modify');
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab4', action: 'delete', message: res.message }));
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Forbidden Request',
						text: res.message,
						footer: null,
					});
				}
			});
		}
	});
}

function classSubjectMoveToArchive(data) {
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
				table: 'classSubject',
				archiveName: 'classSubject',
			};

			httpJSONReq('moveToArchive', dataRes, (res) => {
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab4', action: 'update', message: res.message }));
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
	$('#classSubjectForm').validate({
		rules: {
			classSubjectName: {
				required: true,
			},
		},
		messages: {
			classSubjectName: {
				required: 'Field is not empty',
			},
		},
	});

	$('#classSubjectForm').submit(function (e) {
		e.preventDefault();

		let valid = $('#classSubjectForm').valid();
		let form = document.getElementById('classSubjectForm');

		if (valid === true) {
			let formData = new FormData(form);
			let data = {};

			for (let pair of formData.entries()) {
				data[pair[0]] = pair[1];
			}

			if (localStorage.getItem('modify') === 'true') {
				httpJSONReq('modifyclassSubject', data, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab4', action: 'update', message: res.message }));
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Forbidden Request',
							text: res.message,
							footer: null,
						});
					}
				});
			} else {
				httpJSONReq('addclassSubject', data, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab4', action: 'add', message: res.message }));
					} else {
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
			console.log('forbidden response');
		}
	});
});
