<?php

namespace App\Http\Controllers\Front;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller {

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){

        /*$categories = $this->getListCategories();

        $data = [
            'categories' => $categories
        ];*/

        return view('portal.contact_us');//, $this->_view_data($data));
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

                //$to_name = 'Angello';
                //$to_email = 'angellomijail10@gmail.com';

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

    public function testEmail2(Request $request){

        $to_name = 'Angello';
        $to_email = 'angellomijail10@gmail.com';
        $data = array('name'=>'Nombre Prueba', 'body' => 'A test mail');
        Mail::send('portal.mail', $data, function($message) use ($to_name, $adminemail) {
            $message->to($adminemail, $to_name)->subject($adminsubject);
            $message->from('angellomijail10@gmail.com','Test Mail');
        });

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

    public function sendEmail2(){
        
        //$this->load->view('frontend/correoprueba', $data);

	    if($name != '' && $name != null && $email != '' && $email != null && $mobile != '' && $mobile != null && $message != '' && $message != null){

            try {
                $touser = $email;
                $tocontacto = "contacto@firteccom.com";
                $mobileuser = "Hemos recibido su correo";
                $mobilecontacto = "Nueva Consulta";
                $headersuser = "From: "."webmaster@firteccom.com";
                $headerscontacto = "From: ".$email;


                $cuerpocorreousuario = $this->load->view('frontend/correousuario', $data, TRUE);
                $cuerpocorreocontacto = $this->load->view('frontend/correocontacto', $data, TRUE);

                mail($touser,$mobileuser,$cuerpocorreousuario,$headersuser);
                mail($tocontacto,$mobilecontacto,$cuerpocorreocontacto,$headerscontacto);


                echo json_encode(array('status'=>'success', 'msj'=>'Mensaje enviado'));

            } catch (\Throwable $th) {

                echo json_encode(array('status'=>'error', 'msj'=>'Existe un error'));
            
            }

	    	
	    } else{

	    	echo json_encode(array('status'=>'error', 'msj'=>'Debe completar todos los datos.'));

	    }



	}

}