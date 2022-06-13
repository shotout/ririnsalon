<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Transaksi</h3>
		<div class="card-tools">
		<a href="?page=penggajian/manage_penggajian" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tambah Transaksi</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hovered table-striped">
				<colgroup>
					<col width="20%">
					<col width="13%">
					<col width="13%">
					<col width="5%">
				</colgroup>
				<thead>
					<tr>
											
						<th>Pelanggan</th>						
						<th>Bulan</th>
                        <th>Gaji Bersih</th>						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT id_penggajian,penggajian.id_karyawan,penggajian.id_absensi,tunjangan.id_tunjangan,nama,bulan,POINT,bonus,p_cashbon,p_lain,total FROM penggajian 
						JOIN karyawan ON penggajian.id_karyawan = karyawan.id 
						JOIN absensi ON penggajian.id_absensi = absensi.id
						JOIN tunjangan ON penggajian.id_tunjangan = tunjangan.id_tunjangan order by id_penggajian asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<!-- <td class="text-center"><?php echo $i++; ?></td> -->
								
                            <td><?php echo $row['nama'] ?></td>                            
                            <td>
								<?php if($row['bulan'] == 1): ?>
                                    <span>Januari</span>
                                <?php elseif($row['bulan'] == 2): ?>
                                    <span>Februari</span>
								<?php elseif($row['bulan'] == 3): ?>
                                    <span>Maret</span>
								<?php elseif($row['bulan'] == 4): ?>
                                    <span>April</span>
								<?php elseif($row['bulan'] == 5): ?>
                                    <span>Mei</span>
								<?php elseif($row['bulan'] == 6): ?>
                                    <span>Juni</span>
								<?php elseif($row['bulan'] == 7): ?>
                                    <span>Juli</span>
								<?php elseif($row['bulan'] == 8): ?>
                                    <span>Agustus</span>
								<?php elseif($row['bulan'] == 9): ?>
                                    <span>September</span>
								<?php elseif($row['bulan'] == 10): ?>
                                    <span>Oktober</span>
								<?php elseif($row['bulan'] == 11): ?>
                                    <span>November</span>
                                <?php else :?>
                                    <span>Desember</span>
                                <?php endif; ?>
							</td>							
							<td><?php echo $row['total'] ? "Rp " . number_format($row['total'],0) : ''  ?></td>
							
                                                     	
																				
							

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">	
								  <a class="dropdown-item view_data" href="<?php echo base_url.'admin?page=penggajian/view_penggajian&id='.$row['id_penggajian'] ?>" data-id="<?php echo $row['id_penggajian'] ?>"><span class="fa fa-eye text-dark"></span> Detail</a>
				                  
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Yakin ingin menghapus data tunjangan karyawan ini?","delete_category",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Tambah data penggajian karyawan","penggajian/manage_penggajian.php","mid-large")
		})
		
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	
</script>