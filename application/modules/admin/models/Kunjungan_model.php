<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kunjungan_model extends CI_Model {

	var $table          = 'kunjungan';
    var $column_order   = array('anggota.nama', 'anggota.nis_nipy', 'kunjungan.tanggal', 'kunjungan.waktu', 'kunjungan.id');
    var $column_search  = array('anggota.nama', 'anggota.nis_nipy', 'kunjungan.tanggal', 'kunjungan.waktu', 'kunjungan.id');
    var $order          = array('kunjungan.id' => 'desc');

    private function _get_datatables_query() {
		$this->db->select('anggota.nama AS nama, anggota.nis_nipy AS nis_nipy, kunjungan.tanggal AS tanggal, kunjungan.waktu AS waktu, kunjungan.id AS id_kunjungan');
        $this->db->from($this->table);
		$this->db->join('anggota', 'kunjungan.id_anggota = anggota.id', 'left');
        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function cek_nis_nipy($nis_nipy = NULL)
    {
        return $this->db->get_where('anggota', ['nis_nipy' => $nis_nipy])->row();
    }

    public function cek_kunjungan($nis_nipy = NULL)
    {
        
        $row = $this->cek_nis_nipy($nis_nipy);
        if ($row) {
            $this->db->order_by('id', 'desc');
            return $this->db->get_where('kunjungan', ['id_anggota' => $row->id])->row();
        }
    }
}
