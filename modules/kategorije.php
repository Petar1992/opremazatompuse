<?php
		foreach ($kategorije as $k){
		?>
			<li><a class="active" href="?page=pages/products.php"><i class="icon-chevron-right"></i><?php echo $k->naziv?></a></li>
		<?php
	}
?>