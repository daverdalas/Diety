<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 16:05
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Migration_Add_callendar extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'plan' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'user' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'day' => array('type' => 'TIMESTAMP',),
            'weekend' => array('type' => 'TINYINT', 'constraint' => '1','unsigned' => TRUE,),
            'from' => array('type' => 'INT', 'unsigned' => TRUE,),
            'to' => array('type' => 'INT', 'unsigned' => TRUE,),
            'addy' => array('type' => 'TEXT', 'null' => TRUE,),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('calendar');
   }

    public function down()
    {
        $this->dbforge->drop_table('calendar');
    }
}