<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Build_structure extends CI_Migration {

  public function up() {
    $this->load->dbforge();

    //creating admin users...
    $this->dbforge->add_field(array(
      'id_user' => array(
        'type' => 'INT',
        'constraint' => 5,
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
      'fullname' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'avatar' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
    ));
    $this->dbforge->add_key('id_user', TRUE);
    $this->dbforge->create_table('ep_admin_users');

    //creating admin settings...
    $this->dbforge->add_field(array(
      'id_setting' => array(
        'type' => 'INT',
        'constraint' => 5,
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
    $this->dbforge->add_key('id_setting', TRUE);
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
    $this->dbforge->add_key('session_id', TRUE);
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
      'module_slug' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
    ));
    $this->dbforge->add_key('id_module', TRUE);
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
      'page_slug' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'module' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'page_type' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
        'default' => 'parent',
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
    $this->dbforge->add_key('id_page', TRUE);
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
    $this->dbforge->add_key('id_sidebar', TRUE);
    $this->dbforge->create_table('ep_sidebars');

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
      'active' => array(
        'type' => 'INT',
        'constraint' => '1',
        'default' => '0'
      ),
    ));
    $this->dbforge->add_key('id_theme', TRUE);
    $this->dbforge->create_table('ep_themes');

    $ep_admin_settings = array(
      array(
        'name'  => 'website_title',
        'value' => 'Website Title',
      ),
      array(
        'name'  => 'website_logo',
        'value' => 'logo.png',
      ),
      array(
        'name'  => 'website_copyright',
        'value' => 'Website Copyright',
      ),
      array(
        'name'  => 'website_homepage',
        'value' => '1',
      ),
    );

    foreach ($ep_admin_settings as $admin_setting) {
      $this->db->insert( "ep_admin_settings", $admin_setting );
    }

    $ep_admin_users = array(
      array(
        'user'      => 'admin',
        'pass'      => '$1$bA3.Ib5.$0aMvbLek/MvCcpzfvja98.',
        'fullname'  => 'Administrator',
        'email'     => 'admin@easypanel-cms.com',
        'avatar'    => 'account/default.png',
      ),
    );

    foreach ($ep_admin_users as $admin_user) {
      $this->db->insert( "ep_admin_users", $admin_user );
    }

    $ep_modules = array(
      array(
        'name'        => 'Simple page',
        'module_slug' => 'simple_page',
      ),
    );

    foreach ($ep_modules as $admin_module) {
      $this->db->insert( "ep_modules", $admin_module );
    }

    $ep_pages = array(
      array(
        'title'         => 'Home',
        'page_slug'     => 'homepage',
        'module'        => 'simple_page',
        'page_type'     => 'parent',
        'content'       => '<p>homepage</p>',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '0',
      ),
      array(
        'title'         => 'First Page',
        'page_slug'     => 'first_page',
        'module'        => 'simple_page',
        'page_type'     => 'parent',
        'content'       => '<p>Lorem ipsum</p>',
        'sidebar_style' => 'none',
        'sidebar_left'  => '0',
        'sidebar_right' => '0',
      )
    );

    foreach ($ep_pages as $page) {
      $this->db->insert("ep_pages", $page);
    }

    $ep_themes = array(
      array(
        'name'    => 'test',
        'active'  => '0',
      ),
    );

    foreach ($ep_themes as $themes) {
      $this->db->insert("ep_themes", $themes);
    }
  }

  public function down() {
    $this->dbforge->drop_database('easypanel');
  }
}