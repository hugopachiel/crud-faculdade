<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM funcionarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
        <div class="container-fluid shadow-lg p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">REMOVER FUNCIONÁRIO</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-warning">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Deseja realmente deletar o registro do funcionário?</p>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-light">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>