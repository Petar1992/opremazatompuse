<?php


	$proizvodi = Proizvod::all();
	$results_per_page = 6;
	$number_of_results = count($proizvodi);
	$number_of_pages = ceil($number_of_results/$results_per_page);

	if(!isset($_GET['strana'])){
		$page = 1;
	} else {
		$page = $_GET['strana'];
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

	$sql = "ORDER BY cena ". $sort ." LIMIT ". $this_page_first_result . ",".$results_per_page . " ";
	
	$proizvodi = Proizvod::all(["order" => "cena " . $sort . "" , "limit" => $results_per_page , "offset" => $this_page_first_result]);


	
?>

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Početna</a> <span class="divider">/</span></li>
		<li class="active">Svi proizvodi</li>
    </ul>
	<h3>Svi proizvodi</h3>	
	<hr class="soft"/>

	<form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sortiraj po: </label>
			<select onchange="window.location='?page=sviproizvodi&cena='+this.value">
              <option value="opadajuca" <?php echo ($cena == "opadajuca" ?"selected" : ""); ?>>Ceni - opadajuca</option>
              <option value="rastuca" <?php echo ($cena == "rastuca" ?"selected" : ""); ?>>Ceni - rastuca</option>
            </select>
		</div>
	  </form>
	  

<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">
			<?php 
			
			foreach($proizvodi as $proizvod){

			?>
			<li class="span3">
			  <div class="thumbnail" style="height: 300px;">
				<a href="?page=detalji&proizvod=<?php echo $proizvod->id ?>"><img src="<?php echo $proizvod->thumb ?>" width="160" height="160" alt=""/></a>
				<div class="caption">
				  <h5><?=$proizvod->naziv?></h5>
				  <p> 
					<?=$proizvod->info?> 
				  </p>
				   <h4 style="text-align: center;"><a class="btn" href="?page=detalji&proizvod=<?php echo $proizvod->id ?>">Detaljnije <i class="icon-zoom-in"></i></a>     <span><?=$proizvod->cena?> &euro;</span></h4>
				</div>
			  </div>
			</li>
			<?php
			}
		
		?>
		  </ul>
	<hr class="soft"/>
	</div>
</div>

	
	<div class="pagination">
			<ul>
			
			<?php 
			for($page = 1; $page <= $number_of_pages; $page++){
				echo '<li><a href="?page=sviproizvodi&strana='.$page.'&cena='.$cena.'">'. $page .'</a></li>';
			}
			?>
			
			</ul>
	</div>
	<br class="clr"/>
	
