<div class="row-fluid" style="margin-top: 0">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Listágem rápida</h5>
            </div>
            <div class="widget-content">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url()?>index.php/relatorios/produtosRapid"><i class="icon-barcode"></i> <small>Todos os produtos</small></a></li>
                    <li><a href="<?php echo base_url()?>index.php/relatorios/produtosRapidMin"><i class="icon-barcode"></i> <small>Com estoque mínimo</small></a></li>
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="span8">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Filtros</h5>
            </div>
            <div class="widget-content">
                <div class="span12 well">
                    <form action="<?php echo base_url() ?>index.php/relatorios/produtosCustom" method="get">
                        <div class="span12 well-small">
                            <div class="span6">
                                <label for="">Venda de:</label>
                                <input type="text" name="precoInicial" class="span6 money" />
                            </div>
                            <div class="span6">
                                <label for="">até:</label>
                                <input type="text"  name="precoFinal" class="span6 money" />
                            </div>
                        </div>
                        <div class="span12 well-small" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Estoque de:</label>
                                <input type="text" name="estoqueInicial" class="span6" />
                            </div>
                            <div class="span6">
                                <label for="">até:</label>
                                <input type="text" name="estoqueFinal" class="span6" />
                            </div>
                        </div>
                        <div class="span12" style="margin-left: 0; text-align: center">
                            <input type="reset" class="btn" value="Limpar" />
                            <button class="btn btn-inverse"><i class="icon-print icon-white"></i> Imprimir</button>
                        </div>
                    </form>
                </div>
                .
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});      
    });
</script>