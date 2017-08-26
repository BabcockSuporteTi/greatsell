<?php if (!isset($dados) || $dados == null) { ?>
    <div class="row-fluid" style="margin-top:0">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                    </span>
                    <h5>Dados do emitente</h5>
                </div>
                <div class="widget-content ">
                    <div class="alert alert-danger">É necessário cadastrar o emitente.</div>
                    <a href="#modalCadastrar" data-toggle="modal" role="button" class="btn btn-success">Cadastrar Dados</a>
                </div>
            </div>    

        </div>
    </div>
    <div id="modalCadastrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?php echo base_url(); ?>index.php/greatsell/cadastrarEmitente" id="formCadastrar" enctype="multipart/form-data" method="post" class="form-horizontal" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Cadastrar dados do emitente</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label for="nome" class="control-label">Razão Social:<span class="required">*</span></label>
                    <div class="controls">
                        <input id="nome" type="text" name="nome" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="cnpj" class="control-label">CNPJ: <span class="required">*</span></label>
                    <div class="controls">
                        <input class="" type="text" name="cnpj" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">IE: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="ie" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Logradouro: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="logradouro" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Número: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="numero" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Bairro: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="bairro" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Cidade: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="cidade" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">UF: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="uf" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Telefone: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="telefone" value=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">E-mail: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" name="email" value="" />
                    </div>
                </div>

                <div class="control-group">
                    <label for="logo" class="control-label">Logomarca: <span class="required">*</span></label>
                    <div class="controls">
                        <input type="file" name="userfile" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
                <button class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <div class="row-fluid" style="margin-top:0">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                    </span>
                    <h5>Dados do emitente</h5>
                </div>
                <div class="widget-content ">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 25%"><img src=" <?php echo $dados[0]->url_logo; ?> "></td>
                                <td> <span style="font-size: 20px; "> <?php echo $dados[0]->nome; ?> </span> </br><span><?php echo $dados[0]->cnpj; ?> </br> <?php echo $dados[0]->rua . ', nº:' . $dados[0]->numero . ', ' . $dados[0]->bairro . ' - ' . $dados[0]->cidade . ' - ' . $dados[0]->uf; ?> </span> </br> <span> E-mail: <?php echo $dados[0]->email . ' - Fone: ' . $dados[0]->telefone; ?></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#modalAlterar" data-toggle="modal" role="button" class="btn btn-primary">Alterar dados</a>
                    <a href="#modalLogo" data-toggle="modal" role="button" class="btn btn-inverse">Alterar logo</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modalAlterar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?php echo base_url(); ?>index.php/greatsell/editarEmitente" id="formAlterar" enctype="multipart/form-data" method="post" class="form-horizontal" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="">Editar dados do emitente</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label for="nome" class="control-label">Razão social:</label>
                    <div class="controls">
                        <input class="medio" id="nome" type="text" name="nome" value="<?php echo $dados[0]->nome; ?>"  />
                        <input id="nome" type="hidden" name="id" value="<?php echo $dados[0]->id; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cnpj" class="control-label">CNPJ:</label>
                    <div class="controls">
                        <input class="medio" type="text" name="cnpj" value="<?php echo $dados[0]->cnpj; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">IE:</label>
                    <div class="controls">
                        <input class="pequeno" type="text" name="ie" value="<?php echo $dados[0]->ie; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Logradouro:</label>
                    <div class="controls">
                        <input type="text" name="logradouro" value="<?php echo $dados[0]->rua; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Número:</label>
                    <div class="controls">
                        <input class="pequeno" type="text" name="numero" value="<?php echo $dados[0]->numero; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Bairro:</label>
                    <div class="controls">
                        <input type="text" name="bairro" value="<?php echo $dados[0]->bairro; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Cidade:</label>
                    <div class="controls">
                        <input type="text" name="cidade" value="<?php echo $dados[0]->cidade; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">UF:</label>
                    <div class="controls">
                        <input class="pequeno" type="text" name="uf" value="<?php echo $dados[0]->uf; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">Telefone:</label>
                    <div class="controls">
                        <input type="text" name="telefone" value="<?php echo $dados[0]->telefone; ?>"  />
                        <span class="required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="descricao" class="control-label">E-mail:</label>
                    <div class="controls">
                        <input type="text" name="email" value="<?php echo $dados[0]->email; ?>" />
                        <span class="required">*</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
                <button class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>

    <div id="modalLogo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?php echo base_url(); ?>index.php/greatsell/editarLogo" id="formLogo" enctype="multipart/form-data" method="post" class="form-horizontal" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="">Alterar logo</h3>
            </div>
            <div class="modal-body">
                <div class="span12 alert alert-info">Tamanho indicado (130px por 130px).</div>
                <div>
                    <label for="logo" class="control-label" style="width: 18px; padding-top: 5px;"><span class="required">Logo:</span></label>
                    <div class="controls" style="margin-left: 40px;">
                        <input type="file" name="userfile" value="" />
                        <input id="nome" type="hidden" name="id" value="<?php echo $dados[0]->id; ?>"  />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
                <button class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $("#formLogo").validate({
            rules: {
                userfile: {required: true}
            },
            messages: {
                userfile: {required: 'Campo obrigatório.'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });


        $("#formCadastrar").validate({
            rules: {
                userfile: {required: true},
                nome: {required: true},
                cnpj: {required: true},
                ie: {required: true},
                logradouro: {required: true},
                numero: {required: true},
                bairro: {required: true},
                cidade: {required: true},
                uf: {required: true},
                telefone: {required: true},
                email: {required: true}
            },
            messages: {
                userfile: {required: 'Campo obrigatório.'},
                nome: {required: 'Campo obrigatório.'},
                cnpj: {required: 'Campo obrigatório.'},
                ie: {required: 'Campo obrigatório.'},
                logradouro: {required: 'Campo obrigatório.'},
                numero: {required: 'Campo obrigatório.'},
                bairro: {required: 'Campo obrigatório.'},
                cidade: {required: 'Campo obrigatório.'},
                uf: {required: 'Campo obrigatório.'},
                telefone: {required: 'Campo obrigatório.'},
                email: {required: 'Campo obrigatório.'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });


        $("#formAlterar").validate({
            rules: {
                userfile: {required: true},
                nome: {required: true},
                cnpj: {required: true},
                ie: {required: true},
                logradouro: {required: true},
                numero: {required: true},
                bairro: {required: true},
                cidade: {required: true},
                uf: {required: true},
                telefone: {required: true},
                email: {required: true}
            },
            messages: {
                userfile: {required: 'Campo obrigatório.'},
                nome: {required: 'Campo obrigatório.'},
                cnpj: {required: 'Campo obrigatório.'},
                ie: {required: 'Campo obrigatório.'},
                logradouro: {required: 'Campo obrigatório.'},
                numero: {required: 'Campo obrigatório.'},
                bairro: {required: 'Campo obrigatório.'},
                cidade: {required: 'Campo obrigatório.'},
                uf: {required: 'Campo obrigatório.'},
                telefone: {required: 'Campo obrigatório.'},
                email: {required: 'Campo obrigatório.'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>