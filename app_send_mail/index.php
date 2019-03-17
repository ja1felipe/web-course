<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<form action="./scripts/enviar.php" method="post">
							<div class="form-group">
								<label for="para">De</label>
								<input type="text" class="form-control" id="para" name="de" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="para">Para</label>
								<input type="text" class="form-control" id="para" name="para" placeholder="joao@dominio.com.br, para mais de 1 destinário separar os emails com uso da vígula(',')">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input type="text" class="form-control" id="assunto" name="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea class="form-control" id="mensagem" name="msg"></textarea>
							</div>
							<?php if($_GET['result'] == "sucesso"){
							?> <p class="text-success">Email enviado com sucesso.</p>
							<?php } ?>

							<?php if($_GET['result'] == "falha"){
							?> <p class="text-danger">Falha no envio do email, por favor preencha todos campos corretamente.</p>
							<?php } ?>
							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>