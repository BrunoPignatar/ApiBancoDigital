<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url){
      //   http://localhost:8000/correntista/save
     case '/correntista/save':
        break;
      //   http://localhost:8000/conta/extrato
        case '/conta/extrato':
        break;
      //   http://localhost:8000/conta/pix/enviar
     case '/conta/pix/enviar':
        break;
      //   http://localhost:8000/conta/pix/receber
     case '/conta/pix/receber':
        break;
      //   http://localhost:8000/correntista/entrar
      case '/correntista/entrar':
        break;

        default:
        http_response_code(403);
        break;


}