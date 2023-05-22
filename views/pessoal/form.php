<?php //dd($this);
$this->layout("theme/_themeApp", $this->data);  ?>

<div class="pa1ge">
    <?php if ($user->photo) : ?>
        <img class="page_use1r_photo" src="<?= $user->photo; ?>" alt="<?= $user->first_name; ?>" title="<?= $user->first_name; ?>" />
    <?php endif; ?>
    <h1>Olá <?= $user->first_name; ?>,</h1>
    <div class="row">
        <div class="col text-info ">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Resumo do Mês <?= $mes ?>
                </div>
                <ul class="list-group list-group-flush text-dark">
                    <li class="list-group-item">
                        <h5 class="card-title">Faturas</h5>
                    </li>
                    <li class="list-group-item text-left">
                        Total: <?= $total ?>
                    </li>
                    <li class="list-group-item text-left text-success">
                        Entrada: <?= $entrada ?>
                    </li>
                    <li class="list-group-item text-left text-danger">
                        Saída: <?= $saida ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col"></div>
    </div>


</div>