		
		<?php


		$akcijskiProizvodi = Proizvod::all(array('conditions' => "akcija = 1"));
		$najnovijiProizvod = Proizvod::all(["conditions" => "najnoviji = 1"]);
		$proizvodi = Proizvod::all();
		$results_per_page = 6;
		$number_of_results = count($proizvodi);
		$number_of_pages = ceil($number_of_results/$results_per_page);
		
		if(!isset($_GET['strana'])){
			$page = 1;
		} else {
			$page = filter_var($_GET['strana'],FILTER_SANITIZE_NUMBER_INT);
		}

	if(!isset($_GET['cena'])){
		$sort = "desc";
		$cena = "opadajuca";
	} else {
		$cena = $_GET['cena'];
		if($cena == "opadajuca"){
			$sort = "desc";
		} 
		if($cena == "rastuca"){
			$sort = "asc";
		}
	}


		$this_page_first_result = ($page-1)*$results_per_page;

		$proizvodi = Proizvod::find("all", array('order' => 'cena '. $sort .'' ,  'limit' => $results_per_page , 'offset' => $this_page_first_result));
		
		?>



		<div class="span9">		
			<div class="well well-small visible-desktop">
			<h4>Proizvodi na akciji</h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
				<?php 
				$brojDivova = count($akcijskiProizvodi)/4;
				$pocetak = 0;
				$uslov = 3;
				for($i = 1; $i <= $brojDivova; $i++){

					if($i == 1 ){
						echo '<div class="item active">';
					} else {
						echo '<div class="item">';
					} 
					echo '<ul class="thumbnails">';

					for($j = $pocetak; $j <= $uslov; $j++){
						$akcija = $akcijskiProizvodi[$j];
				?>
				<li class="span3">
				  <div class="thumbnail" style="height: 280px;">
					<a href="?page=detalji&proizvod=<?php echo $akcija->id ?>"><img src="<?=$akcija->thumb?>" alt="<?=$akcija->naziv?>"></a>
					<div class="caption">
					  <h5><?=$akcija->naziv?></h5>
					  <h4 style="text-align: center;"><a class="btn" href="?page=detalji&proizvod=<?php echo $akcija->id ?>">Detaljnije <i class="icon-zoom-in"></i></a> <span><?=$akcija->cena?>&euro;</span></h4>
					</div>
				  </div>
				</li>
				<?php 
					}

					$pocetak +=4;
					$uslov +=4;

					echo "</ul>";
					echo "</div>";
				}
				?>
			  
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
			  
		
		<h4 id="sviproizvodi"></h4>
			  <ul class="thumbnails">
			  	<?php
					foreach($proizvodi as $proizvod){
				?>
				<li class="span3" >
				  <div class="thumbnail" style="height: 280px;">
					<a  href="?page=detalji&proizvod=<?php echo $proizvod->id ?>"><img src="<?php echo $proizvod->thumb?>" width=160 height=160 alt=""/></a>
					<div class="caption">
					  <h5><?=$proizvod->naziv?></h5>
					 
					 
					  <h4 style="text-align: center;"> <a class="btn" href="?page=detalji&proizvod=<?php echo $proizvod->id ?>">Detaljnije <i class="icon-zoom-in"></i></a> <span><?=$proizvod->cena?>&euro;</span></h4>
					</div>
				  </div>
				</li>
				<?php } ?>
			  </ul>

			  	<div class="pagination">
			<ul>
			
			<?php 
			for($page = 1; $page <= $number_of_pages; $page++){
				echo '<li><a href="?strana='.$page.'&cena='.$cena.'#sviproizvodi">'. $page .'</a></li>';
			}
			?>
			
			</ul>
	</div>
	<br class="clr"/>
			  	
			</div>
			