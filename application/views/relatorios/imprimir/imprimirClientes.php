<html>
    <head>
        <title>Great Sell - Relação de Clientes</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title">
                            <h4 style="text-align: center">Relação de Clientes</h4>
                        </div>
                        <div class="widget-content nopadding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($clientes as $c) {
                                        echo '<tr>';
                                        echo '<td>' . $c->nomeCliente . '</td>';
                                        echo '<td>' . $c->telefone . '</td>';
                                        echo '<td>' . $c->email . '</td>';
                                        echo '<td>' . $c->documento . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h5 style="text-align: right">Sitação em: <?php echo date('d/m/Y'); ?></h5>
                </div>
            </div>
        </div>
</html>