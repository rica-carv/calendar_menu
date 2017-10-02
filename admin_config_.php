<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('calendar_menu','admin_calendar_menu',true);

trait EventTrait {
    public function category($default = ''){
        $sql = e107::getDb();
        $categories = $sql->select("event_cat", "event_cat_id, event_cat_name", "event_cat_name != '".$default."' ORDER BY event_cat_name ASC");
        while ($row = $sql ->fetch())
        {
//        var_dump ($row);
          $cat_array[$row['event_cat_id']]= $row['event_cat_name'];
        }
        return $cat_array;
    }

}


class calendar_menu_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'categories'	=> array(
			'controller' 	=> 'calendar_menu_categories_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_categories_form_ui',
			'uipath' 		=> null
		),
		'events'	=> array(
			'controller' 	=> 'calendar_menu_events_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_events_form_ui',
			'uipath' 		=> null
		),
		'subscriptions'	=> array(
			'controller' 	=> 'calendar_menu_subscriptions_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_subscriptions_form_ui',
			'uipath' 		=> null
		),
		'prefs'	=> array(
			'controller' 	=> 'calendar_menu_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_form_ui',
			'uipath' 		=> null
		),
		'forthcoming'	=> array(
			'controller' 	=> 'calendar_menu_forthcoming_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_form_forthcoming_ui',
			'uipath' 		=> null
		),
/*
		'maintenance'	=> array(
			'controller' 	=> 'calendar_menu_maintenance_ui',
			'path' 			=> null,
			'ui' 			=> 'calendar_menu_form_maintenance_ui',
			'uipath' 		=> null
		),
*/
	);	
	
	
	protected $adminMenu = array(

		'categories/list'			=> array('caption'=> LAN_CATEGORY, 'perm' => 'P'),
		'categories/create'		=> array('caption'=> LAN_CREATE_CATEGORY, 'perm' => 'P'),
		'main/opt1'              => array('divider'=>true),
		'events/list'			=> array('caption'=> EC_ADLAN_A209, 'perm' => 'P'),
		'events/create'		=> array('caption'=> 'Create Event', 'perm' => 'P'),
		'main/opt2'              => array('divider'=>true),
		'subscriptions/list'			=> array('caption'=> EC_ADLAN_A173, 'perm' => 'P'),
//?		'subscriptions/create'		=> array('caption'=> LAN_CREATE_CATEGORY, 'perm' => 'P'),
		'main/opt3'              => array('divider'=>true),
		'prefs/prefs'			=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
		'forthcoming/prefs'			=> array('caption'=> EC_ADLAN_A100, 'perm' => 'P'),
//		'maintenance/form'			=> array('caption'=> EC_ADLAN_A141, 'perm' => 'P'),
		'prefs/maintenance'			=> array('caption'=> EC_ADLAN_A141, 'perm' => 'P'),

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = EC_ADLAN_1;
}

