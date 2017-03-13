<?php


 namespace App\Http\Controllers;

 class SehifeController extends Controller{

   public function getIndex(){
     return view("pages/welcome");
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
