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
            <fieldset>           
            <div class="container-fluid row">
           

                    <input type="hidden" name = "text_id_karyawan" id = "text_id_karyawan" class="form-control rounded-0" readonly value= "<?php echo isset($id_karyawan) ? $id_karyawan : ''  ?>"></input>	
                    
                    <input type="hidden" name = "text_id_tunjangan" id = "text_id_tunjangan" class="form-control rounded-0" readonly value= "<?php echo isset($id_tunjangan) ? $id_tunjangan : ''  ?>"></input>
                    
                    <input type="hidden" name = "text_id_absensi" id = "text_id_absensi" class="form-control rounded-0" readonly value= "<?php echo isset($id_absensi) ? $id_absensi : ''  ?>"></input>
                    
                    <div class="col-md-5">
                        <div class="form-group">                          
                        
                        
                            <label for="karyawan" class="control-label text-info">Karyawan</label>
                            
                            <select name="nama_karyawan" id="nama_karyawan" class="custom-select select2">
                                                        
                            <option <?php echo !isset($id_karyawan) ? 'selected' : '' ?>disabled></option>
                                                       							
                           	<?php 
                            $karyawan = $conn->query("SELECT tunjangan.id_karyawan,`nama`,`jabatan`,`gajipokok`,`t_kesehatan`,`t_makan`,`t_makeup`,`t_transport`,`t_kasir`,`t_kerajinan`,`lembur`,absensi.`id`,`id_tunjangan` FROM karyawan JOIN tunjangan ON karyawan.id = tunjangan.id_karyawan JOIN absensi ON karyawan.id = absensi.id_karyawan WHERE bulan = MONTH(CURDATE()) ORDER BY karyawan.id ASC");
                            while($row=$karyawan->fetch_assoc()):
                            ?>

                            <option value="<?php echo $row['id_karyawan'].'-'.$row['nama'].'-'.$row['jabatan'].'-'.$row['gajipokok'].'-'.$row['t_kesehatan'].'-'.$row['t_makan'].'-'.$row['t_makeup'].'-'.$row['t_transport'].'-'.$row['t_kasir'].'-'.$row['t_kerajinan'].'-'.$row['lembur'].'-'.$row['id'].'-'.$row['id_tunjangan']?>" <?php echo isset($id) && $id == $row['id'] ? "selected" : "" ?> ><?php echo $row['nama'] ?></option>					   
                            
                            <?php endwhile; ?>                            
                                                                                      						 
                            </select>                           

                        </div>
                    </div>
                     
                    <div class="col-md-3">
                        <label class="control-label text-info">Jabatan</label>                     
                                   
						<div class="row-md-2">                                  
                        <input type="text" name = "jabatan" id = "jabatan" class="form-control rounded-0" readonly ?>
						</div> 
                                              
                    </div>
                    <div class="col-md-1 text-center">
                            
                            <label class="control-label text-info"> <?php echo " &nbsp" ?></label>
                            <div class="row-md-2">
                                <button type="button" class="btn btn-primary" id="add_to_list"> Hitung </button>
                            </div>
                    </div>
                    
                </br> 
                </div>
                
                            </fieldset>
                <hr>
                <h4 class="text-info">Rincian Gaji</h4>
            <table class="table table-striped table-bordered" id="list">
                <colgroup>                                          
                    <col width="15%">
                    <col width="12%">
                    <col width="10%">
                    <col width="10%">
                    <col width="12%">
                    <col width="10%">
                    <col width="10%">
                    <col width="25%"> 
                    
                </colgroup>
                <thead>
                    <tr class="text-light bg-navy" style="font-size:10pt;">
                    
                            <th class="text-center py-1 px-2">Gaji Pokok</th>
                            <th class="text-center py-1 px-2">T. Kesehatan</th>
                            <th class="text-center py-1 px-2">T. Makan</th>                     
                            <th class="text-center py-1 px-2">T. Make Up</th>
                            <th class="text-center py-1 px-2">T. Transport</th>
                            <th class="text-center py-1 px-2">T. Kasir</th>
                            <th class="text-center py-1 px-2">T. Kerajinan</th>
                            <th class="text-center py-1 px-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                        
                    if(isset($id_karyawan)):
                    $qry = $conn->query("SELECT tunjangan.id_karyawan,`nama`,`jabatan`,`gajipokok`,`t_kesehatan`,`t_makan`,`t_makeup`,`t_transport`,`t_kasir`,`t_kerajinan`,`lembur`,absensi.`id`,`id_tunjangan` FROM karyawan JOIN tunjangan ON karyawan.id = tunjangan.id_karyawan JOIN absensi ON karyawan.id = absensi.id_karyawan WHERE karyawan.id = '{$id_karyawan}' and bulan = '{$bulan}'");
                    while($row = $qry->fetch_assoc()):
                        // $total += $row['hargapaket']
                    ?>
                    <tr>        
                    <td class="py-1 px-2 text-left gajipokok"></td>
                    <td class="py-1 px-2 text-left t_kesehatan"></td>
                    <td class="py-1 px-2 text-left t_makan"></td>
                    <td class="py-1 px-2 text-left t_makeup"></td>
                    <td class="py-1 px-2 text-left t_transport" ></td>
                    <td class="py-1 px-2 text-left t_kasir"></td>
                    <td class="py-1 px-2 text-left t_kerajinan"></td>
                    <td class="py-1 px-2 text-right total"></td>           
                    </tr>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    
                </tbody>
                <tfoot>                    
                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Lembur <input style="width:40px " id="lemburhari" name="lemburhari" class='text-left'value="<?php echo isset($lembur) ? $lembur : 0 ?>" readonly> Jam
                        
                        <th class="text-right py-1 px-2 lembur"> 0 </th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Point <input style="width:60px !important" id="pointangka" name="pointangka" class='' type="number" min="0" max="500" value="0">
                        <input type="hidden" name="bonus">
                        </th>
                        <th class="text-right py-1 px-2 point">0
                       
                        </th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Total Gaji</th>
                        <th class="text-right py-1 px-2 sub-total">0</th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="8">Potongan Cashbon <input class="text-right" style="width:180px !important" id="cashbon" name="cashbon" type="number" value="0">
                    </th>
                        
                    </tr>

                    <tr>
                    <th class="text-right py-1 px-2" colspan="8">Potongan Lainnya <input class="text-right" style="width:180px !important" id="lainnya" name="lainnya" type="number" value="0">
                    </th>
                    </tr>

                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Gaji Bersih
                        <input type="hidden" name="gajibersih">
                        </th>
                       
                        <th class="text-right py-1 px-2 grandtotal">0
                        
                        </th>
                    </tr>
                    
                </tfoot>
            </table>
                
                <hr>
                
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="penggajian-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=penggajian/penggajian' ?>">Cancel</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>        
    <td class="py-1 px-2 text-left gajipokok"></td>
    <td class="py-1 px-2 text-left t_kesehatan"></td>
    <td class="py-1 px-2 text-left t_makan"></td>
    <td class="py-1 px-2 text-left t_makeup"></td>
    <td class="py-1 px-2 text-left t_transport" ></td>
    <td class="py-1 px-2 text-left t_kasir"></td>
    <td class="py-1 px-2 text-left t_kerajinan"></td>
    <td class="py-1 px-2 text-right total"></td>           
    </tr>
