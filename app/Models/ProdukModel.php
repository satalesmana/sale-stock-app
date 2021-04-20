<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'produks';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_produk','kategori_id','gambar','harga'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'nama_produk'=>'required',
		'kategori_id'=>'required|integer',
		'harga'=>'required'
	];
	protected $validationMessages   = [
		'kategori_id'=>[
			'required'=>'kolom kategori harus di isi',
			'integer'=>'kolom kategori harus berupa integer / number',
		],
		'harga'=>[
			'required'=>'Harga harus di isi',
		]
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = ['getKategoriById'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function getKategoriById(array $produk){

		$kategori = new \App\Models\Kategori();
		
		if(isset($produk['data']['kategori_id'])){
			$kategori_id = $produk['data']['kategori_id'];
			$produk['data']['kategori'] =  $kategori->find($kategori_id);
		}else{
			foreach($produk['data'] as $key=>$item){
				$kategori_id = $item['kategori_id'];
				$produk['data'][$key]['kategori'] =  $kategori->find($kategori_id);
			}
		}

		

		return $produk;
	}
}
