<?php 
$qry = $conn->query("SELECT `id_penggajian`,tunjangan.id_karyawan,`nama`,`jabatan`,`gajipokok`,`t_kesehatan`,`t_makan`,`t_makeup`,`t_transport`,`t_kasir`,`t_kerajinan`,`lembur`,absensi.`id`,tunjangan.`id_tunjangan`,`uanglembur`,`point`,`bonus`,`p_cashbon`,`p_lain`,`total`,`bulan` FROM karyawan JOIN tunjangan ON karyawan.id = tunjangan.id_karyawan JOIN absensi ON karyawan.id = absensi.id_karyawan JOIN penggajian ON penggajian.`id_karyawan`= karyawan.`id` WHERE id_penggajian = '{$_GET['id']}' AND bulan = MONTH(CURDATE())");

if($qry->num_rows >0){
    foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
    }
}
?>
<div class="card card-outline card-primary">
    
    <div class="card-header">
        <label class="card-title">Rincian Gaji - <?php echo $nama ?></label>
    </div>
    
    <div class="card-body" id="print_out">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="bulan" class="control-label text-info">Bulan </label>
                        
                        <?php if($bulan == 1): ?>
                                    <span>Januari</span>
                                <?php elseif($bulan == 2): ?>
                                    <span>Februari</span>
								<?php elseif($bulan == 3): ?>
                                    <span>Maret</span>
								<?php elseif($bulan == 4): ?>
                                    <span>April</span>
								<?php elseif($bulan == 5): ?>
                                    <span>Mei</span>
								<?php elseif($bulan == 6): ?>
                                    <span>Juni</span>
								<?php elseif($bulan == 7): ?>
                                    <span>Juli</span>
								<?php elseif($bulan == 8): ?>
                                    <span>Agustus</span>
								<?php elseif($bulan == 9): ?>
                                    <span>September</span>
								<?php elseif($bulan == 10): ?>
                                    <span>Oktober</span>
								<?php elseif($bulan == 11): ?>
                                    <span>November</span>
                                <?php else :?>
                                    <span>Desember</span>
                                <?php endif; ?>
                        </div>                        
                    </div>
                 
            <div class="col-md-5">
                        
                    </div>               
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jabatan" class="control-label text-info">Jabatan </label>
                        <?php if($jabatan == 1): ?>
                                <span>Hairstylist</span>
                            <?php elseif($jabatan == 2): ?>
                                <span>Kasir</span>
                            <?php else: ?>
                                <span>Hairdresser</span>
                            <?php endif; ?></div>                        
                    </div>
                </div>
            </div>
            
</br>
            <!-- <h4 class="text-info">Rincian Gaji</h4> -->
            <table class="table table-striped table-bordered" id="list">
                <colgroup>                                          
                    <col width="15%">
                    <col width="12%">
                    <col width="10%">
                    <col width="10%">
                    <col width="12%">
                    <col width="10%">
                    <col width="12%">
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
                    $totalkotor = 0;
                        
                    if(isset($id_karyawan)):
                    $qry = $conn->query("SELECT `id_penggajian`,tunjangan.id_karyawan,`nama`,`jabatan`,`gajipokok`,`t_kesehatan`,`t_makan`,`t_makeup`,`t_transport`,`t_kasir`,`t_kerajinan`,`lembur`,absensi.`id`,tunjangan.`id_tunjangan`,`total`,`uanglembur`,`point`,`bonus`,`p_cashbon`,`p_lain`,`total`,`bulan` FROM karyawan JOIN tunjangan ON karyawan.id = tunjangan.id_karyawan JOIN absensi ON karyawan.id = absensi.id_karyawan JOIN penggajian ON penggajian.`id_karyawan`= karyawan.`id` WHERE id_penggajian = '{$_GET['id']}' AND bulan = MONTH(CURDATE())");
                    while($row = $qry->fetch_assoc()):
                         $totalkotor = $row['gajipokok'] + $row['t_kesehatan'] + $row['t_makan'] + $row['t_makeup'] + $row['t_transport'] + $row['t_kasir'] + $row['t_kerajinan']
                    ?>
                    <tr>        
                    <td class="py-1 px-2 text-left gajipokok">
                    <?php echo number_format($row['gajipokok']); ?>
                    </td>
                    
                    <td class="py-1 px-2 text-left t_kesehatan">
                    <?php echo number_format($row['t_kesehatan']); ?>
                    </td>

                    <td class="py-1 px-2 text-left t_makan">
                    <?php echo number_format($row['t_makan']); ?>
                    </td>

                    <td class="py-1 px-2 text-left t_makeup">
                    <?php echo number_format($row['t_makeup']); ?>
                    </td>

                    <td class="py-1 px-2 text-left t_transport">
                    <?php echo number_format($row['t_transport']); ?>
                    </td>

                    <td class="py-1 px-2 text-left t_kasir">
                    <?php echo number_format($row['t_kasir']); ?>
                    </td>

                    <td class="py-1 px-2 text-left t_kerajinan">
                    <?php echo number_format($row['t_kerajinan']); ?>
                    </td>

                    <td class="py-1 px-2 text-right total">
                    <?php echo number_format($totalkotor); ?>
                    </td>           
                    </tr>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    
                </tbody>
                <tfoot>
               
                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Lembur <?php echo isset($lembur) ? $lembur : 0 ?> Hari</th>
                        <th class="text-right py-1 px-2 lembur"><?php echo isset($uanglembur) ? number_format($uanglembur,0) : 0 ?></th>
                    </tr>

                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Point <?php echo isset($point) ? $point : 0 ?></th>
                        <th class="text-right py-1 px-2 bonus"><?php echo isset($bonus) ? number_format($bonus,0) : 0 ?></th>
                    </tr>
                    
                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Potongan Cashbon</th>
                        <th class="text-right py-1 px-2 p_cashbon"><?php echo isset($p_cashbon) ? number_format($p_cashbon,0) : 0 ?></th>
                    </tr>

                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Potongan Lainnya</th>
                        <th class="text-right py-1 px-2 p_lain"><?php echo isset($p_lain) ? number_format($p_lain,0) : 0 ?></th>
                    </tr>

                    <tr>
                        <th class="text-right py-1 px-2" colspan="7">Gaji Bersih</th>
                        <th class="text-right py-1 px-2 total"><?php echo isset($total) ? number_format($total,0) : 0 ?></th>
                    </tr>

                </tfoot>
            </table>
            
        </div>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-success" type="button" id="print">Print</button>
        <!-- <a class="btn btn-flat btn-primary" href="<?php echo base_url.'/admin?page=penggajian/manage_penggajian&id='.(isset($id_penggajian) ? $id_penggajian : '') ?>">Edit</a> -->
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=penggajian/penggajian' ?>">Kembali</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>
        <!-- <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td> -->               
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
    
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Slip Gaji - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Slip Gaji</h4>'+
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

    