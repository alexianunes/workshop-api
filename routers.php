<?php
global $routes;
$routes = array();

/* Endpoints Usuarios */
$routes['/usuarios/login'] = '/usuarios/login';
$routes['/usuarios/cadastrar'] = '/usuarios/cadastrar';
$routes['/usuarios/listar'] = '/usuarios/listar';
$routes['/usuarios/{id}'] = '/usuarios/retornar/:id';
