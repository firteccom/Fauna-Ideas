<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\BlogCategory;
use App\Model\Post;

class BlogController extends Controller {

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){
        
        $categories = Category::where('sstatus', 'A')->get();
        $posts = $this->getPosts();
        $blogcategorieslist = $this->getListBlogCategories();
        $recentposts = $this->getRecentPosts();
        $archivedposts = $this->getArchivedPosts();

        /*$categories = $this->getListCategories();
        */
        $data = [
            'categories' => $categories,
            'posts' => $posts,
            'recentposts' => $recentposts,
            'blogcategorieslist' => $blogcategorieslist,
            'archivedposts' => $archivedposts
        ];

        return view('portal.blog', $this->_view_data($data));
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

}