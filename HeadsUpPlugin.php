<?php


class HeadsUpPlugin extends Omeka_Plugin_AbstractPlugin {

  protected $_hooks = array(
      'install',
      'uninstall',
      'admin_dashboard'
  );

  protected $_filters = array(
      'admin_navigation_main'
  );


  public function hookInstall()
  {
      set_option('headsup-active', 'true');
  }

  public function hookUninstall()
  {
      delete_option('headsup-active');
  }

  public function hookAdminDashboard(){
    $headsup_active = get_option('headsup-active');
    echo "<section class='five columns omega'>
    <div class='panel'>
      <h2>Heads Up Info:</h2>
      <p>Data</p>
      <p>Active: {$headsup_active}</p>
    </div>
    </section>";
  }



  public function filterAdminNavigationMain($navArray){

    $navArray['HeadsUp'] = array(
        'label' => __("HeadsUp"),
        'uri' => url('headsup')
    );

    return $navArray;
  }




}
