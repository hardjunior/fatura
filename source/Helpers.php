<?php

/**
 * site
 *
 * @param  string null $param
 * @return string
 */
function site(string $param = null): string
{
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }
    return SITE["root"];
}


/**
 * asset
 *
 * @param  string $path
 * @param  bool $time
 * @return string
 */
function asset(string $path, $time = true): string
{
    $separator = (strpos($path, "/") === 0) ? '' : '/';

    $file = HOST_ASSET . $separator . $path;
    $fileOnDir = DIR_ASSET . $separator . $path;
    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}

function flash(string $type = null, string $message = null, string $icon = null): ?string
{
    // if ($type && $message && $icon){
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
            // "icon"=>$icon
        ];
        return null;
    }
    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash["type"]}\">{$flash["message"]}</div>";
    }
    return null;
}

/**
 * Criar uma imagem temporária
 *
 * @param  mixed $imageUrl
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "https://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}


/**
 *    ################
 *    ###   date   ###
 *    ################
 */
function diferencaTimestamp($data_inicial, $data_final)
{
    $data1 = new DateTime($data_inicial); // data inicial
    $data2 = new DateTime($data_final); // data final

    return $data1->diff($data2); // calcula a diferença entre as datas
    // echo "Diferença: " . $intervalo->h . " horas"; // exibe a diferença em horas
}

function validateDate($date, $format = 'Y-m-d H:i')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function mes_estenso($mes)
{
    $diames = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    return $diames[intval($mes)];
}

function mes_est_abr($mes)
{
    $diames = array('', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
    return $diames[intval($mes)];
}

function dia_semana($dia)
{
    $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'erro');
    if (!(isset($dia))) {
        die($dia);
    }

    return $diasemana[intval($dia)];
    /* xxxxxxxxxxxxx.---------------xxxxxxxxxxxxxxx-------------------fol_ajust_ext----fol_ext----- pow_torico --- map_servico----*/
}
function dia_sem_abr($dia)
{
    $diasemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'erro');
    if (!(isset($dia))) {
        die($dia);
    }

    return $diasemana[intval($dia)];
    /* xxxxxxxxxxxxx.---------------xxxxxxxxxxxxxxx-------------------fol_ajust_ext----fol_ext----- pow_torico --- map_servico----*/
}

function abr_dia_sem($dia)
{
    $diasemana = array('Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom', 'erro');
    if (!(isset($dia))) {
        die($dia);
    }

    return $diasemana[intval($dia)];
    /* xxxxxxxxxxxxx.---------------xxxxxxxxxxxxxxx-------------------fol_ajust_ext----fol_ext----- pow_torico --- map_servico----*/
}