class calendar_menu_categories_ui extends e_admin_ui
{
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'blogcalendar_menu-event_cat'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'event_cat';
		protected $pid				= 'event_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_cat_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_cat_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_icon' =>   array ( 'title' => LAN_ICON, 'type' => 'icon', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_class' =>   array ( 'title' => LAN_USERCLASS, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_subs' =>   array ( 'title' => 'Subs', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_ahead' =>   array ( 'title' => 'Ahead', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_msg1' =>   array ( 'title' => 'Msg1', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_msg2' =>   array ( 'title' => 'Msg2', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_notify' =>   array ( 'title' => 'Notify', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_last' =>   array ( 'title' => 'Last', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_today' =>   array ( 'title' => 'Today', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_lastupdate' =>   array ( 'title' => LAN_LAST_UPDATED, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_addclass' =>   array ( 'title' => 'Addclass', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_description' =>   array ( 'title' => LAN_DESCRIPTION, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_force_class' =>   array ( 'title' => 'ForceClass', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_cat_name', 'event_cat_class', 'event_cat_lastupdate');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
/*
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'event_cat';
		protected $pid				= 'event_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_cat_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_cat_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_description' =>   array ( 'title' => LAN_DESCRIPTION, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_approved' =>   array ( 'title' => 'Approved', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_linked' =>   array ( 'title' => 'Linked', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_cat_id', 'event_cat_name', 'glo_author', 'glo_datestamp');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
*/
	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
}		
	
class calendar_menu_categories_form_ui extends e_admin_form_ui
{
}		

class calendar_menu_events_ui extends e_admin_ui
{
    use EventTrait;

		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'blogcalendar_menu-event_cat'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'event';
		protected $pid				= 'event_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_start' =>   array ( 'title' => LAN_START, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_end' =>   array ( 'title' => LAN_END, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_allday' =>   array ( 'title' => 'All Day event', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_recurring' =>   array ( 'title' => 'Recurring event', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_title' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_location' =>   array ( 'title' => LAN_LOCATION, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_details' =>   array ( 'title' => LAN_DETAILS, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'user', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_contact' =>   array ( 'title' => 'Contact', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_category' =>   array ( 'title' => 'Category', 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_thread' =>   array ( 'title' => 'Thread', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_rec_m' =>   array ( 'title' => 'Rec_m', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_rec_y' =>   array ( 'title' => 'Rec_y', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_title', 'event_category', 'event_datestamp', 'event_start', 'event_end');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
/*
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'event_cat';
		protected $pid				= 'event_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_cat_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_cat_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_description' =>   array ( 'title' => LAN_DESCRIPTION, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_approved' =>   array ( 'title' => 'Approved', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_linked' =>   array ( 'title' => 'Linked', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_cat_id', 'event_cat_name', 'glo_author', 'glo_datestamp');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
*/
	
		public function init()
		{
			// Set drop-down values (if any). 
/*
        $sql = e107::getDb();
        $categories = $sql->select("event_cat", "event_cat_id, event_cat_name", "event_cat_name != '' ORDER BY event_cat_name ASC");
        while ($row = $sql ->fetch())
        {
//        var_dump ($row);
          $array[$row['event_cat_id']]= $row['event_cat_name'];
        }
*/
//        var_dump ($array);
//        var_dump ($categories);
//        var_dump ($row);
 		$this->fields['event_category']['writeParms']['optArray'] = $this->category();
       
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
}		
	
class calendar_menu_events_form_ui extends e_admin_form_ui
{
}		



class calendar_menu_subscriptions_ui extends e_admin_ui
{
    use EventTrait;

		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'blogcalendar_menu-event_cat'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'subs';
		protected $pid				= 'event_subid';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_subid DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_subid' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_userid' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'user', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat' =>   array ( 'title' => 'Category', 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_userid', 'event_cat');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
/*
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'event_cat';
		protected $pid				= 'event_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'event_cat_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'event_cat_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'event_cat_description' =>   array ( 'title' => LAN_DESCRIPTION, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_approved' =>   array ( 'title' => 'Approved', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_linked' =>   array ( 'title' => 'Linked', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('event_cat_id', 'event_cat_name', 'glo_author', 'glo_datestamp');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 
*/
	
		public function init()
		{
			// Set drop-down values (if any). 
 		$this->fields['event_cat']['writeParms']['optArray'] = $this->category();
       
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
}		
	
class calendar_menu_subscriptions_form_ui extends e_admin_form_ui
{
}		


class calendar_menu_ui extends e_admin_ui
{
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'calendar_menu';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

  	protected $prefs = array( 
  					'eventpost_admin'  => array('title'=> EC_ADLAN_A208,'type' => 'userclass'),
					  'eventpost_super'  => array('title'=> EC_ADLAN_A211,'type' => 'userclass'),
					  'eventpost_adminlog'  => array('title'=> EC_ADLAN_A134,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A87,EC_ADLAN_A135,EC_ADLAN_A136)), 'help' => EC_ADLAN_A137),
					  'eventpost_menulink'  => array('title'=> EC_ADLAN_A165,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A209,EC_ADLAN_A210,EC_ADLAN_A185))),
					  'eventpost_showmouseover'  => array('title'=> EC_ADLAN_A183,'type' => 'boolean', 'help' => EC_ADLAN_A184),
					  'eventpost_showeventcount'  => array('title'=> EC_ADLAN_A140,'type' => 'boolean'),
					  'eventpost_forum'  => array('title'=> EC_ADLAN_A213,'type' => 'boolean', 'help' => EC_ADLAN_A22),
					  'eventpost_recentshow'  => array('title'=> EC_ADLAN_A171,'type' => 'text', 'help' => EC_ADLAN_A172),
//					  'eventpost_weekstart'  => array('title'=> EC_ADLAN_A212,   'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('0'=> EC_LAN_18,'1'=> EC_LAN_12,'2'=> EC_LAN_13,'3'=> EC_LAN_14,'4'=> EC_LAN_15,'5'=> EC_LAN_16,'6'=> EC_LAN_17))),
					  'eventpost_weekstart'  => array('title'=> EC_ADLAN_A212,   'type'=>'dropdown',),
					  'eventpost_lenday'  => array('title'=> EC_ADLAN_A214,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>1,2=>2,3=>3))),
					  'eventpost_dateformat'  => array('title'=> EC_ADLAN_A215,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A216,EC_ADLAN_A217))),
					  'eventpost_datedisplay'  => array('title'=> EC_ADLAN_A165,   'type'=>'dropdown', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>'yyyy-mm-dd',2=>'dd-mm-yyyy',3=>'mm-dd-yyyy',4=>'yyyy.mm.dd',5=>'dd.mm.yyyy',6=>'mm.dd.yyyy',7=>'yyyy/mm/dd',8=>'dd/mm/yyyy',9=>'mm/dd/yyyy'))),
					  'eventpost_fivemins'  => array('title'=> EC_ADLAN_A138,'type' => 'boolean', 'help' => EC_ADLAN_A139),
					  'eventpost_editmode'  => array('title'=> EC_ADLAN_A200,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A201,EC_ADLAN_A202,EC_ADLAN_A203))),
					  'eventpost_caltime'  => array('title'=> EC_ADLAN_A122,   'type'=>'radio', 'data' => 'int', 'help' => EC_ADLAN_A129),
					  'eventpost_timedisplay'  => array('title'=> EC_ADLAN_A123,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>'24-hour hhmm',4=>'24-hour hh:mm',2=>'12-hour', 3=>'Custom')), 'help' => EC_ADLAN_A127),
					  'eventpost_dateevent'  => array('title'=> EC_ADLAN_A166,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>'dayofweek day month yyyy',2=>'dyofwk day mon yyyy',3=>'dyofwk dd-mm-yy', 0=>'Custom')), 'help' => EC_ADLAN_A169),
					  'eventpost_datenext'  => array('title'=> EC_ADLAN_A167,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>'dd month',2=>'dd mon',3=>'month dd',4=>'mon dd', 0=>'Custom')), 'help' => EC_ADLAN_A170),
					  'eventpost_printlists'  => array('title'=> EC_ADLAN_A193,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A194,EC_ADLAN_A195))),
					  'eventpost_asubs'  => array('title'=> EC_ADLAN_A95,'type' => 'boolean', 'help' => EC_ADLAN_A96),
					  'eventpost_mailfrom'  => array('title'=> EC_ADLAN_A92,'type' => 'text'),
					  'eventpost_mailsubject'  => array('title'=> EC_ADLAN_A91,'type' => 'text'),
					  'eventpost_mailaddress'  => array('title'=> EC_ADLAN_A93,'type' => 'text'),
					  'eventpost_emaillog'  => array('title'=> EC_ADLAN_A114,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(EC_ADLAN_A87,EC_ADLAN_A115,EC_ADLAN_A116))),
            
            );

		public function init()
		{
require_once('ecal_class.php'); 
$ecal_class = new ecal_class;
			// Set drop-down values (if any). 
/*
 var_dump (setlocale(LC_ALL, 0));
$timestamp = strtotime('next Sunday');
$days = array();
for ($i = 0; $i < 7; $i++) {
    $days[] = strftime('%A', $timestamp);
    $timestamp = strtotime('+1 day', $timestamp);
}
var_dump ($days);
*/
//setlocale(LC_ALL, 'en_US') or die('Locale not installed');
//$currentLocal = setlocale(LC_ALL, 0);
//var_dump ($currentLocal);

$darray = e107::getDate()->terms('day');
//var_dump ($darray);

$last = array_pop($darray);
//var_dump ($last);

array_unshift($darray, $last);
//var_dump ($darray);

/*
 		$this->fields['eventpost_weekstart']['writeParms']['optArray'] = array(
      '0'=>LCLAN_ITEM_17,
      '1'=>LCLAN_ITEM_18,
      '4'=>LCLAN_ITEM_19
      );
*/
 		$this->prefs['eventpost_weekstart']['writeParms']['optArray'] = $darray;
       
 		$this->prefs['eventpost_caltime']['writeParms']['optArray'] = array(1=>'<div>Server<br><small class="text-info">('.EC_ADLAN_A124.$ecal_class->time_string($ecal_class->time_now).')</small></div>',2=>'<div>Site<br><small class="text-info">('.EC_ADLAN_A125.$ecal_class->time_string($ecal_class->site_timedate).')</small></div>' ,3=>'<div>User<br><small class="text-info">('.EC_ADLAN_A126.$ecal_class->time_string($ecal_class->user_timedate).')</small></div>');


		$frm = e107::getForm();
		
    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_timecustom', e107::getPlugPref('calendar_menu')['eventpost_timecustom'], array('type'=>'text', 'help' => EC_ADLAN_A128));
    $text .= '</div>';

 		$this->prefs['eventpost_timedisplay']['writeParms']['post'] = $text;

    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_eventdatecustom', e107::getPlugPref('calendar_menu')['eventpost_eventdatecustom'], array('type'=>'text', 'help' => EC_ADLAN_A168));
    $text .= '</div>';

 		$this->prefs['eventpost_dateevent']['writeParms']['post'] = $text;

    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_nextdatecustom', e107::getPlugPref('calendar_menu')['eventpost_nextdatecustom'], array('type'=>'text', 'help' => EC_ADLAN_A168));
    $text .= '</div>';

 		$this->prefs['eventpost_datenext']['writeParms']['post'] = $text;


   	if (e107::isInstalled('pdf')) { $this->prefs['eventpost_printlists']['writeParms']['optArray'][] = EC_ADLAN_A196; }

  	}

