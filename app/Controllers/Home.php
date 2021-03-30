<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['page'] = 'pages/home_view';

		return view('main',$data);
	}

}
