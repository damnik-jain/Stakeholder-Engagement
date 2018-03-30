<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		echo "<script src='view/javascript/jquery/jquery-2.1.1.min.js' />";
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['user_token'] = $this->session->data['user_token'];
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		// Check install directory exists
		if (is_dir(DIR_APPLICATION . 'install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}
		
		// Dashboard Extensions
		$dashboards = array();

		$this->load->model('setting/extension');

		// Get a list of installed modules
		$extensions = $this->model_setting_extension->getInstalled('dashboard');
		
		// Add all the modules which have multiple settings for each module
		foreach ($extensions as $code) {
			if ($this->config->get('dashboard_' . $code . '_status') && $this->user->hasPermission('access', 'extension/dashboard/' . $code)) {
				$output = $this->load->controller('extension/dashboard/' . $code . '/dashboard');
				
				if ($output) {
					$dashboards[] = array(
						'code'       => $code,
						'width'      => $this->config->get('dashboard_' . $code . '_width'),
						'sort_order' => $this->config->get('dashboard_' . $code . '_sort_order'),
						'output'     => $output
					);
				}
			}
		}

		$sort_order = array();

		foreach ($dashboards as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $dashboards);
		
		// Split the array so the columns width is not more than 12 on each row.
		$width = 0;
		$column = array();
		$data['rows'] = array();
		
		$count=0;
		
		foreach ($dashboards as $dashboard) {
			$count++;
			if($count!=2 && $count!=1 )
				continue;
			$column[] = $dashboard;
			
			$width = ($width + $dashboard['width']);
			
			//if ($width >= 12) {
			if ($count==2) {
				$data['rows'][] = $column;
				
				$width = 0;
				$column = array();
			}

			
		}

		if (DIR_STORAGE == DIR_SYSTEM . 'storage/') {
			$data['security'] = $this->load->controller('common/security');
		} else {
			$data['security'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		
		
			$data['column_left'] = $this->load->controller('common/column_left');
		
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->refresh();
		}


		
		
		$this->load->model('sale/voucher');
		$recentproj = $this->model_sale_voucher->getRecentProject();

		$data['projectlist'] = array();
		$i =0;

		foreach($recentproj as $recentproject){
			$data['projectlist'][] = array(
				'image' => $recentproject['image'],
				'link' => 'controller_dashvoard_dashboard.com',
				'title' => $recentproject['title'],
				'department' => $recentproject['department'],
				'last_update' => substr($recentproject['last_updated'],0,10),
				'view' => $recentproject['view'],
				'interested' => $recentproject['interested']
			);
		}
		echo "<script> alert('staaaart');</script>";

		$data['newscolumn1'] = "No.";
		$data['newscolumn2'] = "Title";
		$data['newscolumn3'] = "Last updated";
		$data['newscolumn4'] = "Views";
		$data['newscolumn5'] = "Submitted";

		$newsrow = $this->model_sale_voucher->getNewsInfo();
		$data['newstable'] = array();
		$count=1;
		foreach($newsrow as $rowt){
			$data['newstable'][] = array(
				'number' => $count++,
				'headline' => $rowt['headline'],
				'lastupdated' => 'NA',
				'view' => 'NA',
				'submit' => 'NA'
			); 
		}






		$this->response->setOutput($this->load->view('common/dashboard', $data));
	}

	



}
