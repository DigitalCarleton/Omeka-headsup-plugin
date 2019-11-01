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
              $options = $form->getValues();
              foreach ($options as $value) {
                  set_option('headsup-active', $value);
              }
          }
      }
      return;
    }
}
