<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 16:05
 */

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Migration_Add_invoices extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'order' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'user' => array('type' => 'BIGINT','unsigned' => TRUE,),
            'path' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('invoices');
   }

    public function down()
    {
        $this->dbforge->drop_table('invoices');
    }
}