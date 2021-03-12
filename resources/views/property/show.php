<h1>Pagina Single</h1>

<?php

if (!empty($property)){

     foreach ($property as $prop){
         ?>

        <h2>Titulo do Imovel: <?= $prop->title; ?></h2>

        <p>Descrição <?= $prop->description; ?></p>

        <p>Valor Locação R$: <?= number_format($prop->rental_price, 2, ',', '.'); ?></p>

        <p> Valor Venda R$: <?= number_format($prop->sale_price, 2, ',', '.'); ?></p>
        <?php
    }
}