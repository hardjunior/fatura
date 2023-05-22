<?php

namespace Source\Models;

use Exception;
use HardJunior\Datalayer\DataLayer;


/**
 * Class Anotacao
 * @package Source\Models
 */
class Anotacao extends DataLayer
{
    /**
     * Método construtor extendendo a Class DataLayer
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct("anotacao", ["id_users", "nome"]);
    }
}
