<?php

class HeadsUp_Form_Settings extends Omeka_Form
{
    public function init()
    {
        parent::init();

        $displayExhibits = get_option('display_exhibits');
        $displayExhibitPages = get_option('display_exhibit_pages');
        $displayItems = get_option('display_items');
        $displayCollections = get_option('display_collections');
        $displayCollectionDate = get_option('display_date');

        // adds elements to form
        $this->addElement( 'checkbox', 'exhibits', 
                            array( 'label' => 'Display number of Exhibits', 'value' => $displayExhibits ) );

        $this->addElement( 'checkbox', 'exhibit_pages', 
                            array( 'label' => 'Display number of Exhibit pages', 'value' => $displayExhibitPages ) );

        $this->addElement( 'checkbox', 'items',
                            array( 'label' => 'Display number of Items', 'value' => $displayItems ) );

        $this->addElement( 'checkbox', 'collections',
                            array( 'label' => 'Display number of Collections', 'value' => $displayCollections ) );
        
        $this->addElement( 'checkbox', 'collection_date',
                            array( 'label' => 'Display date of Collections', 'value' => $displayCollectionDate ) );

        // builds the submit button
        $this->addElement('submit', 'submit', array(
                'label' => __('Save Settings'),
                'class' => 'submit submit-medium',
                'decorators' => (array(
                    'ViewHelper',
                    array('HtmlTag', array('tag' => 'div', 'class' => 'field')))),
        ));

        // build the display group for each setting
        $this->addDisplayGroup( array('exhibits'), 'Exhibits' );
        $this->addDisplayGroup( array('exhibit_pages'), 'Exhibit Pages' );
        $this->addDisplayGroup( array('items'), 'Items' );
        $this->addDisplayGroup( array('collections'), 'Collections' );
        $this->addDisplayGroup( array('collection_date'), 'Collection Date');
        $this->addDisplayGroup( array('submit'), 'Save Settings Button' );
    }
}
