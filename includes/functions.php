<?php

function filejasonencode($datafilelink, $datatofile){
	
	$datafile = file_get_contents($datafilelink);
	$datafileinfo = json_decode($datafile, true);
	
    if($datafileinfo) {
        $datatofile = array_merge($datafileinfo, $datatofile);
    }
	$datatoencode = json_encode($datatofile);

    file_put_contents($datafilelink, $datatoencode);

}

function getDataFromFile($datafilelink){
	
	$datafile = file_get_contents($datafilelink);
	$datafileinfo = json_decode($datafile, true);
	
	return $datafileinfo;
}

function generateAcountNo(){
	$saskaitos_nr = 'LT';
	for($i = 0; $i < 18; $i++)
	{
		$saskaitos_nr .= rand(0, 9);
	}
	
	return $saskaitos_nr;
}

function message($status, $message) {

    $messages = [
        1 => 'Sąskaita sėkmingai sukurta',
        2 => 'Neužpildyti formos laukeliai',
        3 => 'Sąskaita sėkmingai ištrinta',
        4 => 'Įvyko klaida',
        5 => 'Sąskaita sėkmingai atnaujinta',
		6 => 'Neįvestas arba neteisingai įvestas e.paštas',
		7 => 'Vartotojas su tokiu e.pašo adresu nerastas',
		8 => 'Neteisingas slaptažodis',
		9 => 'Negalima ištrinti sąskaitos kurioje yra lėšų!',
		10 => 'Negalima išimti daugiau lėšų negu yra sąskaitoje',
		11 => 'Sėkmingai išsiėmėte lėšas',
		12 => 'Sėkmingai pridėjote lėšų',
		13 => 'Vardas ir pavardė turi turėti bent tris simbolius',
		14 => 'Asmens kodas netinkamas',
		15 => 'Toks asmens kodas jau įrašytas',
		16 => 'Sąskaitos suma negali būti neigiama',
		17 => 'Prašome vesti skaičių darant pakeitimus sąskaitoje'
    ];    

    //Statusas 1 arba 2. 1 reiskia sekminga veiksma. 2 Reiskia nesekme.
    $klase = 'success';

    if($status == 2) {
        $klase = 'danger';
    }

    echo '<div class="alert alert-'.$klase.'" role="alert">';
    echo $messages[$message];
    echo '</div>';
}

function checkPersonalNumber($number){
	$isNumberGood = true;
	
	
	if(strlen($number) != 11)
	{	
		$isNumberGood = false;
	}
	else
	{
	
		$firstsimb = substr($number,0,1); 
		if($firstsimb > 6 or $firstsimb < 0)
			$isNumberGood = false;
		
		$fourthsimb = substr($number,3,1); 
		if($fourthsimb > 1 or $fourthsimb < 0)
			$isNumberGood = false;
		
		$s = substr($number,0,1)*1 + substr($number,1,1)*2 + 
		substr($number,2,1)*3 + substr($number,3,1)*4 + substr($number,4,1)*5 + 
		substr($number,5,1)*6 + substr($number,6,1)*7 + substr($number,7,1)*8 + 
		substr($number,8,1)*9 + substr($number,9,1)*1;
		
		$k = 0;
		 
		if($s % 11 != 10){
			
			$k = $s % 11;
			
		}else{
			
			$s = substr($number,0,1)*3 + substr($number,1,1)*4 + 
			substr($number,2,1)*5 + substr($number,3,1)*6 + substr($number,4,1)*7 +
			substr($number,5,1)*8 + substr($number,6,1)*9 + substr($number,7,1)*1 + 
			substr($number,8,1)*2 + substr($number,9,1)*3;
		
			if($s % 11 != 10){
				
				$k = $s % 11;
				
			}
			
		}
		
		$lastNo = substr($number,10,1);

		if($lastNo != $k)
			$isNumberGood = false;
	}
	
	return $isNumberGood;
	
}

















