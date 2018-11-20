<!DOCTYPE html>
<html>
<head>
	<title>Obrigado!!!</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<--!//botão para retornar a home -->
<a href="login.html" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Voltar</a></div>
<?php

include_once("conexao.php"); //chamar a conexao
header('Content-Type: text/html; charset=utf-8');
//requirir tags do formulário HTML e armazená-las em variáveis do PHP
$user = $_POST['user_txt'];
$email = $_POST['email_txt'];
$problem = $_POST['problema_txt'];
$desc = $_POST['desc_txt'];

//definir valores/parâmetros do insert na tabela

$insert = "INSERT INTO Suporte(user,email,problema,descp) VALUES ('$user','$email','$problem','$desc')";
//Linkar insert ao banco por meio da conexão
$link = mysqli_query ($conx,$insert);

//--------------------------------------------------------------
//confirmação de e-mail

require 'PHPMailer/PHPMailerAutoload.php';

$Mailer = new PHPMailer();

//Define que será usado SMTP
$Mailer->IsSMTP();

//Enviar e-mail em HTML
$Mailer->isHTML(true);

//Aceitar carasteres especiais
$Mailer->Charset = 'UTF-8';

//Configurações

$Mailer->Port = 465;
$Mailer->SMTPDebug = 0;
$Mailer->SMTPSecure = "ssl";
//nome do servidor
$Mailer->Host = 'smtp.gmail.com';

$Mailer->SMTPAuth = true;
//Dados do e-mail de saida - autenticação
$Mailer->Username = 'gitqfix@gmail.com';
$Mailer->Password = 'quickfix123';

//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
$Mailer->From = 'gitqfix@gmail.com';

//Nome do Remetente
$Mailer->FromName = 'Equipe QuickFix';

//Assunto da mensagem
$Mailer->Subject = 'Suporte registrado';

//Corpo da Mensagem
$msg = 'Olá '.$user.', sua solicitação foi registrada e logo entraremos em contato para resolver isso aí :)<br>';
$msg .= '<br><br>Enviado por Equipe QuickFix';
$Mailer->Body = $msg;

//Destinatario
$Mailer->AddAddress($email);

if($Mailer->Send()){
    echo "";
}else{
    echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
}

//Requisição de envio de email para a equipe
$Mailer = new PHPMailer();

//Define que será usado SMTP
$Mailer->IsSMTP();

//Enviar e-mail em HTML
$Mailer->isHTML(true);

//Aceitar carasteres especiais
$Mailer->Charset = 'UTF-8';

//Configurações

$Mailer->Port = 465;
$Mailer->SMTPDebug = 0;
$Mailer->SMTPSecure = "ssl";
//nome do servidor
$Mailer->Host = 'smtp.gmail.com';

$Mailer->SMTPAuth = true;
//Dados do e-mail de saida - autenticação
$Mailer->Username = 'gitqfix@gmail.com';
$Mailer->Password = 'quickfix123';

//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
$Mailer->From = 'gitqfix@gmail.com';

//Nome do Remetente
$Mailer->FromName = 'Equipe QuickFix';

//Assunto da mensagem
$Mailer->Subject = 'Suporte registrado';

//Corpo da Mensagem
$Mailer->Body = 'Foi registrada uma nova solicitação de suporte pelo usuário: '.$email.', a solicitação é do tipo: '.$problem.', e sua descrição foi a seguinte:"'.$desc.'"';

//Corpo da mensagem em texto
$Mailer->AltBody = 'Deixa com a gente :)';

//Destinatario
$Mailer->AddAddress('gitqfix@gmail.com');

if($Mailer->Send()){
    echo "<br>Solicitação registrada";
}else{
    echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
}
?>


</body>
</html>

