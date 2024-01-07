const subjectTable = '.subject-table';
const subjectNoTesult = 'subjectNoResult';

// menu
const subjectMenu = '#subjectDropdownMenu';
const subjectDropdownBtn = '#subjectDropdownBtn';

// filter
const subjectSearchId = 'subjectSearchEl';
const subjectToggle = '#onModalsubjectToggle';

// search

const subjectPrint = 'subjectPrint';
const subjectPageArea = '.subject-printable';

// getMenu(subjectMenu, subjectTable);
document.addEventListener('DOMContentLoaded', function () {
	showPage(subjectTable, subjectNoTesult);
});


// tableSorting(subjectMenu, subjectTable, subjectNoTesult);

let subjectSearchEl = document.getElementById(subjectSearchId);

subjectSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	if(searchValue.length > 0){
			filterTable(subjectTable, subjectNoTesult, searchValue);
	}else{
		$('#' + subjectNoTesult).addClass('hidden');
		showPage(subjectTable, subjectNoTesult);
	}

});

$('#' + subjectPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(subjectPageArea).removeClass('hidden');

	$(subjectPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(subjectPageArea).addClass('hidden');
		}),
	});
});

$('#subjectCloseModal').on('click', function () {
	 $('#subjectName').val('');
	 	localStorage.removeItem('modify');
		 $('#subjectForm')[0].reset();

});




function editsubject(data) {
	modal = 'edit';

	console.log(data);

	$('#subjectTitle').text('Update a');
	$('#subjecBtn').text('Update');
	$('#subjectName').val(data.name);
	$('#subject_id').val(data.id);
;
	$(subjectToggle).click();

	localStorage.setItem('modify',JSON.stringify(true));


}

function deletesubject(data) {
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
				subject_id: data.id,
			};

			httpJSONReq('deleteSubject', dataRes, (res) => {
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




function subjectMoveToArchive(data) {
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
				table: 'subject',
				archiveName: 'subject',
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



$(document).ready(function(){

  $('#subjectForm').validate({
		rules: {
			subjectName: {
				required: true,
			},
		},
		messages: {
			subjectName: {
				required: 'Field is not empty',
			},
		},
	});



  $('#subjectForm').submit(function(e){
    e.preventDefault();
    
    let valid = $('#subjectForm').valid()
    let form = document.getElementById('subjectForm');

    if(valid === true){
        let formData = new FormData(form);
				let data = {};

				for (let pair of formData.entries()) {
					data[pair[0]] = pair[1];
				}
				

			if(localStorage.getItem('modify') === 'true'){
				httpJSONReq('modifySubject', data, (res) => {
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
			}
			else{
				httpJSONReq('addSubject', data, (res) => {
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

    }
    else{
      console.log('forbidden response')
    }



  });


})



