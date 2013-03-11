<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$dbName = "coisas2.db";
$response =array();
$db = new SQLite3($dbName);


// Uso essa função só para gerar dados fakes para ser usado no sistema
$app->get('/preload-inicial', function () use ($db,$response)
{       $value = rand(5,99);
        $db->exec('CREATE TABLE IF NOT EXISTS clientes(id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT);');
        $db->exec('CREATE TABLE IF NOT EXISTS compras(id INTEGER PRIMARY KEY AUTOINCREMENT, cliente_id INTEGER, valor INTEGER, compra_realizada DATETIME);');
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
    $response = $db->exec("INSERT INTO compras (valor,cliente_id,compra_realizada) VALUES ($valor,$cliente,datetime());");
    echo $response;
});


// Ediar cliente

$app->post('/cliente',function() use($db,$response,$app){
    $request = $app->request();
    $nome = $request->post('nome');
    $cliente_id = $request->post('id');
    $response = $db->exec("UPDATE clientes SET nome='$nome' WHERE id=$cliente_id;");
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
// lista todas as compras
$app->get('/historico-compras',function() use($db,$response,$app){
   $app->contentType('application/json');
   $tarefas = $db->query("SELECT * FROM compras INNER JOIN clientes ON compras.cliente_id = clientes.id ORDER BY compra_realizada ASC");
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
$app->get('/backup',function() use($dbName,$app){
    $date = time();
    $file = './backups/backup-'.$date . '.sql';
    echo exec("sqlite3 ".$dbName." .dump > ".$file);

   echo '<a href="/backups/'.$file.'">Download</a>';
});
$app->get('/list-backups',function() use($app){
    $files = array();
   foreach (glob("backups/*.sql") as $filename) {
          array_push($files, $filename);
   }
   echo json_encode($files);
});

// Deleta cliente
$app->delete('/cliente', function () use ($db,$response,$app) {
    $request = $app->request();
    $cliente_id = $request->delete('id');
    // para remover compras existentes do cliente
    $db->exec("DELETE FROM compras WHERE cliente_id=$cliente_id;");
    $response =$db->exec("DELETE FROM clientes WHERE id=$cliente_id;");
    echo $response; 
});
// Deleta compra
$app->delete('/compra', function () use($db,$response,$app) {
    $request = $app->request();
    $compra_id = $request->delete('id');
    // para remover compras existentes do cliente
    $response = $db->exec("DELETE FROM compras WHERE id=$compra_id;");
    echo $response; 
});

$app->run();
