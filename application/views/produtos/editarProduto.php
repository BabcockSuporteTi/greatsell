<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Editar Produto</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal" >
                    <fieldset>
                        <legend>Dados do produto</legend>
                        <div class="control-group">
                            <?php echo form_hidden('idProdutos',$result->idProdutos) ?>
                            <label for="descricao" class="control-label">Descrição:</label>
                            <div class="controls">
                                <input class="grande" id="descricao" type="text" name="descricao" value="<?php echo $result->descricao; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="unidade" class="control-label">Unidade:</label>
                            <div class="controls">
                                <input class="pequeno" id="unidade" type="text" name="unidade" value="<?php echo $result->unidade; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Valores</legend>
                        <div class="control-group">
                            <label for="precoCompra" class="control-label">Preço de compra:</label>
                            <div class="controls">
                                <input id="precoCompra" class="dinheiro" type="text" name="precoCompra" value="R$ <?php echo number_format($result->precoCompra,2,",","."); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="precoVenda" class="control-label">Preço de venda:</label>
                            <div class="controls">
                                <input id="precoVenda" class="dinheiro" type="text" name="precoVenda" value="R$ <?php echo number_format($result->precoVenda,2,",","."); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="estoque" class="control-label">Estoque:</label>
                            <div class="controls">
                                <input id="estoque" type="number" name="estoque" value="<?php echo $result->estoque; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="estoqueMinimo" class="control-label">Estoque mínimo:</label>
                            <div class="controls">
                                <input id="estoqueMinimo" type="number" name="estoqueMinimo" value="<?php echo $result->estoqueMinimo; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3">
                                    <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                    <a href="<?php echo base_url() ?>index.php/produtos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

         </div>
     </div>
</div>


<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$ ", decimal:",", thousands:"."});

        $('#formProduto').validate({
            rules :{
                  descricao: { required: true},
                  unidade: { required: true},
                  precoCompra: { required: true},
                  precoVenda: { required: true},
                  estoque: { required: true},
                  estoqueMinimo:{ required: true}
            },
            messages:{
                  descricao: { required: 'Campo obrigatório'},
                  unidade: {required: 'Campo obrigatório'},
                  precoCompra: { required: 'Campo obrigatório'},
                  precoVenda: { required: 'Campo obrigatório'},
                  estoque: { required: 'Campo obrigatório'},
                  estoqueMinimo: {required: 'Campo obrigatório'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
    });
</script>




