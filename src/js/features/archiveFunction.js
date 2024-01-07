// fitertable table


const archiveTable = '.archieve-table';

const archiveNoResult = 'archiveNoResult';

document.addEventListener('DOMContentLoaded', function () {
	showPage(archiveTable, archiveNoResult);
});





const archiveSearchList = 'archieveSearchEl';



let archiveSearchEl = document.getElementById(archiveSearchList);

archiveSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	if(searchValue.length > 0){
			filterTable(archiveTable, archiveNoResult, searchValue);
	}else{
		$('#' + archiveNoResult).addClass('hidden');
			showPage(archiveTable, archiveNoResult);
	}
});





$('#filterTable').on('change', function () {
  let selectedOption = $('#filterTable option:selected').val();
	let selectedColumn = $('#filterTable option:selected').data('id');

    location.href = `?page=dashboard&table=${selectedOption}&columnId=${selectedColumn}`;

	 localStorage.setItem('data', JSON.stringify({ id: '#tab11', action: '', message:''}));

});



function deleteArchive(data) {
    

    console.log(data);

  httpJSONReq('deleteArchive', data,(res)=>{
    if (res.success) {
			location.href = '?page=dashboard';
			localStorage.setItem('data', JSON.stringify({ id: '#tab11', action: 'update', message: res.message }));

		} else {
		 Swal.fire({
				icon: 'success',
				title: 'Forbidden request',
				text: res.message,
			});
		}

  
  });

}



function restoreArchive(data) {



  httpJSONReq('restoreArchive', data, (res) => {
     if(res.success){
      	location.href = '?page=dashboard';
				localStorage.setItem('data', JSON.stringify({ id: '#tab11', action: 'update', message: res.message }));
     }else{
        Swal.fire({
					icon: 'success',
					title: 'Forbidden request',
					text: res.message,
				});
     }
  });


}