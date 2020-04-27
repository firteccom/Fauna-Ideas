<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\BlogCategory;
use App\Model\Post;

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

}