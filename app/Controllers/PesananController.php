<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PesananController extends BaseController
{
	var $pesanan;

	public function __construct()
	{
		$this->pesanan = new \App\Models\Pesanan();
	}

	public function index()
	{
		$segment = $this->request->uri->getSegment(1);

		$data['page'] = 'pages/pesanan_view';
		if($segment=='api'){
			return $this->getData();
		}else
			return view('main',$data);
	}

	private function getData(){
		$data = $this->pesanan->findAll();
		return $this->response->setJSON(['data'=>$data]);
	}
}
