<?php

$router = new \HardJunior\Route\Router(ROOT);
// use CoffeeCode\Router\Router;


// $router = new Router(site());
$router->namespace("Source\Controllers");
/**
 * 
 * Web
 */
$router->group(null);

$router->get("/", "Web:login", "web.login");
$router->get("/cadastrar", "Web:register", "web.register");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");
$router->get("/minificalizar", "Web:minificar", "web.minificar");

/**
 * AUTH
 */
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");

/**
 * AUTH SOCIAL
 */


/**
 * PROFILE
 */
$router->group("/pessoal");
$router->get("/", "PessoalController:home", "pessoal.home");
$router->get("/sair", "PessoalController:logoff", "pessoal.logoff");


/**
 * Fatura
 */
$router->group("/fatura");
$router->get("/", "FaturaController:index", "fatura.index");


/**
 * Venda
 */
$router->group("/venda");
$router->get("/", "VendaController:index", "venda.index");

/**
 * Anotação
 */
$router->group("/anotacao");
$router->get("/", "AnotacaoController:index", "anotacao.index");


/**
 * ERRORS
 */
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");

/**
 * ROUTE PROCESS
 */



/**
 * This method executes the routes
 */
$router->dispatch();

/*
 * Redirect all errors
 */
if (($router->error()) && (LOCAL == 'online')) {
    $router->redirect("web.error", ["errcode" => $router->error()]);
} else {
    echo $router->error();
    exit;
}
