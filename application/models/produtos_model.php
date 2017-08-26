<?php

class Produtos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array') {
        $entidade = $this->session->userdata('entidade');
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idProdutos', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where('entidade', $entidade);
        $query = $this->db->get();
        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    function getById($id) {
        $entidade = $this->session->userdata('entidade');
        $this->db->where('idProdutos', $id);
        $this->db->where('entidade', $entidade);
        $this->db->limit(1);
        return $this->db->get('produtos')->row();
    }

    function add($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function edit($table, $data, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($table, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function count($table) {
        $entidade = $this->session->userdata('entidade');
        $this->db->select('idProdutos');
        $this->db->from($table);
        $this->db->where('entidade', $entidade);
        return $this->db->count_all_results();
    }

	public function getProdutoEmUsoOrdemServico($id = null) {
        $this->db->select('produtos_id');
        $this->db->from('produtos_os');
        $this->db->where('produtos_os.produtos_id', $id);
        return $this->db->get()->result();
    }
	
	public function getProdutoEmUsoVendas($id = null) {
        $this->db->select('produtos_id');
        $this->db->from('itens_de_vendas');
        $this->db->where('itens_de_vendas.produtos_id', $id);
        return $this->db->get()->result();
    }
}
