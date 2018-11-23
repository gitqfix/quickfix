<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// Se a sessão está setada redireciona para o index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
    $upass = $_POST['pass'];

    $password = hash('sha256', $upass); // Hash de senha SHA256
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email= ?");
    $stmt->bind_param("s", $email);
    /* executar query */
    $stmt->execute();
    //resultados
    $res = $stmt->get_result();
    $stmt->close();

    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $count = $res->num_rows;
    if ($count == 1 && $row['password'] == $password) {
        $_SESSION['user'] = $row['id'];
        header("Location: index.php");
    } elseif ($count == 1) {
        $errMSG = "Senha Incorreta";
    } else $errMSG = "Usuário não encontrado";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="js/bootstrap.min.js"></script>
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
        <a class="nav-link" href="home.html"> Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="quemsomos.html"> Quem somos? </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="sup.html"> Suporte </a>
      </li>
      <li class="nav-item" >
        <a class="nav-link " href="register.php" > Cadastro </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link active" href="login.php"> Login </a>
      </li>
     
    </ul>

  </div>
</nav>
    <div id="login">
		<?php
			if (isset($errMSG)) {

		?>
		<div class="form-group">
			<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
			</div>
		</div>
	<?php
								}
	?>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3>Login</h3>
							   

                            <div class="form-group">
                                <label for="username">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label><br>
                                <input type="password" name="pass" id="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                
                                <input type="submit" name="btn-login" class="btn btn-info btn-md" value="Login">
								<button type="button" class="btn btn-link"><a href="register.php">Cadastre-se</a></button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<nav class="navbar fixed-bottom navbar-dark bg-dark">
			Copyright © 2018 www.quickfix.com - Tel.: 7070-7070	
	</nav>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>