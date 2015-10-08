<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 29.09.15
 * Time: 16:30
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Migration_Add_diets extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'calories' => array('type' => 'BIGINT',),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('diets');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'diet' => array('type' => 'BIGINT',),
            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'days' => array('type' => 'BIGINT',),
            'price' => array('type' => 'BIGINT',),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('diet_pricelist');
    }

    public function down()
    {
        $this->dbforge->drop_table('diets');
        $this->dbforge->drop_table('diet_pricelist');
    }
}