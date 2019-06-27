<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Accueil</title>
  </head>
  <body>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Bienvenue sur "Virement"</h1>
	
<div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card text-white bg-primary mb-3">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Les Comptes</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Création</li>
              <li>Modification</li>
              <li>Interrogation</li>
              <li>Supression</li>
            </ul>
            <a href="controllers/compte/compteListerCl.php"><button type="button" class="btn btn-lg btn-block btn-success">Gérer</button></a>
          </div>
        </div>
        <div class="card text-white bg-primary mb-3">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Vos Bénéficiaires</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
             <li>Création</li>
              <li>Modification</li>
              <li>Interrogation</li>
              <li>Supression</li>
            </ul>
            <a href="controllers/beneficiaire/beneficiaireListerCl.php"><button type="button" class="btn btn-lg btn-block btn-success">Gérer</button></a>
          </div>
        </div>
        <div class="card text-white bg-primary mb-3">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Les Categories</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
             <li>Création</li>
              <li>Modification</li>
              <li>Interrogation</li>
              <li>Supression</li>
            </ul>
            <a href="controllers/categorie/categorieListerCl.php"><button type="button" class="btn btn-lg btn-block btn-success">Gérer</button></a>
          </div>
		 </div>  
		 </div>
		 <div class="row">
  <div class="col-sm-6">
    <div class="card border-primary mb-3">
      <div class="card-body text-primary">
        <h5 class="card-title">Vos Opérations</h5>
        <p class="card-text">Pour la Création , Modification , Interrogation ou Supression</p>
       <a href="controllers/operation/operationListerCl.php"><button type="button" class="btn btn-lg btn-success" style="width:50%">Gérer</button></a>
		
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card border-primary mb-3">
      <div class="card-body text-primary">
        <h5 class="card-title">Vos Remises</h5>
        <p class="card-text">Pour la Création , Modification , Interrogation ou Supression</p>
        <a href="controllers/remise/remiseListerCl.php"><button type="button" class="btn btn-lg btn-success" style="width:50%">Gérer</button></a>
      </div>
    </div>
  </div>
</div>
      

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
