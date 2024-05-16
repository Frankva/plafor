<?php
/**
 * Fichier de migration créant la table course_plan
 *
 * @author      Orif (ViDi, HeMa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddCoursePlan extends Migration {

    public function up() {


        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'formation_number' => [
                'type' => 'varchar',
                'constraint' => '5',
            ],
            'official_name' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'date_begin' => [
                'type' => 'date',

            ],
            'archive timestamp null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('course_plan');
        $seeder = \Config\Database::seeder();
        $seeder->call('\Plafor\Database\Seeds\addCoursePlanDatas');
    }

    public function down() {
        $this->forge->dropTable('course_plan');
    }
}