<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Daftar Absensi Karyawan</h3>
		<div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=absensi/manage_absensi" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Tambah Data Absensi</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hovered table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="13%">
					<col width="13%">
					<col width="13%">
					<col width="13%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>						
						<th>Nama</th>						
						<th>Bulan</th>
                        <th>Hadir</th>                        
                        <th>Absen</th>
						<th>Lembur</th>
						<th>Izin</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT absensi.id,id_karyawan,nama,bulan,hadir,absen,lembur,izin FROM karyawan JOIN absensi ON karyawan.id=absensi.id_karyawan order by id_karyawan asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<!-- <td class="text-center"><?php echo $i++; ?></td> -->
                            <td><?php echo $row['id_karyawan'] ?></td>	
                            <td><?php echo $row['nama'] ?></td>                            
                            <td><?php echo $row['bulan'] ?></td>
							<td><?php echo $row['hadir'] ?> Hari</td>
							<td><?php echo $row['absen'] ?> Hari</td>
							<td><?php echo $row['lembur'] ?> Hari</td>
							<td><?php echo $row['izin'] ?> Hari</td>	
                                                     	
																				
							

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">				                   
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
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
			_conf("Yakin ingin menghapus data absensi karyawan ini?","delete_category",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Tambah Data Absensi Karyawan","absensi/manage_absensi.php","mid-large")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Data Absensi Karyawan","absensi/manage_absensi.php?id="+$(this).attr('data-id'),"mid-large")
		})
		// $('.view_data').click(function(){
		// 	uni_modal("<i class='fa fa-box'></i> Detail Data Karyawan","karyawan/view_karyawan.php?id="+$(this).attr('data-id'),"")
		// })
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_absensi",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>