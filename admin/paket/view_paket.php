<?php require_once('./../../config.php') ?>
<?php 
 $qry = $conn->query("SELECT * from jasa where idjasa = '{$_GET['id']}' ");
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
                        
                    
                        <dt class="text-info">Nama Jasa</dt>
                        <dd class="pl-3"><?php echo $namajasa ?></dd>

                        <dt class="text-info">Harga</dt>
                        <dd class="pl-3"><?php echo isset($hargajasa) ? "Rp " . number_format($hargajasa,0) : '' ?></dd>

                        <dt class="text-info">Keterangan Jasa</dt>
                        <dd class="pl-3"><?php echo isset($keteranganjasa) ? $keteranganjasa : '' ?></dd>                                               
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