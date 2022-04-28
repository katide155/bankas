<?php 

if( isset($_GET['action']) AND $_GET['action'] == 'delete') {

    if( isset($_GET['id']) ) {

        $id = $_GET['id'];

        $data = getDataFromFile($datafilelink);
		
		$esama_suma = $data[$id]['saskaitos_suma'];
		if($esama_suma > 0){
			
			header('Location: index.php?psl=sarasas&status=2&message=9');
			
		}else{
			
			unset($data[$id]);
		
			if( file_put_contents($datafilelink, json_encode($data) ) ) {
				
				header('Location: index.php?psl=sarasas&status=1&message=3');
				
			} else {
				
				header('Location: index.php?psl=sarasas&status=2&message=4');
				
			}
		}
        
    }

}

?>

 
<div class="py-5 text-center">
	<h2>Sąskaitų sąrašas</h2>
</div>

<?php
	if( isset($_GET['status']) AND isset($_GET['message'])) {
		message($_GET['status'], $_GET['message']);
	}
?>

<div class="text-start">
	
	<table class="table table-success table-striped">
		<thead>
			<th>Eil. Nr.</th>
			<th>Vardas</th>
			<th>Pavardė</th>
			<th>Sąskaitos numeris</th>
			<th>Asmens kodas</th>
			<th>Suma sąskaitoje</th>
			<th style="width: 260px;"></th>
		</thead>
		<tbody>
			<?php
				$data = getDataFromFile($datafilelink);
			
				foreach($data as $id => $value){
					
					$data[$id]['idto']= $id;
				}
				

				$sort_by = array_column($data, 'pavarde');
				array_multisort($sort_by, SORT_ASC, $data);
				

			   
				$i = 1;
				foreach($data as $id => $reiksme) :
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $reiksme['vardas']; ?></td>
					<td><?php echo $reiksme['pavarde']; ?></td>
					<td><?php echo $reiksme['saskaitos_nr']; ?></td>
					<td><?php echo $reiksme['asmens_kodas']; ?></td>
					<td><?php echo $reiksme['saskaitos_suma']; ?></td>
					<td>
						<a href="index.php?psl=sarasas&action=delete&id=<?php echo $reiksme['idto']; ?>" class="btn btn-danger">X</a>
						<a href="index.php?psl=redaguoti&id=<?php echo $reiksme['idto']; ?>" class="btn btn-success">Redaguoti</a>
						<a href="index.php?psl=pridetilesu&id=<?php echo $reiksme['idto']; ?>" class="btn btn-primary">+</a>
						<a href="index.php?psl=nuskaiciuoti&id=<?php echo $reiksme['idto']; ?>" class="btn btn-warning">-</a>
					</td>
				</tr>
			<?php $i++; endforeach; ?>
		</tbody>
	</table>

</div>

