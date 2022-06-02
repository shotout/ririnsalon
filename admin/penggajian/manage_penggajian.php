<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT id_penggajian,jabatan,penggajian.id_karyawan,penggajian.id_absensi,tunjangan.id_tunjangan,nama,bulan,POINT,bonus,p_cashbon,p_lain,total FROM penggajian 
    JOIN karyawan ON penggajian.id_karyawan = karyawan.id 
    JOIN absensi ON penggajian.id_absensi = absensi.id
    JOIN tunjangan ON penggajian.id_tunjangan = tunjangan.id_tunjangan WHERE id_penggajian = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
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
    <div class="card-header">Gaji Karyawan</h4>
    </div>
    
    <div class="card-body">
        <form action="" id="penggajian-form"> 
        <input type="hidden" name ="id" value="<?php echo isset($id_penggajian) ? $id_penggajian : '' ?>">            
                        
            <div class="container-fluid">
            <div class="col-md-3">
                        <div class="form-group">                          
                            
                            <label for="bulan" class="control-label text-info">Bulan</label>
                            <select  name = "bulan" id="bulan" class="custom-select select3">
                                    <option selected></option>
                                    
                                    <option value="1" 
                                    <?php echo isset($bulan) && $bulan == 1 ? 'selected': '' ?>>Januari</option>
                                     
                                    <option value="2" 
                                    <?php echo isset($bulan) && $bulan == 2 ? 'selected': '' ?>>Februari</option>

                                    <option value="3" 
                                    <?php echo isset($bulan) && $bulan == 3 ? 'selected': '' ?>>Maret</option>

                                    <option value="4" 
                                    <?php echo isset($bulan) && $bulan == 4 ? 'selected': '' ?>>April</option>

                                    <option value="5" 
                                    <?php echo isset($bulan) && $bulan == 5 ? 'selected': '' ?>>Mei</option>

                                    <option value="6" 
                                    <?php echo isset($bulan) && $bulan == 6 ? 'selected': '' ?>>Juni</option>

                                    <option value="7" 
                                    <?php echo isset($bulan) && $bulan == 7 ? 'selected': '' ?>>Juli</option>

                                    <option value="8" 
                                    <?php echo isset($bulan) && $bulan == 8 ? 'selected': '' ?>>Agustus</option>

                                    <option value="9" 
                                    <?php echo isset($bulan) && $bulan == 9 ? 'selected': '' ?>>September</option>

                                    <option value="10" 
                                    <?php echo isset($bulan) && $bulan == 10 ? 'selected': '' ?>>Oktober</option>

                                    <option value="11" 
                                    <?php echo isset($bulan) && $bulan == 11 ? 'selected': '' ?>>November</option>

                                    <option value="12" 
                                    <?php echo isset($bulan) && $bulan == 12 ? 'selected': '' ?>>Desember</option>
                                    
                                </select>                        
                            </select>                            

                        </div>
                    </div></br>
                <div class="column">               
                        					
						<input type="hidden" name = "text_id_karyawan" id = "text_id_karyawan" class="form-control rounded-0" readonly value= "<?php echo isset($id_karyawan) ? $id_karyawan : ''  ?>"></input>
						                     
                   

                    <div class="col-md-5">
                        <div class="form-group">                          
                        
                            <label for="karyawan" class="control-label text-info">Karyawan</label>
                            
                            <select name="nama_karyawan" id="nama_karyawan" class="custom-select select2">
                                                        
                            <option <?php echo !isset($id_karyawan) ? 'selected' : '' ?>disabled></option>
                                                       							
                           	<?php 
                            $karyawan = $conn->query("SELECT * FROM karyawan ORDER BY id ASC");
                            while($row=$karyawan->fetch_assoc()):
                            ?>

                            <option value="<?php echo $row['id'].'-'.$row['nama'].'-'.$row['jabatan'].'-'.$row['gajipokok']?>" <?php echo isset($id) && $id == $row['id'] ? "selected" : "" ?> ><?php echo $row['nama'] ?></option>					   
                            
                            <?php endwhile; ?>                            
                                                                                      						 
                            </select>                           

                        </div>
                    </div>
                     
                    <div class="col-md-4">
                        <label class="control-label text-info">Jabatan</label>                     
                                   
						<div class="row-md-1">                                  
                        <input type="text" name = "jabatan" id = "jabatan" class="form-control rounded-0" readonly ?>
						</div>                       
                    </div>

                            </br>

                    <div class="col-md-3">
                        <label class="control-label text-info">Gaji Pokok</label>                     
                                   
						<div class="row-md-1">                                  
                        <input type="text" name = "gapok" id = "gapok" class="form-control rounded-0" readonly ?>
						</div>                       
                    </div>

                    

                </div>
                <hr>
                <fieldset>
                    
                    <div class="row  align-items-end">
                            
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_kesehatan"  class="control-label">Kesehatan</label>
                                <input type="number"  class="form-control rounded-0" id = "t_kesehatan" name = "t_kesehatan" value="<?php echo isset($t_kesehatan) ? $t_kesehatan : ''; ?>">
                            </div>
                        </div>       
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_makan"  class="control-label">Makan</label>
                                <input type="number"  class="form-control rounded-0" id = "t_makan" name = "t_makan" value="<?php echo isset($t_makan) ? $t_makan : ''; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_makeup"  class="control-label">Make Up</label>
                                <input type="number"  class="form-control rounded-0" id = "t_makeup" name = "t_makeup" value="<?php echo isset($t_makeup) ? $t_makeup : ''; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_transport"  class="control-label">Transport</label>
                                <input type="number"  class="form-control rounded-0" id = "t_transport" name = "t_transport" value="<?php echo isset($t_transport) ? $t_transport : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_kasir" class="control-label">Kasir</label>
                                <input type="number" step="any" class="form-control rounded-0" id="t_kasir" name="t_kasir" value="<?php echo isset($t_kasir) ? $t_kasir : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="t_kerajinan" class="control-label">Kerajinan</label>
                                <input type="number" step="any" class="form-control rounded-0" id="t_kerajinan" name="t_kerajinan" value="<?php echo isset($t_kerajinan) ? $t_kerajinan : ''; ?>">
                            </div>
                        </div>
                        <!-- <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list">Add to List</button>
                            </div>
                        </div> -->
                </fieldset>
                <hr>
                
    <!-- <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="absensi-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=absensi/absensi' ?>">Cancel</a>
    </div> -->
