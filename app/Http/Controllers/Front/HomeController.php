<?php

	namespace App\Http\Controllers\Front;

	use App\Model\Parameter;
	use App\Model\Category;
	use App\Model\Product;
	use App\Model\Catalog;
	use App\Model\Slider;
	use Exception;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Storage;

	class HomeController extends Controller {

		public function _index(){

			$nsitio = Parameter::where('sstatus', 'A')->where('scode','SITENAME')->pluck('svalue')->first();
			$logo = Parameter::where('sstatus', 'A')->where('scode','LOGO')->pluck('svalue')->first();
			$twitter = Parameter::where('sstatus', 'A')->where('scode','TWITTER')->pluck('svalue')->first();
			$facebook = Parameter::where('sstatus', 'A')->where('scode','FACEBOOK')->pluck('svalue')->first();
			
			$slider = Slider::where('sstatus', 'A')->get();
			$categorias = Category::where('sstatus', 'A')->get();
			$populares = Product::where('sstatus', 'A')->where('shighlighted','Y')->get();
			$catalogos = Catalog::where('sstatus', 'A')->get();

			return view('portal._index')->with(['nsitio' => $nsitio,
												'logo' => $logo,
												'slider'=> $slider,
												'twitter'=> $twitter,
												'facebook'=> $facebook,
												'categorias' => $categorias,
												'catalogos' => $catalogos,
												'populares' => $populares]);
		}
	}