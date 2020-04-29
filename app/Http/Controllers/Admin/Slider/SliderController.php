<?php

    namespace App\Http\Controllers\Admin\Slider;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Controller;
    use App\Model\Slider;
    use App\Model\Product;
    use App\Model\Category;
    use App\Model\Catalog;
    use App\Model\Type;

    class SliderController extends Controller {

        public function __construct(){
            parent::__construct(); 
        }


        public function showView(){

            $tiposobj = Type::from('types')->where('sstatus','A')->where('ntypeparentid',20)->get();

            $data = [
                'tiposobj' => $tiposobj
            ];

            return view('admin.slider', parent::_view_data($data));
        }


        public function getSlide(Request $request){

            try {

                $data = Slider::from('slides as sld');
                
                $data = $data->where('sld.nslideid',$request->nslideid);
        
                $select[] = 'sld.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el slide.';
                $resp['slide'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el slide '.$ex->getMessage();
                $resp['slide'] = '';
            }

            return response($resp);

        }

        public function getSlides(Request $request){

            $item_por_pag = $request->length;
            $pagina = $request->start;

            $slidemaintext = $request->slidemaintext;
            $slidesecondarytext = $request->slidesecondarytext;
            $slidestatus = $request->slidestatus;
    
            $data = [];
            $data['draw'] = (int)$request->draw;

            $data['recordsTotal'] = $this->getSlidesFilter($slidemaintext,$slidesecondarytext,$slidestatus,$item_por_pag,$pagina,true);
            $data['recordsFiltered'] = $data['recordsTotal'];
    
            $data['data'] = $this->getSlidesFilter($slidemaintext,$slidesecondarytext,$slidestatus,$item_por_pag,$pagina,false);
    
            return response($data);

        }

        public function getSlidesFilter($slidemaintext,$slidesecondarytext,$slidestatus,$item_por_pag,$pagina,$contar){
            $data = Slider::from('slides as sld');

            if(trim($slidemaintext)!=''){
                $data = $data->where(\DB::raw('UPPER(sld.smaintext)'), 'like', '%'. mb_strtoupper(trim($slidemaintext)).'%');
            }

            if(trim($slidesecondarytext)!='' && $slidesecondarytext!=0){
                $data = $data->where(\DB::raw('UPPER(sld.ssecondarytext)'), '=', $slidesecondarytext);
            }

            if(trim($slidestatus)!=''){
                $data = $data->where(\DB::raw('UPPER(sld.sstatus)'), '=', $slidestatus);
            }
        
            if ($contar){
    
                $data = $data->count();
    
            } else {
    
                $select[] = 'sld.*';
                
    
                $data = $data->select($select)
                ->offset($pagina)->limit($item_por_pag)
                ->get();
            }

    
            return $data;
    
        }


        public function saveSlide(Request $request){
            try {

                $slider = new Slider();
                $slider->nobjecttype = $request->objecttype;
                $slider->nobjectid = $request->objectid;
                $slider->smaintext = $request->slidemaintext;
                $slider->ssecondarytext = $request->slidesecondarytext;
                $slider->sbuttontext = $request->slidebuttontext;
                $slider->sfullimage = $request->slidefullimage;
                $slider->dcreatedon = @date('Y-m-d H:i:s');
                $slider->ncreatedby = Auth::user()->nuserid;
                
                $slider->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'El slide se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el slide '.$ex->getMessage();

            }
                
            return response()->json($data);
        }

        public function updateSlide(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('slides')
                        ->where('nslideid',$request->nslideid)
                        ->update(['nobjecttype'=>$request->objecttype,
                                  'nobjectid'=>$request->objectid,
                                  'smaintext'=>$request->slidemaintext,
                                  'ssecondarytext'=>$request->slidesecondarytext,
                                  'sbuttontext'=>$request->slidebuttontext,
                                  'sfullimage'=>$request->slidefullimage,
                                  'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                  'nmodifiedby'=>Auth::user()->nuserid]);
                                  
                $resp['status'] = 'success';
                $resp['msg'] = 'El slide se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el slide '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }


        public function desactivateSlide(Request $request){
            try {
                $data = \DB::connection('mysql')->table('slides')->where('nslideid',$request->id)->update(['sstatus'=>'N']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El slide se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el slide '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateSlide(Request $request){
            try {
                $data = \DB::connection('mysql')->table('slides')->where('nslideid',$request->id)->update(['sstatus'=>'A']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El slide se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el slide '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }


        public function getObjects(Request $request){

        try {

            switch ($request->tipo) {
                case '21':
                    $data = Product::from('products as pr')->where('pr.sstatus','A')->select('pr.nproductid as id', 'pr.*')->get();
                break;
                case '22':
                    $data = Category::from('categories as cat')->where('cat.sstatus','A')->select('cat.ncategoryid as id', 'cat.*')->get();
                break;
                case '23':
                    $data = Catalog::from('catalog as cat')->where('cat.sstatus','A')->select('cat.ncatalogid as id', 'cat.*')->get();
                break;
            }
            

    
            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente la lista de objetos.';
            $resp['objects'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo obtener la información '.$ex->getMessage();

            }

            return response()->json($resp);

        }


    }