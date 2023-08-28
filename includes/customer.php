<?php

if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
else{

?>

<div class="row"><!-- row begin -->	
	<div class="col-lg-12"><!-- col-lg-12 begin -->	
		<ol class="breadcrumb">
			<li><i class="fa fa-tasks"></i> View Customers</li>
		</ol>
	</div><!-- col-lg-12 finish -->
</div><!-- row finish -->
<div class="row"><!-- row begin -->
	<div class="col-lg-12"><!-- col-lg-12 begin -->		
		<div class="panel panel-default"><!-- panel panel-default begin -->			
			<div class="panel-heading"><!-- panel-heading begin -->				
				<h3 class="panel-title">Customer Information</h3>
			</div><!-- panel-heading finish -->
			<div class="panel-body"><!-- panel-body begin -->				
				<div class="table-responsive"><!-- table-responsive begin -->					
					<table class="table table-hover table-striped table-bordered">						
						<thead>
							<tr>
								<th> ID </th>
								<th> Name </th>
								<th> Email </th>
								<th> Phone </th>
								<th> Gender </th>
							</tr>
						</thead>
						<tbody>
							<?php
								$get_p_cats = "select * from users order by id";
								$run_p_cats = mysqli_query($con,$get_p_cats);
								while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
									$p_cat_id = $row_p_cats['id'];
									$p_cat_name = $row_p_cats['nickname'];
									$p_cat_email = $row_p_cats['email'];
									$p_phone = $row_p_cats['phone'];
									$p_gender = $row_p_cats['gender'];

                                    
							?>
							<tr>
								<td><?php echo $p_cat_id; ?></td>
								<td><?php echo $p_cat_name; ?></td>
								<td width="300"><?php echo $p_cat_email; ?></td>
								<td width="300"><?php echo $p_phone; ?></td>
								<td width="300"><?php echo $p_gender; ?></td>

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