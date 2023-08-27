<?php

if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
else{

?>

<div class="row"><!-- row begin -->	
	<div class="col-lg-12"><!-- col-lg-12 begin -->	
		<ol class="breadcrumb">
			<li><i class="fa fa-tasks"></i> Orders</li>
			<li>View Order</li>
		</ol>
	</div><!-- col-lg-12 finish -->
</div><!-- row finish -->
<div class="row"><!-- row begin -->
	<div class="col-lg-12"><!-- col-lg-12 begin -->		
		<div class="panel panel-default"><!-- panel panel-default begin -->			
			<div class="panel-heading"><!-- panel-heading begin -->				
				<h3 class="panel-title">View Order</h3>
			</div><!-- panel-heading finish -->
			<div class="panel-body"><!-- panel-body begin -->				
				<div class="table-responsive"><!-- table-responsive begin -->					
					<table class="table table-hover table-striped table-bordered">						
						<thead>
							<tr>
								<th> ID </th>
								<th> Product Name </th>
								<th> User Name </th>
								<th> Amount </th>
								<th> Order Date </th>
								<th> Operation </th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_orders = "select * from orders";
								$run_orders = mysqli_query($con,$get_orders);
								if($run_orders!=false || $run_orders!=true )
									while ($row_orders = mysqli_fetch_array($run_orders)) {
										$p_id = $row_orders['product_id'];
										
										$product_query = "SELECT name, price FROM product WHERE id = '$p_id'";
										$product_result = mysqli_query($con, $product_query);
										if (mysqli_num_rows($product_result) > 0) {
											$product = mysqli_fetch_assoc($product_result);
											$product_name = $product['name'];
										}
										$u_id = $row_orders['user_id'];
										$user_query = "SELECT nickname FROM users WHERE id = '$u_id'";
										$user_result = mysqli_query($con, $user_query);
										if (mysqli_num_rows($user_result) > 0) {
											$user = mysqli_fetch_assoc($user_result);
											$user_name = $user['nickname'];
										}
										$order_id = $row_orders['id'];
										$order_amount = $row_orders['total_price'];
										$order_date = $row_orders['order_date'];
								
								
							?>
							<tr>
								<td><?php echo $order_id; ?></td>
								<td width="300"><?php echo $product_name; ?></td>
								<td width="300"><?php echo $user_name; ?></td>
								<td width="300"><?php echo $order_amount; ?></td>
								<td width="300"><?php echo $order_date; ?></td>


								<td>
								    <a href="index.php?orders=delete&id=<?php echo $order_id; ?>">
									<i class="fa fa-trash-o"></i> Delete
								    </a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- panel-body finish -->
			</div><!-- panel-body finish -->
		</div><!-- panel panel-default finish -->
	</div><!-- col-lg-12 finish -->
</div><!-- row finish -->

<?php } ?>