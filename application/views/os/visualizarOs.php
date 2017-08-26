<?php $totalServico = 0; $totalProdutos = 0; ?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Ordem de serviço</h5>
                <div class="buttons">
                    <?php
                    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="' . base_url() . 'index.php/os/editar/' . $result->idOs . '"><i class="icon-pencil icon-white"></i> Editar</a>';
                    }
                    echo '<a target="_blank" id="imprimir" title="Imprimir" class="btn btn-mini btn-inverse" href="' . base_url() . 'index.php/relatorios/imprimirOrdemServico/' . $result->idOs . '"><i class="icon-print icon-white"></i> Imprimir</a>';                    
                    ?>
                </div>
            </div>
            
            <div class="widget-content" id="printOs" >
                <div class="invoice-content" style="padding: 5px 5px 0px 5px;">
                    <div class="invoice-head" style="margin-bottom: 0">
                        <table class="table-condensed">
                            <tbody>
                                <?php if ($emitente == null) { ?>
                                    <tr>
                                        <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td style="width: 10%"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                        <td> <span style="font-size: 20px; "> <?php echo $emitente[0]->nome; ?></span> </br><span style="font-size: 12px;" ><?php echo $emitente[0]->cnpj; ?> </br> <?php echo $emitente[0]->rua . ', nº:' . $emitente[0]->numero . ', ' . $emitente[0]->bairro . ' - ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> </br> <span style="font-size: 12px;"> E-mail: <?php echo $emitente[0]->email . ' - Fone: ' . $emitente[0]->telefone; ?></span></td>
                                        <td style="width: 20%; text-align: center">Protocolo: #<span ><?php echo $result->idOs ?></span><br><span>Emissão: <?php echo date('d/m/Y') ?></span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <table class="table" style="margin-bottom: 0px">
                            <tbody style="font-size: 12px;" >
                                <tr>
                                    <td style="width: 50%; padding:0px;">
                                        <ul>
                                            <li>
                                                <span style="font-size: 13px; font-weight: bold;">Cliente: </span>		
                                                <span><?php echo $result->nomeCliente ?></span><br/>												
                                                <span>Telefone: <?php echo $result->clienteTelefone ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 50%; padding:0px;">
                                        <ul>
                                            <li>
                                                <span style="font-size: 13px; font-weight: bold;">Responsável: </span> 
                                                <span><?php echo $result->nome ?></span> <br/>
                                                <span>Telefone: <?php echo $result->telefone ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div style="margin-top: 0; padding-top: 0">
                        <?php if ($result->descricaoProduto != null) { ?>
                        <hr style="margin: 0">
                        <span style="font-weight: bold;">Descrição: </span> <br/> 
                        <pre style="font-size: 11px; padding: 0px;"><?php echo $result->descricaoProduto ?></pre>
                        <?php } if ($result->observacoes != null) { ?>
                        <hr style="margin: 0"/>
                        <span style="font-weight: bold;">Observação: </span> <br/>
                        <pre style="font-size: 11px; padding: 0px;"><?php echo $result->observacoes ?> </pre>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if ($produtos != null) { ?>
                        <hr style="margin: 0"/>
                        <h5 style="text-align: center">Produtos</h5>
                            <table class="table table-condensed" id="tblProdutos"  style="margin-bottom: 5px;">
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
                        <?php if ($servicos != null) { ?>
                        <hr style="margin: 0"/>
                        <label style="text-align: center"> <strong>Serviços</strong></label>
                        <table class="table table-condensed" id="tblServicos" style="margin-bottom: 5px;">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th style="text-align: right; font-size: 10px;">Valor unitário</th>
                                        <th style="text-align: right;">Quantidade</th>
                                        <th style="text-align: right;">Total</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    <?php
                                    $totalServicos = 0;
                                    foreach ($servicos as $s) {
                                        $total = $s->valor_unitario * $s->quantidade;
                                        $totalServicos = $totalServicos + $total;
                                        echo '<tr>';
                                        echo '<td>' . $s->descricao . '</td>';
                                        echo '<td style="text-align: right;">R$ ' . number_format($s->valor_unitario, 2, ',', '.') . '</td>';
                                        echo '<td style="text-align: right;">' . $s->quantidade . '</td>';
                                        echo '<td style="text-align: right;">R$ ' . number_format($total, 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" style="text-align: right">Total serviços:</td>
                                        <td style="text-align: right"><strong>R$ <?php echo number_format($totalServicos, 2, ',', '.'); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div> 
                    <div>
                        <hr style="margin: 0"/>
                        <div>
                            <label style="text-align: right">Produtos e serviços: R$ <?php echo number_format($result->valorTotal, 2, ",", "."); ?></label>
                        </div> 
                        <div>
                            <label style="text-align: right">Desconto: R$ <?php echo number_format($result->desconto , 2, ",", "."); ?></label>
                        </div>
                        <div>
                            <label style="text-align: right"><strong>Total: R$ <?php echo number_format($result->valorTotal - $result->desconto , 2, ",", "."); ?></strong></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>