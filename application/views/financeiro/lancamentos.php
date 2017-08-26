<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<?php
$situacao = $this->input->get('situacao');
$periodo = $this->input->get('periodo');
$id_os = $this->input->get('id_os');
$dataInicial = $this->input->get('dataInicial');
$dataFinal = $this->input->get('dataFinal');
$id_venda = $this->input->get('id_venda');
?>
<style type="text/css">
    label.error{
        color: #b94a48;
    }
    input.error{
        border-color: #b94a48;
    }
    input.valid{
        border-color: #5bb75b;
    }
</style>

<?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aLancamento')) { ?>
    <div class="span5" style="margin-left: 0">
        <a href="#modalReceita" data-toggle="modal" role="button" class="btn btn-success tip-bottom" title="Cadastrar receita"><i class="icon-plus icon-white"></i> Receita</a>  
        <a href="#modalReceitaOs" data-toggle="modal" role="button" class="btn btn-success tip-bottom" title="Cadastrar receita OS"><i class="icon-plus icon-white"></i> Receita OS</a>  
        <a href="#modalDespesa" data-toggle="modal" role="button" class="btn btn-danger tip-bottom" title="Cadastrar despesa"><i class="icon-plus icon-white"></i> Despesa</a>
    </div>
<?php } ?>

<div class="span7" style="margin-left: 0">
    <form action="<?php echo base_url() . 'index.php/financeiro/lancamentos'; ?>" method="get" >
        <div class="span9" style="margin-left: 0">
            <div class="span4">
                <label>Situação <i class="icon-info-sign tip-top" title="Lançamentos com situação específica ou todos."></i></label>
                <select name="situacao" class="span12">
                    <option value="todos">Todos</option>
                    <option value="previsto" 
                        <?php if ($situacao == 'previsto') {
                            echo 'selected';
                        } ?>>Previsto</option>
                    <option value="atrasado" 
                        <?php if ($situacao == 'atrasado') {
                            echo 'selected';
                        } ?>>Atrasado</option>
                    <option value="realizado" <?php if ($situacao == 'realizado') {
                            echo 'selected';
                        } ?>>Realizado</option>
                    <option value="pendente" <?php if ($situacao == 'pendente') {
                            echo 'selected';
                        } ?>>Pendente</option>
                </select>
            </div>
            <div class="span4">
                <label>Número da OS <i class="icon-info-sign tip-top" title="Lançamentos pelo número da OS."></i></label>
                <input name="id_os" class="span12" value="<?php echo $id_os; ?>"/>
            </div>
            <div class="span4">
                <label>Número da venda <i class="icon-info-sign tip-top" title="Lançamentos pelo número da venda."></i></label>
                <input name="id_venda" class="span12" value="<?php echo $id_venda; ?>"/>
            </div>
        </div>
        <div class="span9" style="margin-left: 0">
            <div class="span4">
                <label for="">De:</label>
                <input type="date" name="dataInicial" class="span12" value="<?php echo $dataInicial; ?>"/>
            </div>
            <div class="span4">
                <label for="">Até:</label>
                <input type="date" name="dataFinal" class="span12" value="<?php echo $dataFinal; ?>"/>
            </div>
            <div class="span4" >
                &nbsp
                <button type="submit" class="span12 btn btn-primary">Filtrar</button>
            </div>
        </div>	
        <input id="periodo" type="hidden" name="periodo" value="todos"/>		
    </form>
</div>

