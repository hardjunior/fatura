<?php $this->layout("theme/_themeApp", $this->data); ?>

<div class="pa1ge">
    <?php if ($user->photo) : ?>
        <img class="page_use1r_photo" src="<?= $user->photo; ?>" alt="<?= $user->first_name; ?>" title="<?= $user->first_name; ?>" />
    <?php endif; ?>
    <h1>Olá <?= $user->first_name; ?>, estas em vendas.</h1>
    <p>Aqui é onde vamos listar e inserir as faturas, mas por enquanto a única coisa que você pode fazer é sair dela :P</p>
</div>