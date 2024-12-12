<?

class UserController{
    

    // exibi todos os usuarios
    public function index(){

    }

    // cadastra o usuario
    public function store(){
        include __DIR__ .'/../includes/db.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Criptografa a senha
        
            // Verificando se o e-mail já existe
            function verificarDominioEmail($email)
            {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return "E-mail inválido!";
                }
        
                $dominio = substr(strrchr($email, "@"), 1);
        
                // Verifica se o domínio possui um registro MX válido
                if (checkdnsrr($dominio, 'MX')) {
                    return "O domínio do e-mail é válido!";
                } else {
                    return "O domínio do e-mail não é válido!";
                }
            }
        
            // Verificando o domínio do e-mail
            $emailMensagem = verificarDominioEmail($email);
            echo $emailMensagem;
           
        
            // Verificando se o e-mail já está cadastrado
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $usuarioExistente = $stmt->fetch();
        
            if ($usuarioExistente) {
                echo "<p class='erro'>Esse e-mail já está cadastrado. Tente outro.</p>";
            } else {
                // Inserindo o novo usuário no banco de dados
                $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
                $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]);
        
                echo "<p>Cadastro realizado com sucesso! <a href='login.php'>Clique aqui para entrar.</a></p>";
            }
        }
                // Verificando se o e-mail já está cadastrado
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $usuarioExistente = $stmt->fetch();
        
            if ($usuarioExistente) {
                echo "<p class='erro'>Esse e-mail já está cadastrado. Tente outro.</p>";
            } else {
                // Inserindo o novo usuário no banco de dados
                $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
                $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]);
        
                echo "<p>Cadastro realizado com sucesso! <a href='login.php'>Clique aqui para entrar.</a></p>";
            }
        
    }

        
    

    // exibi um usuario pelo id 
    public function show($id){

    }
    // deleta o usuario
    public function destroy(){

    }
    // carrega a pagina para editar os dados do usuario
    public function edit(){

    }
    // atualiza os dados do usuario
    public function update(){

    }
}