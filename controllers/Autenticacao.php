<?


class Autenticao {

    public static function logar($id,$name,$email){
        session_start();
        $_SESSION['usuarioAutenticado']= [
            'id'=> $id,
            'name'=>$name,
            'email'=>$email
        ];
    }
    public static function deslogar(){
        session_destroy();
       
    }

}