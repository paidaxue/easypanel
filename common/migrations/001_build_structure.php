<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Build_structure extends CI_Migration {
  public function up() {
    //creating database...
    $this->dbforge->create_database('dev.easypanel');

    //creating admin users...
    $this->dbforge->add_field(array(
        'id_user' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'user' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'pass' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));

    $this->dbforge->create_table('ep_admin_users');

    //creating admin settings...
    $this->dbforge->add_field(array(
        'id_setting' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'value' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));

    $this->dbforge->create_table('ep_admin_settings');

    //creating admin sessions...
    $this->dbforge->add_field(array(
        'session_id' => array(
          'type' => 'VARCHAR',
          'constraint' => 40,
          'default' => '0',
        ),
        'id_adress' => array(
          'type' => 'VARCHAR',
          'constraint' => '45',
          'default' => '0',
        ),
        'user_agent' => array(
          'type' => 'VARCHAR',
          'constraint' => '120',
        ),
        'last_activity' => array(
          'type' => 'INT',
          'constraint' => '10',
          'default' => '0',
          'unsigned' => TRUE,
        ),
        'user_data' => array(
          'type' => 'TEXT',
        ),
    ));

    $this->dbforge->create_table('ep_admin_sessions');

    //creating modules...
    $this->dbforge->add_field(array(
        'id_module' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'nickname' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));

    $this->dbforge->create_table('ep_modules');

    //creating pages...
    $this->dbforge->add_field(array(
        'id_page' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'title' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'link_title' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'module' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'page_type' => array(
          'type' => 'INT',
          'constraint' => '11',
          'default' => '1',
        ),
        'content' => array(
          'type' => 'text',
        ),
        'sidebar_style' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'sidebar_left' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'sidebar_right' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
    ));

    $this->dbforge->create_table('ep_pages');

    //creating sidebars...
    $this->dbforge->add_field(array(
        'id_sidebar' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'content' => array(
          'type' => 'TEXT',
        ),
    ));

    $this->dbforge->create_table('ep_modules');

    //creating themes...
    $this->dbforge->add_field(array(
        'id_theme' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'content' => array(
          'type' => 'INT',
          'constraint' => '1',
        ),
    ));

    $this->dbforge->create_table('ep_themes');

  }

  public function down() {
    $this->dbforge->drop_database('easypanel');
  }
}