<html>
    <head>
        <title>Great Sell - Vendas</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <body style="background-color: transparent">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content" id="printOs">
                        <div class="invoice-content" style="padding: 5px 5px 0px 5px;">
                            <div class="invoice-head" style="margin-bottom: 0">
                                <table class="table-condensed">
                                    <tbody>
                                        <?php if ($emitente == null) { ?>
                                            <tr>
                                                <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/greatsell/emitente">Configurar</a><<<</td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td style="width: 20%;"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                                <td style="width: 60%;"> <span style="font-size: 20px; "> <?php echo $emitente[0]->nome; ?></span> <br><span style="font-size: 12px;" ><?php echo $emitente[0]->cnpj; ?> <br> <?php echo $emitente[0]->rua . ', nº:' . $emitente[0]->numero . ', ' . $emitente[0]->bairro . ' - ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> <br> <span style="font-size: 12px;"> E-mail: <?php echo $emitente[0]->email . ' - Fone: ' . $emitente[0]->telefone; ?></span></td>
                                                <td style="width: 20%; text-align: center">#Venda: <span ><?php echo $result->idVendas ?></span><br> <span>Emissão: <?php echo date('d/m/Y') ?></span></td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>

                                <table class="table" style="margin-bottom: 0px">
                                    <tbody style="font-size: 12px;" >
                                        <tr>
                                            <td style="width: 50%; padding-left: 0">
                                                <span style="font-size: 13px; font-weight: bold;">Cliente:</span>
                                                <span><?php echo $result->nomeCliente ?></span><br/>												
                                                <span>Telefone: <?php echo $result->clienteTelefone ?></span>

                                            </td>
                                            <td style="width: 50%; padding-left: 0">
                                                <span style="font-size: 13px; font-weight: bold;">Vendedor:</span>
                                                <span><?php echo $result->nome ?></span> <br/>
                                                <span>Telefone: <?php echo $result->telefone ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                            <div>
                                <?php if ($produtos != null) { ?>
                                    <hr style="margin: 0"/>
                                    <h6 style="text-align: center">Produtos</h6>
                                    <table class="table table-condensed" id="tblProdutos" style="margin-bottom: 5px; font-size: 10px;">
                                        <thead>
                                            <tr>
                                                <th>Descrição</th>
                                                <th style="text-align: right;">Valor unitário</th>
                                                <th style="text-align: right;">Quantidade</th>
                                                <th style="text-align: right;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 10px;">
                                            <?php
                                            $totalProdutos = 0;
                                            foreach ($produtos as $p) {
                                                $total = $p->valor_unitario * $p->quantidade;
                                                $totalProdutos = $totalProdutos + $total;
                                                echo '<tr>';
                                                echo '<td>' . $p->descricao . '</td>';
                                                echo '<td style="text-align: right;">R$ ' . number_format($p->valor_unitario, 2, ',', '.') . '</td>';
                                                echo '<td style="text-align: right;">' . $p->quantidade . '</td>';
                                                echo '<td style="text-align: right;">R$ ' . number_format($total, 2, ',', '.') . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="3" style="text-align: right">Total produtos:</td>
                                                <td style="text-align: right"><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.'); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                            <div>
                                <hr style="margin: 0"/>
                                <div>
                                    <label style="text-align: right">Produtos: R$ <?php echo number_format($result->valorTotal, 2, ",", "."); ?></label>
                                </div> 
                                <div>
                                    <label style="text-align: right">Desconto: R$ <?php echo number_format($result->desconto, 2, ",", "."); ?></label>
                                </div>
                                <div>
                                    <label style="text-align: right"><strong>Total: R$ <?php echo number_format($result->valorTotal - $result->desconto, 2, ",", "."); ?></strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>