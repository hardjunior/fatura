<?php $this->layout("theme/_themeApp", $this->data); ?>

<div class="pag1e">
  <?php if ($user->photo) : ?>
    <img class="page_user_photo" src="<?= $user->photo; ?>" alt="<?= $user->first_name; ?>" title="<?= $user->first_name; ?>" />
  <?php endif; ?>
  <form class="needs-validation" novalidate action="#" method="post">
    <div class="container form-row body">
      <div class="row">
        <div class=" col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="form-group">
            <label for="entidade">Entidade</label>
            <select class="custom-select" name="entidade" id="entidade">
              <option selected disabled value="">Escolha...</option>
              <option value=""></option>
              <option value="novo"></option>
            </select>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="form-group">
            <label for="pagamento">Pagamento</label>
            <select class="custom-select" name="pagamento" id="pagamento">
              <option selected disabled value="">Escolha...</option>
              <option value=""></option>
              <option value="novo"></option>
            </select>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
          <label for="share">Partilha</label>
          <select class="custom-select" id="share" required>
            <option selected disabled value="">Escolha...</option>
            <option value="novo"></option>
          </select>
          <div class="invalid-tooltip">
            Please select a valid state.
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="form-group">
            <label for="type">Entrada/Saída</label>
            <select class="custom-select" name="type" id="type">
              <option selected disabled value="">Escolha...</option>
              <option value="e">Entrada</option>
              <option value="s">Saída</option>
            </select>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="form-group">
            <label for="repetir">Repetir</label>
            <select class="custom-select" name="repetir" id="repetir">
              <option selected disabled value="">Escolha...</option>
              <option value="s">Sim</option>
              <option value="n">Não</option>
            </select>
          </div>
        </div>

      </div>
    </div>
    <hr class='bg-light'>
    <div class="footer float-right">
      <button class="btn btn-success" type="submit">Submit form</button>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <!-- <h1>Olá <?= $user->first_name; ?>, estas em fatura.</h1>
    <p>Aqui é onde vamos listar e inserir as faturas, mas por enquanto a única coisa que você pode fazer é sair dela :P</p> -->
  </form>
</div>