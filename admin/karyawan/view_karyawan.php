<?php require_once('./../../config.php') ?>
<?php 
 $qry = $conn->query("SELECT * from karyawan where id = '{$_GET['id']}' ");
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
                        <dt class="text-info">Nama:</dt>
                        <dd class="pl-3"><?php echo $nama ?></dd>

                        <dt class="text-info">Alamat:</dt>
                        <dd class="pl-3"><?php echo isset($alamat) ? $alamat : '' ?></dd>

                        <dt class="text-info">No. Handphone:</dt>
                        <dd class="pl-3"><?php echo isset($nohp) ? $nohp : '' ?></dd>

                        <dt class="text-info">Jabatan:</dt>
                        <dd class="pl-3">
                            <?php if($jabatan == 1): ?>
                                <span>Hairstylist</span>
                            <?php elseif($jabatan == 2): ?>
                                <span>Kasir</span>
                            <?php else: ?>
                                <span>Hairdresser</span>
                            <?php endif; ?>
                        </dd>
                        
                        <dt class="text-info">Gaji Pokok:</dt>
                        <dd class="pl-3"><?php echo isset($gajipokok) ? "Rp " . number_format($gajipokok,0) : '' ?></dd>

                        <dt class="text-info">Tanggal Masuk:</dt>
                        <dd class="pl-3"><?php echo isset($tanggalmasuk) ? date('d M Y', strtotime($tanggalmasuk)) : '' ?></dd>
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