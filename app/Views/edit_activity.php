<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Atividade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Editar Atividade</h2>
    <form action="/activity/update/<?= $activity['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $activity['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"><?= $activity['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="start_datetime">Data e horário de inicio</label>
            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" value="<?= date('Y-m-d\TH:i', strtotime($activity['start_datetime'])) ?>" required>
        </div>
        <div class="form-group">
            <label for="end_datetime">Data e horário de fim</label>
            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" value="<?= date('Y-m-d\TH:i', strtotime($activity['end_datetime'])) ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Estado atual</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" <?= $activity['status'] == 'pending' ? 'selected' : '' ?>>Pendente</option>
                <option value="completed" <?= $activity['status'] == 'completed' ? 'selected' : '' ?>>Concluída</option>
                <option value="cancelled" <?= $activity['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
</body>
</html>
