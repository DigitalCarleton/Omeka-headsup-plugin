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
      set_option('display_date', 1);
  }

  public function hookUninstall()
  {
      delete_option('display_exhibits');
      delete_option('display_exhibit_pages');
      delete_option('display_items');
      delete_option('display_collections');
      delete_option('display_date');
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
      $recentCollection = get_recent_collections($num=1);
      $dateRecentCollection = $recentCollection[0]["added"];


      $totalExhibitPages = 0;
      foreach ($exhibits as $key => $exhibit) {
        $pages = $exhibit->getPages();
        $totalExhibitPages += count($pages);
      }

      $displayStartMessage = true;
      $displayExhibits = get_option('display_exhibits');
      $displayExhibitPages = get_option('display_exhibit_pages');
      $displayItems = get_option('display_items');
      $displayCollections = get_option('display_collections');
      $displayDate = get_option('display_date');
      $settings = array( $displayExhibits, $displayExhibitPages, $displayItems, $displayCollections, $displayDate);

      // if any items are selected to be displayed, we don't print the startup message
      foreach ($settings as $value) {
        if ($value==1) {
          $displayStartMessage = false;
        }
      }

      echo "<h2>Heads Up Info:</h2>";
      if ($displayStartMessage == true) {
        echo "<p>No options have been selected. Go to the HeadsUp settings page to get started!</p>";
      } else {
          // only displays information for the selected checkboxes
          if ($displayExhibits == 1) {
            echo "<p>Number of exhibits: {$numExhibits}</p>";
          }
          if ($displayExhibitPages == 1) {
            echo "<p>Total number of exhibit pages: {$totalExhibitPages}</p>";
          }
          if ($displayItems == 1) {
            echo "<p>Number of items: {$numItems}</p>";
          }
          if ($displayCollections == 1) {
            echo "<p>Number of collections: {$numCollections}</p>";
          }
          if ($displayDate == 1) {
            echo "<p>Date of Recent Collection: {$dateRecentCollection}</p>";
          }
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



