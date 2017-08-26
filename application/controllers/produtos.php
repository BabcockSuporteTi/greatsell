<?php

class Produtos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('produtos_model', '', TRUE);
        $this->data['menuProdutos'] = 'Produtos';
    }

    function index(){
	   $this->gerenciar();
    }

    function gerenciar(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vProduto')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar produtos.');
           redirect(base_url());
        }
        $entidade = $this->session->userdata('entidade');

        $this->load->library('table');
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'index.php/produtos/gerenciar/';
        $config['total_rows'] = $this->produtos_model->count('produtos');
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

        $this->data['results'] = $this->produtos_model->get('produtos', 'idProdutos,descricao,unidade,precoCompra,precoVenda,estoque,estoqueMinimo', '', $config['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'produtos/produtos';
        $this->load->view('tema/topo', $this->data);
    }
	
    function adicionar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $this->load->library('parser');
            $precoCompra = $this->parser->moeda($this->input->post('precoCompra'));
            $precoVenda = $this->parser->moeda($this->input->post('precoVenda'));
            $entidade = $this->session->userdata('entidade');
            $data = array(
                'descricao' => set_value('descricao'),
                'unidade' => set_value('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => set_value('estoque'),
                'estoqueMinimo' => set_value('estoqueMinimo'),
                'entidade' => $entidade
            );

            if ($this->produtos_model->add('produtos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
                redirect(base_url() . 'index.php/produtos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';
        $this->load->view('tema/topo', $this->data);
    }

    function editar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $this->load->library('parser');
            $precoCompra = $this->parser->moeda($this->input->post('precoCompra'));
            $precoVenda = $this->parser->moeda($this->input->post('precoVenda'));
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'unidade' => $this->input->post('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => $this->input->post('estoque'),
                'estoqueMinimo' => $this->input->post('estoqueMinimo')
            );
            if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == TRUE) {
                $this->session->set_flashdata('success', 'Produto editado com sucesso!');
                redirect(base_url() . 'index.php/produtos/editar/' . $this->input->post('idProdutos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));
        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto "' . $this->uri->segment(3) . '" não encontrado.');
            redirect(base_url() . 'index.php/produtos');
        }
        $this->data['view'] = 'produtos/editarProduto';
        $this->load->view('tema/topo', $this->data);
    }

    function visualizar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }
        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto "' . $this->uri->segment(3) . '" não encontrado.');
            redirect(base_url() . 'index.php/produtos');
        }
        $this->data['view'] = 'produtos/visualizarProduto';
        $this->load->view('tema/topo', $this->data);
    }

    function excluir(){
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }
        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(base_url() . 'index.php/produtos/gerenciar/');
        }
		if (!empty($this->produtos_model->getProdutoEmUsoVendas($id))){
            $this->session->set_flashdata('error', 'Erro ao excluir. Produto está em uso em uma ou mais vendas.');
            redirect(base_url() . 'index.php/produtos/gerenciar/');		
		}
		if (!empty($this->produtos_model->getProdutoEmUsoOrdemServico($id))){
            $this->session->set_flashdata('error', 'Erro ao excluir. Produto está em uso em uma ou mais ordens de serviço.');
            redirect(base_url() . 'index.php/produtos/gerenciar/');		
		}		
        $this->produtos_model->delete('produtos', 'idProdutos', $id);
        $this->session->set_flashdata('success', 'Produto excluido com sucesso!');
        redirect(base_url() . 'index.php/produtos/gerenciar/');
    }
}

