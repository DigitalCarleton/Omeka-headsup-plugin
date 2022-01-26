<?php

class HeadsUp_IndexController extends Omeka_Controller_AbstractActionController
{
    public function indexAction()
    {
      $form = new HeadsUp_Form_Settings();
      $this->view->form = $form;

      $request = $this->getRequest();
      if ($request->isPost()) {
          if ($form->isValid($request->getPost())) {
              $values = $form->getValues();
              $options = array( 'display_exhibits', 'display_exhibit_pages', 'display_items', 'display_collections', 'display_collection_date' );
              $i = 0;
              // iterates through each option to set value of 0 or 1
              foreach ($values as $value) {
                set_option($options[$i], $value);
                $i++;
              }
          }
      }
      return;
    }
}
