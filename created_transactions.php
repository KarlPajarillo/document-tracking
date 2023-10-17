<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=send_document"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Reference Number</th>
						<th>Sender Name</th>
						<th>Recipient Name</th>
						<th>Document Type</th>
						<th>Last Update</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if(isset($_GET['s'])){
						$where = " where status = {$_GET['s']} ";
					}
					if($_SESSION['login_type'] != 1 ){
						if(empty($where))
							$where = " where ";
						else
							$where .= " and ";
						// $where .= " (from_branch_id = {$_SESSION['login_branch_id']} or to_branch_id = {$_SESSION['login_branch_id']}) ";
						$where .= " (created_by = {$_SESSION['login_id']}) ";
					}
					$qry = $conn->query("SELECT * from parcels $where order by  unix_timestamp(date_created) desc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td><b><?php echo ($row['reference_number']) ?></b></td>
						<td><b><?php echo ucwords($conn->query("SELECT concat(firstname, ' ', lastname) as name from users where id = ".$row['sender_name'])->fetch_array()['name']) ?></b></td>
						<td><b><?php echo ucwords($conn->query("SELECT concat(firstname, ' ', lastname) as name from users where id = ".$row['recipient_name'])->fetch_array()['name']) ?></b></td>
						<td><b><?php echo ucwords($conn->query("SELECT doc_name from documents where id = ".$row['doc_type'])->fetch_array()['doc_name']).': '.$row['remarks'] ?></b></td>
						<td><b><?php echo ucwords(date("M jS, Y", strtotime($row['date_updated']))) ?></b></td>
						<td class="text-center">
							<?php 
							switch ($row['status']) {
								case '0':
									echo "<span class='badge badge-pill badge-primary'> Sent</span>";
									break;
								case '1':
									echo "<span class='badge badge-pill badge-success'> Received</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-danger'> Denied</span>";
									break;
								// case '4':
								// 	echo "<span class='badge badge-pill badge-primary'> Arrived At Destination</span>";
								// 	break;
								// case '5':
								// 	echo "<span class='badge badge-pill badge-primary'> Out for Delivery</span>";
								// 	break;
								// case '6':
								// 	echo "<span class='badge badge-pill badge-primary'> Ready to Pickup</span>";
								// 	break;
								// case '7':
								// 	echo "<span class='badge badge-pill badge-success'>Delivered</span>";
								// 	break;
								// case '8':
								// 	echo "<span class='badge badge-pill badge-success'> Picked-up</span>";
								// 	break;
								// case '9':
								// 	echo "<span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span>";
								// 	break;
								
								// default:
								// 	echo "<span class='badge badge-pill badge-info'> Files To Confirm</span>";
									
								// 	break;
							}

							?>
						</td>
						<?php 
							echo '<td class="text-center">
                                <div class="btn-group">
                                    <a href="index.php?page=track&rnum='.$row['reference_number'].'" class="btn btn-dark btn-flat ">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <button type="button" class="btn btn-info btn-flat view_parcel" data-id="'.$row['id'].'">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="index.php?page=edit_transaction&id='.$row['id'].'" class="btn btn-primary btn-flat ">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="'.$row['id'].'">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>';
						?>
						
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_parcel').click(function(){
			uni_modal("Parcel's Details","view_parcel.php?id="+$(this).attr('data-id'),"large")
		})
		$('.forward_parcel').click(function(){
			uni_modal("Send this to","forward_parcel.php?id="+$(this).attr('data-id'),"large")
		})
		$('.delete_parcel').click(function(){
			_conf("Are you sure to delete this parcel?","delete_parcel",[$(this).attr('data-id')])
		})
		$('.confirm_parcel').click(function(){
			_conf("Are you sure to confirm this parcel?","confirm_parcel",[$(this).attr('data-id')])
		})
		$('.deny_parcel').click(function(){
			_conf("Are you sure to deny this parcel?","deny_parcel",[$(this).attr('data-id')])
		})
		$('.resend_parcel').click(function(){
			_conf("Are you sure to resend this parcel?","resend_parcel",[$(this).attr('data-id')])
		})
	})

	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Transaction successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})

		
	}
	function confirm_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:{id:$id,
				status:1
				},
			success:function(resp){
				if(resp==1){
					alert_toast("Document successfully received",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}

	function deny_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:{
				id:$id,
				status:2
				},
			success:function(resp){
				if(resp==1){
					alert_toast("Document successfully denied",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}

	function resend_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:{
				id:$id,
				status:0
				},
			success:function(resp){
				if(resp==1){
					alert_toast("Document successfully sent",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>