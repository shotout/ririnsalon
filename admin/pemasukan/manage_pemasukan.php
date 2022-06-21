<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `kas` where idkas = '{$_GET['id']}' and statuskas ='masuk'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="pemasukan-form">
	<div class="form-group">
	<?php
	$qry = $conn->query("SELECT MAX(noreferensi) AS kodeTerbesar FROM kas where statuskas ='masuk';");
	$data = mysqli_fetch_array($qry);
	$koderef = $data['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($koderef, 4, 4);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++; 
	$huruf = "MREF";
	$koderef = $huruf . sprintf("%04s", $urutan);
	
	?>

			<input type="hidden" name="idkas" id="idkas" class="form-control rounded-0" value= "<?php echo isset($idkas) ? $idkas : ''  ?>" readonly>
			
			<label for="noreferensi" class="control-label">No Referensi</label>
			<input type="text" name="noreferensi" id="noreferensi" class="form-control rounded-0" value="<?php echo $koderef ?>" readonly>
		</div>
		
		<div class="form-group">
			<label for="tanggal" class="control-label">Tanggal Masuk</label>
			<input type="date" name="tanggal" id="tanggal" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($tanggal) ? $tanggal : ''; ?>">
		</div>			
        
        <div class="form-group">
			<label for="amount" class="control-label">Amount</label>
			<input type="number" name="amount" id="amount" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($amount) ? $amount : ''; ?>">
		</div>
        

		<div class="form-group">
			<label for="keterangan" class="control-label">Keterangan</label>
			<textarea type="text" name="keterangan" id="keterangan" class="form-control rounded-0" value="<?php echo isset($keterangan) ? $keterangan : ''; ?>"></textarea>
		</div>

        
		
	</form>
</div>
<script>
	
	$(document).ready(function(){
        
		$('#pemasukan-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_pemasukan",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload();
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
</script>