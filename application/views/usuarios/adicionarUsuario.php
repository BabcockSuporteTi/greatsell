<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Usuário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <fieldset>
                        <legend>Dados Pessoais</legend>                    
                        <div class="control-group">
                            <label for="nome" class="control-label">Nome:</label>
                            <div class="controls">
                                <input id="nome" type="text" name="nome" value="<?php echo set_value('nome'); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="telefone" class="control-label">Telefone:</label>
                            <div class="controls">
                                <input id="telefone" type="text" name="telefone" value="<?php echo set_value('telefone'); ?>" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" />
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="rg" class="control-label">RG:</label>
                            <div class="controls">
                                <input id="rg" type="text" name="rg" value="<?php echo set_value('rg'); ?>"  />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="cpf" class="control-label">CPF:</label>
                            <div class="controls">
                                <input id="cpf" type="text" name="cpf" value="<?php echo set_value('cpf'); ?>"  />
                            </div>
                        </div>


                    </fieldset>
                    <fieldset>
                        <legend>Dados Para Acesso</legend>                    
                        <div class="control-group">
                            <label for="email" class="control-label">E-mail:</label>
                            <div class="controls">
                                <input id="email" type="text" name="email" value="<?php echo set_value('email'); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="senha" class="control-label">Senha:</label>
                            <div class="controls">
                                <input id="senha" type="password" name="senha" value="<?php echo set_value('senha'); ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label  class="control-label">Situação:</label>
                            <div class="controls">
                                <select name="situacao" id="situacao">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label  class="control-label">Permissões:</label>
                            <div class="controls">
                                <select name="permissoes_id" id="permissoes_id">
                                      <?php foreach ($permissoes as $p) {
                                          echo '<option value="'.$p->idPermissao.'">'.$p->nome.'</option>';
                                      } ?>
                                </select>
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="entidade" class="control-label">Entidade:</label>
                            <div class="controls">
                                <input id="entidade" type="number" name="entidade" value="<?php echo set_value('entidade'); ?>" />
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3">
                                    <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                    <a href="<?php echo base_url() ?>index.php/usuarios" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<script  src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.mask.min.js"/></script>
<script type="text/javascript">
      $(document).ready(function(){

           $('#formUsuario').validate({
            rules : {
                  nome:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true},
                  senha:{ required: true},
                  entidade:{ required: true}
            },
            messages: {
                  nome :{ required: 'Campo obrigatório'},
                  telefone:{ required: 'Campo obrigatório'},
                  email:{ required: 'Campo obrigatório'},
                  senha:{ required: 'Campo obrigatório'},
                  entidade:{ required: 'Campo obrigatório'}
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
           $("#telefone").mask("(00) 0000-00009");
      });
</script>




