<?php
// index.php — Roteamento manual básico

// Captura a URL requisitada (sem parâmetros de query)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove barra final opcional para padronizar
$requestUri = rtrim($requestUri, '/');

// Definição das rotas e callbacks
$routes = [
    '' => function () {
        echo "<h1>Página Inicial</h1>";
    },
    '/sobre' => function () {
        echo "<h1>Sobre Nós</h1><p>Informações da empresa...</p>";
    },
    '/contato' => function () {
        echo "<h1>Contato</h1><form><input placeholder='Seu nome'></form>";
    },
];

// Verifica se a rota existe
if (array_key_exists($requestUri, $routes)) {
    try {
        $routes[$requestUri](); // Executa a função associada
    } catch (Throwable $e) {
        http_response_code(500);
        echo "<h1>Erro interno</h1><pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    }
} else {
    // Página não encontrada
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
}
