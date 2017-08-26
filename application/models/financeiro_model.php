<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financeiro_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array') {
        $entidade = $this->session->userdata('entidade');
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('os', 'os.idOs = lancamentos.os_id', 'left');
        $this->db->join('vendas', 'vendas.idVendas = lancamentos.venda_id', 'left');
        $this->db->order_by('data_vencimento', 'asc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where('lancamentos.entidade', $entidade);
        $query = $this->db->get();

        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    function getById($id) {
        $entidade = $this->session->userdata('entidade');
        $this->db->where('idClientes', $id);
        $this->db->where('entidade', $entidade);
        $this->db->limit(1);
        return $this->db->get('clientes')->row();
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

    function count($table, $where = '') {
        $entidade = $this->session->userdata('entidade');
        $this->db->select('idLancamentos');
        $this->db->from($table);

        if ($where) {
            $this->db->where($where);
        }
        $this->db->where('entidade', $entidade);
        return $this->db->count_all_results();
    }

}
