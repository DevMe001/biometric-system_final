const att_Table = '.att-table';

const att_NoResult = 'att_NoResult';

document.addEventListener('DOMContentLoaded', function () {
	showPage(att_Table, att_NoResult);
});

const att_SearchList = 'attSearchEl';

let att_SearchEl = document.getElementById(att_SearchList);

att_SearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	if (searchValue.length > 0) {
		filterTable(att_Table, att_NoResult, searchValue);
	} else {
		$('#' + att_NoResult).addClass('hidden');
		showPage(att_Table, att_NoResult);
	}
});
