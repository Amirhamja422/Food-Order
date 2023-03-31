
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php echo session_id(); ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php 
             $getPd = $pt->getFeatureProduct();
			 if($getPd){
				while($result= $getPd->fetch_assoc()) {?>
			
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?id=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>

					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $result['body'];?></p>
					 <p><span class="price">$</span><?php echo $result['price'];?></p>
				     <div class="button"><span><a href="details.php?id=<?php $result['productId'];?>" class="details">Details</a></span></div>
				</div>
             <?php }} ?> 
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
                 $getNpd = $pt->getNewProduct();
			     if($getNpd){					
			     while($result= $getNpd->fetch_assoc()) {?>
				 <div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?id=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>

					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $result['body'];?></p>
					 <p><span class="price">$</span><?php echo $result['price'];?></p>
				     <div class="button"><span><a href="details.php?id=<?php echo $result['productId']; ?>">Details</a></span></div>
				</div>
              <?php }} ?>
			</div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
