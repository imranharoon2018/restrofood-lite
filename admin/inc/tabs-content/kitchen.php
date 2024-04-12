<?php
namespace RestroFoodLite\Admin;
 /**
  * 
  * @package    RestroFoodLite 
  * @since      3.0.0
  * @version    3.0.0
  * @author     ThemeLooks
  * @Websites:  http://themelooks.com/
  *
  */


class Kitchen_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Kitchen Options', 'restrofoodlite' ),
            'icon'    => 'fa fa-tools',
            'id'      => 'kitchenopt'
        ]);
        // Pro features deactivate
        $this->promo();

        if( restrofoodlite_is_active_multi_branch() ){
          $this->switcher([
            'title' => esc_html__( 'Branch Transfer Option', 'restrofoodlite' ),
            'name'  => 'kitchen-branch-transfer'
          ]);
        }
        $this->switcher([
          'title' => esc_html__( 'Deliver Boy Assign Option', 'restrofoodlite' ),
          'name'  => 'kitchen-boy-assign'
        ]);
        $this->switcher([
          'title' => esc_html__( 'All Order Show In Kitchen', 'restrofoodlite' ),
          'name'  => 'kitchen-all-order'
        ]);

        $this->end_fields_section(); // End fields section
   }
}

new Kitchen_Settings_Tab();