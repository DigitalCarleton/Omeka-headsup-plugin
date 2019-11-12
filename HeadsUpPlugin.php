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
      set_option('headsup_active', 1);
  }

  public function hookUninstall()
  {
      delete_option('headsup_active');
  }


  public function filterAdminNavigationMain($navArray){

    $navArray['HeadsUp'] = array(
        'label' => __("HeadsUp"),
        'uri' => url('heads-up')
    );

    return $navArray;
  }



  public function hookAdminDashboard(){
    $headsup_active = get_option('headsup_active');
    if ($headsup_active == 1) {

      $exhibits = get_records('Exhibit', limit=0);
      $numExhibits = count($exhibits);

      var_dump($exhibits);

      $totalPages = 0;
      foreach ($exhibits as $key => $exhibit) {
        $pages = $exhibit->getPages();
        $numPages = count($pages);
        $totalPages += $numPages;
      }






      echo "<section class='five columns omega'>
      <div class='panel'>
        <h2>Heads Up Info:</h2>
        <p>Number of exhibits: {$numExhibits}</p>
        <p>Total number of exhibit pages: {$numPages}</p>
      </div>
      </section>";
    }
  }








}