<div class="span12" style="margin-left: 0;">
<?php if (!$results) { ?>
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Lançamentos financeiros</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Tipo</th>
                            <th>OS</th>	
                            <th>Venda</th>	
                            <th>Cliente ou Fornecedor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9">Nenhuma lançamento encontrado</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php } else { ?>
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Lançamentos financeiros</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered " id="divLancamentos">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Tipo</th>
                            <th>OS</th>	
                            <th>Venda</th>	
                            <th>Cliente ou Fornecedor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalReceita = 0;
                        $totalDespesa = 0;
                        $saldo = 0;
                        foreach ($results as $r) {
                            $vencimento = date(('d/m/Y'), strtotime($r->data_vencimento));
                            if ($r->baixado == 0) {
                                $status = 'Pendente';
                            } else {
                                $status = 'Pago';
                            }
                            if ($r->tipo == 'receita') {
                                $label = 'success';
                                $totalReceita += $r->valor;
                            } else {
                                $label = 'important';
                                $totalDespesa += $r->valor;
                            }
                            echo '<tr>';
                            echo '<td>' . $r->idLancamentos . '</td>';
                            echo '<td><span class="label label-' . $label . '">' . ucfirst($r->tipo) . '</span></td>';
                            if ($r->idOs == null) {
                                echo '<td></td>';
                            } else {
                                echo '<td> <a href="' . base_url() . 'index.php/os/visualizar/'. $r->idOs .'" title="'.$r->descricaoProduto.'">#'.$r->idOs.'</td>';
                            }
                            if ($r->idVendas == null) {
                                echo '<td></td>';
                            } else {
                                echo '<td> <a href="' . base_url() . 'index.php/vendas/visualizar/'. $r->idVendas . '" title="'.$r->observacao.'">#'.$r->idVendas.'</td>';
                            }
                            echo '<td>' . $r->cliente_fornecedor . '</td>';
                            echo '<td>' . $vencimento . '</td>';
                            echo '<td>' . $status . '</td>';
                            echo '<td> R$ ' . number_format($r->valor, 2, ',', '.') . '</td>';

                            echo '<td>';
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eLancamento')) {
                                $data_pagamento_local = date('d/m/Y', strtotime($r->data_pagamento));
                                if (empty($r->data_pagamento)){
                                    $data_pagamento_local = "";
                                }
                                echo '<a href="#modalEditar" style="margin-right: 1%" data-toggle="modal" role="button" idLancamento="' . $r->idLancamentos . '" descricao="' . $r->descricao . '" valor="R$ ' . number_format($r->valor, 2, ',', '.') . '" vencimento="' . date('d/m/Y', strtotime($r->data_vencimento)) . '" pagamento="' . $data_pagamento_local . '" baixado="' . $r->baixado . '" cliente="' . $r->cliente_fornecedor . '" formaPgto="' . $r->forma_pgto . '" tipo="' . $r->tipo . '" idVendas="'. $r->idVendas.'" idOs="'. $r->idOs.'" class="btn btn-info tip-top editar" title="Editar Lançamento"><i class="icon-pencil icon-white"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dLancamento')) {
                                echo '<a href="#modalExcluir" data-toggle="modal" role="button" idLancamento="' . $r->idLancamentos . '" class="btn btn-danger tip-top excluir" title="Excluir Lançamento"><i class="icon-remove icon-white"></i></a>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" style="text-align: right; color: green"> <strong>Total Receitas:</strong></td>
                            <td colspan="2" style="text-align: left; color: green"><strong>R$ <?php echo number_format($totalReceita, 2, ',', '.') ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: right; color: red"> <strong>Total Despesas:</strong></td>
                            <td colspan="2" style="text-align: left; color: red"><strong>R$ <?php echo number_format($totalDespesa, 2, ',', '.') ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: right"> <strong>Saldo:</strong></td>
                            <td colspan="2" style="text-align: left;"><strong>R$ <?php echo number_format($totalReceita - $totalDespesa, 2, ',', '.') ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

    <?php echo $this->pagination->create_links();
} ?>

<!-- Modal nova receita -->
<div id="modalReceita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formReceita" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceita" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Adicionar receita</h3>
        </div>
        <div class="modal-body">
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <label for="descricao">Descrição: </label>
                <input class="span12" id="descricao" type="text" name="descricao"  />
                <input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
            </div>	
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="cliente">Cliente: <span class="required">*</span></label>
                    <input class="span12" id="cliente" type="text" name="cliente"  />
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor:  <span class="required">*</span></label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" />	
                    <input class="span12 dinheiro" id="valor" type="text" name="valor"  />
                </div>
                <div class="span4" >
                    <label for="vencimento">Vencimento:  <span class="required">*</span></label>
                    <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
                </div>
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Pago:</label>
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
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-success">Adicionar Receita</button>
        </div>
    </form>
</div>

