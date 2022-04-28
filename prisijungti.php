<?php

?>
<form action="prisijungimas.php" method="post" name="prisijungti" >
	<section class="vh-100" style="background-color: #d1e7dd;">
	  <div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
		  <div class="col-12 col-md-8 col-lg-6 col-xl-5">
			<div class="card shadow-2-strong" style="border-radius: 1rem;">
			  <div class="card-body p-5 text-center">

				<h3 class="mb-5">Prisijungimo duomenys</h3>
				
				<?php
					if( isset($_GET['status']) AND isset($_GET['message'])) {
						message($_GET['status'], $_GET['message']);
					}
				?>

				<div class="form-outline mb-4">
				  <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="login" placeholder="Vartotojo vardas"/>
				  <!--<label class="form-label" for="typeEmailX-2">Vartotojo vardas</label>-->
				</div>

				<div class="form-outline mb-4">
				  <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" placeholder="Slaptažodis"/>
				 <!-- <label class="form-label" for="typePasswordX-2">Slaptažodis</label>-->
				</div>


				<button name="prisijungti" class="btn btn-success btn-lg btn-block" type="submit">Prisijungti</button>

				<hr class="my-4">


			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</form>