public function maintenancePage(){

require_once ('../../class2.php');

require_once(e_ADMIN."auth.php");
// ====================================================
//			MAINTENANCE OPTIONS
// ====================================================

	$frm = e107::getForm();
  $mes = e107::getMessage();
  global $ns;
//if(($action == 'maint'))
//{

	$text = "
	<form method='post' action='".e_SELF."?maint'>
	<fieldset id='plugin-ecal-maintenance'>
	<table class='table adminform'>
	<tr>
		<td style='width:40%;vertical-align:top;'>".EC_ADLAN_A142." </td>
		<td style='width:60%;vertical-align:top;' class='form-inline'>
";

$text.=$frm->select("eventpost_deleteoldmonths",array_reverse(range(1,12)), false,array('useValues'=>TRUE));

/*
$text.="			<select name='eventpost_deleteoldmonths' class='tbox'>
			<option value='12' selected='selected'>12</option>
			<option value='11'>11</option>
			<option value='10'>10</option>
			<option value='9'>9</option>
			<option value='8'>8</option>
			<option value='7'>7</option>
			<option value='6'>6</option>
			<option value='5'>5</option>
			<option value='4'>4</option>
			<option value='3'>3</option>
			<option value='2'>2</option>
			<option value='1'>1</option>
			</select>
";
*/
$text.="			<span class='field-help'><em>".EC_ADLAN_A143."</em></span>	".$frm->admin_button('deleteold', EC_ADLAN_A145, 'delete')."
		</td>
	</tr>
";

//	$ns->tablerender(EC_ADLAN_1." - ".EC_ADLAN_A141, $mes->render() . $text);
	$ns->tablerender("", $mes->render() . $text);

	$text = "
	<tr>
		<td>".EC_ADLAN_A159." <em>".EC_ADLAN_A160."</em> </td>
		<td>".$frm->admin_button('cache_clear', EC_ADLAN_A161, 'delete')."</td>
	</tr>
	</table>
	</fieldset>
	</form>";
	
//	$ns->tablerender(EC_ADLAN_1." - ".EC_ADLAN_A159, $mes->render() . $text);
	$ns->tablerender("", $mes->render() . $text);

//require_once (e_ADMIN."footer.php");
//}
}

}
				


