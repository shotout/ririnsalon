<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Daftar Transaksi</h3>
		<div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=transaksi/manage_transaksi" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Transaksi</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hovered table-striped">
				<colgroup>
					<!-- <col width="5%"> -->
					<col width="25%">
					<col width="15%">
					<col width="15%">
					<col width="5%">
					
				</colgroup>
				<thead>
					<tr>
						<!-- <th>ID</th>						 -->
						<th>No Faktur</th>						
						<th>Tanggal</th>
                        <th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from transaksi order by nofaktur asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<!-- <td class="text-center"><?php echo $i++; ?></td> -->
                            <td><?php echo $row['nofaktur'] ?></td>	
                            <td><?php echo date("d M Y",strtotime($row['tanggal'])) ?></td>                           
                            <td><?php echo $row['total'] ? "Rp " . number_format($row['total'],0) : '' ?></td>	
                            
													
							

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="<?php echo base_url.'admin?page=transaksi/view_transaksi&id='.$row['id_transaksi'] ?>" data-id="<?php echo $row['id_transaksi'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    
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
			_conf("Yakin ingin menghapus paket ini?","delete_category",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Tambah Jasa","paket/manage_paket.php","mid-large")
		})
		
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-box'></i> Detail Jasa","paket/view_paket.php?id="+$(this).attr('data-id'),"")
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_paket",
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