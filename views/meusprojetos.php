
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/mostrarpj.css">
</head>
<body>
    <?php 

var_dump(session_status());


    var_dump($_SESSION['meusProjetos'])?>
    <?php include_once __DIR__."/components/header.php" ?>
    <h1>Seus Projetos</h1>
    <ul>
       <?php 
       // Verifica se há projetos do usuário
       if (!empty($projetos_user)){ 
           foreach ($projetos_user as $projeto):               
               echo htmlspecialchars($projeto['name']); 
           endforeach; 
       } else {
           echo "Nenhum projeto encontrado."; // Corrigido o fechamento do echo
       }
       ?>
    </ul>

    <h1>Projetos de outros usuários</h1>
    <ul>
        <?php if (!empty($projetos_terceiros)){
            foreach ($projetos_terceiros as $projeto):
                echo htmlspecialchars($projeto['name']);
            endforeach;
        }else{
           echo "Nenhum projeto encontrado";
        }
        ?>
    </ul>

    <a href="formulario">Criar projeto</a>

    <?php include_once __DIR__."/components/footer.php";?> 
</body>
</html>
