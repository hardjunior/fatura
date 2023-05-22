<?php

namespace Source\Controllers;

use Source\Models\User;

class FaturaController extends Controller
{
    /** @var User */
    protected $user;

    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION['user']) || (gettype($_SESSION['user']) != 'integer')  || !$this->user = (new User)->findById($_SESSION['user'])) {

            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
    }

    public function index(): void
    {

        $head = $this->seo->optimize(
            "Bem-vindo(a) {$this->user->first_name} | " . site("name"),
            site("desc"),
            $this->router->route("fatura.index"),
            routeImage("Conta de {$this->user->first_name}")
        )->render();

        echo $this->view->render("fatura/form", [
            "head" => $head,
            "user" => $this->user
        ]);
        exit;
    }

    public function logoff(): void
    {
        unset($_SESSION['user']);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect("web.login");
    }
}