class calendar_menu_form_ui extends e_admin_form_ui
{

}		
		
class calendar_menu_forthcoming_ui extends e_admin_ui
{
    use EventTrait;

		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'calendar_menu';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

  	protected $prefs = array( 
  					'eventpost_menuheading'  => array('title'=> EC_ADLAN_A108,'type' => 'text'),
					  'eventpost_daysforward'  => array('title'=> EC_ADLAN_A101,'type' => 'text'),
					  'eventpost_numevents'  => array('title'=> EC_ADLAN_A102,   'type'=>'text'),
					  'eventpost_checkrecur'  => array('title'=> EC_ADLAN_A103,   'type'=>'boolean'),
					  'eventpost_fe_hideifnone'  => array('title'=> EC_ADLAN_A107,'type' => 'boolean'),
					  'eventpost_fe_showrecent'  => array('title'=> EC_ADLAN_A199,'type' => 'boolean'),
					  'eventpost_namelink'  => array('title'=> EC_ADLAN_A130,   'type'=>'radio', 'data' => 'int', 'writeParms'=>array('optArray'=> array(1=>EC_ADLAN_A131,2=>EC_ADLAN_A132))),
					  'eventpost_linkheader'  => array('title'=> EC_ADLAN_A104,   'type'=>'boolean'),
					  'eventpost_showcaticon'  => array('title'=> EC_ADLAN_A120,'type' => 'boolean'),
					  'eventpost_fe_set'  => array('title'=> EC_ADLAN_A118,'type' => 'checkboxes'),
            
            );

