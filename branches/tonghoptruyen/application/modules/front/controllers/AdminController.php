<?php
class Front_AdminController extends Zend_Controller_Action {
	private $session;
	private $account;
	public function init() {
		$this->session = new Zend_Session_Namespace ( 'session' );
		$this->_helper->layout->setLayout ( 'admin_layout' );
	}
	public function removeAction() {
		$tableName = $this->_request->getParam('t','');
		$id = $this->_request->getParam('id','');
		$key = $this->_request->getParam('key','id');
		$flag = $this->_request->getParam('f','1');
		if(empty($tableName) || empty($id)) die('ERROR');
		if($flag == 1) { //delete
			Core_Utils_DB::delete($tableName, $id,$key);
		} else { //update status
			Core_Utils_DB::update($tableName, array('status' => 0),array($key => $id));
		}
		die('OK');
	}
	public function grabberAction() {
		try {
			$form = array (
					'id' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'style' => 'display:none' 
							) 
					),
					'url' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'Url...' 
							) 
					)
					 
			);
			$tableName = 'links';
			$this->view->title = 'Grabber management';
			$array = array (
					'status' => 1 
			);
			if ($this->_request->isPost ()) {
				$form_data = $this->_request->getParams ();
				// print_r($form_data);die;
				if ($form_data ['button'] == 'Save') {
					if (! empty ( $form_data ['url'] )) {
						if (($class_name = Core_Utils_Tools::getGrabber ( $form_data ['url'] )) == null)
							throw new Core_Exception ( 'HOST INVALID' );
						if (! empty ( $form_data ['id'] )) { // update
							Core_Utils_DB::update ( $tableName, array (
									'url' => $form_data ['url'],
									'class_name' => $class_name 
							), array (
									'id' => $form_data ['id'] 
							) );
						} else {
							Core_Utils_DB::query ( 'INSERT DELAYED INTO `links`(`url`,`class_name`,`create_time`) VALUES (?,?,NOW())', 3, array (
									$form_data ['url'],
									$class_name 
							) );
						}
					}
					$this->_redirect ( '/admin/grabber' );
					die ();
				} else if ($form_data ['button'] == 'Search') {
					$array ['url'] = "%{$form_data['url']}%";
					$form ['url'] ['attrs'] ['value'] = $form_data ['url'];
				}
			}
			
			$this->view->html = Core_Utils_Tools::form2HTML ( $form );
			$this->view->list = Core_Utils_DB::search ( $tableName, $array, ' order by id desc' );
		} catch ( Exception $e ) {
			$this->_forward ( 'error', 'admin', 'front', array (
					'msg' => $e->getMessage (),
					'trace' => $e->getTraceAsString () 
			) );
		}
	}
	public function categoryAction() {
		try {
			$tableName = 'categories';
			$redirect_url = '/admin/category';
			$this->view->display_field = 'name';
			$form = array (
					'id' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'style' => 'display:none' 
							) 
					),
					'name' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'Name...' 
							) 
					),
					'seo_name' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'SEO Name...'
							)
					)
					,
					'url' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'Url...' 
							) 
					)
					,
					'keywords' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'Keywords...' 
							) 
					)
					,
					'description' => array (
							'tag' => 'textarea',
							'attrs' => array (
									'cols' => '80',
									'rows' => '5',
									'placeholder' => 'Description...' 
							) 
					)
					 
			)
			;
			$this->view->title = 'Categories management';
			$array = array (
					'status' => 1 
			);
			if ($this->_request->isPost ()) {
				$form_data = $this->_request->getParams ();
				// print_r($form_data);die;
				if ($form_data ['button'] == 'Save') {
					$data = array();
					foreach ($form_data as $key => $value) {
						if($key != 'id' && isset($form[$key])) $data[$key] = $value;
					}
					if (! empty ( $form_data ['id'] )) { // update
						Core_Utils_DB::update ( $tableName, $data, array ('id' => $form_data ['id']) );
					} else {
						$data['status'] = 1;
						Core_Utils_DB::insert($tableName, $data);
					}
					$this->_redirect ( $redirect_url );
					die ();
				} else if ($form_data ['button'] == 'Search') {
					$array ['url'] = "%{$form_data['url']}%";
					$form ['url'] ['attrs'] ['value'] = $form_data ['url'];
				}
			}
			$this->view->tableName = $tableName;
			$this->view->html = Core_Utils_Tools::form2HTML ( $form );
			$this->view->list = Core_Utils_DB::search ( $tableName, $array, ' order by id desc' );
			$this->render('/form');
		} catch ( Exception $e ) {
			$this->_forward ( 'error', 'admin', 'front', array (
					'msg' => $e->getMessage (),
					'trace' => $e->getTraceAsString () 
			) );
		}
	}
	
	public function feedComicAction() {
		try {
			$tableName = 'feed_comic';
			$redirect_url = '/admin/feed-comic';
			$this->view->display_field = 'url';
			$sql = 'SELECT * FROM `categories` WHERE `status` = 1';
			$rows = Core_Utils_DB::query($sql,QUERY_DB_RETURN_MULTI);
			$options = array('' => 'Select category');
			foreach ($rows as $row) $options[$row['id']] = $row['name'];
			$form = array (
					'id' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'style' => 'display:none'
							)
					),
					'url' => array (
							'tag' => 'input',
							'attrs' => array (
									'type' => 'text',
									'placeholder' => 'Url...'
							)
					),
					'category_id' => array (
							'tag' => 'select',
							'attrs' => array (
									'type' => 'text',
							),
							'options' => $options
					)
			)
			;
			$this->view->title = 'Feed Comic management';
			$array = array (
					0 => 't0.status >= 0'
			);
			if ($this->_request->isPost ()) {
				$form_data = $this->_request->getParams ();
				// print_r($form_data);die;
				if ($form_data ['button'] == 'Save') {
					$data = array();
					foreach ($form_data as $key => $value) {
						if($key != 'id' && isset($form[$key])) $data[$key] = $value;
					}
					if (! empty ( $form_data ['id'] )) { // update
						Core_Utils_DB::update ( $tableName, $data, array ('id' => $form_data ['id']) );
					} else {
						$data['status'] = 0;
						$data['update_time'] = Core_Utils_Date::getCurrentDateSQL();
						Core_Utils_DB::insert($tableName, $data);
					}
					$this->_redirect ( $redirect_url );
					die ();
				} else if ($form_data ['button'] == 'Search') {
					$array ['t1.id'] = $form_data['category_id'];
					$form ['category_id'] ['attrs'] ['value'] = $form_data ['category_id'];
				}
			}
			$this->view->tableName = $tableName;
			$this->view->html = Core_Utils_Tools::form2HTML ( $form );
			$this->view->list = Core_Utils_DB::search ( '`feed_comic` t0 LEFT JOIN `categories` t1 ON t0.`category_id` = t1.`id`', $array, ' order by t0.id desc limit 0,20','t0.id,t0.url,t1.name,category_id,t0.status' );
			$this->render('/form-search');
		} catch ( Exception $e ) {
			$this->_forward ( 'error', 'admin', 'front', array (
					'msg' => $e->getMessage (),
					'trace' => $e->getTraceAsString ()
			) );
		}
	}
}

