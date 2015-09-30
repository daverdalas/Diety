<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 28.09.15
 * Time: 14:31
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Migration_Add_users extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'email' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'hash' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'name' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'surname' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'addy' => array('type' => 'TEXT', 'null' => FALSE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '255',),
            'nip' => array('type' => 'VARCHAR', 'null' => TRUE, 'constraint' => '255',),
            'fvat' => array('type' => 'VARCHAR', 'null' => TRUE, 'constraint' => '255',),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}