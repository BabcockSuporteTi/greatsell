<?php
class Vendas extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('greatsell/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('vendas_model', '', TRUE);
        $this->data['menuVendas'] = 'Vendas';
    }

    function index() {
        $this->gerenciar();
    }

    function gerenciar() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar vendas.');
            redirect(base_url());
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/vendas/gerenciar/';
        $config['total_rows'] = $this->vendas_model->count('os');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $this->data['results'] = $this->vendas_model->get('vendas', '*', '', $config['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'vendas/vendas';
        $this->load->view('tema/topo', $this->data);
    }

    function adicionar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar vendas.');
            redirect(base_url());
        }
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('vendas') == false) {
            $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            $entidade = $this->session->userdata('entidade');
            $dataVenda = $this->input->post('dataVenda');
            try {
                $dataVenda = explode('/', $dataVenda);
                $dataVenda = $dataVenda[2] . '-' . $dataVenda[1] . '-' . $dataVenda[0];
            } catch (Exception $e) {
                $dataVenda = date('Y/m/d');
            }
            $data = array(
                'observacao' => $this->input->post('observacao'),
                'dataVenda' => $dataVenda,
                'clientes_id' => $this->input->post('clientes_id'),
                'usuarios_id' => $this->input->post('usuarios_id'),
                'faturado' => 0,
                'entidade' => $entidade
            );

            if (is_numeric($id = $this->vendas_model->add('vendas', $data, true))) {
                $this->session->set_flashdata('success', 'Cadastro realizado com sucesso.');
                redirect('vendas/editar/' . $id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'vendas/adicionarVenda';
        $this->load->view('tema/topo', $this->data);
    }

    function editar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar vendas');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $this->load->helper('date');
        if ($this->form_validation->run('vendas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $this->load->library('parser');
            $dataVenda = $this->input->post('dataVenda');
            try {
                $dataVenda = explode('/', $dataVenda);
                $dataVenda = $dataVenda[2] . '-' . $dataVenda[1] . '-' . $dataVenda[0];
            } catch (Exception $e) {
                $dataVenda = date('Y/m/d');
            }
            $valorDesconto = $this->parser->moeda($this->input->post('valorDesconto'));
            $data = array(
                'desconto' => $valorDesconto,
                'observacao' => $this->input->post('observacao'),
                'dataVenda' => $dataVenda,
                'usuarios_id' => $this->input->post('usuarios_id'),
                'clientes_id' => $this->input->post('clientes_id')
            );
            if ($this->vendas_model->edit('vendas', $data, 'idVendas', $this->input->post('idVendas')) == TRUE) {
                $this->session->set_flashdata('success', 'Cadastro alterado com sucesso.');
                redirect(base_url() . 'index.php/vendas/editar/' . $this->input->post('idVendas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $this->data['view'] = 'vendas/editarVenda';
        $this->load->view('tema/topo', $this->data);
    }

    public function visualizar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar vendas.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->load->model('greatsell_model');
        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $this->data['emitente'] = $this->greatsell_model->getEmitente();

        $this->data['view'] = 'vendas/visualizarVenda';
        $this->load->view('tema/topo', $this->data);
    }

    function excluir() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir vendas');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir o registro.');
            redirect(base_url() . 'index.php/vendas/gerenciar/');
        }

        $sqlProduto = "UPDATE produtos p set p.estoque = p.estoque + (select sum(quantidade) from itens_de_vendas po where po.produtos_id = p.idProdutos and po.vendas_id = ?) where exists (select * from itens_de_vendas po where po.produtos_id = p.idProdutos and po.vendas_id = ?)";
        $this->db->query($sqlProduto, array($id, $id));
        
        $this->db->where('vendas_id', $id);
        $this->db->delete('itens_de_vendas');

        $this->db->where('idVendas', $id);
        $this->db->delete('vendas');

        $this->session->set_flashdata('success', 'Cadastro excluído com sucesso.');
        redirect(base_url() . 'index.php/vendas/gerenciar/');
    }

    public function autoCompleteProduto() {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteProduto($q);
        }
    }

    public function autoCompleteCliente() {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteCliente($q);
        }
    }

    public function autoCompleteUsuario() {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteUsuario($q);
        }
    }

    public function adicionarProduto() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar vendas.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idProduto', 'Produto', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idVendasProduto', 'Vendas', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            echo json_encode(array('result' => false));
        } else {
            $this->load->library('parser');
            $valorUnitario = $this->parser->moeda($this->input->post('valorUnitario'));
            $quantidade = $this->input->post('quantidade');
            $produto = $this->input->post('idProduto');
            $data = array(
                'quantidade' => $quantidade,
                'valor_unitario' => $valorUnitario,
                'produtos_id' => $produto,
                'vendas_id' => $this->input->post('idVendasProduto'),
            );

            if ($this->vendas_model->add('itens_de_vendas', $data) == true) {
                //ATUALIZA ESTOQUE DO PRODUTO
                $sqlProduto = "UPDATE produtos set estoque = estoque - ? WHERE idProdutos = ?";
                $this->db->query($sqlProduto, array($quantidade, $produto));
                //ATUALIZA VALOR TOTAL DA VENDA
                $sqlVenda = "update vendas set valorTotal = (select SUM(quantidade * valor_unitario) from itens_de_vendas where vendas_id = idVendas) where idVendas = ?";
                $this->db->query($sqlVenda, array($this->input->post('idVendasProduto')));
                echo json_encode(array('result' => true));
            } else {
                echo json_encode(array('result' => false));
            }
        }
    }

    function excluirProduto() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar Vendas');
            redirect(base_url());
        }
        $ID = $this->input->post('idProduto');
        if ($this->vendas_model->delete('itens_de_vendas', 'idItens', $ID) == true) {
            $quantidade = $this->input->post('quantidade');
            $produto = $this->input->post('produto');
            //ATUALIZA ESTOQUE DO PRODUTO
            $sql = "UPDATE produtos set estoque = estoque + ? WHERE idProdutos = ?";
            $this->db->query($sql, array($quantidade, $produto));
            //ATUALIZA VALOR TOTAL DA VENDA
            $sqlVenda = "update vendas set valorTotal = (select SUM(quantidade * valor_unitario) from itens_de_vendas where vendas_id = idVendas) where idVendas = ?";
            $this->db->query($sqlVenda, array($this->input->post('idVendas')));
            echo json_encode(array('result' => true));
        } else {
            echo json_encode(array('result' => false));
        }
    }

    public function faturar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar Vendas');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $vencimento = $this->input->post('vencimento');
            $recebimento = $this->input->post('recebimento');
            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }
            if (empty($recebimento)) {
                $recebimento = null;
            } else {
                try {
                    $recebimento = explode('/', $recebimento);
                    $recebimento = $recebimento[2] . '-' . $recebimento[1] . '-' . $recebimento[0];
                } catch (Exception $e) {
                    $recebimento = date('Y/m/d');
                }
            }
            
            $this->load->library('parser');
            $valorTotal = $this->parser->moeda($this->input->post('valor'));
            $entidade = $this->session->userdata('entidade');
            $venda = $this->input->post('vendas_id');
            $data = array(
                'descricao' => set_value('descricao'),
                'valor' => $valorTotal,
                'clientes_id' => $this->input->post('clientes_id'),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $recebimento,
                'baixado' => $this->input->post('recebido'),
                'cliente_fornecedor' => set_value('cliente'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => $this->input->post('tipo'),
                'entidade' => $entidade,
                'venda_id' => $venda
            );

            if ($this->vendas_model->add('lancamentos', $data) == TRUE) {
                $this->db->set('faturado', 1);
                $this->db->where('idVendas', $venda);
                $this->db->update('vendas');
                $this->session->set_flashdata('success', 'Venda faturada com sucesso.');
                $json = array('result' => true);
                echo json_encode($json);
                die();
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar venda.');
                $json = array('result' => false);
                echo json_encode($json);
                die();
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar venda.');
        $json = array('result' => false);
        echo json_encode($json);
    }
}