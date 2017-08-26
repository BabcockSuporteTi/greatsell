<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do cliente</a></li>
            <li><a data-toggle="tab" href="#tab2">Ordens de serviço</a></li>
            <div class="buttons">
                <?php
                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                    echo '<a title="Icon Title" class="btn btn-mini btn-info" href="' . base_url() . 'index.php/clientes/editar/' . $result->idClientes . '"><i class="icon-pencil icon-white"></i> Editar</a>';
                }
                ?>
            </div>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 100px">
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span class="icon"><i class="icon-list"></i></span><h5>Dados pessoais</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 100px"><strong>Nome:</strong></td>
                                        <td><?php echo $result->nomeCliente ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>CPF ou CNPJ:</strong></td>
                                        <td><?php echo $result->documento ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Cadastrado em:</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($result->dataCadastro)) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Telefone:</strong></td>
                                        <td><?php echo $result->telefone ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Celular:</strong></td>
                                        <td><?php echo $result->celular ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>E-mail:</strong></td>
                                        <td><?php echo $result->email ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span class="icon"><i class="icon-list"></i></span><h5>Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 100px"><strong>Rua:</strong></td>
                                        <td><?php echo $result->rua ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Número:</strong></td>
                                        <td><?php echo $result->numero ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Bairro:</strong></td>
                                        <td><?php echo $result->bairro ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Cidade:</strong></td>
                                        <td><?php echo $result->cidade ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>CEP:</strong></td>
                                        <td><?php echo $result->cep ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 100px">
        <?php if (!$results) { ?>
                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Data inicial</th>
                            <th>Descricao</th>
							<th>Placa</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    </tbody>
                </table>
<?php } else { ?>
                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Data inicial</th>
                            <th>Descricao</th>                            
							<th>Placa</th>
                            <th>Status</th>
                            <th>Faturado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results as $r) {
                            $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                            if ($r->faturado == 1) {
                                $faturado = 'Sim';
                            } else {
                                $faturado = 'Não';
                            }
                            echo '<tr>';
                            echo '<td>' . $r->idOs . '</td>';
                            echo '<td>' . $dataInicial . '</td>';
                            echo '<td>' . $r->descricaoProduto . '</td>';
							echo '<td>' . $r->placa . '</td>';
                            echo '<td>' . $r->status . '</td>';
                            echo '<td>' . $faturado . '</td>';
                            echo '<td>';
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                                echo '<a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                echo '<a href="' . base_url() . 'index.php/os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
<?php } ?>
        </div>
    </div>
</div>