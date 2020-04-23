<?php

    namespace App\Http\Controllers\Admin\Catalog;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Catalog;

    class CatalogController extends Controller {

        private function _view_data($data = array()){
          $data_view = [];
    
          return array_merge($data_view, $data);
        }

        public function showView(){

            $data = [
                
            ];

            return view('admin.catalog', $this->_view_data($data));
        }

        public function getCatalog(Request $request){

            try {

                $data = Catalog::from('catalog as cat');
                
                $data = $data->where('cat.ncatalogid',$request->ncatalogid);
        
                $select[] = 'cat.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el catálogo.';
                $resp['catalog'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el catálogo '.$ex->getMessage();
                $resp['catalog'] = '';
            }
    
            return response($resp);

        }


        public function saveCatalog(Request $request){

            try {
                $catalog = new Catalog();
                $catalog->sname = $request->catalogname;
                $catalog->sdescription = $request->catalogdescription;
                $catalog->sfullimage = $request->catalogfullimage;
				$catalog->ncreatedby = Auth::user()->nuserid;
                
                $catalog->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'El catálogo se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el catálogo '.$ex->getMessage();

            }

            return response()->json($data);

        }


        public function updateCatalog(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('catalog')
                        ->where('ncatalogid',$request->catalogid)
                        ->update(['sname'=>$request->catalogname,
                                  'sdescription'=>$request->catalogdescription,
                                  'sfullimage'=>$request->catalogfullimage,
                                  'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                  'nmodifiedby'=>Auth::user()->nuserid]);
                                  
                $resp['status'] = 'success';
                $resp['msg'] = 'El catálogo se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el catálogo '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }


        public function getCatalogs(Request $request){

            //$codigousuario = Auth::user()->id;
            $item_por_pag = $request->length;
            $pagina = $request->start;

            $catalogname = $request->catalogname;
            $catalogdescription = $request->catalogdescription;
            $catalogstatus = $request->catalogstatus;
    
            $data = [];
            $data['draw'] = (int)$request->draw;

            $data['recordsTotal'] = $this->getCatalogFilter($catalogname,$catalogdescription,$catalogstatus,$item_por_pag,$pagina,true);
            $data['recordsFiltered'] = $data['recordsTotal'];
    
            $data['data'] = $this->getCatalogFilter($catalogname,$catalogdescription,$catalogstatus,$item_por_pag,$pagina,false);
    
            return response($data);

        }

        public function getCatalogFilter($catalogname,$catalogdescription,$catalogstatus,$item_por_pag,$pagina,$contar){
            $data = Catalog::from('catalog as cat');

            if(trim($catalogname)!=''){
                $data = $data->where(\DB::raw('UPPER(cat.sname)'), 'like', '%'. mb_strtoupper(trim($catalogname)).'%');
            }

            if(trim($catalogdescription)!=''){
                $data = $data->where(\DB::raw('UPPER(cat.sdescription)'), '=', $catalogdescription);
            }

            if(trim($catalogstatus)!=''){
                $data = $data->where(\DB::raw('UPPER(cat.sstatus)'), '=', $catalogstatus);
            }
        
            if ($contar){
    
                $data = $data->count();
    
            } else {
    
                $select[] = 'cat.*';
                
    
                $data = $data->select($select)
                ->offset($pagina)->limit($item_por_pag)
                ->get();
            }

    
            return $data;
    
        }


        public function desactivateCatalog(Request $request){
            try {
                $data = \DB::connection('mysql')->table('catalog')->where('ncatalogid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El catálogo se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el catálogo '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateCatalog(Request $request){
            try {
                $data = \DB::connection('mysql')->table('catalog')->where('ncatalogid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El catálogo se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el catálogo '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }
     
    }
