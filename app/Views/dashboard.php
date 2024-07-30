<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda Eletrônica</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
</head>
<body>
<div class="container">
    <h2>Agenda Eletrônica</h2>
    <a href="/activity/create" class="btn btn-primary">Criar Nova Atividade</a>

    <div id="calendar"></div>

    <h3>Suas Atividades</h3>
    <ul class="list-group">
        <?php $activityModel = new \App\Models\ActivityModel();
         foreach ($activities as $activity): ?>
            <li class="list-group-item">
                <strong><?= esc($activity['name']) ?></strong><br>
                <?= esc($activity['description']) ?><br>
                Inicio: <?= esc($activity['start_datetime']) ?><br>
                Fim: <?= esc($activity['end_datetime']) ?><br>
                Estado atual: <?= esc(ucfirst($activityModel->translateStatus($activity['status']))) ?>
                <a href="/activity/edit/<?= $activity['id'] ?>" class="btn btn-warning btn-sm float-right ml-2">Editar</a>
                <a href="/activity/delete/<?= $activity['id'] ?>" class="btn btn-danger btn-sm float-right">Deletar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt-br.min.js"></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            locale: 'pt-br',
            events: '/activity/getUserActivities', // Endpoint to fetch user activities
            editable: true,
            eventClick: function(event) {
                // Event click handling logic
            }
        });
    });
</script>
</body>
</html>
