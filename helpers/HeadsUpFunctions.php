<?php 

/**
 * Make appropiate changes depending on whether ExhibitBuilder plugin is 
 * active or not. 
 *
 * @return array
 *
 */
function optionsControlExhibit(){
    if (plugin_is_active('ExhibitBuilder')) {
        if(plugin_is_active('Geolocation')){
            return array( 
                'is_active' => 1, 
                'options' => array(
                    'display_exhibits', 
                    'display_exhibit_pages', 
                    'display_location', 
                    'display_items', 
                    'display_collections', 
                    'display_collection_date'
                )
            );
        }
        else{
            return array(
                'is_active' => 1, 
                'options' => array( 
                    'display_exhibits', 
                    'display_exhibit_pages',
                    'display_items', 
                    'display_collections', 
                    'display_collection_date'
                )
            );
        }
    }
    else {
        return array(
            'is_active' => 0, 
            'options' => array( 
                'display_items', 
                'display_collections',
                'display_collection_date'
                )
            );
    }
}
/**
 * Make appropiate changes depending on whether Geolocation plugin is 
 * active or not. 
 *
 * @return array
 *
 */
function optionsControlGeo(){
    $check_exhibit = optionsControlExhibit();
    if (plugin_is_active('Geolocation')) {
        if(plugin_is_active('ExhibitBuilder')){
            return array( 
                'is_active' => 1, 
                'options' => array(
                    'display_exhibits', 
                    'display_exhibit_pages', 
                    'display_location', 
                    'display_items', 
                    'display_collections', 
                    'display_collection_date'
                )
            );
        }
        else{
            return array(
                'is_active' => 1, 
                'options' => array(
                    'display_location', 
                    'display_items', 
                    'display_collections', 
                    'display_collection_date'
                )
            );
        }
    }
    else {
        return array(
            'is_active' => 0, 
            'options' => array( 
                'display_items', 
                'display_collections',
                'display_collection_date'
                )
            );
    }
}