</div>

<script>




	$('#nama_karyawan').change(function(){       
		karyawan = $('#nama_karyawan').val();
        karyawanarray = karyawan.split("-");
		// $('#text_id_karyawan').text(tes);
        $("#text_id_karyawan").val(karyawanarray[0]);
               
        jbt = karyawanarray[2];
        var gaji = karyawanarray[3]; 
        var	number_string = gaji.toString(),
	    sisa 	= number_string.length % 3,
	    rupiah 	= number_string.substr(0, sisa),
	    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
        if (ribuan) {
	    separator = sisa ? '.' : '';
	    rupiah += separator + ribuan.join('.');
        }
        
         $("#gapok").val(rupiah);
       

        if (jbt == 1){
            namajabatan = "Hairstylist";
            $("#jabatan").val(namajabatan);
        }else if(jbt == 2){
            namajabatan = "Kasir";
            $("#jabatan").val(namajabatan);
        }else{
            namajabatan = "Hairdresser";
            $("#jabatan").val(namajabatan);
        }
	})

    
	$(function(){
        $('.select2').select2({
            placeholder:"Pilih karyawan",
            width:'resolve',
        })       
    })
        

    $(function(){
        $('.select3').select2({
            placeholder:"Pilih Bulan",
            width:'resolve',
        })       
    })


        
        $('#penggajian-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_tunjangan",
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
						location.replace(_base_url_+"admin/?page=tunjangan/tunjangan");
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

        if('<?php echo isset($id_tunjangan) && $id_tunjangan > 0 ?>' == 1){
            
            $('#nama_karyawan').trigger('change')
            $('#nama_karyawan').attr('readonly','readonly')
            
        }
    // })
    // function rem(_this){
    //     _this.closest('tr').remove()
    //     calc()
    //     if($('table#list tbody tr').length <= 0)
    //         $('#supplier_id').removeAttr('readonly')

    // }
    // function calc(){
    //     var sub_total = 0;
    //     var grand_total = 0;
    //     var discount = 0;
    //     var tax = 0;
    //     $('table#list tbody input[name="total[]"]').each(function(){
    //         sub_total += parseFloat($(this).val())
            
    //     })
    //     $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
    //     var discount =   sub_total * (parseFloat($('[name="discount_perc"]').val()) /100)
    //     sub_total = sub_total - discount;
    //     var tax =   sub_total * (parseFloat($('[name="tax_perc"]').val()) /100)
    //     grand_total = sub_total + tax
    //     $('.discount').text(parseFloat(discount).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
    //     $('[name="discount"]').val(parseFloat(discount))
    //     $('.tax').text(parseFloat(tax).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
    //     $('[name="tax"]').val(parseFloat(tax))
    //     $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
    //     $('[name="amount"]').val(parseFloat(grand_total))

    // }
</script>