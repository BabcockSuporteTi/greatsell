<?php
class Greatsell_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
        $this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function alterarSenha($senha,$oldSenha,$id){
        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);
        $usuario = $this->db->get('usuarios')->row();
        if($usuario->senha != $oldSenha){
            return false;
        }
        else{
            $this->db->set('senha',$senha);
            $this->db->where('idUsuarios',$id);
            return $this->db->update('usuarios');    
        }
    }

	function pesquisar($termo){
		$entidade = $this->session->userdata('entidade');
        $data = array();
		if (empty($termo)){
			$data['clientes'] = [];
			$data['produtos'] = [];
			$data['os'] = [];
			$data['servicos'] = [];
			return $data;
		}
        // buscando clientes
        $this->db->like('nomeCliente',$termo);
        $this->db->where('entidade',$entidade);
        $this->db->limit(999);
        $data['clientes'] = $this->db->get('clientes')->result();

        // buscando os
        $this->db->where('entidade',$entidade);
		$this->db->or_like(array('placa' => $termo, 'idOs' => $termo, 'descricaoProduto' => $termo));/* LIKE OR LIKE */
        $this->db->limit(999);
        $data['os'] = $this->db->get('os')->result();

        // buscando produtos
        $this->db->like('descricao',$termo);
        $this->db->where('entidade',$entidade);
        $this->db->limit(999);
        $data['produtos'] = $this->db->get('produtos')->result();

        //buscando serviços
        $this->db->like('nome',$termo);
        $this->db->where('entidade',$entidade);
        $this->db->limit(999);
        $data['servicos'] = $this->db->get('servicos')->result();
        return $data;
    }
    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1'){
			return TRUE;
		}	
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() >= 0){
			return TRUE;
		}
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1'){
			return TRUE;
		}
		return FALSE;        
    }   
	
	function count($table){
		return $this->db->count_all($table);
	}

    function getOsAbertas(){
        $entidade = $this->session->userdata('entidade');
        $this->db->select('os.*, clientes.nomeCliente');
        $this->db->from('os');
        $this->db->join('clientes', 'clientes.idClientes = os.clientes_id');
        $this->db->where('os.status','Aberto');
        $this->db->where('os.entidade',$entidade);
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    function getProdutosMinimo(){
        $sql = "SELECT * FROM produtos WHERE estoque <= estoqueMinimo LIMIT 10"; 
        return $this->db->query($sql)->result();
    }

    function getOsEstatisticas(){
        $entidade = $this->session->userdata('entidade');
        $sql = "SELECT status, COUNT(status) as total FROM os where entidade = ? GROUP BY status ORDER BY status";
        return $this->db->query($sql, array($entidade))->result();
    }

    public function getEstatisticasFinanceiro(){
        $entidade = $this->session->userdata('entidade');
        $sql = "SELECT SUM(CASE WHEN baixado = 1 AND tipo = 'receita' THEN valor END) as total_receita, 
                       SUM(CASE WHEN baixado = 1 AND tipo = 'despesa' THEN valor END) as total_despesa,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'receita' THEN valor END) as total_receita_pendente,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'despesa' THEN valor END) as total_despesa_pendente FROM lancamentos where entidade = ?";
        return $this->db->query($sql, array($entidade))->row();
    }

    public function getEmitente(){   
        $entidade = $this->session->userdata('entidade');
        $this->db->where("entidade",$entidade);
        return $this->db->get('emitente')->result();
    }

    public function addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email, $logo){
       $entidade = $this->session->userdata('entidade');
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('email', $email);
       $this->db->set('url_logo', $logo);
       $this->db->set('entidade', $entidade);
       return $this->db->insert('emitente');
    }

    public function editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email){
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('email', $email);
       $this->db->where('id', $id);
       return $this->db->update('emitente');
    }

    public function editLogo($id, $logo){
        $this->db->set('url_logo', $logo); 
        $this->db->where('id', $id);
        return $this->db->update('emitente'); 
         
    }
}