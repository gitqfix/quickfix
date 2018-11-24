<?php
session_start();
require_once '../dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
// Select das caracteristicas do user
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

$result_service_list = mysqli_query($conn, "SELECT * FROM services INNER JOIN users ON userID = id WHERE id!=". $_SESSION['user']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quick Fix App</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img class="nvlogo" src="img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="../home.html"> Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../quemsomos.html"> Quem somos? </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="../sup.html"> Suporte </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="../form/insertion.php"> Anunciar serviço </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link active" href="listagem.php"> Procurar serviço </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="meuschamados.php"> Meus serviços </a>
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
                        <li><a href="../logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                        </li>
                    </ul>

  </div>
</nav>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Nome do anunciante</th>
								<th class="column3">Tipo de Serviço</th>
								<th class="column3">Preço</th>
								<th class="column3">Contato</th>
						</thead>
						<tbody>
							<?php
								while ($item = mysqli_fetch_array($result_service_list)) {
									echo "<tr>";
									echo "<td>".$item['username']."</td>";
									echo "<td>".$item['service_type']."</td>";
									echo "<td>".$item['service_price']."</td>";
									echo "<td>".$item['contato']."</td>";
									echo "<tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>