<?php


namespace Config;

use App\Filters\ApiFiltro;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/sobre', 'Home::sobre');

// Rotas de login
$routes->get('/login', 'Home::login');
$routes->post('/admin/logar', 'Admin/Autenticacao::logar');

// Rotas de cadastro
// $routes->get('/cadastrar', 'Home::cadastrar');
// $routes->post('/admin/cadastro', 'Admin/Autenticacao::cadastrar');

$routes->group('admin', ['filter' => 'admin'], function($routes){
    $routes->get('painel', 'Admin/Painel::painel');
    $routes->get('motoristas', 'Admin/Motorista::motoristas');
    $routes->get('linhas', 'Admin/Linha::linhas');
    $routes->get('empresa', 'Admin/Empresa::empresa');
    $routes->get('suporte', 'Admin/Suporte::suporte');
    $routes->get('horarios', 'Admin/Horario::horarios');
    // $routes->get('documentos', 'Admin/Documentos::documentacao');

    $routes->post('horarios', 'Admin/Horario::horarios');

    // Controllers de cadastro
    $routes->post('motoristas/salvar', "Admin\Motorista::salvar");
    $routes->post('linhas/salvar', "Admin\Linha::salvar");
    $routes->post('horarios/salvar', "Admin\Horario::salvar");
    $routes->post('horarios/salvarlocal', "Admin\Horario::salvarLocal");

    // Controllers de alteração
    $routes->get("motoristas/(:num)" , "Admin\Motorista::motoristas/$1");
    $routes->get("linhas/(:num)" , "Admin\Linha::linhas/$1");
    $routes->get("empresa/(:num)" , "Admin\Empresa::empresa/$1");
    $routes->get("horarios/(:num)" , "Admin\Horario::horarios/$1");
    $routes->get("suporte/(:num)" , "Admin\Suporte::suporte/$1");

    // Controllers de exclusão
    $routes->get("motoristas/remover/(:num)" , "Admin\Motorista::remover/$1");
    $routes->get("linhas/remover/(:num)" , "Admin\Linha::remover/$1");
    $routes->get("horarios/remover/(:num)" , "Admin\Horario::remover/$1");
    $routes->get("suporte/remover/(:num)" , "Admin\Suporte::remover/$1");

    //deslogar
    $routes->get("sair", "Admin/Autenticacao::sair");
});

// Grupo de rotas da API
$routes->group('api', ['filter' => ApiFiltro::class], function($routes){
    $routes->get('listarcards', 'API/Requests::listarCards');
    $routes->get('suporte', 'API/Requests::listarSuporte');
    $routes->get('localizacaolinha', 'API/Requests::localizacaoLinha');
    $routes->get('listarmotorista', 'API/Requests::listarMotorista');
    $routes->get('listarlinhasapp', 'API/Requests::listarLinhaApp');

    $routes->post('cadastrolocalizacao', 'API/Requests::cadastroLocalizacao');
    $routes->post('loginmotorista', 'API/Requests::loginMotorista');
    $routes->post('loginusuario', 'API/Requests::loginUsuario');
    $routes->post('cadastrousuario', 'API/Requests::cadastroUsuario');
    $routes->post('listardadosmotorista', 'API/Requests::listarDadosMotorista');
    $routes->post('listarhorarios', 'API/Requests::listarHorarios');
    $routes->post('listarsuporteapp', 'API/Requests::listarSuporteApp');
    $routes->post('pedidosuporteapp', 'API/Requests::pedidoSuporteApp');
    $routes->post('alterarsenha', 'API/Requests::alterarSenhaApp');
    $routes->post('excluirconta', 'API/Requests::excluirContaApp');
});

$routes->get('api/negada', 'API/Requests::negada');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
