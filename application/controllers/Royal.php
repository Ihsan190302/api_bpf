<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Royal extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Royal_model','ry');
    }
    
    public function index_get()
    {
        $id = $this->get('id');
        if ($id == null) {
            $royal = $this->ry->get();
        } else {
            $royal = $this->ry->get($id);
        }

        if($royal){
            $this->response([
                'status' => true,
                'data' => $royal
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'data' => 'Id tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan ID'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->ry->delete($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data berhasil dihapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'harga' => $this->post('harga')
        ];
        if ($this->ry->insert($data) >= 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambahkan data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'harga' => $this->put('harga')
        ];
        if ($this->ry->update($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal mengubah data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
?>