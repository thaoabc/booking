<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use App\Model\phong;
class phongcontroller extends Controller
{
	public function view_all(){
		$phong = new phong();
		$array_phong = $phong->view_all();
		return view('phong.view_all',[
			'array_phong' => $array_phong
		]);
	}
	public function view_insert(){
		$phong = new phong();
		$array_phong = $phong->insert();
		return view('phong.view_insert');
	}
}