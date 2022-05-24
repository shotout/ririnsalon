<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Daftar Kas</h3>
		
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hovered table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="30%">
					<col width="30%">
					<col width="15%">
					
				</colgroup>
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>						
						<th>Pemasukan</th>						
						<th>Pengeluaran</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT tanggalpemasukan,amount,amount_pengeluaran FROM pemasukan RIGHT JOIN (SELECT tanggal_pengeluaran,amount_pengeluaran
						FROM pengeluaran) AS tanggal ON tanggalpemasukan = tanggal_pengeluaran ");
						while($row = $qry->fetch_assoc()):
						
					?>			
								
					
						<tr>						
									
							<td class="text-left"><?php echo $i++; ?></td>
                            
							<td><?php echo date("d M Y",strtotime($row['tanggalpemasukan'])) ?></td>	
                            <td><?php echo $row['amount'] ? "Rp " . number_format($row['amount'],0) : '' ?></td>
							<td><?php echo $row['amount_pengeluaran'] ? "Rp " . number_format($row['amount_pengeluaran'],0) : '' ?></td>                             
                                         	
																		
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
								  
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="<?php echo base_url.'admin?page=kas/view_kas&id='.$row['tanggalpemasukan'] ?>" data-id="<?php echo $row['tanggalpemasukan'] ?>"><span class="fa fa-eye text-dark"></span> Detail</a>
												                    
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
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-box'></i> Detail kas","kas/view_kas.php?id="+$(this).attr('data-id'),"")
		})
		
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	
</script>