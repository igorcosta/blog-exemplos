<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$response =array();
$db = new SQLite3('coisas.db');


// Uso essa função só para gerar dados fakes para ser usado no sistema
$app->get('/preload-inicial', function () use ($db,$response)
{       $value = rand(5,99);
        $db->exec('CREATE TABLE IF NOT EXISTS clientes(id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT);');
        $db->exec('CREATE TABLE IF NOT EXISTS compras(id INTEGER PRIMARY KEY, cliente_id INTEGER, valor INTEGER, compra_realizada DATETIME);');
        $db->query("INSERT OR IGNORE INTO clientes (nome) VALUES ('Igor Costa');");
        $db->query("INSERT OR IGNORE INTO clientes (nome) VALUES ('Elly Costa');");
        $db->query("INSERT OR IGNORE INTO clientes (nome) VALUES ('Leonardo Sobral');");
        $db->query("INSERT OR IGNORE INTO clientes (nome) VALUES ('Francisco Brianezi');");
        for($i=1;$i<=4;$i++){
            $db->query("INSERT INTO compras (valor,cliente_id,compra_realizada) VALUES ($value,$i,datetime());");
        }
        
});
// adicionar cliente
$app->put('/cliente', function () use($db,$response,$app) {
    $request = $app->request();
    $cliente = $request->put('nome');
    $response =$db->exec("INSERT INTO clientes (nome) VALUES ('$cliente');");
    echo $response;
});
// adicionar nova compra
$app->put('/compra', function () use($db,$response,$app) {
    $request = $app->request();
    $valor = $request->put('valor');
    $cliente = $request->put('cliente_id');
    $response = $db->query("INSERT INTO compras (valor,cliente_id,compra_realizada) VALUES ($valor,$cliente,datetime());");
    echo $response;
});


// Ediar cliente

$app->post('/cliente/:id',function($id) use($db,$response,$app){
    $request = $app->request();
    $nome = $request->post('nome');
    $response = $db->exec("UPDATE clientes SET nome='$nome' WHERE id=$id;");
    echo json_encode($response);
});

$app->post('/compra/:id',function($id) use($db,$response,$app){
    $request = $app->request();
    $valor = $request->post('valor');
    $cliente = $request->post('cliente_id');
    $response = $db->exec("UPDATE compras SET valor='$valor', cliente_id='$cliente' WHERE id=$id;");
    echo json_encode($response);
});

// lista os clientes
$app->get('/clientes',function()use ($db,$response,$app){
   
   $app->contentType('application/json');
   $tarefas = $db->query("SELECT * FROM clientes");
        while ($row = $tarefas->fetchArray(SQLITE3_ASSOC)) {
            array_push($response,$row);
        }
      echo json_encode($response);
    
});
// lista todas as compras
$app->get('/compras',function() use($db,$response,$app){
   $app->contentType('application/json');
   $tarefas = $db->query("SELECT clientes.id,clientes.nome,COUNT(*) as total_compras
                          FROM compras INNER JOIN clientes ON compras.cliente_id = clientes.id 
                          GROUP BY clientes.nome ORDER BY clientes.nome ASC");
        while ($row = $tarefas->fetchArray(SQLITE3_ASSOC)) {
            array_push($response,$row);
        }
      echo json_encode($response);
    
});
// lista todas as compras por id do cliente
$app->get('/compras/:id',function($id) use ($db,$response){

    $tarefas = $db->query("SELECT * FROM compras INNER JOIN clientes 
        ON compras.cliente_id = clientes.id  WHERE clientes.id = $id");
        while ($row = $tarefas->fetchArray(SQLITE3_ASSOC)) {
            array_push($response,$row);
        }
      echo json_encode($response); 
});
$app->get('/backup',function() use($app){
    $date = date("Y-m-d");
    exec('mkdir backups');
    $file = 'backups/backup-'.$date . '.sql';
    exec("sqlite3 coisas.db .dump > ".$file);
    echo readfile($file);
});

// Deleta cliente
$app->delete('/deleta/cliente/:id', function ($id) use ($db,$response,$app) {
    
    // para remover compras existentes do cliente
    $db->exec("DELETE FROM compras WHERE cliente_id=$id;");
    $response =$db->query("DELETE FROM clientes WHERE id=$id;");
    echo $response; 
});
// Deleta compra
$app->delete('/deleta/compra/:id', function ($id) {
    $response =$db->query("DELETE FROM compras WHERE id=$id;");
    echo $response; 
});

$app->run();
