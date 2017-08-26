<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Serviço</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formServico" method="post" class="form-horizontal" >
                    <fieldset>
                        <legend>Dados do serviço</legend>
                        <div class="control-group">
                            <label for="nome" class="control-label">Nome:</label>
                            <div class="controls">
                                <input id="nome" type="text" name="nome" value="<?php echo set_value('nome'); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="descricao" class="control-label">Descrição:</label>
                            <div class="controls">
                                <input class="grande" id="descricao" type="text" name="descricao" value="<?php echo set_value('descricao'); ?>"  />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Valores</legend>
                        <div class="control-group">
                            <label for="preco" class="control-label">Preço:</label>
                            <div class="controls">
                                <input id="preco" class="dinheiro" type="text" name="preco" value="<?php echo set_value('preco'); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3">
                                    <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                    <a href="<?php echo base_url() ?>index.php/servicos" id="btnAdicionar" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("input.dinheiro").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
        $('#formServico').validate({
            rules: {
                nome: {required: true},
                preco: {required: true}
            },
            messages: {
                nome: {required: 'Campo obrigatório'},
                preco: {required: 'Campo obrigatório'}
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
    });
</script>





