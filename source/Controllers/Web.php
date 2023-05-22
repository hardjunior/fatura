<?php

namespace Source\Controllers;

use Source\Models\User;

class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if (!empty($_SESSION['user'])) {
            $this->router->redirect("pessoal.home");
        }
    }

    public function login(): void
    {
        $head = $this->seo->optimize(
            "Crie sua conta no " . site("name"),
            site("desc"),
            $this->router->route("web.login"),
            routeImage("Login")
        )->render();

        echo $this->view->render("theme/login", [
            "head" => $head
        ]);
    }

    public function register(): void
    {

        $head = $this->seo->optimize(
            "Faça Login para Continuar | " . site("name"),
            site("desc"),
            $this->router->route("web.register"),
            routeImage("Regiter")
        )->render();

        $form_user = new \stdClass();
        $form_user->first_name = "Ivamar Júnior";
        $form_user->last_name = null;
        $form_user->email = null;

        echo $this->view->render("theme/register", [
            "head" => $head,
            "user" => $form_user

        ]);
    }

    public function forget(): void
    {

        $head = $this->seo->optimize(
            "Recupere sua Senha | " . site("name"),
            site("desc"),
            $this->router->route("web.forget"),
            routeImage("forget")
        )->render();

        echo $this->view->render("theme/forget", [
            "head" => $head
        ]);
    }

    /**
     * Método de reset da senha para login
     *
     * @param  Array(get) $data
     * @return void
     */
    public function reset($data): void
    {
        if (empty($_SESSION['forget'])) {
            flash("info", "Informe seu E-MAIL para recuperar a senha");
            $this->router->redirect("web.forget");
        }

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);

        $errForget = "Não foi possível recuperar, tente novamente";

        if (!$email || !$forget) {
            flash("error", $errForget);
            $this->router->redirect("web.forget");
        }

        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();
        if (!$user) {
            flash("error", $errForget . " por gentileza");
            $this->router->redirect("web.forget");
        }

        $head = $this->seo->optimize(
            "Crie Sua Nova Senha | " . site("name"),
            site("desc"),
            $this->router->route("web.reset"),
            routeImage("Reset")
        )->render();

        echo $this->view->render("theme/reset", [
            "head" => $head
        ]);
    }

    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);

        $head = $this->seo->optimize(
            "Ooops {$error} | " . site("name"),
            site("desc"),
            $this->router->route("web.error", ["errcode" => $error]),
            routeImage($error)
        )->render();

        echo $this->view->render("theme/error", [
            "head" => $head,
            "error" => $error
        ]);
    }
    public function minificar(){
        /**
         * Minificar css
         */

        $minCss = new \MatthiasMullie\Minify\CSS();
        $minCss->add(DIR_ASSET . "/css/style.css");
        $minCss->add(DIR_ASSET . "/css/form.css");
        $minCss->add(DIR_ASSET . "/css/button.css");
        $minCss->add(DIR_ASSET . "/css/message.css");
        $minCss->add(DIR_ASSET . "/css/load.css");
        $minCss->minify(DIR_ASSET . "/style.min.css");


        /**
         * Minificar js
         */
        $minJs = new \MatthiasMullie\Minify\JS();
        $minJs->add(DIR_ASSET . "/js/jquery.js");
        $minJs->add(DIR_ASSET . "/js/jquery-ui.js");
        $minJs->minify(DIR_ASSET . "/scripts.min.js");

    }
}
