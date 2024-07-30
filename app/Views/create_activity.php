<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criar Atividade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Criar uma atividade</h2>
    <form action="/activity/store" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="start_datetime">Data e horário de inicio</label>
            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
        </div>
        <div class="form-group">
            <label for="end_datetime">Data e horário de fim</label>
            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
</div>
</body>
</html>
