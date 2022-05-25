<?php require_once('./../../config.php') ?>
<?php 
 $qry = $conn->query("SELECT * from pengeluaran where idpengeluaran = '{$_GET['id']}' ");
 if($qry->num_rows > 0){
     foreach($qry->fetch_assoc() as $k => $v){
         $$k=$v;
     }
 }
?>
   <style>
    #uni_modal .modal-footer{
        display:none;
    }
</style> 
<div class="container-fluid" id="print_out">
    <div id='transaction-printable-details' class='position-relative'>
        <div class="row">
            <fieldset class="w-100">
                <div class="col-12">
                    
                    <dl>
                        <dt class="text-info">No Referensi</dt>
                        <dd class="pl-3"><?php echo $noreferensi_pengeluaran ?></dd>

                        <dt class="text-info">Tanggal Pengeluaran</dt>
                        <dd class="pl-3"><?php echo isset($tanggal_pengeluaran) ? date('d M Y', strtotime($tanggal_pengeluaran)) : '' ?></dd>

                        <dt class="text-info">Amount</dt>
                        <dd class="pl-3"><?php echo isset($amount_pengeluaran) ? "Rp " . number_format($amount_pengeluaran,0) : '' ?></dd>

                        <dt class="text-info">Keterangan</dt>
                        <dd class="pl-3"><?php echo isset($keterangankeluar) ? $keterangankeluar : '' ?></dd>                                             
                        

                        
                    </dl>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-12">
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-dark btn-flat" type="button" id="cancel" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
    

<script>
    $(function(){
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
    })
</script>