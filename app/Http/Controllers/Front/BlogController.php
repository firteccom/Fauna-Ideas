<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\BlogCategory;
use App\Model\Post;
use App\Model\PostComment;

class BlogController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }
    
    public function showView(){
        $data = [];
        $posts = $this->getPosts();
        $blogcategorieslist = $this->getListBlogCategories();
        $recentposts = $this->getRecentPosts();
        $archivedposts = $this->getArchivedPosts();

        $data = [
            'posts' => $posts,
            'recentposts' => $recentposts,
            'blogcategorieslist' => $blogcategorieslist,
            'archivedposts' => $archivedposts
        ];

        return view('portal.blog', parent::_view_data($data));
    }

    public function getListBlogCategories(){

        $data = BlogCategory::from('blog_categories as blg');

        
        $data = $data->where('blg.sstatus','A');

        $select[] = 'blg.nblogcategoryid as blogcategoryid';
        $select[] = 'blg.sname as blogcategoryname';
        
        $data = $data->select($select)
        ->orderBy('blg.dcreatedon', 'desc')
        ->get();

        return $data;

    }
        
    public function getPosts(){

        $data = Post::from('posts as pst')
                ->join('blog_categories as blg','blg.nblogcategoryid','=','pst.nblogcategoryid');

        
        $data = $data->where('pst.sstatus','A');

        $select[] = '*';
        $select[] = 'pst.sdescription as postdescription';
        $select[] = 'blg.sname as blogcategoryname';
        $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d/%m/%Y") as date');
        $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d") as day');
        $select[] = \DB::raw('ELT(DATE_FORMAT(pst.dcreatedon,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic") as month');
        
        $data = $data->select($select)
        ->orderBy('pst.dcreatedon', 'desc')
        ->get();

        return $data;

    }

    public function getRecentPosts(){

        $data = Post::from('posts as pst');
        
        $data = $data->where('pst.sstatus','A');

        $select[] = 'pst.*';
        $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d/%m/%Y") as date');
        $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d") as day');
        $select[] = \DB::raw('ELT(DATE_FORMAT(pst.dcreatedon,"%m"),"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre") as month');
        $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%Y") as year');
        
        $data = $data->select($select)
        ->orderBy('pst.dcreatedon', 'desc')
        ->limit(3)
        ->get();

        return $data;

    }

    public function getArchivedPosts(){

        $data = Post::from('posts as pst')->select(\DB::raw('DISTINCT DATE_FORMAT(dcreatedon,"%m-%Y") as archivedate'))->groupBy('pst.dcreatedon')->get();

        return $data;

    }

    public function postDetail($id){

        $post = $this->getPost($id)['post'];
        $blogcategorieslist = $this->getListBlogCategories();
        $relatedposts = $this->getRecentPosts();
        $recentposts = $this->getRecentPosts();
        $archivedposts = $this->getArchivedPosts();

        $data = [
            'post' => $post,
            'relatedposts' => $relatedposts,
            'recentposts' => $recentposts,
            'blogcategorieslist' => $blogcategorieslist,
            'archivedposts' => $archivedposts
        ];

        //echo $product->nproductid;

        if ($this->getPost($id)['status'] == 'success' && $this->getPost($id)['post'] != null)
        {
            
            return view('portal.post', $this->_view_data($data));

        } else {

            return view('portal.product_not_found', $this->_view_data($data));
            
        }

    }
        
    public function getPost($id){

        try {

            $data = Post::from('posts as pst')
                    ->join('blog_categories as blg','blg.nblogcategoryid','=','pst.nblogcategoryid');

            
            $data = $data->where('pst.sstatus','A');
            $data = $data->where('pst.npostid',$id);

            $select[] = '*';
            $select[] = 'pst.sdescription as postdescription';
            $select[] = 'blg.sname as blogcategoryname';
            $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d/%m/%Y") as date');
            $select[] = \DB::raw('DATE_FORMAT(pst.dcreatedon,"%d") as day');
            $select[] = \DB::raw('ELT(DATE_FORMAT(pst.dcreatedon,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic") as month');
                    
            $data = $data->select($select)->first();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente la publicación.';
            $resp['post'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo la publicación '.$ex->getMessage();
            $resp['post'] = '';
        }

        //var_dump($data);

        return $resp;

    }

    public function sendComment(Request $request){
        
        $postid = @$request->postid;
        $name = @$request->name;
        $email = @$request->email;
        $mobile = @$request->mobile;
        $comment = @$request->comment;
        $ipaddress = '';

        try {
            $postcomment = new PostComment();
            $postcomment->npostid = $postid;
            $postcomment->sname = $name;
            $postcomment->semail = $email;
            $postcomment->smobile = $mobile;
            $postcomment->scomment = $comment;

            //Get device Address Public 
            $ipaddress = $this->get_client_ip();
            $postcomment->smac = "";
            $postcomment->saddresspublic = $ipaddress;
            
            $postcomment->saveAsNew();
            //var_dump($post);

            $data['status'] = 'success';
            $data['msg'] = 'Tu comentario se registró correctamente, un moderador lo revisará y te enviaremos un correo informando el rechazo o aprobación.';

        } catch (\Exception $ex) {

            $data['status'] = 'error';
            $data['msg'] = 'No se pudo registrar tu comentario '.$ex->getMessage();

        }
            
        return response()->json($data);
        
    }

    private function sendEmail($name, $email, $mobile, $comment){

        $adminemail = 'angellomijail10@gmail.com';
        $adminname = 'Contacto';
        $adminsubject = 'Nueva Consulta';
        $usersubject = 'Hemos recibido su correo';

        $name = @$request->name;
        $email = @$request->email;
        $mobile = @$request->mobile;
        $messageuser = @$request->message;

	    if($name != '' && $name != null && $email != '' && $email != null && $messageuser != '' && $messageuser != null){

            try {

                $data = array(
                    'name'=>$name,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'messageuser'=>$messageuser
                );

                //Mail to User
                Mail::send('portal.mail_user', $data, function($message) use ($name, $email, $usersubject) {
                    $message->to($email, $name)->subject($usersubject);
                    $message->from('angellomijail10@gmail.com','Webmaster Fauna Ideas & Diseño');
                });

                //Mail to Admin
                Mail::send('portal.mail_admin', $data, function($message) use ($adminname, $adminemail, $adminsubject) {
                    $message->to($adminemail, $adminname)->subject($adminsubject);
                    $message->from('angellomijail10@gmail.com','Webmaster Fauna Ideas & Diseño');
                });
                
                $data['status'] = 'success';
                $data['msg'] = 'Mensaje enviado';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el archivo '.$ex->getMessage();
            
            }
        
        } else{

            $data['status'] = 'warning';
            $data['msg'] = 'Debe completar todos los datos requeridos.';

        }
                
        return response()->json($data);

    }

    function get_client_ip(){
       // Nothing to do without any reliable information
       if (!isset ($_SERVER['REMOTE_ADDR'])) {
           return NULL;
       }

       // Header that is used by the trusted proxy to refer to
       // the original IP
       $proxy_header = "HTTP_X_FORWARDED_FOR";

       // List of all the proxies that are known to handle 'proxy_header'
       // in known, safe manner
       $trusted_proxies = array ("2001:db8::1", "192.168.50.1");

       if (in_array ($_SERVER['REMOTE_ADDR'], $trusted_proxies)) {

           // Get the IP address of the client behind trusted proxy
           if (array_key_exists ($proxy_header, $_SERVER)) {

               // Header can contain multiple IP-s of proxies that are passed through.
               // Only the IP added by the last proxy (last IP in the list) can be trusted.
               $proxy_list = explode (",", $_SERVER[$proxy_header]);
               $client_ip = trim (end ($proxy_list));

               // Validate just in case
               if (filter_var ($client_ip, FILTER_VALIDATE_IP)) {
                   return $client_ip;
               } else {
                   // Validation failed - beat the guy who configured the proxy or
                   // the guy who created the trusted proxy list?
                   // TODO: some error handling to notify about the need of punishment
               }
           }
       }

       // In all other cases, REMOTE_ADDR is the ONLY IP we can trust.
       return $_SERVER['REMOTE_ADDR'];
    }

}