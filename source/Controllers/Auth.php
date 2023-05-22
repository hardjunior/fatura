<?php

namespace Source\Controllers;

use Source\Models\User;
use Source\Support\Email;

class Auth extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * Valida entrada de dados e verifica usuário existente
     * Com a confirmação deverá enviar para página inicial
     *
     * @param  Array(post) $data
     * @return void
     */
    public function login($data): void
    {
        $email = FILTER_VAR($data['email'], FILTER_VALIDATE_EMAIL);
        $passwd = FILTER_VAR($data['passwd'], FILTER_DEFAULT);

        if (!$email || !$passwd) {

            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu e-mail e senha para logar"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();

        if (!$user || !password_verify($passwd, $user->passwd)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "E-mail ou senha informados não conferem"
            ]);
            return;
        }

        $_SESSION['user'] = $user->id;

        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("pessoal.home")]);
    }


    public function register($data): void
    {
        $dados = (object) filter_var_array($data, FILTER_DEFAULT);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para se registar!"
            ]);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Se faz favor preencha com um email válido"
            ]);
            return;
        }

        $user = new User();
        $user->first_name = $dados->first_name;
        $user->last_name = $dados->last_name;
        $user->email = $dados->email;
        $user->passwd = $dados->passwd;
        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("pessoal.home")
        ]);
    }

    /**
     * forget
     *
     * @param  Array(post) $data
     * @return void
     */
    public function forget($data): void
    {
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe o SEU E-MAIL para recuperar a senha"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O E-MAIL informado não é registado"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION['forget'] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . site("name"),
            $this->view->render("emails/recover", [
                "user" => $user,
                "link" => $this->router->route("web.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();

        flash("sucess", "Enviamos um link de recuperação para seu e-mail");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.forget")
        ]);
    }

    /**
     * reset
     *
     * @param  mixed $data
     * @return void
     */
    public function reset($data): void
    {
        if (empty($_SESSION['forget']) || !$user = (new User())->findById($_SESSION['forget'])) {
            flash("error", "Não foi possível recuperar, tente novamente");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.forget")
            ]);
            return;
        }

        if (empty($data['password']) || empty($data['password_re'])) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe e repita sua nova senha"
            ]);
            return;
        }

        if ($data['password'] != $data['password_re']) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você informou duas senhas diferentes"
            ]);
            return;
        }

        $user->passwd = $data["password"];
        $user->forget = null;

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        unset($_SESSION['forget']);

        flash("success", "Sua senha foi atualizada com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);
    }
}
