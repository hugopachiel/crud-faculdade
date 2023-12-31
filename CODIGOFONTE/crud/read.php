<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM funcionarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["nome"];
                $address = $row["endereco"];
                $salary = $row["salario"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Colaboradores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<header style="  display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    padding: 24px;">
        
        <nav class="nav nav-pills nav-justified-content-center">
        <a class="nav-item nav-link active" href="#">BEM VINDO!</a>
        <a class="nav-item nav-link" href="#">CONTATO TI</a>
        <a class="nav-item nav-link" href="#">SITE</a>
        <a class="nav-item nav-link btn btn-dark" href="#">LOGOUT</a>
        </nav>
        <img style="height: 72px" src="CRUD.png">
    </header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Visualização do Registro</h1>
                    <div class="form-group">
                        <label>Nome</label>
                        <p><b><?php echo $row["nome"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <p><b><?php echo $row["endereco"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salário</label>
                        <p><b><?php echo $row["salario"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>