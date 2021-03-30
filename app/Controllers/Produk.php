<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produk extends BaseController
{
	public function index()
	{
		$data['page'] = 'pages/produk_view';
		return view("main",$data);
	}

	public function data()
	{
		$produkModel = new \App\Models\ProdukModel();
		echo json_encode($produkModel->findAll());
	}
}
