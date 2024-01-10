
const teacherAttendanceTable = '.teacherAttendance-table';

const teacherAttendanceNoTesult = 'teacherAttendanceNoResult';

document.addEventListener('DOMContentLoaded', function () {
	showPage(teacherAttendanceTable, teacherAttendanceNoResult);
});

// menu
const teacherAttendanceMenu = '#teacherAttendanceDropdownMenu';
const teacherAttendanceDropdownBtn = '#teacherAttendanceDropdownBtn';

// filter
const teacherAttendanceSearchId = 'teacherAttendanceSearchEl';
const teacherAttendanceToggle = '#onModalteacherAttendanceToggle';

// search

const teacherAttendancePrint = 'teacherAttendancePrint';
const teacherAttendancePageArea = '.teacherAttendance-printable';

// getMenu(teacherAttendanceMenu, teacherAttendanceTable);

showPage(teacherAttendanceTable, teacherAttendanceNoTesult);
// tableSorting(teacherAttendanceMenu, teacherAttendanceTable, teacherAttendanceNoTesult);

let teacherAttendanceSearchEl = document.getElementById(teacherAttendanceSearchId);

teacherAttendanceSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');
  if(searchValue != ''){
    	filterTable(teacherAttendanceTable, teacherAttendanceNoTesult, searchValue);
  }else{
    	$('#' + teacherAttendanceNoTesult).addClass('hidden');
			showPage(teacherAttendanceTable, teacherAttendanceNoTesult);
  }

});



$('#' + teacherAttendancePrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(teacherAttendancePageArea).removeClass('hidden');

	$(teacherAttendancePageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(teacherAttendancePageArea).addClass('hidden');
		}),
	});
});