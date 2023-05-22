<?php

namespace Source\Models;

use Exception;
use HardJunior\Datalayer\DataLayer;

/**
 * Class User
 * @package Source\Models
 */
class User extends DataLayer
{
    /**
     * Método construtor extendendo a Class DataLayer
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "passwd"], "id");
    }

    public function save(): bool
    {
        if (
            !$this->validateEmail()
            || !$this->validatePassword()
            || !parent::save()
        ) {
            return false;
        }
        return true;
    }

    public function validateEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um email válido");
            return false;
        }

        $userByEmail = null;

        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O e-mail informado já está em uso");
            return false;
        }
        return true;
    }


    public function validatePassword(): bool
    {
        if (empty($this->passwd) || (mb_strlen(trim($this->passwd)) < 5)) {
            $this->fail = new Exception("Informe uma senha com pelo menos 5 Caracteres");
            return false;
        }

        if (password_get_info($this->passwd)["algo"]) {
            return true;
        }

        $this->passwd = password_hash($this->passwd, PASSWORD_DEFAULT);
        return true;
    }
}
