<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Registro</h2>
    <form action="/auth/registerSave" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="username">Usuário</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= isset($validation) ? old('username') : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= isset($validation) ? old('email') : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <p class="mt-3">
            Já tem uma conta? <a href="/auth/login">Faça login</a>
        </p>
    </form>
</div>
</body>
</html>
