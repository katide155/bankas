<?php

$data = getDataFromFile($datafilelink);

if( isset($_GET['id']) ) {
	$id = $_GET['id'];

	if(count($data[$id]) > 0) {
		$sask = $data[$id];   
	}
	
} else {
	header('Location: ./index.php?psl=sarasas');
}



$vardas = '';
$pavarde = '';
$asmens_kodas = '';


if( isset($_POST['sask']) ) {
	if(	$_POST['sask']['vardas'] != '' and $_POST['sask']['pavarde'] != '' and
	$_POST['sask']['asmens_kodas'] != '' and $_POST['sask']['saskaitos_suma'] != '' ) 
	{
		
		$vardas = $_POST['sask']['vardas'];
		$pavarde = $_POST['sask']['pavarde'];
		$asmens_kodas = $_POST['sask']['asmens_kodas'];
		
		$asmens_kodas_tikrinimui = preg_replace("/[^0-9]+/", "", $asmens_kodas);

		if(strlen($asmens_kodas_tikrinimui) > 0)
			$asmens_kodas_tikrinimui = checkPersonalNumber($asmens_kodas_tikrinimui);
			
		if(strlen($_POST['sask']['vardas']) < 3 || strlen($_POST['sask']['pavarde']) < 3){
			
			header('Location: index.php?psl=redaguoti&id='.$id.'&status=2&message=13');
			
		}else{

			if(!$asmens_kodas_tikrinimui){
				
				header('Location: index.php?psl=redaguoti&id='.$id.'&status=2&message=14');
				
			}
			else{
				
				$asmens_kodai = array_column($data, 'asmens_kodas');
				
				unset($asmens_kodai[$id]);
			 

				if(in_array($asmens_kodas, $asmens_kodai)){
					
					header('Location: index.php?psl=redaguoti&id='.$id.'&status=2&message=15');
					
				}
				else
				{
					$skaicius = $_POST['sask']['saskaitos_suma'];
				
					if(!is_numeric($skaicius)){
					
						header('Location: ./index.php?psl=redaguoti&id='.$id.'&status=2&message=17');
					
					}
					else
					{
						if ($_POST['sask']['saskaitos_suma'] < 0){
						
							header('Location: ./index.php?psl=redaguoti&id='.$id.'&status=2&message=16');
							
						}
						else
						{
							
							$vardas = preg_replace("/[^a-z ąčęėįšųūž A-Z]+/", "", $vardas);
							$pavarde = preg_replace("/[^a-zA-Z]+/", "", $pavarde);
							
							$data[$id]['vardas'] = ucwords($vardas);
							$data[$id]['pavarde'] = ucwords($pavarde);
							$data[$id]['asmens_kodas'] = $_POST['sask']['asmens_kodas'];
							$data[$id]['saskaitos_suma'] = $_POST['sask']['saskaitos_suma'];
							
							if( file_put_contents( $datafilelink, json_encode($data) ) ) {
								
								header('Location: ./index.php?psl=sarasas&status=1&message=5');
								
							} else {
								
								header('Location: ./index.php?psl=redaguoti&id='.$id.'&status=2&message=4');
								
							}
						}
					}
				
				}
					
			}		
		}
	}

}
    
?>

<div class="py-5 text-center">
	<h2>Sąskaitos redagavimas</h2>
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
				<div class="col-sm-2">
					<label class="form-label">Kliento vardas</label>
					<input type="text" id="vardas" class="form-control" name="sask[vardas]" value="<?php echo $sask['vardas']; ?>" />
				</div>
				<div class="col-sm-3">
					<label class="form-label">Kliento pavardė</label>
					<input type="text" id="pavarde" class="form-control" name="sask[pavarde]" value="<?php echo $sask['pavarde']; ?>" />
				</div>
				<div class="col-sm-3">
					<label class="form-label">Sąskaitos Nr.</label>
					<input type="text" id="saskaitos_nr" class="form-control" name="sask[saskaitos_nr]" value="<?php echo $sask['saskaitos_nr']; ?>" readonly/>
				</div>
				<div class="col-sm-2">
					<label class="form-label">Asmens kodas</label>
					<input type="text" id="asmens_kodas" class="form-control" name="sask[asmens_kodas]" value="<?php echo $sask['asmens_kodas']; ?>" />
				</div>
				<div class="col-sm-2">
					<label class="form-label">Sąskaitos suma</label>
					<input type="text" id="saskaitos_suma" class="form-control" name="sask[saskaitos_suma]" value="<?php echo $sask['saskaitos_suma']; ?>" />
				</div>
			</div>
			<div class="mt-5 mb-5">
				<button class="w-100 btn btn-success btn-lg" type="submit">Redaguoti sąskaitą</button>
			</div>
		</form>
	</div>
</div>
