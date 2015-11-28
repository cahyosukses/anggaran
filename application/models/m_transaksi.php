<?php

class M_transaksi extends CI_Model {
    
    function save_setting_tagihan() {
        $this->db->trans_begin();
        $param = array(
            'id' => post_safe('id_tagihan'),
            'kode_prodi' => post_safe('jurusan'),
            'tahun' => post_safe('tahun'),
            'total_spp' => currencyToNumber(post_safe('total_spp')),
            'biaya_pengembangan' => currencyToNumber(post_safe('biaya_pengembangan'))
        );
        if ($param['id'] === '') {
            $this->db->insert('tb_tagihan', $param);
            $id_tagihan = $this->db->insert_id();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $result['status'] = FALSE;
            }
            
            if ($param['biaya_pengembangan'] !== '0' or $param['biaya_pengembangan'] !== '') {
                $data_detail = array(
                    'id_tagihan' => $id_tagihan,
                    'semester' => 1,
                    'tagihan' => $param['biaya_pengembangan'],
                    'status' => 'Dana Pengembangan'
                );
                $this->db->insert('tb_tagihan_detail', $data_detail);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $result['status'] = FALSE;
                }
            }
            for ($i = 1; $i <= 8; $i++) {
                $data_detail2 = array(
                    'id_tagihan' => $id_tagihan,
                    'semester' => $i,
                    'tagihan' => ($param['total_spp']/8),
                    'status' => 'SPP'
                );
                $this->db->insert('tb_tagihan_detail', $data_detail2);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $result['status'] = FALSE;
                }
            }
            $result['act'] = 'add';
            $result['id'] = $id_tagihan;
        } else {
            $id_tagihan = $param['id'];
            $this->db->where('id', $param['id']);
            $this->db->update('tb_tagihan', $param);
            $this->db->delete('tb_tagihan_detail', array('id_tagihan' => $param['id']));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $result['status'] = FALSE;
            }
            if ($param['biaya_pengembangan'] !== '0' or $param['biaya_pengembangan'] !== '') {
                $data_detail = array(
                    'id_tagihan' => $id_tagihan,
                    'semester' => 1,
                    'tagihan' => $param['biaya_pengembangan'],
                    'status' => 'Dana Pengembangan'
                );
                $this->db->insert('tb_tagihan_detail', $data_detail);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $result['status'] = FALSE;
                }
            }
            for ($i = 1; $i <= 8; $i++) {
                $data_detail2 = array(
                    'id_tagihan' => $id_tagihan,
                    'semester' => $i,
                    'tagihan' => ($param['total_spp']/8),
                    'status' => 'SPP'
                );
                $this->db->insert('tb_tagihan_detail', $data_detail2);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $result['status'] = FALSE;
                }
            }
            $result['act'] = 'edit';
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result['status'] = FALSE;
        } else {
            $this->db->trans_commit();
            $result['status'] = TRUE;
        }
        return $result;
    }
    
    function get_data_tagihan_mahasiswa($limit = null, $start = null, $search = null) {
        $q = null;
        $sql = "select t.*, p.nama_prodi from tb_tagihan t join tb_prodi p on (t.kode_prodi = p.kode_prodi) where t.id is not NULL";
        $limitation = null;
        $limitation.=" limit $start , $limit";
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
    
    function save_pembayaran_mahasiswa() {
        $data = array(
            'id' => post_safe('id_pembayaran'),
            'tanggal' => date2mysql(post_safe('tanggal')),
            'id_jenis_penerimaan' => post_safe('jenis_pembayaran'),
            'id_mhs' => post_safe('nim'),
            'nominal' => currencyToNumber(post_safe('nominal'))
        );
        if ($data['id'] === '') {
            $this->db->insert('tb_pembayaran', $data);
            $result['id'] = $this->db->insert_id();
            $result['act']= 'add';
        } else {
            $this->db->where('id', $data['id']);
            $this->db->update('tb_pembayaran', $data);
            $result['id'] = $data['id'];
            $result['act']= 'edit';
        }
        return $result;
    }
    
    function save_import_pembayaran_mahasiswa() {
        $this->db->trans_begin();
        $id = post_safe('id');
        $UploadDirectory	= 'assets/images/company/'; //Upload Directory, ends with slash & make sure folder exist
        $NewFileName= "";
        //die($UploadDirectory);
            // replace with your mysql database details
        if (!@file_exists($UploadDirectory)) {
                //destination folder does not exist
                die('No upload directory');
        }
        if ($id === '') {
            if(isset($_FILES['mFile']['name'])) {

                    $foto               = post_safe('foto');
                    $FileName           = strtolower($_FILES['mFile']['name']); //uploaded file name
                    $FileTitle		= 'slide';
                    $ImageExt		= substr($FileName, strrpos($FileName, '.')); //file extension
                    $FileType		= $_FILES['mFile']['type']; //file type
                    //$FileSize		= $_FILES['mFile']["size"]; //file size
                    $RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
                    //$uploaded_date		= date("Y-m-d H:i:s");
                    
                    if ($foto !== '') {
                        @unlink('assets/img/content/'.$foto);
                    }
                    switch(strtolower($FileType))
                    {
                            //allowed file types
                            case 'application/wps-office.xls': //ms excel file
                                    break;
                            default:
                                    die('Unsupported File!'); //output error
                    }


                    //File Title will be used as new File name
                    $NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
                    $NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
               //Rename and save uploded file to destination folder.
               /*if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
               {
                    //die('Success! File Uploaded.');
               }else{
                    //die('error uploading File!');
               }*/
            }
            // membaca file excel yang diupload
            $data = new Spreadsheet_Excel_Reader($_FILES['mFile']['tmp_name']);

            // membaca jumlah baris dari data excel
            $baris = $data->rowcount($sheet_index=0);
            for ($i=2; $i<=$baris; $i++) {
                $nim        = trim($data->val($i, 1));
                $tanggal    = $data->val($i, 3);
                $transaksi  = $data->val($i, 4);
                $jumlah     = $data->val($i, 5);
                $norek      = $data->val($i, 6);
                //echo $nim.'#'.$tanggal.'#'.$transaksi.'#'.$jumlah.'#'.$norek.'<br/>';
                $get    = $this->db->query("select row_id from tb_mahasiswa where k_mhs = '$nim'")->row();
                $get2   = $this->db->query("select id from tb_jenis_penerimaan where nama = '$transaksi'")->row();
                $get3   = $this->db->query("select id from tb_bank where no_rekening = '$norek'")->row();
                $array = array(
                    'tanggal' => date2mysql($tanggal),
                    'id_jenis_penerimaan' => $get2->id,
                    'id_mhs' => $get->row_id,
                    'nominal' => currencyToNumber($jumlah),
                    'id_bank' => $get3->id
                );
                $this->db->insert('tb_pembayaran', $array);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $result['status'] = FALSE;
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $result['status'] = FALSE;
            } else {
                $this->db->trans_commit();
                $result['status'] = TRUE;
            }
        }
        return $result;
    }
    
    function get_data_pembayaran_mahasiswa($limit = null, $start = null, $search = null) {
        $q = null;
        if ($search['id'] !== '') {
            $q.=" and p.id = '".$search['id']."'";
        }
        if ($search['jurusan'] !== '') {
            $q.=" and m.k_prs = '".$search['jurusan']."'";
        }
        if ($search['jenis_bayar'] !== '') {
            $q.=" and p.id_jenis_penerimaan = '".$search['jenis_bayar']."'";
        }
        if ($search['nim'] !== '') {
            $q.=" and m.row_id = '".$search['nim']."'";
        }
        if ($search['tanggal'] !== '') {
            $q.=" and p.tanggal = '".$search['tanggal']."'";
        }
        if ($search['tanggalinput'] !== '') {
            $q.=" and date(p.waktu) = '".$search['tanggalinput']."'";
        }
        $sql = "select p.*, m.row_id, m.k_prs as kode_prodi, m.n_mhs, m.k_mhs, jp.nama as jenis_pembayaran, b.nama as bank
            from tb_pembayaran p 
            join tb_jenis_penerimaan jp on (p.id_jenis_penerimaan = jp.id) 
            join tb_mahasiswa m on (p.id_mhs = m.row_id)
            left join tb_bank b on (p.id_bank = b.id)
            where p.id is not NULL $q";
        $limitation = null;
        $limitation.=" limit $start , $limit";
        $query = $this->db->query($sql . $q . $limitation);
        //echo $sql . $q . $limitation;
        $queryAll = $this->db->query($sql . $q);
        $data['data'] = $query->result();
        $data['jumlah'] = $queryAll->num_rows();
        return $data;
    }
}
?>
