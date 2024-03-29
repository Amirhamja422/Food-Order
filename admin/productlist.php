﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../helpers/format.php';?>
<?php include '../classes/product.php';?>

<?php
$pd = new Product();
$fm = new Format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
				<?php 
                  $getPd = $pd->getAllProduct();
				  if($getPd){
					while($result = $getPd->fetch_assoc()){?>		
				<tr class="odd gradeX">
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td class="center"><?php echo $result['brandName'];?></td>
					<td class="center"><?php echo $fm->textShorten($result['body'],50);?></td>
					<td class="center">$<?php echo $result['price'];?></td>
					<td class="center"><img src="<?php echo $result['image'];?>"  style="height:40px; width:40px;"></td>
					<td class="center">
						
					   <?php 
					     if($result['type']=='0'){
							echo "Featured";
						 }else{
							echo "General";
						 }
					   
					   ?>
				    
				    </td>
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
				</tr>
				<?php }} ?>

			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
