jQuery(function($){
	
	$('.sf-menu').superfish();
	
	$('.yakin-hapus').click(function(){
		var konfirm = confirm('Yakin akan menghapus data ini?');
		if(konfirm == false) {
			return false;
		}
	});
	
	$('.yakin').click(function(){
		var konfirmasi = confirm('Apakah anda yakin ingin logout?');
		if(konfirmasi == false) {
			return false;
		}
	});

	$("#jenis-nilai").change(function(){
		var pilihan = $(this).val();
		
		if(pilihan == 0) {
			$("#list").slideUp(200);
		} else if(pilihan== 1){
			$("#list").slideDown(200);
		}
	});
	
	$('.tambah-pilihan').click(function(){
		
		lastCtr = $('#pilihan-var tbody tr:last-child').data('counter');
		if(!lastCtr) {
			lastCtr = 0;
		}
		lastCtr += 1;
		appendHtml = '<tr data-counter="'+lastCtr+'">';
		appendHtml += '<td><input type="text" name="pilihan['+lastCtr+'][nama]"></td>';
		appendHtml += '<td><input type="text" name="pilihan['+lastCtr+'][nilai]"></td>';
		appendHtml += '<td><input type="text" name="pilihan['+lastCtr+'][urutan]"></td>';
		appendHtml += '<td><a href="#" class="red del-this-row"><span class="text-danger"></span>Hapus</a></td>';
		appendHtml += '</tr>';
		$('#pilihan-var tbody').append(appendHtml);
		return false;
	});
	
	$('body').on('click', '.del-this-row', function(){
		var konfirm = confirm('Yakin akan menghapus data ini?');
		if(konfirm == true) {
			$(this).closest('tr').remove();
		}		
		return false;
	});
	
});