<?php

	namespace App\Http\Controllers\Front;

	use App\Model\Parameter;
	use Exception;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Storage;

	class HomeController extends Controller {

		public function _index(){

			/*$logo = Parametro::where('sactivo', 'S')->where('scodigo','LOGO_WEB')->pluck('svalor')[0];
			$txt_portada = Parametro::where('sactivo', 'S')->where('scodigo','TXT_PORTADA')->pluck('svalor')[0];*/
			
			/*return view('portal._index')->with(['title' => 'Visita virtual - Ministerio de Cultura','espacios'=> $espacios,'logo'=>$logo,'txt_portada'=>$txt_portada,'tipo_espacios'=>$tipo_espacios]);*/

			$nsitio = null; //Parameter::where('sstatus', 'A')->where('scode','SITENAME')->pluck('svalue')[0];

			return view('portal._index')->with(['nsitio' => $nsitio]);
		}
	}