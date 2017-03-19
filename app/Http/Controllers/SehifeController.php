<?php


 namespace App\Http\Controllers;
 use App\Post;
 class SehifeController extends Controller{

   public function getIndex(){
	 $posts = Post::orderBy("created_at","desc")->limit(4)->get();
     return view("pages/welcome")->withPosts($posts);
   }

   public function getAbout(){
     $ad = "Ilyas";
     $soyad = "Ilyasov";
     $email = "ilyas.ilyasov.1@gmail.com";
     $ad_soyad = $ad." ".$soyad;
     $data = [];
     $data["birinci"] = "bir";
     $data["ikinci"] = "iki";
     $data["ucuncu"] = "uc";
     //return view("about")->with("adsoyad",$ad_soyad);
     return view("pages/about")->withAd_soyad($ad_soyad)->withEmail($email)->withData($data);
   }

 }
