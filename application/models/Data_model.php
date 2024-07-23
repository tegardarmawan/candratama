<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(string $table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function update(string $table, $where, $data)
    {
        return $this->db->update($table, $data, $where);
    }
    public function update_stock_increment($table, $where, $increment)
    {
        $this->db->set('stock', 'stock + ' . (int)$increment, FALSE);
        $this->db->where($where);
        return $this->db->update($table);
    }

    public function delete(string $table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function get_all(string $table)
    {
        $query = $this->db->get($table);
        return $query;
    }

    public function get_file_name($table, $where, $field)
    {
        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->file_name;
        } else {
            return null;
        }
    }

    public function count($table)
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM $table");
        return $query->row()->count;
    }

    public function count_where($table, $column, $id)
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM $table where $column = $id");
        return $query->row()->count;
    }
    public function count_stock($table, $condition)
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM $table WHERE $condition");
        return $query->row()->count;
    }

    public function find(string $table, $where)
    {
        $query = $this->db->where($where);
        $query = $this->db->from($table);
        $query = $this->db->get();
        return $query;
    }
    public function get_jabatan_by_divisi()
    {
        $id_divisi = $this->input->post('id_divisi');
        $this->db->where('id_divisi', $id_divisi);
        $result = $this->db->get('tjabatan')->result();
        echo json_encode($result);
    }

    public function get(array $data)
    {
        //decleare select
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        //decleare from
        if (isset($data['from'])) {
            $this->db->from($data['from']);
        }
        //deceleare join
        if (isset($data['join'])) {
            foreach ($data['join'] as $item_join) {
                $explode_item_join = explode(',', $item_join);
                //param 1
                isset($explode_item_join[0]) ? $param_1 = $explode_item_join[0] : $param_1 = '';
                //param 2
                isset($explode_item_join[1]) ? $param_2 = $explode_item_join[1] : $param_2 = '';
                //param 3
                isset($explode_item_join[2]) ? $param_3 = $explode_item_join[2] : $param_3 = '';

                $this->db->join($param_1, $param_2, $param_3);
            }
        }
        if (isset($data['join_custom'])) {
            foreach ($data['join_custom'] as $table_name => $item_join) {
                $explode_item_join = explode(',', $item_join);
                $last_param = end($explode_item_join);
                $value_param = str_replace(',' . $last_param, ' ', $item_join);
                $this->db->join($table_name, $value_param, $last_param);
            }
        }
        //decleare where 
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['or_where'])) {
            $this->db->or_where($data['or_where']);
        }

        //define where in
        if (isset($data['where_in'])) {
            foreach ($data['where_in'] as $field_name => $array_list) {
                $this->db->where_in($field_name, $array_list);
            }
        }
        //define where not in
        if (isset($data['where_not_in'])) {
            foreach ($data['where_not_in'] as $field_name => $array_list) {
                $this->db->where_not_in($field_name, $array_list);
            }
        }
        //define not like
        if (isset($data['not_like'])) {
            foreach ($data['not_like'] as $field_name => $item_not_like) {
                $explode_item_not_like = explode(',', $item_not_like);
                if (count($explode_item_not_like) > 1) {
                    $param2 = end($explode_item_not_like);
                    $param1 = substr($item_not_like, 0, strlen($item_not_like) - (strlen($param2) + 1));
                    //add to query
                    $this->db->not_like($field_name, $param1, $param2);
                } else {
                    $this->db->not_like($field_name, $item_not_like);
                }
            }
        }
        //define like
        if (isset($data['like'])) {
            foreach ($data['like'] as $field_name => $item_like) {
                $explode_item_like = explode(',', $item_like);
                if (count($explode_item_like) > 1) {
                    $param2 = end($explode_item_like);
                    $param1 = substr($item_like, 0, strlen($item_like) - (strlen($param2) + 1));
                    //add to query
                    $this->db->like($field_name, $param1, $param2);
                } else {
                    $this->db->not_like($field_name, $item_like);
                }
            }
        }
        //decleare order by 
        if (isset($data['order_by'])) {
            $explode_order_by = explode(',', $data['order_by']);
            if (count($explode_order_by) > 1) {
                $param2 = end($explode_order_by);
                $param1 = substr($data['order_by'], 0, strlen($data['order_by']) - (strlen($param2) + 1));
                $this->db->order_by($param1, $param2);
            } else {
                $this->db->order_by($data['order_by']);
            }
        }
        //decleare group by
        if (isset($data['group_by'])) {
            $this->db->group_by($data['group_by']);
        }
        //decleare having
        if (isset($data['having'])) {
            $this->db->having($data['having']);
        }
        //decleare limit 
        if (isset($data['limit'])) {
            if (is_array($data['limit'])) {
                //when array data
                //decide use 
                if (isset($data['limit']['limit']) && isset($data['limit']['start'])) {
                    //use both
                    $this->db->limit($data['limit']['limit'], $data['limit']['start']);
                } else {
                    if (isset($data['limit']['limit'])) {
                        $this->db->limit($data['limit']['limit']);
                    }
                }
            } else {
                //when not array
                $this->db->limit($data['limit']);
            }
        }
        //final deleare using get
        $query = $this->db->get();
        return $query;
    }

    public function custom(string $query)
    {
        $query = $this->db->query($query);
        return $query;
    }
    public function generateKodeKaryawan()
    {
        $prefix = 'KR-';
        $date = date('ymd'); //mengambil format dua digit belakang tahun, bulan, tanggal (240714)

        //  mendapatkan jumlah kode karyawan hari ini
        $this->db->like('kodek', $prefix . $date, 'after');
        $this->db->from('tkaryawan');
        $count = $this->db->count_all_results();

        $kode_karyawan = $count + 1;

        //format kode karyawan
        $kodek = $prefix . $date . str_pad($kode_karyawan, 3, '0', STR_PAD_LEFT);
        return $kodek;
    }

    public function generateNoInduk()
    {
        $today = date('ymd');

        // Ambil nomor terakhir untuk hari ini
        $this->db->select_max('no_induk');
        $this->db->like('no_induk', '.' . $today . '.', 'both');
        $query = $this->db->get('tkaryawan');
        $last_number = $query->row()->no_induk;

        if ($last_number) {
            // Jika sudah ada nomor untuk hari ini, tambahkan 1
            $parts = explode('.', $last_number); //explode digunakan untuk memisah value dengan . sebagai pemisahnya
            //$new_number untuk menyimpan dua digit pertama nomor induk
            $new_number = str_pad((int)$parts[0] + 1, 2, '0', STR_PAD_LEFT); //str_pad dipakai untuk melakukan penambahan karakter
        } else {
            // Jika belum ada nomor untuk hari ini, mulai dari 01
            $new_number = '01';
        }

        // Generate nomor baru
        $new_nomor_induk = $new_number . '.' . $today . '.15';

        return $new_nomor_induk;
    }
    public function generateNota() //generate nota stock keluar masuk
    {
        $prefix = 'SS-';
        $date = date('ymd'); // Format tahun, bulan, tanggal (20240710)

        // Dapatkan jumlah nota hari ini
        $this->db->select_max('nota');
        $this->db->like('nota', $prefix . $date, 'after');
        $query = $this->db->get('tstock');
        $last_nota = $query->row()->nota;

        if ($last_nota === null) {
            $new_numeric_part = '001';
        } else {
            $last_numeric_part = substr($last_nota, -3);
            $new_numeric_part = str_pad(intval($last_numeric_part) + 1, 3, '0', STR_PAD_LEFT);
        }


        // Format nomor nota lengkap
        $nota = $prefix . $date . $new_numeric_part;

        return $nota;
    }
    //generate kode barang
    public function generateKodeb()
    {
        $date = date('ymd');
        $prefix = '99';
        $this->db->select_max('kodeb');
        $this->db->like('kodeb', $prefix . $date, 'after');
        $query = $this->db->get('tbarang');
        $last_number = $query->row()->kodeb;

        // Periksa apakah $last_number null atau tidak
        if ($last_number === null) {
            // Jika null, berarti belum ada kode barang untuk hari ini
            $new_numeric_part = '0001';
        } else {
            // Jika tidak null, lakukan proses seperti sebelumnya
            $last_numeric_part = substr($last_number, -4);
            $new_numeric_part = str_pad(intval($last_numeric_part) + 1, 4, '0', STR_PAD_LEFT);
        }

        // format kodeb
        $kode_barang = $prefix . $date . $new_numeric_part;

        return $kode_barang;
    }
    //generate kode customer
    public function generateKodec()
    {
        $date = date('ymd');
        $prefix = 'CT-';

        $this->db->select_max('kodec');
        $this->db->like('kodec', $prefix . $date, 'after');
        $query = $this->db->get('tcust');
        $last_kodec = $query->row()->kodec;

        if ($last_kodec == null) {
            $new_kodec_part = '001';
        } else {
            $last_kodec_part = substr($last_kodec, -3);
            $new_kodec_part = str_pad(intval($last_kodec_part) + 1, 3, '0', STR_PAD_LEFT); //intval digunakan untuk mengubah karakter menjadi tipe int
        }
        $kodeCustomer = $prefix . $date . $new_kodec_part;
        return $kodeCustomer;
    }
    // PR0000002489
    public function generateNotaProject()
    {
        $prefix = 'PR';

        $this->db->select_max('nota');
        $this->db->like('nota', $prefix, 'after');
        $query = $this->db->get('tproject');
        $last_nota = $query->row()->nota;

        $new_nota_part = str_pad(intval(substr($last_nota, -10)  + 1), 10, '0', STR_PAD_LEFT);

        $new_nota = $prefix . $new_nota_part;
        return $new_nota;
    }
    //generate kodec1 pelanggan
    public function generateKodec1()
    {
        $this->db->select_max('kodec1');
        $this->db->like('kodec1');
        $query = $this->db->get('tcust');
        $last_kodec1 = $query->row()->kodec1;

        $new_kodec1 = $last_kodec1 + 1;
        return $new_kodec1;
    }
    //generate kode group barang
    public function generateKodeg()
    {
        $prefix = 'GR-';

        $this->db->select_max('kodeg');
        $this->db->like('kodeg', $prefix, 'after');
        $query = $this->db->get('tgroup');
        $last_number = $query->row()->kodeg;

        $parts = explode('-', $last_number);
        $kodeg = $prefix . str_pad((int)$parts[1] + 1, 3, '0', STR_PAD_LEFT);
        return $kodeg;
    }
    //generate kode satuan barang
    public function generateSatuan()
    {
        $prefix = 'ST-';

        $this->db->select_max('kodest');
        $this->db->like('kodest', $prefix, 'after');
        $query = $this->db->get('tsatuan');
        $last_number = $query->row()->kodest;

        $parts = explode('-', $last_number);
        $kodest = $prefix . str_pad((int)$parts[1] + 1, 3, '0', STR_PAD_LEFT);
        return $kodest;
    }
}
