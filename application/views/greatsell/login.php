<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Great Sell</title>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h2>
                <span>Faça login</span> 
                <i> ou solicite um acesso </i> 
                <a href="#">aqui</a>
            </h2>
            <span class="log-close"> </span>
            <div class="login-bottom">
                <form id="formLogin" method="post">
                    <?php if ($this->session->flashdata('error') != null) { ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                    <div class="text">
                        <input type="text" placeholder="E-mail" required="" id="email" name="email"/>
                        <span class="men"></span>
                        <div class="clear"> </div>
                    </div>
                    <div class="text">		
                        <input type="password" placeholder="Senha" required="" name="senha"/>
                        <span class="pass"></span>
                        <div class="clear"> </div>
                    </div>
                    <div class="remember">
                        <div class="remember-top">
                            <a href="#">Esqueceu sua senha?</a>
                            <span class="checkbox1">
                                <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Me mantenha conectado</label>
                            </span>
                        </div>
                        <div class="send">
                            <input type="submit" value="Entrar">
                        </div>
                        <div class="clear"> </div>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/validate.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#email').focus();
                $("#formLogin").validate({
                     rules :{
                          email: { required: true},
                          senha: { required: true}
                    },
                    messages:{
                          email: { required: 'Campo Requerido.'},
                          senha: {required: 'Campo Requerido.'}
                    },
                   submitHandler: function( form ){       
                         var dados = $( form ).serialize();
                        $.ajax({
                          type: "POST",
                          url: "<?php echo base_url(); ?>index.php/greatsell/verificarLogin?ajax=true",
                          data: dados,
                          dataType: 'json',
                          success: function(data)
                          {
                            if(data.result == true){
                                window.location.href = "<?php echo base_url(); ?>index.php/greatsell";
                            }
                            else{
                                $('#call-modal').trigger('click');
                            }
                          }
                          });

                          return false;
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
                
                $('.log-close').on('click', function(c){
                    $('.login').fadeOut('slow', function(c){
                        $('.login').remove();
                    });
                });
            });

        </script>

        <a href="#notification" id="call-modal" role="button" class="btn" data-toggle="modal" style="display: none ">notification</a>

        <div id="notification" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">Great Sell</h4>
          </div>
          <div class="modal-body">
            <h5 style="text-align: center">Falha no acesso, tente novamente.</h5>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fechar</button>
          </div>
        </div>
    </body>
</html>