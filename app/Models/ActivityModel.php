<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'name', 'description', 'start_datetime', 'end_datetime', 'status'];
    public function translateStatus($status)
    {
        switch ($status) {
            case 'pending':
                return 'Pendente';
            case 'completed':
                return 'Concluída';
            case 'canceled':
                return 'Cancelada';
            default:
                return 'Status desconhecido';
        }
    }
}
