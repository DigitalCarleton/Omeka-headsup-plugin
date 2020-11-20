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
      set_option('display_exhibits', 1);
      set_option('display_exhibit_pages', 1);
      set_option('display_items', 1);
      set_option('display_collections', 1);
  }

  public function hookUninstall()
  {
      delete_option('display_exhibits');
      delete_option('display_exhibit_pages');
      delete_option('display_items');
      delete_option('display_collections');
  }


  public function filterAdminNavigationMain($navArray){
    $navArray['HeadsUp'] = array(
        'label' => __("HeadsUp"),
        'uri' => url('heads-up')
    );
    return $navArray;
  }
  
  /**
   * counts the number of exhibits, exhibit pages, items, and collections and displays them
   */
  public function displayHeadsUp(){
      $exhibits = get_records('Exhibit', $params=array(), $limit=0);
      $numExhibits = count($exhibits);
      $numItems = total_records('Item');
      $numCollections = total_records('Collection');

      $totalExhibitPages = 0;
      foreach ($exhibits as $key => $exhibit) {
        $pages = $exhibit->getPages();
        $totalExhibitPages += count($pages);
      }

      // only displays information for the selected checkboxes
      echo "<h2>Heads Up Info:</h2>";
      if (get_option('display_exhibits') == 1) {
        echo "<p>Number of exhibits: {$numExhibits}</p>";
      }
      if (get_option('display_exhibit_pages') == 1) {
        echo "<p>Total number of exhibit pages: {$totalExhibitPages}</p>";
      }
      if (get_option('display_items') == 1) {
        echo "<p>Number of items: {$numItems}</p>";
      }
      if (get_option('display_collections') == 1) {
        echo "<p>Number of collections: {$numCollections}</p>";
      }
  }

  /**
   * Hook to call relevant information to be displayed in an HTML section
   */
  public function hookAdminDashboard() {
    ?>
    <section class='five columns omega' style="margin-left:0%">
      <div class='panel'>
        <?php $this->displayHeadsUp() ?>
      </div>
    </section>
    <?php
  }
}



