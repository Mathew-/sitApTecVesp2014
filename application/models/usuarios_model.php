<?php

if (!defined('BASEPATH'))
    exit('Acesso direto ao script não é permitido');

class Usuarios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserir($data) {
        //Inserção na tabela usuario
        return $this->db->insert('usuario', $data);
    }

    function listar() {
        //Listagem da tabela usuário
        $query = $this->db
                ->order_by('nome', 'asc') //Ordem alfabética
                ->get('usuario');

        return $query->result();
    }

    function editar($idusuario) {
        $this->db->where('idusuario', $idusuario);
        $query = $this->db->get('usuario');
        return $query->result();
    }

    function atualizar($data) {
        $this->db->where('idusuario', $data['idusuario']);
        $this->db->set($data);
        return $this->db->update('usuario');
    }

    function deletar($idusuario) {
        $this->db->where('idusuario', $idusuario);
        return $this->db->delete('usuario');
    }

    function login($username, $password) {
        $this->db->select('idusuario, email, senha');
        $this->db->from('usuario');
        $this->db->where('email', $username);
        $this->db->where('senha', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */