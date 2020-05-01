<?php

namespace App\Http\Controllers;

//Models
use App\Model\BlogCategory;
use App\Model\Catalog;
use App\Model\CatalogProduct;
use App\Model\Category;
use App\Model\File;
use App\Model\Parameter;
use App\Model\Post;
use App\Model\Product;
use App\Model\ProductAttribute;
use App\Model\Slider;
use App\Model\Type;
use App\Model\User;

use Illuminate\Http\Request;
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

	protected $user;

	public function __construct(){

        $this->nsitio = Parameter::where('sstatus', 'A')->where('scode','SITENAME')->pluck('svalue')->first();
        $this->logo = Parameter::where('sstatus', 'A')->where('scode','LOGO')->pluck('svalue')->first();
		$this->twitter = Parameter::where('sstatus', 'A')->where('scode','TWITTER')->pluck('svalue')->first();
		$this->facebook = Parameter::where('sstatus', 'A')->where('scode','FACEBOOK')->pluck('svalue')->first();
		$this->slider = Slider::where('sstatus', 'A')->get();
		$this->categorias = Category::where('sstatus', 'A')->get();
		$this->populares = Product::from('products as prd')->where('prd.sstatus', 'A')->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid')->where('prd.shighlighted','Y')->select('prd.*','cat.ncategoryid as categoryid','cat.sname as category')->get();
		$this->catalogos = Catalog::where('sstatus', 'A')->get();
		$this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            $this->data_general = ['nsitio' => $this->nsitio,
									'logo' => $this->logo,
									'slider'=> $this->slider,
									'twitter'=> $this->twitter,
									'facebook'=> $this->facebook,
									'categorias' => $this->categorias,
									'catalogos' => $this->catalogos,
									'populares' => $this->populares,
									'user'=> $this->user];
            return $next($request);
        });

		
    }


    protected function _view_data($data = array()){
	  return array_merge($this->data_general, $data);
	}


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    

}
