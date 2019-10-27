<?php


class HeadsUpPlugin extends Omeka_Plugin_AbstractPlugin {

  protected $_hooks = array(
      'admin_dashboard'
  );

  protected $_filters = array(
      'admin_navigation_main'
  );


  public function hookAdminDashboard(){
    echo "<section class='five columns omega'>
    <div class='panel'>
      <h2>Heads Up Info:</h2>
      <p>data</p>
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
