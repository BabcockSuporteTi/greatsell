<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financeiro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }
        $this->load->model('financeiro_model', '', TRUE);
        $this->data['menuFinanceiro'] = 'financeiro';
        $this->load->helper(array('codegen_helper'));
    }

    public function index() {
        $this->lancamentos();
    }

    public function lancamentos() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar lançamentos.');
            redirect(base_url());
        }
        $where = '';
        $periodo = $this->input->get('periodo');
        $situacao = $this->input->get('situacao');
        $id_os = $this->input->get('id_os');
        $id_venda = $this->input->get('id_venda');
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');

        // busca todos os lançamentos
        if ($periodo == 'todos') {
            if ($situacao == 'previsto') {
                $where = 'data_vencimento > "' . date('Y-m-d') . '" AND baixado = "0"';
            } else {
                if ($situacao == 'atrasado') {
                    $where = 'data_vencimento < "' . date('Y-m-d') . '" AND baixado = "0"';
                } else {
                    if ($situacao == 'realizado') {
                        $where = 'baixado = "1"';
                    }

                    if ($situacao == 'pendente') {
                        $where = 'baixado = "0"';
                    }
                }
            }
        }
        if ($id_os != null) {
            if ($where == null) {
                $where = 'os_id = "' . $id_os . '"';
            } else {
                $where = $where . ' and os_id = "' . $id_os . '"';
            }
        }

        if ($id_venda != null) {
            if ($where == null) {
                $where = 'venda_id = "' . $id_venda . '"';
            } else {
                $where = $where . ' and venda_id = "' . $id_venda . '"';
            }
        }

        if ($dataInicial != null) {
            if ($where == null) {
                $where = 'data_vencimento >= "' . $dataInicial . '"';
            } else {
                $where = $where . ' and data_vencimento >= "' . $dataInicial . '"';
            }
        }
        if ($dataFinal != null) {
            if ($where == null) {
                $where = 'data_vencimento <= "' . $dataFinal . '"';
            } else {
                $where = $where . ' and data_vencimento <= "' . $dataFinal . '"';
            }
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/financeiro/lancamentos';
        $config['total_rows'] = $this->financeiro_model->count('lancamentos', $where);
        $config['per_page'] = 100;
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
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $this->data['results'] = $this->financeiro_model->get('lancamentos', 'idLancamentos,descricao,valor,data_vencimento,data_pagamento,baixado,cliente_fornecedor,tipo,forma_pgto, os.idOs, os.descricaoProduto, vendas.idVendas, vendas.observacao', $where, $config['per_page'], $this->uri->segment(3));
        $this->data['view'] = 'financeiro/lancamentos';
        $this->load->view('tema/topo', $this->data);
    }

    function adicionarReceita() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar lançamentos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $vencimento = $this->input->post('vencimento');
            $recebimento = $this->input->post('recebimento');
            if (empty($recebimento)) {
                $recebimento = null;
            } else {
                $recebimento = explode('/', $recebimento);
                $recebimento = $recebimento[2] . '-' . $recebimento[1] . '-' . $recebimento[0];
            }
            if (empty($vencimento)) {
                $vencimento = date('d/m/Y');
            }
            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }
            $this->load->library('parser');
            $entidade = $this->session->userdata('entidade');
            $data = array(
                'descricao' => set_value('descricao'),
                'valor' => $this->parser->moeda(set_value('valor')),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $recebimento != null ? $recebimento : date('Y-m-d'),
                'baixado' => $this->input->post('recebido'),
                'cliente_fornecedor' => set_value('cliente'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => set_value('tipo'),
                'entidade' => $entidade
            );
            if ($this->financeiro_model->add('lancamentos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Receita adicionada com sucesso!');
                redirect($urlAtual);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar adicionar receita.');
        redirect($urlAtual);
    }
	
    function adicionarReceitaOs() {
       if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar lançamentos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('receitaOs') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
			$this->session->set_flashdata('error', $this->data['custom_error']);
			redirect($urlAtual);
        } else {
            $vencimento = $this->input->post('vencimentoOs');
            $recebimento = $this->input->post('recebimento');
            if (empty($recebimento)) {
                $recebimento = null;
            } else {
                $recebimento = explode('/', $recebimento);
                $recebimento = $recebimento[2] . '-' . $recebimento[1] . '-' . $recebimento[0];
            }
            if (empty($vencimento)) {
                $vencimento = date('d/m/Y');
            }
            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }
            $this->load->library('parser');
            $entidade = $this->session->userdata('entidade');
			$idOs = $this->input->post('numeroOs');
			$this->load->model('os_model');
			$result = $this->os_model->getById($idOs);
			if (!empty($idOs)){
				if (empty($result)) {
					$this->session->set_flashdata('error', 'Ordem de serviço "' . $idOs . '" não encontrada.');
					redirect($urlAtual);
				}				
			} else {
				$this->session->set_flashdata('error', 'Ordem de serviço "' . $idOs . '" não encontrada.');
				redirect($urlAtual);
			}
				$descricao = 'Receita manual da OS #'.$idOs;
				$data = array(
					'descricao' => $descricao,
					'valor' => $this->parser->moeda(set_value('valor')),
				    'clientes_id' => $result->clientes_id,
					'data_vencimento' => $vencimento,
					'data_pagamento' => $recebimento != null ? $recebimento : date('Y-m-d'),
					'baixado' => $this->input->post('recebido'),
				    'cliente_fornecedor' => $result->nomeCliente,
					'forma_pgto' => $this->input->post('formaPgto'),
					'tipo' => $this->input->post('tipo'),
					'os_id' => $idOs,
					'entidade' => $entidade
				);
				if ($this->financeiro_model->add('lancamentos', $data) == TRUE) {
					$this->session->set_flashdata('success', 'Receita de ordem de serviço adicionada com sucesso.');
					redirect($urlAtual);
				} else {
					$this->session->set_flashdata('error','Erro ao adicionar receita para a ordem de serviço'.$idOs);
					redirect($urlAtual);
				}
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar adicionar receita.');
        redirect($urlAtual);
    }	

    function adicionarDespesa() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar lançamentos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('despesa') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $vencimento = $this->input->post('vencimento');
            $pagamento = $this->input->post('pagamento');
            if (empty($pagamento)) {
                $pagamento = null;
            } else {
                $pagamento = explode('/', $pagamento);
                $pagamento = $pagamento[2] . '-' . $pagamento[1] . '-' . $pagamento[0];
            }
            if (empty($vencimento)) {
                $vencimento = date('d/m/Y');
            }
            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }
            $this->load->library('parser');
            $entidade = $this->session->userdata('entidade');
            $data = array(
                'descricao' => set_value('descricao'),
                'valor' => $this->parser->moeda(set_value('valor')),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $pagamento != null ? $pagamento : date('Y-m-d'),
                'baixado' => $this->input->post('pago'),
                'cliente_fornecedor' => set_value('fornecedor'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => set_value('tipo'),
                'entidade' => $entidade
            );
            if ($this->financeiro_model->add('lancamentos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Registro cadastrado com sucesso.');
                redirect($urlAtual);
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar adicionar despesa!');
                redirect($urlAtual);
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar adicionar despesa.');
        redirect($urlAtual);
    }

    public function editar() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar lançamentos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');

        $this->form_validation->set_rules('descricao', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fornecedor', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('valor', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vencimento', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pagamento', '', 'trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');
            $pagamento = $this->input->post('pagamento');
            if (empty($pagamento)) {
                $pagamento = null;
            } else {
                $pagamento = explode('/', $pagamento);
                $pagamento = $pagamento[2] . '-' . $pagamento[1] . '-' . $pagamento[0];
            }
            try {
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2] . '-' . $vencimento[1] . '-' . $vencimento[0];
                
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }
            $this->load->library('parser');
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'valor' => $this->parser->moeda($this->input->post('valor')),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $pagamento,
                'baixado' => $this->input->post('pago'),
                'cliente_fornecedor' => $this->input->post('fornecedor'),
                'forma_pgto' => $this->input->post('formaPgto')
            );
            if ($this->financeiro_model->edit('lancamentos', $data, 'idLancamentos', $this->input->post('id')) == TRUE) {
                $this->session->set_flashdata('success', 'Registro alterado com sucesso.');
                redirect($urlAtual);
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar editar lançamento!');
                redirect($urlAtual);
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar editar lançamento.');
        redirect($urlAtual);
        $this->load->library('parser');
        $data = array(
            'descricao' => $this->input->post('descricao'),
            'valor' => $this->parser->moeda($this->input->post('valor')),
            'data_vencimento' => $this->input->post('vencimento'),
            'data_pagamento' => $this->input->post('pagamento'),
            'baixado' => $this->input->post('pago'),
            'cliente_fornecedor' => set_value('fornecedor'),
            'forma_pgto' => $this->input->post('formaPgto'),
            'tipo' => $this->input->post('tipo')
        );
        print_r($data);
    }

    public function excluirLancamento() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dLancamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir lançamentos.');
            redirect(base_url());
        }
        $id = $this->input->post('id');
        if ($id == null || !is_numeric($id)) {
            $json = array('result' => false);
            echo json_encode($json);
        } else {
            $result = $this->financeiro_model->delete('lancamentos', 'idLancamentos', $id);
            if ($result) {
                $json = array('result' => true);
                echo json_encode($json);
            } else {
                $json = array('result' => false);
                echo json_encode($json);
            }
        }
    }

    protected function getThisYear() {
        $dias = date("z");
        $primeiro = date("Y-m-d", strtotime("-" . ($dias) . " day"));
        $ultimo = date("Y-m-d", strtotime("+" . ( 364 - $dias) . " day"));
        return array($primeiro, $ultimo);
    }

    protected function getThisWeek() {

        return array(date("Y/m/d", strtotime("last sunday", strtotime("now"))), date("Y/m/d", strtotime("next saturday", strtotime("now"))));
    }

    protected function getLastSevenDays() {

        return array(date("Y-m-d", strtotime("-7 day", strtotime("now"))), date("Y-m-d", strtotime("now")));
    }

    protected function getThisMonth() {
        $mes = date('m');
        $ano = date('Y');
        $qtdDiasMes = date('t');
        $inicia = $ano . "-" . $mes . "-01";
        $ate = $ano . "-" . $mes . "-" . $qtdDiasMes;
        return array($inicia, $ate);
    }
}