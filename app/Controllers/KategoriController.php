<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
	var $kategori;

	public function __construct()
	{
		$this->kategori = new \App\Models\Kategori();
	}

	public function index()
	{		
		$segment = $this->request->uri->getSegment(1);
		
		$data['page'] = 'pages/kategori_view';
		if($segment=='api'){
			return $this->getData();
		}else
			return view('main',$data);
	}

	public function cmbKategori(){
		$kategoriModel = new \App\Models\Kategori();

		return $this->response->setJSON(
			$kategoriModel->findAll()
		);
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

	private function getData(){
		$data = $this->kategori->findAll();
		return $this->response->setJSON(['data'=>$data]);
	}
}
