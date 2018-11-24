<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// Select das caracteristicas do user
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
    <title>Hello,<?php echo $userRow['email']; ?></title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>

<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img class="nvlogo" src="img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="home.html"> Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="quemsomos.html"> Quem somos? </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="sup.html"> Suporte </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="form/insertion.php"> Anunciar serviço </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="table/listagem.php"> Procurar serviço </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="table/meuschamados.php"> Meus serviços </a>
      </li>

     
    </ul>
	  <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span
                            class="glyphicon glyphicon-user" color="white"></span>&nbsp;Logged
                        in: <?php echo $userRow['email']; ?>
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                        </li>
                    </ul>

  </div>
</nav>




<div class="container">
    <!-- Jumbotron-->
    <div class="jumbotron">
        <h1>Olá, <?php echo $userRow['username']; ?></h1>
        <p>Agora que você está logado você pode: </p>
        <p><a class="btn btn-primary btn-lg" href="form/insertion.php" role="button">Anunciar um serviço</a>
		<a class="btn btn-primary btn-lg" href="table/listagem.php" role="button">Procurar um serviço</a>
		<a class="btn btn-primary btn-lg" href="table/meuschamados.php" role="button">Ver seus serviços</a></p>
    </div>
</div>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>
</html>
