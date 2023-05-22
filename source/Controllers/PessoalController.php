<?php

namespace Source\Controllers;

use Source\Models\User;

class PessoalController extends Controller
{
    /** @var User */
    protected $user;

    public function __construct($router)
    {
        parent::__construct($router);
        // dd($_SESSION);
        // if (empty($_SESSION['user']))
        //     dump(1);
        // if (gettype($_SESSION['user']) != 'integer')
        //     dump(2);
        // if (!$this->user = (new User())->findById($_SESSION['user']))
        //     dump(3);
        // dd(4);
        if (empty($_SESSION['user']) || (gettype($_SESSION['user']) != 'integer')  || (!$this->user = (new User())->findById($_SESSION['user']))) {
            // dd("pessoal", __LINE__, $_SESSION, $this);
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }

    public function home($dados): void
    {
        $head = $this->seo->optimize(
            "Bem-vindo(a) {$this->user->first_name} | " . site("name"),
            site("desc"),
            $this->router->route("pessoal.home"),
            routeImage("Conta de {$this->user->first_name}")
        )->render();

        $dados = (object) filter_var_array($dados, FILTER_DEFAULT);

        $resumoFaturas = $this->getResumoFaturas($dados);
        $total = $resumoFaturas->total ?? '';
        $entrada = $resumoFaturas->entrada ?? '';
        $saida = $resumoFaturas->saida ?? '';

        // echo $this->view->addData([
        //     "head" => $head,
        //     "user" => $this->user,
        //     "total" => $total,
        //     "entrada" => $entrada,
        //     "saida" => $saida,
        //     "mes" => mes_estenso(date("m")),
        // ]);

        echo $this->view->render("pessoal/form", [
            "head" => $head,
            "user" => $this->user,
            "total" => $total,
            "entrada" => $entrada,
            "saida" => $saida,
            "mes" => mes_estenso(date("m")),
        ]);
        exit;
    }

    public function logoff(): void
    {
        unset($_SESSION['user']);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect("web.login");
    }

    public function getResumoFaturas($dados)
    {
        $rf = new \stdClass();
        $rf->total = 200;
        $rf->entrada = 400;
        $rf->saida = 200;
        return $rf;
    }
}
