<?php
ob_start();
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}
include_once 'dbconnect.php';

if (isset($_POST['signup'])) {

    $uname = trim($_POST['uname']); // Pegar os dados e remover espaços em branco
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);
	$cupass = trim($_POST['cpass']);
 
	if ($upass != $cupass) {
		$errTyp = "warning";
        $errMSG = "Senhas não conferem";
	
	}else{
 

    // criar hash da senha com SHA256;
    $password = hash('sha256', $upass);

    // checa se o email existe
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // Se o email não existir adiciona um user


        $stmts = $conn->prepare("INSERT INTO users(username,email,password) VALUES(?, ?, ?)");
        $stmts->bind_param("sss", $uname, $email, $password);
        $res = $stmts->execute();//get result
        $stmts->close();
		
		//---------------
		
		//---------------
        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // seta a sessão e redireciona para a página index
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Algo deu errado, Tente novamente";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "Email já utilizado";
    }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/cadastro.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <li class="nav-item">
        <a class="nav-link active" href="register.php"> Cadastro </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="login.php"> Login </a>
      </li>
      
    </ul>

  </div>
</nav>
<form method="post"style="border:1px solid #212529">
  <div id="cadastro" class="container-fluid">
    <h1>Vem ser QuickFixer</h1>
	   <?php
                if (isset($errMSG)) {
                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
    <p>Preencha os campos para fazer parte da nossa comunidade de pessoas que ajudam a ajudar</p>
    <hr>

    <label for="uname"><b>Usuário</b></label>
    <input type="text" placeholder="Digite um nome de usuário" class="form-control" name="uname" required>

    <label for="email"><b>E-mail</b></label>
    <input type="text" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$" placeholder="Digite seu email aqui" class="form-control" name="email" required>

    <label for="psw"><b>Senha</b></label>
    <input type="password" placeholder="Digite sua senha aqui" class="form-control" name="pass" required>

    <label for="psw-repeat"><b>Repita a senha (só pra ter certeza né?)</b></label>
    <input type="password" placeholder="Digite a senha aqui tambem :)" class="form-control" name="cpass" required>

    
    <p>Confirmando seu cadastro você concorda com nossos termos!!! (Que nem são tantos assim na moral) <a href="termos.html" style="color:dodgerblue" target="_blank">Termos & Privacidade do Quickfix </a>.</p>

    <div class="clearfix">
      <button  type="button" class="cancelbtn" onclick="window.location.href='login.php'">Voltar :(</button>
      <button type="submit" class="signupbtn" name="signup">Concluir :)</button>
    </div>
  </div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>