</table>

<script>
    var total = 0;
    $('#cashbon').change(function(){
        calc();
        })

    $('#lainnya').change(function(){
        calc();
        })

    $('#pointangka').change(function(){
        calc();
        })  

	$('#nama_karyawan').change(function(){   
        bulan = $('#bulan').val();    
		karyawan = $('#nama_karyawan').val();
        
        karyawanarray = karyawan.split("-");
		// $('#text_id_karyawan').text(tes);
        $("#text_id_karyawan").val(karyawanarray[0]);
        $("#text_id_absensi").val(karyawanarray[11]);
        $("#text_id_tunjangan").val(karyawanarray[12]);
        
               
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
        
         
       
         if (bulan == ''){
             tes="";
            alert_toast(' Pilih bulan terlebih dahulu.','warning');
            $("#nama_karyawan").val(tes);
            return false;
            
        }

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
				url:_base_url_+"classes/Master.php?f=save_gaji",
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
						location.replace(_base_url_+"admin/?page=penggajian/penggajian");
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

        // if('<?php echo isset($id_tunjangan) && $id_tunjangan > 0 ?>' == 1){
            
        //     $('#nama_karyawan').trigger('change')
        //     $('#nama_karyawan').attr('readonly','readonly')
            
        // }
    // })

    $('#add_to_list').click(function(){
        
        karyawan = $('#nama_karyawan').val();
        
        karyawanarray = karyawan.split("-");
		
        $("#text_id_karyawan").val(karyawanarray[0]);
               
        
        var gaji = karyawanarray[3];
        var tkesehatan = karyawanarray[4];
        var tmakan = karyawanarray[5];
        var tmakeup = karyawanarray[6];
        var ttransport = karyawanarray[7];
        var tkasir = karyawanarray[8];
        var tkerajinan = karyawanarray[9];
        var lemburhari = karyawanarray[10];
        total = parseInt(gaji)+parseInt(tkesehatan)+parseInt(tmakan)+parseInt(tmakeup)+parseInt(ttransport)+parseInt(tkasir)+parseInt(tkerajinan);

        $("#lemburhari").val(karyawanarray[10]);



        // var	number_string = gaji.toString(),
	    // sisa 	= number_string.length % 3,
	    // rupiah 	= number_string.substr(0, sisa),
	    // ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
        // if (ribuan) {
	    // separator = sisa ? '.' : '';
	    // rupiah += separator + ribuan.join('.');
        // }
                      
                        
            // var idjasa = hargajasa[0];
            // var namajasa = hargajasa[2];
            // var harga = hargajasa[1];
           
            // var jumlah = $('#jumlah').val()
            
            
            // var total = parseFloat(harga)*parseFloat(jumlah)
            
            var tr = $('#clone_list tr').clone()
            // if(jumlah == '' ){
            //     alert_toast('Jumlah tidak boleh kosong.','warning');
            //     return false;
            // }
           
            // tr.find('[name="idjasa[]"]').val(idjasa)
            // tr.find('[name="namajasa[]"]').val(namajasa)
            // tr.find('[name="gajipokok[]"]').val(gaji)
            // tr.find('[name="jumlah[]"]').val(jumlah)
            // tr.find('[name="total[]"]').val(total)
          
            // tr.find('.gajipokok .visible').text(namajasa)
           
            // tr.find('.jumlah').text(jumlah)
        //    if($('table#list tbody').find('tr[data-id="'+karyawan+'"]').length > 0){
        //         alert_toast('Item is already exists on the list.','error');
        //         return false;
        //     }
            tr.find('.gajipokok').text(parseFloat(gaji).toLocaleString('en-US'))
            tr.find('.t_kesehatan').text(parseFloat(tkesehatan).toLocaleString('en-US'))
            tr.find('.t_makan').text(parseFloat(tmakan).toLocaleString('en-US'))
            tr.find('.t_makeup').text(parseFloat(tmakeup).toLocaleString('en-US'))
            tr.find('.t_transport').text(parseFloat(ttransport).toLocaleString('en-US'))
            tr.find('.t_kasir').text(parseFloat(tkasir).toLocaleString('en-US'))
            tr.find('.t_kerajinan').text(parseFloat(tkerajinan).toLocaleString('en-US'))
            tr.find('.lemburhari').text(parseFloat(lemburhari).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))
            $('table#list tbody').append(tr)
            calc()
        //     $('#idjasa').val('')
        //     $('#hargajasa').val('')
        //     $('#jumlah').val('')

        //     $('#idjasa').select2({
        //     placeholder:"Silakan pilih jasa",
            
        // })
    })
    // function rem(_this){
    //     _this.closest('tr').remove()
    //     calc()
    //     if($('table#list tbody tr').length <= 0)
    //         $('#supplier_id').removeAttr('readonly')

    // }
    function calc(){
        
        var sub_total = 0;
        var grand_total = 0;
        // var discount = 0;
        // var tax = 0;
        var pcashbon = (parseFloat($('[name="cashbon"]').val()));
        var plainnya = (parseFloat($('[name="lainnya"]').val()));
        var lembur = 0;
        var point = 0;
        var tariflembur = 5000;
        var tarifpoint = 500;
        

        var lembur  =   tariflembur * (parseFloat($('[name="lemburhari"]').val()))
        var point  =   tarifpoint * (parseFloat($('[name="pointangka"]').val()))
        // $('table#list tbody input[name="total[]"]').each(function(){
        //     sub_total += parseFloat($(this).val())
            
        // })
        
        // var discount =   sub_total * (parseFloat($('[name="discount_perc"]').val()) /100)
        sub_total = sub_total + lembur + point + total;
        
        // var tax =   sub_total * (parseFloat($('[name="tax_perc"]').val()) /100)
        grand_total = sub_total - pcashbon - plainnya;
        // $('.discount').text(parseFloat(discount).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="sub-total"]').val(parseFloat(sub_total))
        $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('table#list tfoot .lembur').text(parseFloat(lembur).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="lembur"]').val(parseFloat(lembur))
        $('table#list tfoot .point').text(parseFloat(point).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="bonus"]').val(parseFloat(point))
        // $('.tax').text(parseFloat(tax).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        // $('[name="tax"]').val(parseFloat(tax))
        $('table#list tfoot .grandtotal').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="gajibersih"]').val(parseFloat(grand_total))

    }
</script>