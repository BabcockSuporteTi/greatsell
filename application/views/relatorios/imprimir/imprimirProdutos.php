<html>
    <head>
        <title>Great Sell - Relação de Produtos</title>
        <meta charset="UTF-8" />       
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body style="background-color: transparent">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h4 style="text-align: center">Relação de Produtos</h4>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Unidade</th>
                                        <th style="text-align: right">Compra (R$)</th>
                                        <th style="text-align: right">Venda (R$)</th>
                                        <th style="text-align: right">Estoque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($produtos as $p) {
                                        echo '<tr>';
                                        echo '<td>' . $p->descricao . '</td>';
                                        echo '<td>' . $p->unidade . '</td>';
                                        echo '<td style="text-align: right">' . number_format($p->precoCompra, 2, ',', '.') . '</td>';
                                        echo '<td style="text-align: right">' . number_format($p->precoVenda, 2, ',', '.') . '</td>';
                                        echo '<td style="text-align: right">' . $p->estoque . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <h5 style="text-align: right">Situação em: <?php echo date('d/m/Y'); ?></h5>
                </div>
            </div>
        </div>
    </body>
</html>

