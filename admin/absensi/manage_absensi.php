<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $absensi_id = $_GET['id'];
    $qry = $conn->query("SELECT absensi.id,id_karyawan,nama,bulan,hadir,absen,lembur,izin FROM karyawan JOIN absensi ON karyawan.id=absensi.id_karyawan WHERE absensi.id = '$absensi_id'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $k=$v;
        }
    }
}
?>

<style>
    select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title">Data Absensi Karyawan</h4>
    </div>
    <div class="card-body">
        <form action="" id="absensi-form">
            <input type="hidden" name="absensi_id" value="<?php echo isset($absensi_id) ? $absensi_id : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">ID Karyawan</label>

						<div class="row-md-1">
						<input type="text" name = "text_id_karyawan" id = "text_id_karyawan" class="form-control rounded-0" readonly value= "<?php echo isset($absensi_id) ? $absensi_id : ''  ?>"></input>
						</div>                       
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="karyawan" class="control-label text-info">Karyawan</label>
                            <select name="nama_karyawan" id="nama_karyawan" class="custom-select select2">
                            
                            <option <?php echo !isset($id_karyawan) ? 'selected' : '' ?> disabled></option>

							<?php 
                            $karyawan = $conn->query("SELECT id,nama FROM karyawan ORDER BY id ASC");
                            while($row=$karyawan->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?> "selected" : "" > <?php echo $row['nama'] ?>
											
							</option>							
                            <?php endwhile;  ?>							
                            </select>							
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">Data absensi</legend>
                    <div class="row justify-content-center align-items-end">
                            
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bulan" class="control-label">Bulan</label>
                                <select  name = "bulan" id="bulan" class="custom-select select2">
                                    <option selected></option>                                   
                                    <option value=1>Januari</option>
                                    <option value=2>Februari</option>
                                    <option value=3>Maret</option>
                                    <option value=4>April</option>
                                    <option value=5>Mei</option>
                                    <option value=6>Juni</option>
                                    <option value=7>Juli</option>
                                    <option value=8>Agustus</option>
                                    <option value=9>September</option>
                                    <option value=10>Oktober</option>
                                    <option value=11>November</option>
                                    <option value=12>Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="unit"  class="control-label">Hadir</label>
                                <input type="text"  class="form-control rounded-0" id="hadir" name ="hadir">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="unit"  class="control-label">Absen</label>
                                <input type="text"  class="form-control rounded-0" id="absen" name="absen">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty" class="control-label">Lembur</label>
                                <input type="number" step="any" class="form-control rounded-0" id="lembur" name="lembur">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty" class="control-label">Izin</label>
                                <input type="number" step="any" class="form-control rounded-0" id="izin" name="izin">
                            </div>
                        </div>
                        <!-- <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list">Add to List</button>
                            </div>
                        </div> -->
                </fieldset>
                <hr>
                
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="absensi-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=absensi/absensi' ?>">Cancel</a>
    </div>
</div>

<script>
        
	$('#nama_karyawan').change(function(){
		tes = $('#nama_karyawan').val();
		// $('#text_id_karyawan').text(tes);
        $("#text_id_karyawan").val(tes);
	})

    
	    $(function(){
        $('.select2').select2({
            placeholder:"Pilih karyawan",
            width:'resolve',
        })
        $('#bulan').select2({
            placeholder:"Pilih Bulan",
            width:'resolve',
        })

        

        
        $('#absensi-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_absensi",
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
					if(resp.status == 'success'){
						location.replace(_base_url_+"admin/?page=absensi/absensi");
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
                    $('html,body').animate({scrollTop:0},'fast')
				}
			})
		})

        if('<?php echo isset($id) && $id > 0 ?>' == 1){
            calc()
            $('#supplier_id').trigger('change')
            $('#supplier_id').attr('readonly','readonly')
            $('table#list tbody tr .rem_row').click(function(){
                rem($(this))
            })
        }
    })
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#supplier_id').removeAttr('readonly')

    }
    function calc(){
        var sub_total = 0;
        var grand_total = 0;
        var discount = 0;
        var tax = 0;
        $('table#list tbody input[name="total[]"]').each(function(){
            sub_total += parseFloat($(this).val())
            
        })
        $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        var discount =   sub_total * (parseFloat($('[name="discount_perc"]').val()) /100)
        sub_total = sub_total - discount;
        var tax =   sub_total * (parseFloat($('[name="tax_perc"]').val()) /100)
        grand_total = sub_total + tax
        $('.discount').text(parseFloat(discount).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="discount"]').val(parseFloat(discount))
        $('.tax').text(parseFloat(tax).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="tax"]').val(parseFloat(tax))
        $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="amount"]').val(parseFloat(grand_total))

    }
</script>