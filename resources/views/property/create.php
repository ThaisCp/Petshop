<h1>Formulario de cadastro :: Imoveis </h1>

<form action="<?= url('/imoveis/store'); ?>" method="post">

    <?= csrf_field();?>


    <label for=""> Titulo do Imovel  </label>
    <input type="text" name="title" id="title">

    <br />

    <label for=""> Descrição  </label>
    <textarea name="description" id="description" cols="30"></textarea>

    <br />

    <label for=""> Valor da locação  </label>
    <input type="text" name="rental_price" id="rental_price">

    <br />

    <label for=""> Valor da Compra </label>
    <input type="text" name="sale_price" id="sale_price">

    <br />
    <button type="submit"> Cadastrar Imovel</button>

</form>