<?php if  
$qry = $conn->query("SELECT * FROM kas  where tanggal = '{$_GET['id']}'");
if($qry->num_rows >0){
    foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
    }
}
?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title text-info">Detail Kas</h4>
    </div>
    <div class="card-body" id="print_out">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="control-label text-info">Detail Kas untuk tanggal <?php echo date("d M Y",strtotime($tanggal)) ?></h4>
                </div>
                
            </div>
</br>
            <!-- <h4 class="text-info">Items</h4> -->
            <table class="table table-striped table-bordered" id="list">
                <colgroup>
                    <col width="10%">
                    <col width="10%">
                    <col width="30%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr class="text-light bg-navy">
                        <th class="text-center py-1 px-2">No</th>
                        <th class="text-center py-1 px-2">No Referensi</th>
                        <th class="text-center py-1 px-2">Keterangan</th>
                        <th class="text-center py-1 px-2">Amount Masuk</th>
                        <th class="text-center py-1 px-2">Amount Keluar</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $total = 0;
                    $qry = $conn->query("SELECT noreferensi,tanggalpemasukan,amount,amount_pengeluaran,keteranganmasuk FROM pemasukan RIGHT JOIN (SELECT tanggal_pengeluaran,amount_pengeluaran
                    FROM pengeluaran) AS tanggal ON tanggalpemasukan = tanggal_pengeluaran  where tanggalpemasukan = '{$_GET['id']}'");
                    while($row = $qry->fetch_assoc()):
                        // $total += $row['total']
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="py-1 px-2 text-center"><?php echo $row['noreferensi'] ?></td>
                        <td class="py-1 px-2 text-left"><?php echo $row['keteranganmasuk'] ?></td>
                        
                        <td class="py-1 px-2 text-center"><?php echo number_format ($row['amount']) ?></td>
                        <td class="py-1 px-2 text-center"><?php echo number_format ($row['amount_pengeluaran']) ?></td>
                        
                    </tr>

                    <?php endwhile; ?>
                    
                </tbody>
                <tfoot>
                    
                    <tr>                        
                        <th class="text-right py-1 px-2" colspan="3">Total</th>
                        <th class="text-right py-1 px-2 grand-total"><?php echo isset($amount) ? number_format($amount,2) : 0 ?></th>
                        <th class="text-right py-1 px-2 grand-total"><?php echo isset($amount_pengeluaran) ? number_format($amount_pengeluaran,2) : 0 ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label for="remarks" class="text-info control-label">Remarks</label>
                        <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-success" type="button" id="print">Print</button>
        
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=kas/kas' ?>">Kembali</a>
    </div>
</div>
<!-- <table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center qty">
            <span class="visible"></span>
            <input type="hidden" name="item_id[]">
            <input type="hidden" name="unit[]">
            <input type="hidden" name="qty[]">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center unit">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right cost">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table> -->
<script>
    
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Data Kas - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Data Kas</h4>'+
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