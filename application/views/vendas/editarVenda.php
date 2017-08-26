<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery.price_format.2.0.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar venda</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da venda</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab">Produtos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="span12" id="divEditarVenda">                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formVendas">
                                    <?php echo form_hidden('idVendas', $result->idVendas) ?>
                                    <div class="span12" style="padding-left: 1%; margin-left: 0">
                                        <h3 style="margin-top: 0">#Protocolo: <?php echo $result->idVendas ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataFinal">Data: <span class="required">*</span></label>
                                            <input id="dataVenda" class="span12 datepicker" type="text" name="dataVenda" value="<?php echo date('d/m/Y', strtotime($result->dataVenda)); ?>"  />
                                        </div>
                                        <div class="span5" >
                                            <label for="cliente">Cliente: <span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>"  />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>"  />
                                            <input id="valorTotal" type="hidden" name="valorTotal" value=""  />
                                        </div>
                                        <div class="span5" style="padding-right: 1%">
                                            <label for="tecnico">Vendedor: <span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->nome ?>"  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span12">
                                            <label for="descricaoProduto">Observação: </label>
                                            <textarea class="span12" name="observacao" id="observacao" cols="35" rows="4"><?php echo $result->observacao ?></textarea>
                                        </div>
                                    </div>
                                    <div id="divTotais">
                                        <div class="span12" style="padding: 1%; margin-left: 0">
                                            <div class="span3">  
                                                <label for="valorTotal">Total produtos: </label>
                                                <input class="span12 dinheiro" readonly="true" id="valorTotal" type="text" name="valorTotal" value="R$ <?php echo number_format($result->valorTotal , 2, ",", "."); ?>"  />
                                            </div>
                                            <div class="span3">  
                                                <label for="valorDesconto">Desconto: </label>
                                                <input class="span12 dinheiro" id="valorDesconto" type="text" name="valorDesconto" value="R$ <?php echo number_format($result->desconto , 2, ",", "."); ?>"  />
                                            </div>
                                        </div>
                                        <div class="span12" style="padding: 1%; margin-left: 0">
                                            <div class="span4"> 
                                                <?php $totalGeral = $result->valorTotal - $result->desconto; ?>
                                                <label><strong> Total geral: R$ <?php echo number_format($totalGeral , 2, ",", "."); ?> </strong></label>
                                                <input type="hidden" id="total-geral" value="<?php echo number_format($totalGeral, 2); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span8 offset2" style="text-align: center">
                                            <?php if ($result->faturado == 0) { ?>
                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="icon-file"></i> Faturar</a>
                                            <?php } ?>
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/vendas/visualizar/<?php echo $result->idVendas; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar Venda</a>
                                            <a href="<?php echo base_url() ?>index.php/vendas" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--Produtos-->
                        <div class="tab-pane" id="tab2">
                            <div class="span12 well" style="padding: 1%; margin-left: 0">
                                <form id="formProdutos" action="<?php echo base_url() ?>index.php/vendas/adicionarProduto" method="post">
                                    <div class="span6">
                                        <input type="hidden" name="idProduto" id="idProduto" />
                                        <input type="hidden" name="idVendasProduto" id="idVendasProduto" value="<?php echo $result->idVendas ?>" />
                                        <input type="hidden" name="estoque" id="estoque" value=""/>
                                        <label for="">Produto: </label>
                                        <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                    </div>
                                    <div class="span2">
                                        <label for="">Valor unitário: </label>
                                        <input type="text" class="dinheiro span12" placeholder="Valor unitário" id="valorUnitario" name="valorUnitario"/>
                                    </div>
                                    <div class="span2">
                                        <label for="">Quantidade: </label>
                                        <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" />
                                    </div>
                                    <div class="span2">
                                        &nbsp;
                                        <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="span12" id="divProdutos" style="margin-left: 0">
                                <table class="table table-bordered" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Valor unitário</th>
                                            <th>Quantidade</th>
                                            <th>Total</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($produtos as $p) {
                                            $total = $total + ($p->quantidade * $p->valor_unitario);
                                            echo '<tr>';
                                            echo '<td>' . $p->descricao . '</td>';
                                            echo '<td>R$ ' . number_format($p->valor_unitario, 2, ',', '.');
                                            echo '<td>' . $p->quantidade . '</td>';
                                            echo '<td>R$ ' . number_format($p->quantidade * $p->valor_unitario, 2, ',', '.') . '</td>';
                                            echo '<td><a href="" idAcao="' . $p->idItens . '" prodAcao="' . $p->idProdutos . '" quantAcao="' . $p->quantidade . '" idVendas="' . $result->idVendas . '" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?><input type="hidden" id="total-venda" value="<?php echo number_format($total, 2); ?>"></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
            </div>
        </div>
    </div>
</div>

<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formFaturar" action="<?php echo current_url() ?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Faturar venda</h3>
        </div>
        <div class="modal-body">
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <label for="descricao">Descrição: </label>
                <input class="span12" id="descricao" readonly="true" type="text" name="descricao" value="Fatura da venda #<?php echo $result->idVendas; ?> "  />
            </div>  
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="cliente">Cliente: </label>
                    <input class="span12" id="cliente" readonly="true" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                    <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
                    <input type="hidden" name="vendas_id" id="vendas_id" value="<?php echo $result->idVendas; ?>">
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor: </label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" /> 
                    <input class="span12 dinheiro" id="valor" type="text" name="valor"/>
                </div>
                <div class="span4" >
                    <label for="vencimento">Vencimento:</label>
                    <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
                </div>
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Pago: </label>
                </div>
                <div class="span4" style="margin-left: 0">
                    &nbsp <input id="recebido" type="checkbox" name="recebido" value="1" /> 
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div id="divRecebimento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="recebimento">Recebimento:</label>
                        <input class="span12 datepicker" id="recebimento" type="text" name="recebimento" /> 
                    </div>
                    <div class="span6">
                        <label for="formaPgto">Pagamento:</label>
                        <select name="formaPgto" id="formaPgto" class="span12">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Boleto">Boleto</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Débito">Débito</option>        
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
            <button class="btn btn-primary">Faturar</button>
        </div>
    </form>
</div>


<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});

        $('#recebido').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimento').show();
            } else {
                $('#divRecebimento').hide();
            }
        });

        $(document).on('click', '#btn-faturar', function (event) {
            event.preventDefault();
            valor = $('#total-geral').val();
            valor = valor.replace(',', '');
            $('#valor').val(valor).priceFormat({
                    prefix: 'R$ ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
        });

        $("#formFaturar").validate({
            rules: {
                descricao: {required: true},
                cliente: {required: true},
                valor: {required: true},
                vencimento: {required: true}

            },
            messages: {
                descricao: {required: 'Campo obrigatório.'},
                cliente: {required: 'Campo obrigatório.'},
                valor: {required: 'Campo obrigatório.'},
                vencimento: {required: 'Campo obrigatório.'}
            },
            submitHandler: function (form) {
                var dados = $(form).serialize();
                $('#btn-cancelar-faturar').trigger('click');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/vendas/faturar",
                    data: dados,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            window.location.reload(true);
                        } else {
                            alert('Ocorreu um erro ao tentar faturar a venda.');
                            $('#progress-fatura').hide();
                        }
                    }
                });

                return true;
            }
        });

        $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteProduto",
            minLength: 2,
            select: function (event, ui) {
                $("#idProduto").val(ui.item.id);
                $("#estoque").val(ui.item.estoque);
                $("#valorUnitario").val(ui.item.preco).priceFormat({
                    prefix: 'R$ ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
                $("#quantidade").focus();
                if (ui.item.id === "-1") {
                    $("#produto").val('');
                    $("#idProduto").val('');
                    $("#idProduto").cleanData();
                    $("#valorUnitario").val('');
                }
            }
        });

        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function (event, ui) {
                $("#clientes_id").val(ui.item.id);
                if (ui.item.id === "-1") {
                    $("#cliente").val('');
                    $("#clientes_id").val('');
                    $("#clientes_id").cleanData();
                }
            }
        });

        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function (event, ui) {
                $("#usuarios_id").val(ui.item.id);
                if (ui.item.id === "-1") {
                    $("#tecnico").val('');
                    $("#usuarios_id").val('');
                    $("#usuarios_id").cleanData();
                }
            }
        });

        $("#formVendas").validate({
            rules: {
                cliente: {required: true},
                tecnico: {required: true},
                dataVenda: {required: true}
            },
            messages: {
                cliente: {required: 'Campo obrigatório.'},
                tecnico: {required: 'Campo obrigatório.'},
                dataVenda: {required: 'Campo obrigatório.'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        $("#formProdutos").validate({
            rules: {
                produto: {required: true},
                quantidade: {required: true},
                valorUnitario: {required: true}
            },
            messages: {
                produto: {required: 'Campo obrigatório.'},
                quantidade: {required: 'Campo obrigatório.'},
                valorUnitario: {required: 'Campo obrigatório.'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            submitHandler: function (form) {
                var quantidade = parseFloat($("#quantidade").val());
                var estoque = parseFloat($("#estoque").val());
                if (estoque < quantidade) {
                    alert('Você não possui estoque suficiente.');
                } else {
                    var dados = $(form).serialize();
                    $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/vendas/adicionarProduto",
                        data: dados,
                        dataType: 'json',
                        success: function (data) {
                            if (data.result == true) {
                                $("#quantidade").val('');
                                $("#idProduto").val('');
                                $("#valorUnitario").val('');
                                $("#produto").val('').focus();
                            } else {
                                alert(data.msg);
                            }
                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                            $("#divTotais").load("<?php echo current_url(); ?> #divTotais", function(){
                                $("#valorDesconto").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                            });
                        }
                    });
                    return false;
                }
            }
        });

        $(document).on('click', 'a', function (event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            var idVendas = $(this).attr('idVendas');
            if ((idProduto % 1) == 0) {
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/vendas/excluirProduto",
                    data: "idProduto=" + idProduto + "&quantidade=" + quantidade + "&produto=" + produto + "&idVendas=" + idVendas,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                            $("#divTotais").load("<?php echo current_url(); ?> #divTotais", function(){
                                $("#valorDesconto").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                            });
                        } else {
                            alert('Ocorreu um erro ao tentar excluir produto.');
                        }
                    }
                });
                return false;
            }
        });
        $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});
    });
</script>

