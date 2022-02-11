<?php

require_once __DIR__ . '/../helpers/exhibitHelper.php';

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
              $check_exhibit = optionsControl();

              $options = $check_exhibit['options'];

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
