<?php require_once('./../../config.php') ?>
<?php 
 $qry = $conn->query("SELECT id_tunjangan,id_karyawan,nama,t_kesehatan,t_makan,t_makeup,t_transport,t_kasir,t_kerajinan FROM tunjangan JOIN karyawan ON karyawan.id = tunjangan.id_karyawan WHERE id_tunjangan = '{$_GET['id']}' ");
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
                        <dt class="text-info">Nama</dt>
                        <dd class="pl-3"><?php echo $nama ?></dd>
                        </br>
                        <dt class="text-info">Tunjangan Kesehatan</dt>
                        <dd class="pl-3"><?php echo isset($t_kesehatan) ? "Rp " . number_format($t_kesehatan,0) : '' ?></dd>

                        <dt class="text-info">Tunjangan Makan</dt>
                        <dd class="pl-3"><?php echo isset($t_makan) ? "Rp " . number_format($t_makan,0) : '' ?></dd>

                        <dt class="text-info">Tunjangan Make Up</dt>
                        <dd class="pl-3"><?php echo isset($t_makeup) ? "Rp " . number_format($t_makeup,0) : '' ?></dd>

                        <dt class="text-info">Tunjangan Transport</dt>
                        <dd class="pl-3"><?php echo isset($t_transport) ? "Rp " . number_format($t_transport,0) : '' ?></dd>
                        
                        <dt class="text-info">Tunjangan Kasir</dt>
                        <dd class="pl-3"><?php echo isset($t_kasir) ? "Rp " . number_format($t_kasir,0) : '' ?></dd>

                        <dt class="text-info">Tunjangan Kerajinan</dt>
                        <dd class="pl-3"><?php echo isset($t_kerajinan) ? "Rp " . number_format($t_kerajinan,0) : '' ?></dd>
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