<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MemberController extends BaseController
{
	public function index()
	{
		$memberModel = new \App\Models\Member();
		$member = $memberModel->findAll();

		return $this->response->setJSON(['data'=>$member]);
	}
}
