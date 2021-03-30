<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
	public function index()
	{
		$kategoriModel = new \App\Models\Kategori();

		$data['page'] = 'pages/kategori_view';
		$data['kategori_data'] = $kategoriModel->findAll();
		return view('main',$data);
	}

	public function store(){
		$input = $this->request->getPost();
		$kategoriModel = new \App\Models\Kategori();

		$kategoriModel->insert($input);
		return redirect()->to('/kategori');
	}

	public function show($id){
		$kategoriModel = new \App\Models\Kategori();
		
		$data['kategori'] = $kategoriModel->find($id);
		$data['kategori_data'] = $kategoriModel->findAll();
		$data['page'] = 'pages/kategori_view';
		return view('main',$data);
	}

	public function update($id){
		$kategoriModel = new \App\Models\Kategori();
		$input = $this->request->getPost();

		$kategoriModel->update($id, $input);
		return redirect()->to('/kategori');
	
	}

	public function destroy($id){
		$kategoriModel = new \App\Models\Kategori();
		$kategoriModel->delete($id);
		return redirect()->to('/kategori');
	}
}