<!-- Modal nova despesa -->
<div id="modalDespesa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formDespesa" action="<?php echo base_url() ?>index.php/financeiro/adicionarDespesa" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Adicionar despesa</h3>
        </div>
        <div class="modal-body">
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <label for="descricao">Descrição: <span class="required">*</span></label>
                <input class="span12" id="descricao" type="text" name="descricao"  />
                <input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
            </div>	
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="fornecedor">Fornecedor ou Empresa: <span class="required">*</span></label>
                    <input class="span12" id="fornecedor" type="text" name="fornecedor"  />
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor: <span class="required">*</span></label>
                    <input type="hidden"  name="tipo" value="despesa" />	
                    <input class="span12 dinheiro"  type="text" name="valor"  />
                </div>
                <div class="span4" >
                    <label for="vencimento">Vencimento: <span class="required">*</span></label>
                    <input class="span12 datepicker"  type="text" name="vencimento"  />
                </div>
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Pago:</label>
                </div>
                <div class="span4" style="margin-left: 0">
                    &nbsp <input id="pago" type="checkbox" name="pago" value="1" /> 
                </div>
            </div>
            <div class="span12" style="margin-left: 0"> 
                <div id="divPagamento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="pagamento">Pagamento:</label>
                        <input class="span12 datepicker" id="pagamento" type="text" name="pagamento" />	
                    </div>

                    <div class="span6">
                        <label for="formaPgto">Forma:</label>
                        <select name="formaPgto"  class="span12">
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
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Adicionar Despesa</button>
        </div>
    </form>
</div>

<!-- Modal editar lançamento -->
<div id="modalEditar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formEditar" action="<?php echo base_url() ?>index.php/financeiro/editar" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Editar lançamento</h3>
        </div>
        <div class="modal-body">
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <label for="descricao">Descrição: </label>
                <input class="span12" id="descricaoEditar" type="text" name="descricao"  />
                <input id="urlAtualEditar" type="hidden" name="urlAtual" value=""  />
            </div>  
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="fornecedor">Cliente ou Fornecedor:</label>
                    <input class="span12" id="fornecedorEditar" type="text" name="fornecedor"  />
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor: </label>
                    <input type="hidden"  name="tipo" value="despesa" />  
                    <input type="hidden"  id="idEditar" name="id" value="" /> 
                    <input class="span12 dinheiro"  type="text" name="valor" id="valorEditar" />
                </div>
                <div class="span4" >
                    <label for="vencimento">Vencimento:</label>
                    <input class="span12 datepicker"  type="text" name="vencimento" id="vencimentoEditar"  />
                </div>
                <div class="span4" style="margin-left: 0">
                    <label for="pago">Pago: </label>
                </div>
                <div class="span4" style="margin-left: 0">
                    &nbsp <input id="pagoEditar" type="checkbox" name="pago" value="1" /> 
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div id="divPagamentoEditar" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="pagamento">Pagamento: </label>
                        <input class="span12 datepicker" id="pagamentoEditar" type="text" name="pagamento" />  
                    </div>

                    <div class="span6">
                        <label for="formaPgto">Forma:</label>
                        <select name="formaPgto" id="formaPgtoEditar"  class="span12">
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
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar">Cancelar</button>
            <button class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>


<!-- Modal Excluir lançamento-->
<div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Excluir lançamento</h3>
    </div>
    <div class="modal-body">
        <h5 style="text-align: center">Deseja excluir esse lançamento?</h5>
        <input name="id" id="idExcluir" type="hidden" value="" />
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
        <button class="btn btn-danger" id="btnExcluir">Excluir lançamento</button>
    </div>
</div>


