<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<body class="d-flex justify-content-center align-items-center vh-100">
    <aside class="col-sm-4">
        <div class="card">
            <article class="card-body">
                <a href="registrar.php" class="float-right btn btn-outline-primary">Cadastrar</a>
                <h4 class="card-title mb-4 mt-1">Login</h4>
                <form action="login-entrar.php" method="post">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input name="nome" class="form-control" placeholder="name" type="name">
                    </div>
                    <div class="form-group">
        <label>Senha:</label>
        <input name="senha" class="form-control" placeholder="******" type="password" required>
        </div>    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> ENTRAR  </button>
                    </div>
                </form>
            </article>
        </div>
    </aside>
</body>

