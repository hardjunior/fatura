<?php

namespace Source\Controllers;

use HardJunior\Optimizer\Optimizer;

/**
 * Class Controller
 * @package Source\Controllers
 */
abstract class Controller
{
    /** * @var Engine   */
    protected $view;

    /** @var Router */
    protected $router;

    /** @var Optimizer*/
    protected $seo;

    /**
     * Controller Construtor
     * Fara o método do view a funcionar
     * e obtém o meio optimizer a funcinar
     * 
     * @param  $router
     */
    public function __construct($router = [])
    {
        $this->router = $router;
        $this->view   = new \League\Plates\Engine(DIR_VIEW, "php");
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(site("name"), site("locale"), "article")
            ->publisher(SOCIAL['facebook_page'], SOCIAL['facebook_author'])
            ->twitterCard(SOCIAL['twitter_creator'], SOCIAL['twitter_site'], site('domain'))
            ->facebook(SOCIAL['facebook_appId']);
    }

    /**
     * Função para transformar tudo em json
     *
     * @param  mixed $param
     * @param  mixed $values
     * @return string
     */
    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}
