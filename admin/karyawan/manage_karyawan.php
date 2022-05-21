<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `karyawan` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="item-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="nama" class="control-label">Nama</label>
			<input type="text" name="nama" id="nama" class="form-control rounded-0" value="<?php echo isset($nama) ? $nama : ''; ?>">
		</div>
		<div class="form-group">
			<label for="alamat" class="control-label">Alamat</label>
			<textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($alamat) ? $alamat : ''; ?></textarea>
		</div>

		<div class="form-group">
			<label for="nohp" class="control-label">No. Handphone</label>
			<input type="number" name="nohp" id="nohp" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($nohp) ? $nohp : ''; ?>">
		</div>

        <div class="form-group col-6">
					<label for="jabatan">Jabatan</label>
					<select name="jabatan" id="jabatan" class="custom-select" value="<?php echo isset($meta['jabatan']) ? $meta['jabatan']: '' ?>" required>
						<option value="1" 
                            <?php echo isset($jabatan) && $jabatan == 1 ? 'selected': '' ?>>Hairstylist</option>
						<option value="2" 
                            <?php echo isset($jabatan) && $jabatan == 2 ? 'selected': '' ?>>Kasir</option>
                        <option value="3" 
                            <?php echo isset($jabatan) && $jabatan == 3 ? 'selected': '' ?>>Hairdresser</option>
					</select>
        </div>

        <div class="form-group">
			<label for="gajipokok" class="control-label">Gaji Pokok</label>
			<input type="text" name="gajipokok" id="gajipokok" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($gajipokok) ? $gajipokok : ''; ?>">
		</div>

        <div class="form-group">
			<label for="tanggalmasuk" class="control-label">Tanggal Masuk</label>
			<input type="date" name="tanggalmasuk" id="tanggalmasuk" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($tanggalmasuk) ? $tanggalmasuk : ''; ?>">
		</div>
        
		<!-- <div class="form-group">
			<label for="supplier_id" class="control-label">Supplier</label>
			<select name="supplier_id" id="supplier_id" class="custom-select select2">
			<option <?php echo !isset($supplier_id) ? 'selected' : '' ?> disabled></option>
			<?php 
			$supplier = $conn->query("SELECT * FROM `supplier_list` where status = 1 order by `name` asc");
			while($row=$supplier->fetch_assoc()):
			?>
			<option value="<?php echo $row['id'] ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? "selected" : "" ?> ><?php echo $row['name'] ?></option>
			<?php endwhile; ?>
			</select>
		</div> -->

		<!-- <div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="custom-select selevt">
			<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
			<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div> -->
	</form>
</div>
<script>
  
	$(document).ready(function(){
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#item-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_karyawan",
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