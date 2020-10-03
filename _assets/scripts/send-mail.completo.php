<?php
	// Setup request to send json via POST
	$data = array(
		'name' => filter_input(INPUT_POST , 'nome'),
		'email' => filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL),
		'contact' => filter_input(INPUT_POST , 'contato'),
		'message' => filter_input(INPUT_POST , 'message'),
		'title' => 'Agência Publikando',
		'emailDestinatario' => 'contato@agenciapublikando.com.br',
		'subject' => 'Agência Publikando - Formulário',
	);

	$payload = http_build_query($data);

	$url = 'https://central.agenciapublikando.com.br/mail/sendMailClient/' . $payload;

	// Iniciamos a função do CURL:
	$cUrl = curl_init($url); // passa a url e o código
	// parametros
	curl_setopt_array($cUrl, [
		// request custom do tipo get
		CURLOPT_CUSTOMREQUEST => 'GET',
		// Permite obter o resultado
		CURLOPT_RETURNTRANSFER => 1,
	]);
	// get cURL execute
	$result = curl_exec($cUrl);

	echo "sucess";

	// close cUrl
	curl_close($cUrl);
?>