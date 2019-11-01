<?php

class HeadsUp_Form_Settings extends Omeka_Form
{
    public function init()
    {
        parent::init();
        //makes a call to the database to get all the dublin core elements
        /*
        $db = get_db();
        $valueOptions = array();
        $table = $db->getTable('Element');
        $tableName = $db->getTableName('Element');
        $elements = $table->fetchObjects("SELECT * FROM {$tableName} WHERE element_set_id = 1");
        foreach ($elements as $element){
          $element_title = $element->getProperty('name');
          $valueOptions["$element_title"] = "$element_title";
        }
        */

        //puts the currently chosen element in the first slot of the dropdownmenu
        $value = get_option('headsup-active');
        if ($value == 'true') {
          $checked = 'checked';
        } else {
          $checked = '';
        }


        //builds the dropdownmenu
        $this->addElement(
            'checkbox',
            'headsup-active',
            array(
                'label' => 'Activate HeadsUp',
                $checked
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
            array('DublinCore'),
            'Dropdownmenu'
        );

        $this->addDisplayGroup(
            array('submit'),
            'Save Settings Button'
        );

    }
}
