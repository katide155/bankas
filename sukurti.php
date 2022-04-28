<?php

$vardas = '';
$pavarde = '';


$saskaitos_nr = generateAcountNo();

$data = getDataFromFile($datafilelink);

$saskaitos = array_column($data, 'saskaitos_nr');

while(true){
	if(in_array($saskaitos_nr, $saskaitos)){
		$saskaitos_nr = generateAcountNo();
	}else{
		break;
	}
}

$asmens_kodas = '';

if( isset($_POST['sask']) ) {
	

	
	if(	$_POST['sask']['vardas'] != '' and $_POST['sask']['pavarde'] != '' and $_POST['sask']['asmens_kodas'] != '' )
		
	{
		
		$vardas = $_POST['sask']['vardas'];
		$pavarde = $_POST['sask']['pavarde'];
		$asmens_kodas = $_POST['sask']['asmens_kodas'];
		
		$asmens_kodas_tikrinimui = preg_replace("/[^0-9]+/", "", $asmens_kodas);

		if(strlen($asmens_kodas_tikrinimui) > 0)
			$asmens_kodas_tikrinimui = checkPersonalNumber($asmens_kodas_tikrinimui);
			
		if(strlen($_POST['sask']['vardas']) < 3 || strlen($_POST['sask']['pavarde']) < 3){
			
			header('Location: index.php?psl=sukurti&status=2&message=13');
			
		}else{
			
			
			
			if(!$asmens_kodas_tikrinimui){
				
				header('Location: index.php?psl=sukurti&status=2&message=14');
				
			}
			else{
				
				$asmens_kodai = array_column($data, 'asmens_kodas');

				if(in_array($asmens_kodas, $asmens_kodai)){
					
					header('Location: index.php?psl=sukurti&status=2&message=15');
					
				}
				else
				{
			
			
				$vardas = preg_replace("/[^a-zA-Z]+/", "", $vardas);
				$pavarde = preg_replace("/[^a-zA-Z]+/", "", $pavarde);
				
				$_POST['sask']['vardas'] = ucwords($vardas);
				$_POST['sask']['pavarde'] = ucwords($pavarde);

				$datatofile = [$_POST['sask']];
				
				filejasonencode($datafilelink, $datatofile);

				header('Location: index.php?psl=sarasas&status=1&message=1');		
				}			
				
			}
			

			
		}

	} else {

		header('Location: index.php?psl=sukurti&status=2&message=2');

	}

}
?>

<div class="py-5 text-center">
	<h2>Sąskaitos sukūrimas</h2>
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
				<div class="col-sm-3">
					<label class="form-label">Kliento vardas</label>
					<input type="text" id="vardas" class="form-control" name="sask[vardas]" value="<?php echo $vardas; ?>" />
				</div>
				<div class="col-sm-3">
					<label class="form-label">Kliento pavardė</label>
					<input type="text" id="pavarde" class="form-control" name="sask[pavarde]" value="<?php echo $pavarde; ?>" />
				</div>
				<div class="col-sm-3">
					<label class="form-label">Sąskaitos Nr.</label>
					<input type="text" id="saskaitos_nr" class="form-control" name="sask[saskaitos_nr]" value="<?php echo $saskaitos_nr; ?>" readonly/>
				</div>
				<div class="col-sm-3">
					<label class="form-label">Asmens kodas</label>
					<input type="text" id="asmens_kodas" class="form-control" name="sask[asmens_kodas]" value="<?php echo $asmens_kodas; ?>" />
				</div>
					<input type="hidden" id="saskaitos_suma" class="form-control" name="sask[saskaitos_suma]" value="0" />
			</div>
			<div class="mt-5 mb-5">
				<button class="w-100 btn btn-success btn-lg" type="submit">Sukurti sąskaitą</button>
			</div>
		</form>
	</div>
</div>