		public function init()
		{
//      var_dump ($this->category(EC_DEFAULT_CATEGORY));
			$this->prefs['eventpost_fe_set']['writeParms']['optArray'] =  $this->category("Default");
  	}
}

class calendar_menu_forthcoming_form_ui extends e_admin_form_ui
{
}		

/*
class calendar_menu_maintenance_ui extends e_admin_ui
{
		protected $pluginTitle		= EC_ADLAN_1;
		protected $pluginName		= 'calendar_menu';
*/
	//	protected $eventName		= 'calendar_menu-calendar_menu'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'calendar_menu';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

//  	protected $prefs = array();
/*----
  	protected $prefs = array( 
					  'eventpost_deleteoldmonths'  => array('title'=> EC_ADLAN_A142,   'type'=>'dropdown', 'help' => EC_ADLAN_A143, 'class'=>'form-inline'),
					  'eventpost_deleteoldmonths'  => array('title'=> EC_ADLAN_A142,   'type'=>'dropdown'),
            
            );

		public function init()
		{
       
//var_dump (array_reverse(array_combine(range(1,12),range(1,12)), true));
 		$this->prefs['eventpost_deleteoldmonths']['writeParms']['optArray'] = array_reverse(array_combine(range(1,12),range(1,12)), true);

		$frm = e107::getForm();

 		$this->prefs['eventpost_deleteoldmonths']['writeParms']['post'] = $frm->admin_button('deleteold', EC_ADLAN_A145, 'delete');

/*		
    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_timecustom', e107::getPlugPref('calendar_menu')['eventpost_timecustom'], array('type'=>'text', 'help' => EC_ADLAN_A128));
    $text .= '</div>';

 		$this->prefs['eventpost_timedisplay']['writeParms']['post'] = $text;

    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_eventdatecustom', e107::getPlugPref('calendar_menu')['eventpost_eventdatecustom'], array('type'=>'text', 'help' => EC_ADLAN_A168));
    $text .= '</div>';

 		$this->prefs['eventpost_dateevent']['writeParms']['post'] = $text;

    $text = '<div class="pull-right">';
    $text .= $frm->renderElement('eventpost_nextdatecustom', e107::getPlugPref('calendar_menu')['eventpost_nextdatecustom'], array('type'=>'text', 'help' => EC_ADLAN_A168));
    $text .= '</div>';

 		$this->prefs['eventpost_datenext']['writeParms']['post'] = $text;


   	if (e107::isInstalled('pdf')) { $this->prefs['eventpost_printlists']['writeParms']['optArray'][] = EC_ADLAN_A196; }
*/
//--------------------  	}

/*
}

class calendar_menu_maintenance_form_ui extends e_admin_form_ui
{

}		
*/
new calendar_menu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN."footer.php");
exit;

?>