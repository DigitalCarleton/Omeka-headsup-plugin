<?php

class HeadsUp_Form_Settings extends Omeka_Form
{
    public function init()
    {
        parent::init();


        $value = get_option('headsup_active');



        $this->addElement(
            'checkbox',
            'activate',
            array(
                'label' => 'Activate HeadsUp',
                'value' => $value
              )
        );

        //builds the submit button
        $this->addElement('submit', 'submit', array(
                'label' => __('Save Settings'),
                'class' => 'submit submit-medium',
                'decorators' => (array(
                    'ViewHelper',
                    array('HtmlTag', array('tag' => 'div', 'class' => 'field')))),
        ));


        //makes display separate groups for visual formatting
        $this->addDisplayGroup(
            array('activate'),
            'Activate'
        );

        $this->addDisplayGroup(
            array('submit'),
            'Save Settings Button'
        );


    }
}
