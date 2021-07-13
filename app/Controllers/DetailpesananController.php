<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DetailpesananController extends BaseController
{
	var $MAC;

	public function __construct()
	{
		$string=exec('getmac');
		$this->MAC = substr($string, 0, 17); 
	}

	public function index()
	{
		$krjModel = new \App\Models\Keranjang();
		$data = $krjModel->where('mac', $this->MAC)->findAll();

		return $this->response->setJSON(['data'=>$data]);
	}

	public function create(){
		$krjModel = new \App\Models\Keranjang();
		$produk = $this->request->getPost('nama_produk');
		$arprd  = explode("-",$produk);
		
		$input['mac'] = $this->MAC;	
		$input['qty'] = $this->request->getPost('qty');
		$input['id_produk'] = $arprd[0];
		$input['nama_produk'] = $arprd[1];

		$krjModel->save($input);
		
		return $this->response->setJSON(['message'=>'data berhasil ditambahkan']);
	}

	public function delete($id){
		$krjModel = new \App\Models\Keranjang();
		$krjModel->delete($id);
		return $this->response->setJSON(['message'=>'data berhasil dihapus']);
	}
}
