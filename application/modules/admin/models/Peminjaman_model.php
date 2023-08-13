<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    var $table          = 'peminjaman';
    var $column_order   = array('peminjaman.id', 'anggota.nama', 'buku.judul', 'peminjaman.tanggal_pinjam', 'peminjaman.tanggal_kembali', 'pengguna.nama');
    var $column_search  = array('peminjaman.id', 'anggota.nama', 'buku.judul', 'peminjaman.tanggal_pinjam', 'peminjaman.tanggal_kembali', 'pengguna.nama');
    var $order          = array('peminjaman.id' => 'desc');

    private function _get_datatables_query() {
        $this->db->select('anggota.nama AS nama_anggota, buku.judul AS judul_buku, peminjaman.tanggal_pinjam AS tanggal_pinjam, peminjaman.tanggal_kembali AS tanggal_kembali, pengguna.nama AS nama_admin, peminjaman.id AS id_peminjaman');
        $this->db->from($this->table);
        $this->db->join('anggota', 'peminjaman.nis_nipy = anggota.nis_nipy', 'left');
        $this->db->join('buku', 'peminjaman.isbn = buku.isbn', 'left');
        $this->db->join('pengguna', 'peminjaman.id_pengguna = pengguna.id', 'left');
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

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function get_data_anggota($inputan = '')
    {
        $this->db->select('id AS value, nama AS label');
        $this->db->like('nama', "$inputan");
        $this->db->order_by('nama', 'asc');
        return $this->db->get('anggota')->result();
    }

    public function get_data_buku($inputan = '')
    {
        $this->db->select('id AS value, judul AS label');
        $this->db->like('judul', "$inputan");
        $this->db->order_by('judul', 'asc');
        return $this->db->get('buku')->result();
    }

    public function get_anggota_by_id_peminjaman($id = '')
    {
        $id_anggota = $this->db->get_where('peminjaman', ['id' => $id])->row()->id_anggota;
        if ($this->db->get_where('anggota', ['id' => $id_anggota])->row()) {
            return $this->db->get_where('anggota', ['id' => $id_anggota])->row();
        }
    }

    public function get_buku_by_id_peminjaman($id = '')
    {
        $id_buku = $this->db->get_where('peminjaman', ['id' => $id])->row()->id_buku;
        if ($this->db->get_where('buku', ['id' => $id_buku])->row()) {
            return $this->db->get_where('buku', ['id' => $id_buku])->row();
        }
    }

    public function get_peminjaman_by_id_anggota($id_anggota = '')
    {
        return $this->db->get_where('peminjaman', ['id_anggota' => $id_anggota, 'kembali' => 'N']);
    }

    public function get_anggota_by_id($id)
    {
        return $this->db->get_where('anggota', ['id' => $id])->row();
    }

    public function get_buku_by_id($id)
    {
        return $this->db->get_where('buku', ['id' => $id])->row();
    }

}
