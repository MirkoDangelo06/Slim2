<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM `alunni` WHERE alunni.id = $args[id]");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"]; 
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $creation = $mysqli_connection->query("INSERT INTO `alunni`(`nome`, `cognome`) VALUES ('$nome','$cognome')");

    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function update(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"]; 
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $creation = $mysqli_connection->query("UPDATE `alunni` SET `nome`='$nome',`cognome`='$cognome' WHERE alunni.id = $args[id]");

    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function delete(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM `alunni` WHERE alunni.id = $args[id]");

    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function filter(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM `alunni` WHERE (alunni.nome LIKE '%$args[txt]%' OR alunni.cognome LIKE '%$args[txt]%')");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }


  //--PER IL CREATE
//curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome": "guido", "cognome": "lauto"}'

//--PER IL DELETE
//curl -X POST http://localhost:8080/alunni/5

//--PER L'UPDATE
//curl -X PUT http://localhost:8080/alunni/3 -H "Content-Type: application/json" -d '{"nome": "GUIDO", "cognome": "LAUTO"}'

}
