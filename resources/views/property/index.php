<h1> Listagem de Progutos </h1>

<p><a href="<?=url('/imoveis/novo'); ?>" >Cadastrar novo Imovel</a></p>

<?php

if (!empty($properties)){

    }
    echo "<table>";

    echo "<tr>
                    <td>Titulo</td>
                    <td>Valor de Locação</td>
                    <td>Valor de Compra</td>
                    <td>Ações</td>
              </tr>";

    foreach ($properties as $property){

        $linkReadMode = url('/imoveis/'. $property->name);
        $linkEdit = url('/imoveis/editar/'. $property->name);
        $linkRemover = url('/imoveis/remover/'. $property->name);


        echo "<tr>
                      
                    <td>{$property->title}</td>
                    <td> R$ ". number_format($property->rental_price, 2, ',', '.') . "</td>
                    <td> R$ ". number_format($property->sale_price, 2, ',', '.') . "</td>
                    <td> <a href='{linkReadmode}'>Ver Mais </a> | <a href='{linkEdit}'>Editar </a> | <a href='{linkRemover}'>Remover </a></td>
              </tr>";


    echo "</table>";

}