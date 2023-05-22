<?php


use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use HardJunior\FirePHP\FirePHP;

/**
 * Sistema hardjunior
 * @author Ivamar Junior <https://hardjunior.ddns.net>
 *
 * [ PHP Basic Config ] Configurações basicas do sistema
 * Document content and charset
 * Configura o timezone da aplicação
 * Horário de lisboa
 */
/** Inicia sessão */
if ((session_status() != PHP_SESSION_ACTIVE) || (!isset($_SESSION))) {

    session_cache_expire(3600); //em minutos
    $remote_addr = $_SERVER['REMOTE_ADDR'] ?? '';
    $http_user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    session_name(md5('seg' . $remote_addr . $http_user_agent));
    // Definir tempo de vida da sessão em 1 hora (3600 segundos)
    ini_set('session.gc_maxlifetime', 3600);

    // Definir tempo de vida do cookie da sessão em 1 hora (3600 segundos)
    session_set_cookie_params(3600);

    session_start();
}

defined(define('HTTP', $_SERVER['PROTO'] ?? 'https'));

defined(define("DIR_BASE", dirname(__DIR__, 1)));
defined(define("DIR_SUB", dirname(__DIR__, 2)));
define("HOST_BASE", $_SERVER['PROTO'] . "://" . $_SERVER['HTTP_HOST']);

//Definições do website por .ini
try {
    $_ENV = parse_ini_file(DIR_SUB . DIRECTORY_SEPARATOR . "faustino.ini", true);
    foreach ($_ENV as $chave => $valor) {
        defined(define($chave, $valor));
    }
} catch (\Exception $e) {
    throw new \Exception("<p>&nbps;</p><p><center><h1>Erro ao obter constantes!<br><u>" . $e . "</1></center></p>");
}
define("DIR_ASSET", DIR_BASE . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets");
define("HOST_ASSET", HOST_BASE . DIRECTORY_SEPARATOR . "assets");

define("DIR_VIEW", DIR_BASE . DIRECTORY_SEPARATOR . "views");

/**
 * SITE CONFIG
 */
defined(define("ROOT", HTTP . "://" . $_SERVER['HTTP_HOST']));
define("SITE", [
    "name" => SITE_DEFAULT['name'],
    "desc" => SITE_DEFAULT['descricao'],
    "domain" => SITE_DEFAULT['domain'],
    "root" => ROOT
]);


/**
 * SITE MINIGY
 */
// if (($_SERVER['REMOTE_ADDR'] == '127.0.0.1') or ($_SERVER['REMOTE_ADDR'] == '::1') || ($_ENV['ipremote'] == $_SERVER['REMOTE_ADDR'])) {
if (($_SERVER['REMOTE_ADDR'] == '127.0.0.1') or ($_SERVER['REMOTE_ADDR'] == '::1') || (true)) {
    error_reporting(E_ALL);
    define("LOCAL", "offline");
    // Debug::enable();

    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();

    /**
     * Sends the given data to the FirePHP Firefox Extension.
     * The data can be displayed in the Firebug Console or in the
     * "Server" request tab.
     * @see http://www.firephp.org/Wiki/Reference/Fb
     * @param mixed $Object
     * @return true
     * @throws Exception
     */
    function fb()
    {
        $instance = FirePHP::getInstance(true);

        $args = func_get_args();
        return call_user_func_array(array($instance, 'FB'), $args);
    }
} else {
    ErrorHandler::register();
    error_reporting(0);
    define("LOCAL", "online");
}

/**
 * DATABASE CONNECT
 */
define('PRETB', "");
define("CONFIG_DB", [
    "driver" => DB['driver'],
    "host" => DB['host_db'],
    "port" => DB['port_db'],
    "dbname" => DB['database'],
    "username" => DB['user_db'],
    "passwd" => DB['pass_db'],
    "options" => [
        1002 => "SET NAMES 'UTF8'", //PDO::MYSQL_ATTR_INIT_COMMAND
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * SOCIAL CONFIG
 */
define("SOCIAL", [
    "facebook_page" => SOCIAL_DEFAULT['facebook_page'],
    "facebook_author" => SOCIAL_DEFAULT['facebook_author'],
    "facebook_appId" => SOCIAL_DEFAULT['facebook_appid'],
    "twitter_creator" => SOCIAL_DEFAULT['twitter_creater'],
    "twitter_site" => SOCIAL_DEFAULT['twitter_site']
]);

/**
 * MAIL CONNECT
 */
// $usuario = "automati1co@gtfs.sgot.pt";
// $host = substr(strstr($usuario, "@"), 1);

define("MAIL", [
    "host" => MAIL_DEFAULT['host'],
    "port" => MAIL_DEFAULT['port'],
    "user" => MAIL_DEFAULT['user'],
    "passwd" => MAIL_DEFAULT['passwd'],
    "from_name" => MAIL_DEFAULT['from_name'],
    "from_email" => MAIL_DEFAULT['from_email']
]);


/**
 * SOCIAL LOGIN: FACEBOOK
 */
define("FACEBOOK_LOGIN", []);


/**
 * SOCIAL LOGIN: GOOGLE
 */
define("GOOGLE_LOGIN", []);
