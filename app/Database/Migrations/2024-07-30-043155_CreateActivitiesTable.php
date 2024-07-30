<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
{
    public function up()
    {   
        $this->forge->dropTable('activities');
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'        => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'name'           => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'description'    => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'start_datetime' => [
                'type'           => 'DATETIME',
            ],
            'end_datetime'   => [
                'type'           => 'DATETIME',
            ],
            'status'         => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'completed', 'cancelled'],
                'default'        => 'pending',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('activities');
    }

    public function down()
    {
        $this->forge->dropTable('activities');
    }
}
