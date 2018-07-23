<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/findAll/[{teste}]', function (Request $request, Response $response) {
    $this->logger->addInfo("Lista de Pessoas");
    $Controller = new ControllerPessoa($this->db);
    $pessoas = $Controller->getPessoas();
    $newResponse = $response->withJson($pessoas, 200);
    return $newResponse;
});

$app->get('/findById/[{id}]', function (Request $request, Response $response, array $args) {
    $pessoa_id = (int)$args['id'];
    $this->logger->addInfo("Pessoa com id: " . $pessoa_id);
    $Controller = new ControllerPessoa($this->db);
    $pessoa = $Controller->getPessoaById($pessoa_id);
    $newResponse = $response->withJson($pessoa, 200);
    return $newResponse;
});

$app->post('/inserir/new', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $pessoa_data = [];
    $pessoa_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $pessoa_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $pessoa_data['data'] = filter_var($data['data'], FILTER_SANITIZE_STRING);    
    $pessoa = new PessoaEntity($pessoa_data);
    $pessoa_Controller = new ControllerPessoa($this->db);
    $pessoa_Controller->save($pessoa);
    return '{ "inserido" : "sucesso" }';
});

$app->put('/update/[{id}]', function (Request $request, Response $response, array $args) {
    $this->logger->addInfo("Ticket list");
    $data = $request->getParsedBody();
    $pessoa_id = (int)$args['id'];
    $pessoa_data = [];
    $pessoa_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $pessoa_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $pessoa_data['data'] = filter_var($data['data'], FILTER_SANITIZE_STRING);
    $pessoa = new PessoaEntity($pessoa_data);
    $pessoa_Controller = new ControllerPessoa($this->db);
    $pessoa_Controller->update($pessoa,  $pessoa_id);
    return '{ "Atualiza��o" : "sucesso" }';
});

$app->delete('/deleteById/[{id}]', function (Request $request, Response $response, array $args) {
    $this->logger->addInfo("Ticket list");
    $pessoa_id = (int)$args['id'];
    $pessoa_Controller = new ControllerPessoa($this->db);
    $response = $pessoa_Controller->deleteById($pessoa_id); 
    return '{ "removido" : "sucesso" }';
});