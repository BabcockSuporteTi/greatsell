<?php
class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        $entidade = $this->session->userdata('entidade');
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idClientes','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        $this->db->where('entidade',$entidade);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $entidade = $this->session->userdata('entidade');       
        $this->db->where('idClientes',$id);
        $this->db->where('entidade',$entidade);
        $this->db->limit(1);
        return $this->db->get('clientes')->row();
    }
    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function count($table) {
        $entidade = $this->session->userdata('entidade');
        $this->db->select('idClientes');
        $this->db->from($table);
        $this->db->where('entidade', $entidade);
        return $this->db->count_all_results();
    }
    
    public function getOsByCliente($id){
        $this->db->where('clientes_id',$id);
        $this->db->order_by('idOs','dataInicial');
        $this->db->limit(999);
        return $this->db->get('os')->result();
    }

}