<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="icon-list"></i></span><h5>Dados do Produto</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 130px"><strong>Descrição: </strong></td>
                            <td><?php echo $result->descricao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Unidade:</strong></td>
                            <td><?php echo $result->unidade ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de compra:</strong></td>
                            <td>R$ <?php echo number_format($result->precoCompra,2,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de venda:</strong></td>
                            <td>R$ <?php echo number_format($result->precoVenda,2,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque:</strong></td>
                            <td><?php echo $result->estoque; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque mínimo:</strong></td>
                            <td><?php echo $result->estoqueMinimo; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
