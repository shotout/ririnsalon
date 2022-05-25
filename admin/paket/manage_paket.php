<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `jasa` where idjasa = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="jasa-form">
		<input type="hidden" name ="id" value="<?php echo isset($idjasa) ? $idjasa : '' ?>">
		<div class="form-group">
			<label for="namajasa" class="control-label">Jasa</label>
			<input type="text" name="namajasa" id="namajasa" class="form-control rounded-0" value="<?php echo isset($namajasa) ? $namajasa : ''; ?>">
		</div>

		<div class="form-group col-md-4">
			<label for="hargajasa" class="control-label">Harga</label>
			<input type="number" name="hargajasa" id="hargajasa" step="any" class="form-control rounded-0 text-end" value="<?php echo isset($hargajasa) ? $hargajasa : ''; ?>">
		</div>

		<div class="form-group">
			<label for="keteranganjasa" class="control-label">Keterangan Jasa</label>
			<textarea name="keteranganjasa" id="keteranganjasa" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($keteranganjasa) ? $keteranganjasa : ''; ?></textarea>
		</div>     
              		
		
	</form>
</div>
<script>
  
	$(document).ready(function(){
       
		$('#jasa-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_jasa",
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