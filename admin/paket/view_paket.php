<?php 
$qry = $conn->query("SELECT paket.idpaket,namapaket,jasa.idjasa,namajasa,hargajasa,jumlah,subtotal,hargapaket,diskon,disk_perc,pajak,pajak_perc,keteranganpaket FROM paket JOIN paket_item ON paket.idpaket=paket_item.idpaket JOIN jasa ON paket_item.idjasa = jasa.idjasa WHERE paket.idpaket = '{$_GET['id']}'");
if($qry->num_rows >0){
    foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
    }
}
?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title">Detail Paket - <?php echo $namapaket ?></h4>
    </div>
    <div class="card-body" id="print_out">
        <div class="container-fluid">
            <div class="row">                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supplier_id" class="control-label text-info">Nama Paket</label>
                        <div><?php echo isset($namapaket) ? $namapaket : '' ?></div>
                    </div>
                </div>
            </div>
</br>
            <h4 class="text-info">List Jasa</h4>
            <table class="table table-striped table-bordered" id="list">
                <colgroup>                                          
                    <col width="35%">
                    <col width="15%">
                     
                    <col width="5%">
                </colgroup>
                <thead>
                    <tr class="text-light bg-navy">
                    
                            <th class="text-center py-1 px-2">Jasa</th>
                            <th class="text-center py-1 px-2">Harga</th>
                            <th class="text-center py-1 px-2" colspan="2">Jumlah</th>                     
                            <th class="text-center py-1 px-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                        
                    if(isset($idpaket)):
                    $qry = $conn->query("SELECT paket.idpaket,namapaket,jasa.idjasa,namajasa,hargajasa,jumlah,subtotal,hargapaket,diskon,disk_perc,pajak,pajak_perc,keteranganpaket FROM paket JOIN paket_item ON paket.idpaket=paket_item.idpaket JOIN jasa ON paket_item.idjasa = jasa.idjasa WHERE paket.idpaket = '{$idpaket}'");
                    while($row = $qry->fetch_assoc()):
                        $total += $row['hargapaket']
                    ?>
                    <tr>
                       
                        
                        <td class="py-1 px-2 text-left namajasa">
                        <span class="visible"><?php echo $row['namajasa']; ?></span>
                            <input type="hidden" name="idjasa[]" value="<?php echo $row['idjasa']; ?>">
                            <input type="hidden" name="hargajasa[]" value="<?php echo $row['hargajasa']; ?>">
                            <input type="hidden" name="jumlah[]" value="<?php echo $row['jumlah']; ?>">
                            <input type="hidden" name="total[]" value="<?php echo $row['subtotal']; ?>">
                        </td>

                        <td class="py-1 px-2 text-center hargajasa">
                        <?php echo number_format($row['hargajasa']); ?>
                        </td>

                        <td class="py-1 px-2 text-center jumlah" colspan="2">
                        <?php echo $row['jumlah']; ?>           
                        </td>
    
                        <td class="py-1 px-2 text-right total" >
                        <?php echo number_format($row['subtotal']); ?>
                        </td>


                    </tr>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="4">Sub Total</th>
                        <th class="text-right py-1 px-2 sub-total"><?php echo number_format($total,0)  ?></th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="4">Discount <?php echo isset($disk_perc) ? $disk_perc : 0 ?>%</th>
                        <th class="text-right py-1 px-2 diskon"><?php echo isset($diskon) ? number_format($diskon,0) : 0 ?></th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="4">Pajak <?php echo isset($pajak_perc) ? $pajak_perc : 0 ?>%</th>
                        <th class="text-right py-1 px-2 pajak"><?php echo isset($pajak) ? number_format($pajak,0) : 0 ?></th>
                    </tr>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="4">Total</th>
                        <th class="text-right py-1 px-2 grand-total"><?php echo isset($hargapaket) ? number_format($hargapaket,0) : 0 ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remarks" class="text-info control-label">Keterangan</label>
                        <p><?php echo isset($keteranganpaket) ? $keteranganpaket : '' ?></p>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-success" type="button" id="print">Print</button>
        <a class="btn btn-flat btn-primary" href="<?php echo base_url.'/admin?page=paket/manage_paket&id='.(isset($idpaket) ? $idpaket : '') ?>">Edit</a>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=paket/paket' ?>">Kembali</a>
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
        
        <td class="py-1 px-2 text-right total" >
        </td>
    </tr>
</table>
<script>
    
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Detail Paket - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Detail Paket</h4>'+
                      '</div>'+
                      '<div class="col-1 text-right">'+
                      '</div>'+
                      '</div><hr/>')
            _el.append(p.html())
            var nw = window.open("","","width=1200,height=900,left=250,location=no,titlebar=yes")
                     nw.document.write(_el.html())
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                            nw.close()
                            end_loader()
                         }, 200);
                     }, 500);
        })
    })
</script>