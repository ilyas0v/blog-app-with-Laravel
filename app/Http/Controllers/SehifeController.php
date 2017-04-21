<?php


 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use App\Post;
 use Mail;
 class SehifeController extends Controller{



   public function getIndex(){
	 $posts = Post::orderBy("created_at","desc")->limit(4)->get();
     return view("pages/welcome")->withPosts($posts);
   }

   public function postContact(Request $request){
     $this->validate($request , [
       "email"   => "required|email",
       "subject" => "min:3",
       "message" => "min:10|"
     ]);
     $data = [
       'email' => $request->email,
       'subject' => $request->subject,
       'bodyMessage' => $request->message
     ];
     Mail::send('emails.contact',$data,function($message) use ($data){
	      $message->from($data['email']);
	       $message->to('ilyas.ilyasov.1@gmail.com');
	        $message->subject($data['subject']);
     });
   }

   public function getAbout(){
     $ad = "ABC";
     $soyad = "BCA";
     $email = "ABCDBA@gmail.com";
     $ad_soyad = $ad." ".$soyad;
     $data = [];
     $data["birinci"] = "bir";
     $data["ikinci"] = "iki";
     $data["ucuncu"] = "uc";
     //return view("about")->with("adsoyad",$ad_soyad);
     return view("pages/about")->withAd_soyad($ad_soyad)->withEmail($email)->withData($data);
   }

 }
