<?php

namespace App\Http\Controllers\Front;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }

    public function showView(){
        $data = [];
        return view('portal.contact_us', parent::_view_data($data));
    }

    public function sendEmail(Request $request){

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

    public function testEmail(Request $request){

        $adminemail = 'angellomijail10@gmail.com';
        $adminname = 'Contacto';
        $adminsubject = 'Nueva Consulta';
        $usersubject = 'Hemos recibido su correo';

        $name = 'Angello';
        $email = 'angellomijail10@gmail.com';
        $mobile = '963702810';
        $messageuser = 'Prueba Prueba';

        $data = array(
            'name'=>$name,
            'email'=>$email,
            'mobile'=>$mobile,
            'messageuser'=>$messageuser
        );

        //Mail to Admin
        Mail::send('portal.mail_admin', $data, function($message) use ($adminname, $adminemail, $adminsubject) {
            $message->to($adminemail, $adminname)->subject($adminsubject);
            $message->from('angellomijail10@gmail.com','Webmaster Fauna Ideas & Diseño');
        });

    }

}