<!-- Modal nova receita da ordem de serviço-->
<div id="modalReceitaOs" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formReceitaOs" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceitaOs" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Adicionar nova receita de uma OS</h3>
        </div>
        <div class="modal-body">
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <label for="numeroOs">Número da OS: </label>
                <input class="span12" id="numeroOs" type="text" name="numeroOs"  />
                <input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
            </div>	
            <div class="span12" style="margin-left: 0; padding: 5px;"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor:  <span class="required">*</span></label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" />	
                    <input class="span12 dinheiro" id="valor" type="text" name="valor"  />
                </div>
                <div class="span4" >
                    <label for="vencimentoOs">Vencimento:  <span class="required">*</span></label>
                    <input class="span12 datepicker" id="vencimentoOs" type="text" name="vencimentoOs"  />
                </div>
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Pago:</label>
                </div>
                <div class="span4" style="margin-left: 0">
                    &nbsp <input id="recebidoOs" type="checkbox" name="recebidoOs" value="1" /> 
                </div>
            </div>
            <div class="span12" style="margin-left: 0; padding: 5px;"> 

                <div id="divRecebimentoOs" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="recebimento">Recebimento:</label>
                        <input class="span12 datepicker" id="recebimentoOs" type="text" name="recebimentoOs" />	
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
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-success">Adicionar Receita</button>
        </div>
    </form>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("input.dinheiro").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
        $('#pago').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divPagamento').show();
            } else {
                $('#divPagamento').hide();
            }
        });


        $('#recebido').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimento').show();
            } else {
                $('#divRecebimento').hide();
            }
        });
		
        $('#recebidoOs').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimentoOs').show();
            } else {
                $('#divRecebimentoOs').hide();
            }
        });
		
        $('#pagoEditar').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divPagamentoEditar').show();
            } else {
                $('#divPagamentoEditar').hide();
            }
        });


        $("#formReceita").validate({
            rules: {
                descricao: {required: true},
                cliente: {required: true},
                valor: {required: true},
                vencimento: {required: true}

            },
            messages: {
                descricao: {required: 'Campo Requerido.'},
                cliente: {required: 'Campo Requerido.'},
                valor: {required: 'Campo Requerido.'},
                vencimento: {required: 'Campo Requerido.'}
            }
        });
		
        $("#formReceitaOs").validate({
            rules: {
                numeroOs: {required: true},
                valor: {required: true},
                vencimentoOs: {required: true}

            },
            messages: {
                numeroOs: {required: 'Campo Requerido.'},
                valor: {required: 'Campo Requerido.'},
                vencimentoOs: {required: 'Campo Requerido.'}
            }
        });
        $("#formDespesa").validate({
            rules: {
                descricao: {required: true},
                fornecedor: {required: true},
                valor: {required: true},
                vencimento: {required: true}

            },
            messages: {
                descricao: {required: 'Campo Requerido.'},
                fornecedor: {required: 'Campo Requerido.'},
                valor: {required: 'Campo Requerido.'},
                vencimento: {required: 'Campo Requerido.'}
            }
        });

        $(document).on('click', '.excluir', function (event) {
            $("#idExcluir").val($(this).attr('idLancamento'));
        });

        $(document).on('click', '.editar', function (event) {
            $("#idEditar").val($(this).attr('idLancamento'));
            $("#descricaoEditar").val($(this).attr('descricao'));
            $("#fornecedorEditar").val($(this).attr('cliente'));
            $("#valorEditar").val($(this).attr('valor'));
            $("#vencimentoEditar").val($(this).attr('vencimento'));
            $("#pagamentoEditar").val($(this).attr('pagamento'));
            $("#formaPgtoEditar").val($(this).attr('formaPgto'));
            $("#tipoEditar").val($(this).attr('tipo'));
            $("#urlAtualEditar").val($(location).attr('href'));
            var baixado = $(this).attr('baixado');
            if (baixado == 1) {
                $("#pagoEditar").attr('checked', true);
                $("#divPagamentoEditar").show();
            } else {
                $("#pagoEditar").attr('checked', false);
                $("#divPagamentoEditar").hide();
            }
            if ($(this).attr('idOs') !== "" || $(this).attr('idVendas') !== ""){
                document.getElementById("descricaoEditar").readOnly = true;
                document.getElementById("fornecedorEditar").readOnly = true;
            } else {
                document.getElementById("descricaoEditar").readOnly = false;
                document.getElementById("fornecedorEditar").readOnly = false;
            }
        });

        $(document).on('click', '#btnExcluir', function (event) {
            var id = $("#idExcluir").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/financeiro/excluirLancamento",
                data: "id=" + id,
                dataType: 'json',
                success: function (data)
                {
                    if (data.result == true) {
                        $("#btnCancelExcluir").trigger('click');
                        $("#divLancamentos").html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
                        $("#divLancamentos").load($(location).attr('href') + " #divLancamentos");

                    } else {
                        $("#btnCancelExcluir").trigger('click');
                        alert('Ocorreu um erro ao tentar excluir produto.');
                    }
                }
            });
            return false;
        });
        $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});
    });
</script>