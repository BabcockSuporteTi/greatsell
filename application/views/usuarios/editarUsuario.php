<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Usuário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <fieldset>
                        <legend>Dados Pessoais</legend>                    

                        <div class="control-group">
                            <?php echo form_hidden('idUsuarios',$result->idUsuarios) ?>
                            <label for="nome" class="control-label">Nome:</label>
                            <div class="controls">
                                <input id="nome" type="text" name="nome" value="<?php echo $result->nome; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="telefone" class="control-label">Telefone:</label>
                            <div class="controls">
                                <input id="telefone" type="text" name="telefone" value="<?php echo $result->telefone; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="rg" class="control-label">RG:</label>
                            <div class="controls">
                                <input id="rg" type="text" name="rg" value="<?php echo $result->rg; ?>"  />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="cpf" class="control-label">CPF:</label>
                            <div class="controls">
                                <input id="cpf" type="text" name="cpf" value="<?php echo $result->cpf; ?>"  />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Dados Para Acesso</legend>                    
                        <div class="control-group">
                            <label for="email" class="control-label">E-mail:</label>
                            <div class="controls">
                                <input id="email" type="text" name="email" value="<?php echo $result->email; ?>"  />
                                <span class="required">*</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="senha" class="control-label">Senha:</label>
                            <div class="controls">
                                <input id="senha" type="password" name="senha" value=""  placeholder="Não preencha se não quiser alterar."  />
                                <i class="icon-exclamation-sign tip-top" title="Se não quiser alterar a senha, não preencha esse campo."></i>
                            </div>
                        </div>

                        <div class="control-group">
                            <label  class="control-label">Situação:</label>
                            <div class="controls">
                                <select name="situacao" id="situacao">
                                    <?php if($result->situacao == 1){$ativo = 'selected'; $inativo = '';} else{$ativo = ''; $inativo = 'selected';} ?>
                                    <option value="1" <?php echo $ativo; ?>>Ativo</option>
                                    <option value="0" <?php echo $inativo; ?>>Inativo</option>
                                </select>
                                <span class="required">*</span>
                            </div>
                        </div>


                        <div class="control-group">
                            <label  class="control-label">Permissões:</label>
                            <div class="controls">
                                <select name="permissoes_id" id="permissoes_id">
                                      <?php foreach ($permissoes as $p) {
                                         if($p->idPermissao == $result->permissoes_id){ $selected = 'selected';}else{$selected = '';}
                                          echo '<option value="'.$p->idPermissao.'"'.$selected.'>'.$p->nome.'</option>';
                                      } ?>
                                </select>
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="entidade" class="control-label">Entidade:</label>
                            <div class="controls">
                                <input id="entidade" type="number" name="entidade" value="<?php echo $result->entidade; ?>" />
                                <span class="required">*</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="span12">
                                <div class="span6 offset3">
                                    <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
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
<script type="text/javascript">
      $(document).ready(function(){

           $('#formUsuario').validate({
            rules : {
                  nome:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true}
            },
            messages: {
                  nome :{ required: 'Campo obrigatório'},
                  telefone:{ required: 'Campo obrigatório'},
                  email:{ required: 'Campo obrigatório'}
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