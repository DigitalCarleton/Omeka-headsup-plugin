<?php


class HeadsUpPlugin extends Omeka_Plugin_AbstractPlugin {

  protected $_hooks = array(
      'admin_dashboard'
  );

  protected $_filters = array(
      'admin_navigation_main'
  );


  public function hookAdminDashboard(){
    echo "<section>HELLLLOOOOOOO</section>";
  }



  public function filterAdminNavigationMain($navArray){

    $navArray['AccessibilityPlus'] = array(
        'label' => __("HeadsUp"),
        'uri' => url('headsup')
    );

    return $navArray;
  }




}
