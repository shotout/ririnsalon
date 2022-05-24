<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `pengeluaran` where idpengeluaran = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="pengeluaran-form">
	<div class="form-group">
	<?php
	$qry = $conn->query("SELECT MAX(noreferensi_pengeluaran) AS kodeTerbesar FROM pengeluaran;");
	$data = mysqli_fetch_array($qry);
	$koderef = $data['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($koderef, 4, 4);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++; 
	$huruf = "KREF";
	$koderef = $huruf . sprintf("%04s", $urutan);
	
	?>

			<input type="hidden" name="idpengeluaran" id="idpengeluaran" class="form-control rounded-0" value= "<?php echo isset($idpengeluaran) ? $idpengeluaran : ''  ?>" readonly>

			<label for="noreferensi" class="control-label">No Referensi</label>
			<input type="text" name="noreferensi_pengeluaran" id="noreferensi_pengeluaran" class="form-control rounded-0" value="<?php echo $koderef ?>" readonly>
		</div>
		
		<div class="form-group">
			<label for="tanggal_pengeluaran" class="control-label">Tanggal Masuk</label>
			<input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($tanggal_pengeluaran) ? $tanggal_pengeluaran : ''; ?>">
		</div>			
        
        <div class="form-group">
			<label for="amount_pengeluaran" class="control-label">Amount</label>
			<input type="number" name="amount_pengeluaran" id="amount_pengeluaran" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($amount_pengeluaran) ? $amount_pengeluaran : ''; ?>">
		</div>
        

		<div class="form-group">
			<label for="keterangankeluar" class="control-label">Keterangan</label>
			<textarea type="text" name="keterangankeluar" id="keterangankeluar" class="form-control rounded-0" value="<?php echo isset($keterangankeluar) ? $keterangankeluar : ''; ?>"></textarea>
		</div>

        
		
	</form>
</div>
<script>
  
	$(document).ready(function(){
        
		$('#pengeluaran-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_pengeluaran",
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