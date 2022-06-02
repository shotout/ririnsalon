<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT paket.idpaket,namapaket,jasa.idjasa,namajasa,jumlah,subtotal,hargapaket,keteranganpaket FROM paket JOIN paket_item ON paket.idpaket=paket_item.idpaket JOIN jasa ON paket_item.idjasa = jasa.idjasa WHERE paket.idpaket ='{$_GET['id']}'");
    if($qry->num_rows >0){
        foreach($qry->fetch_array() as $k => $v){
            $$k = $v;
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
        <h4 class="card-title"><?php echo isset($namapaket) ? "Edit data paket - ".$namapaket : 'Tambah data paket' ?></h4>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name="idpaket" value="<?php echo isset($idpaket) ? $idpaket : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                    <legend class="text-info">Nama Paket</legend>
                        <input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($namapaket) ? $namapaket : '' ?>" >
                    </div>
                    
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">List Jasa</legend>
                    <div class="row justify-content-center align-items-end">                          
							
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="item_id" class="control-label">Jasa</label>
								<select name="idjasa" id="idjasa" class="custom-select select2">
                            <option <?php echo !isset($idjasa) ? 'selected' : '' ?> disabled></option>
                            <?php 
                            							
                            $jasa = $conn->query("SELECT * FROM `jasa` order by `namajasa` asc");
                            while($row=$jasa->fetch_assoc()):  
                                
                                // $harga_arr = $row['hargajasa'];                             
                            ?>
                            <option value="<?php echo $row['idjasa'].'-'.$row['hargajasa'].'-'.$row['namajasa'] ?>" <?php echo isset($idjasa) && $idjasa == $row['idjasa'] ? "selected" : "" ?> ><?php echo $row['namajasa'] ?></option>
							
                            
                            

                            <?php endwhile; ?>
							
                            </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="unit" class="control-label">Harga</label>
                                <input type="text" class="form-control rounded-0" id="hargajasa" name="hargajasa">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty" class="control-label">Jumlah</label>
                                <input type="number" step="any" class="form-control rounded-0" id="jumlah">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list"> Tambah ke list </button>
                            </div>
                        </div>
                </fieldset>
                <hr>
                <table class="table table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <!-- <col width="10%"> -->
                        <col width="35%">
                        <col width="25%">
                        <col width="5%">
                        
                        
                    </colgroup>
                    <thead>
                        <tr class="text-light bg-navy">
                            <th class="text-center py-1 px-2"></th>
                            <th class="text-center py-1 px-2">Jasa</th>
                            <th class="text-center py-1 px-2">Harga</th>
                            <th class="text-center py-1 px-2" colspan="2">Jumlah</th>
                            
                            
                            <th class="text-center py-1 px-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        if(isset($id)):
                        $qry = $conn->query("SELECT p.*,i.name,i.description FROM `po_items` p inner join item_list i on p.item_id = i.id where p.po_id = '{$id}'");
                        while($row = $qry->fetch_assoc()):
                            $total += $row['total']
                        ?>
                        <tr>
                            <td class="py-1 px-2 text-center">
                                <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <!-- <td class="py-1 px-2 text-center qty">
                                <span class="visible"><?php echo number_format($row['quantity']); ?></span>
                                <input type="hidden" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                <input type="hidden" name="unit[]" value="<?php echo $row['unit']; ?>">
                                <input type="hidden" name="qty[]" value="<?php echo $row['quantity']; ?>">
                                <input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="total[]" value="<?php echo $row['total']; ?>">
                            </td>
                            <td class="py-1 px-2 text-center unit">
                            <?php echo $row['unit']; ?>
                            </td>
                            <td class="py-1 px-2 item">
                            <?php echo $row['name']; ?> <br>
                            <?php echo $row['description']; ?>
                            </td>
                            <td class="py-1 px-2 text-right cost">
                            <?php echo number_format($row['price']); ?>
                            </td>
                            <td class="py-1 px-2 text-right total">
                            <?php echo number_format($row['total']); ?>
                            </td> -->
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Sub Total</th>
                            <th class="text-right py-1 px-2 sub-total">0</th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Discount <input style="width:40px !important" name="discount_perc" class='' type="number" min="0" max="100" value="<?php echo isset($discount_perc) ? $discount_perc : 0 ?>">%
                                <input type="hidden" name="discount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 discount"><?php echo isset($discount) ? number_format($discount) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Tax <input style="width:40px !important" name="tax_perc" class='' type="number" min="0" max="100" value="<?php echo isset($tax_perc) ? $tax_perc : 0 ?>">%
                                <input type="hidden" name="tax" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 tax"><?php echo isset($tax) ? number_format($tax) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Total
                                <input type="hidden" name="amount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 grand-total">0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keteranganpaket" class="text-info control-label">Keterangan</label>
                            <textarea name="keteranganpaket" id="keteranganpaket" rows="3" class="form-control rounded-0"><?php echo isset($keteranganpaket) ? $keteranganpaket : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="po-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=purchase_order' ?>">Cancel</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center namajasa">
        <span class="visible"></span>
            <input type="hidden" name="idjasa[]">
            <input type="hidden" name="hargajasa[]">
            <input type="hidden" name="jumlah[]">            
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center hargajasa">
        </td>
        <td class="py-1 px-2 text-center jumlah" colspan="2">
            
        </td>
        <!-- <td class="py-1 px-2 text-right total">asdas1
        </td> -->
        <td class="py-1 px-2 text-right total" >
        </td>
    </tr>
</table>
<script>
   
   

    $('#idjasa').change(function(){
        jasa = $('#idjasa').val();
        hargajasa = jasa.split("-");

        $("#hargajasa").val(hargajasa[1]);
        })

    $(function(){
        
        $('#idjasa').select2({
            placeholder:"Silakan pilih jasa",
            width:'resolve',
        })     

			        
	})

        $('#add_to_list').click(function(){
            jasa = $('#idjasa').val();
            hargajasa = jasa.split("-");          
                        
            var idjasa = hargajasa[0];
            var namajasa = hargajasa[2];
            var harga = hargajasa[1];
           
            var jumlah = $('#jumlah').val()
            // var price = costs[item] || 0
            var total = parseFloat(harga)*parseFloat(jumlah)
            // console.log(supplier,item)
            // var item_name = items[supplier][item].name || 'N/A';
            // var item_description = items[supplier][item].description || 'N/A';
            var tr = $('#clone_list tr').clone()
            if(jumlah == '' ){
                alert_toast('Form Item textfields are required.','warning');
                return false;
            }
            // if($('table#list tbody').find('tr[data-id="'+item+'"]').length > 0){
            //     alert_toast('Item is already exists on the list.','error');
            //     return false;
            // }
            tr.find('[name="idjasa[]"]').val(idjasa)
            tr.find('[name="namajasa[]"]').val(namajasa)
            tr.find('[name="hargajasa[]"]').val(harga)
            tr.find('[name="jumlah[]"]').val(jumlah)
            tr.find('[name="total[]"]').val(total)
            // tr.find('[name="price[]"]').val(price)
            // tr.find('[name="total[]"]').val(total)
            // tr.attr('data-id',item)
            tr.find('.namajasa .visible').text(namajasa)
            // tr.find('.hargajasa .visible').text(harga)
            tr.find('.jumlah').text(jumlah)
            // tr.find('.item').html(item_name+'<br/>'+item_description)
            tr.find('.hargajasa').text(parseFloat(harga).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))
            $('table#list tbody').append(tr)
            calc()
            $('#idjasa').val('')
            $('#hargajasa').val('')
            $('#jumlah').val('')

            $('#idjasa').select2({
            placeholder:"Silakan pilih jasa",
            
        })     
            tr.find('.rem_row').click(function(){
                rem($(this))
            })
            
            $('[name="discount_perc"],[name="tax_perc"]').on('input',function(){
                calc()
            })
            // $('#supplier_id').attr('readonly','readonly')
        })
        $('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
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
						location.replace(_base_url_+"admin/?page=purchase_order/view_po&id="+resp.id);
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
    
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#idjasa').removeAttr('readonly')

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