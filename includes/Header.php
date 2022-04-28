<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
		  <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
			  <li class="nav-item">
				<a class="nav-link <?php if ($page == 'sarasas')
								echo $aktyvi;
								else
								echo $neakt;
								?>" aria-current="sarasas" href="?psl=sarasas">Sąrašas</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link <?php if ($page == 'sukurti')
								echo $aktyvi;
								else
								echo $neakt;
								?>" href="?psl=sukurti">Sukurti sąskaitą</a>

			  <li class="nav-item">
				<a class="nav-link <?php if ($page == 'pridetilesu')
								echo $aktyvi;
								else
								echo $neakt;
								?>" href="?psl=pridetilesu">Pridėti lešų</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link <?php if ($page == 'nuskaiciuoti')
								echo $aktyvi;
								else
								echo $neakt;
								?>" href="?psl=nuskaiciuoti">Nuskaičiuoti lėšas</a>
			  </li>
		  </ul>
		  <?php include "includes/loginbtn.php"; ?>
		</div>
	  </div>
	</nav>
</header>
