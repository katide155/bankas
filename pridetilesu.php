<?php

$data = json_decode($data, true); 

if( isset($_GET['id']) ) {
	$id = $_GET['id'];

	if(count($data[$id]) > 0) {
		$sask = $data[$id];   
	}
	
} else {
	header('Location: ./index.php?psl=sarasas');
}
if( isset($_POST['sask']) ) {
	if( $_POST['sask']['saskaitos_suma'] != '' ) 
	{
		
		$skaicius = $_POST['sask']['saskaitos_suma'];
				
		if(!is_numeric($skaicius)){
			
			header('Location: ./index.php?psl=pridetilesu&id='.$id.'&status=2&message=17');
			
		}
		else{
			

			$data[$id]['saskaitos_suma'] = $_POST['sask']['saskaitos_suma'] + $sask['saskaitos_suma'];
			
			if( file_put_contents( $datafilelink, json_encode($data) ) ) {
				
				header('Location: ./index.php?psl=sarasas&status=1&message=12');
				
			} else {
				
				header('Location: ./index.php?psl=prisetilesu&id='.$id.'&status=2&message=4');
				
			}
		
		}
	}

}
    
?>

<div class="py-5 text-center">
	<h2>Lėšų pridėjimas</h2>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="POST"  id="saskaitos_sukurimas">
			<div class="row g-3">
				<?php
					if( isset($_GET['status']) AND isset($_GET['message'])) {
						message($_GET['status'], $_GET['message']);
					}
				?>
				<div class="col-sm-6">
					<ul class="list-group">
					  <li class="list-group-item"><b>Klientas</b></li>
					  <li class="list-group-item"><?php echo $sask['vardas']." ". $sask['pavarde']; ?></li>
					  <li class="list-group-item">Sąskaitos Nr.: <?php echo $sask['saskaitos_nr']; ?></li>
					  <li class="list-group-item">Asmens kodas: <?php echo $sask['asmens_kodas']; ?></li>
					  <li class="list-group-item">Esama suma sąskaitoje: <?php echo $sask['saskaitos_suma']; ?></li>
					</ul>
				</div>
				<div class="col-sm-4">
					<label class="form-label"><b>Įveskite sumą kurią norite pridėti į sąskaitą</b></label>
					<input type="text" id="saskaitos_suma" class="form-control" name="sask[saskaitos_suma]" value="<?php echo $sask['saskaitos_suma']; ?>" />
				</div>
			</div>
			<div class="mt-5 mb-5">
				<button class="w-100 btn btn-success btn-lg" type="submit">Pridėti lėšų į sąskaitą</button>
			</div>
		</form>
	</div>
</div>