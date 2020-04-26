<?php

namespace App\Http\Controllers;

use App\Model\Parameter;
use App\Model\Category;
use App\Model\Product;
use App\Model\Catalog;
use App\Model\Slider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

	protected $nsitio;
	protected $logo;
	protected $twitter;
	protected $facebook;
	protected $slider;
	protected $categorias;
	protected $populares;
	protected $catalogos;
	protected $data_general;

	public function __construct(){

        $this->nsitio = Parameter::where('sstatus', 'A')->where('scode','SITENAME')->pluck('svalue')->first();
        $this->logo = Parameter::where('sstatus', 'A')->where('scode','LOGO')->pluck('svalue')->first();
		$this->twitter = Parameter::where('sstatus', 'A')->where('scode','TWITTER')->pluck('svalue')->first();
		$this->facebook = Parameter::where('sstatus', 'A')->where('scode','FACEBOOK')->pluck('svalue')->first();
		$this->slider = Slider::where('sstatus', 'A')->get();
		$this->categorias = Category::where('sstatus', 'A')->get();
		$this->populares = Product::where('sstatus', 'A')->where('shighlighted','Y')->get();
		$this->catalogos = Catalog::where('sstatus', 'A')->get();

		$this->data_general = ['nsitio' => $this->nsitio,
		'logo' => $this->logo,
		'slider'=> $this->slider,
		'twitter'=> $this->twitter,
		'facebook'=> $this->facebook,
		'categorias' => $this->categorias,
		'catalogos' => $this->catalogos,
		'populares' => $this->populares];

    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    

}
