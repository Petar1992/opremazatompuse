<?php
	

	$kategorije = Kategorija::find('all');
	$istaknut = Proizvod::all(array('conditions' => 'istaknut = 1'));
	

?>
<div id="sidebar" class="span3">
		<ul class="nav nav-tabs nav-stacked sideManu">
			<li class="subMenu open"><a>KATEGORIJE PROIZVODA</a>
				<ul>
					<?php
						foreach($kategorije as $k){
					?>
		<li><a class="active" href="?page=proizvodi&cat=<?php echo $k->id?>"><?php echo $k->naziv?></a></li>

			<?php
				}
			?>
				</ul>
			</li>
		</ul>

		<br/>
		<ul class="nav nav-tabs nav-stacked sideManu">
			<li  class="subMenu featured-products open"><a href="#" class="desktop">ISTAKNUTI PROIZVODI</a>

				<ul>
					<?php
					foreach($istaknut as $i){
					?>
				<li>
				  <div class="thumbnail">
					<img src="<?php echo $i->thumb ?>" width=160 alt="<?php echo $i->naziv; ?>"/>
					<div class="caption">
					  <h5><?php echo $i->naziv; ?></h5>
						<h4 style="text-align: center;"><a class="btn" href="?page=detalji&proizvod=<?php echo $i->id ?>">Detaljnije <i class="icon-zoom-in"></i></a> <span><?=$i->cena?>&euro; </span></h4>
					</div>
				  </div>
		  		</li>
		  <?php
		  	}
		  ?>
				</ul>
			</li>

		</ul>
		
			
	</div>