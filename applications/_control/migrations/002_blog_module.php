<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Blog_module extends CI_Migration {

  public function up() {
    $this->load->dbforge();

    //creating blog table...
    $this->dbforge->add_field(array(
        'id_post' => array(
          'type' => 'INT',
          'constraint' => 5,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'title' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'image' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'content' => array(
          'type' => 'TEXT',
        ),
        'date_created' => array(
          'type' => 'DATE',
        ),
    ));
    $this->dbforge->add_key('id_post', TRUE);
    $this->dbforge->create_table('blog');
  }

  public function down() {
    $this->dbforge->drop_table('blog');
  }
}