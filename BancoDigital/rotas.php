<?php
use BancoDigital\Controller\{
   CorrentistaController,
   ContaController,
   TransacaoController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

  // php -S 0.0.0.0:8000
  // http://localhost:8000/correntista/save --
  case "/correntista/save":
      CorrentistaController::save();
  break;

  // http://localhost:8000/correntista/login --
  // URL Local: http://0.0.0.0:8000/correntista/login
  case "/correntista/login":
      CorrentistaController::login();
  break;

  // http://localhost:8000/conta/extrato --
  case "/conta/extrato":
      ContaController::extrato();
  break;

  // http://localhost:8000/transacao/pix/enviar --
  case "/transacao/pix/enviar":
      TransacaoController::enviarPix();
  break;

  // http://localhost:8000/transacao/pix/receber --
  case "/transacao/pix/receber":
      TransacaoController::receberPix();
  break;

  default:
      //header("Location: /");
  break;
}