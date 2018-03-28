<?php 

//extension/module/emergencyupload
class Controllerextensionmoduleemergencyupload extends Controller {
	
	private $error = array();


	public function index() {
		$this->load->language('extension/module/emergencyupload');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/emergencyupload');//you have to create this file (i.e. model fle)

		$this->getList();
	}

	public function add() {
		$this->load->language('extension/module/emergencyupload');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/emergencyupload');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_emergencyupload->addMarketing($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_area'])) {
				$url .= '&filter_area=' . $this->request->get['filter_area'];
			}
			
			if (isset($this->request->get['filter_type'])) {
				$url .= '&filter_type=' . $this->request->get['filter_type'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->load->language('extension/module/emergencyupload');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/emergencyupload');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $marketing_id) {
				$this->model_extension_module_emergencyupload->deleteMarketing($marketing_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_area'])) {
				$url .= '&filter_area=' . $this->request->get['filter_area'];
			}
			
			if (isset($this->request->get['filter_type'])) {
				$url .= '&filter_type=' . $this->request->get['filter_type'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_area'])) {
			$filter_area = $this->request->get['filter_area'];
		} else {
			$filter_area = '';
		}
		
		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = '';
		}
		

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$filter_vol = $this->request->get['filter_vol'];
		} else {
			$filter_vol = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_vol=' . $this->request->get['filter_vol'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('extension/module/emergencyupload/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('extension/module/emergencyupload/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['marketings'] = array();

		$filter_data = array(
			'filter_name'       => $filter_name,
			'filter_area'       => $filter_area,
			'filter_type'       => $filter_type,
			'filter_date_added' => $filter_date_added,
			'filter_vol'       => $filter_vol,
			'sort'              => $sort,
			'order'             => $order,
			'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'             => $this->config->get('config_limit_admin')
		);

		$marketing_total = $this->model_extension_module_emergencyupload->getTotalMarketings($filter_data);

		$results = $this->model_extension_module_emergencyupload->getMarketings($filter_data);

		foreach ($results as $result) {
			$data['marketings'][] = array(
				'marketing_id' => $result['alert_id'],
				'name'         => $result['title'],
				'area'         => $result['area'],
				'type'       => $result['type'],
				'date'       => $result['date'],
				'vol'       => $result['vol'],
				//'date_added'   => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'         => $this->url->link('extension/module/emergencyupload/edit', 'user_token=' . $this->session->data['user_token'] . '&marketing_id=' . $result['alert_id'] . $url, true),
				'volunteer'         => $this->url->link('extension/module/emergencyupload/getVol', 'user_token=' . $this->session->data['user_token'] . '&marketing_id=' . $result['alert_id'] . $url, true)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_vol=' . $this->request->get['filter_vol'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		/*$data['sort_name'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.name' . $url, true);
		$data['sort_code'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.code' . $url, true);
		$data['sort_date_added'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.date_added' . $url, true);*/

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_vol'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $marketing_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($marketing_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($marketing_total - $this->config->get('config_limit_admin'))) ? $marketing_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $marketing_total, ceil($marketing_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_area'] = $filter_area;
		$data['filter_type'] = $filter_type;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_vol'] = $filter_vol;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/emergencyupload_list', $data));
	}
	
	public function getVol() {
		
		$this->load->language('extension/module/emergencyuploadVol');
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_area'])) {
			$filter_area = $this->request->get['filter_area'];
		} else {
			$filter_area = '';
		}
		
		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = '';
		}
		

		/*if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$filter_vol = $this->request->get['filter_vol'];
		} else {
			$filter_vol = '';
		}*/

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_vol=' . $this->request->get['filter_vol'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('extension/module/emergencyupload/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('extension/module/emergencyupload/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['marketings'] = array();

		$filter_data = array(
			'filter_name'       => $filter_name,
			'filter_area'       => $filter_area,
			'filter_type'       => $filter_type,
			//'filter_date_added' => $filter_date_added,
			//'filter_vol'       => $filter_vol,
			'sort'              => $sort,
			'order'             => $order,
			'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'             => $this->config->get('config_limit_admin')
		);

		$this->load->model('extension/module/emergencyupload');
		
		$marketing_total = $this->model_extension_module_emergencyupload->getTotalVolunteers($filter_data, $this->request->get['marketing_id']);

		$results = $this->model_extension_module_emergencyupload->getVolunteers($filter_data, $this->request->get['marketing_id']);

		foreach ($results as $result) {
			$data['marketings'][] = array(
				//'marketing_id' => $result['v.volunteer_id'],
				'name'         => $result['user_id'],
				'area'         => $result['volunteer_name'],
				'type'       => $result['volunteer_contact'],
				//'date'       => $result['date'],
				//'vol'       => $result['vol'],
				//'date_added'   => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				//'edit'         => $this->url->link('extension/module/emergencyupload/edit', 'user_token=' . $this->session->data['user_token'] . '&marketing_id=' . $result['alert_id'] . $url, true),
				//'volunteer'         => $this->url->link('extension/module/emergencyupload/getVol', 'user_token=' . $this->session->data['user_token'] . '&marketing_id=' . $result['alert_id'] . $url, true)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		/*if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_vol=' . $this->request->get['filter_vol'];
		}*/

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		/*$data['sort_name'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.name' . $url, true);
		$data['sort_code'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.code' . $url, true);
		$data['sort_date_added'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . '&sort=m.date_added' . $url, true);*/

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		/*if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_vol'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_vol'];
		}*/

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $marketing_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($marketing_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($marketing_total - $this->config->get('config_limit_admin'))) ? $marketing_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $marketing_total, ceil($marketing_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_area'] = $filter_area;
		$data['filter_type'] = $filter_type;
		//$data['filter_date_added'] = $filter_date_added;
		//$data['filter_vol'] = $filter_vol;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/emergencyupload_listVol', $data));
	}
	
	

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['marketing_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['area'])) {
			$data['error_area'] = $this->error['area'];
		} else {
			$data['error_area'] = '';
		}
		
		if (isset($this->error['type'])) {
			$data['error_type'] = $this->error['type'];
		} else {
			$data['error_type'] = '';
		}

		/*if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}*/

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_area'])) {
			$url .= '&filter_area=' . $this->request->get['filter_area'];
		}
		
		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['marketing_id'])) {
			$data['action'] = $this->url->link('extension/module/emergencyupload/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('extension/module/emergencyupload/edit', 'user_token=' . $this->session->data['user_token'] . '&marketing_id=' . $this->request->get['marketing_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['marketing_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$marketing_info = $this->model_extension_module_emergencyupload->getMarketing($this->request->get['marketing_id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		$data['store'] = HTTP_CATALOG;

		if (isset($this->request->post['title'])) {
			$data['name'] = $this->request->post['title'];
		} elseif (!empty($marketing_info)) {
			$data['name'] = $marketing_info['title'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['area'])) {
			$data['area'] = $this->request->post['area'];
		} elseif (!empty($marketing_info)) {
			$data['area'] = $marketing_info['area'];
		} else {
			$data['area'] = '';
		}
		
		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($marketing_info)) {
			$data['type'] = $marketing_info['type'];
		} else {
			$data['type'] = '';
		}

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (!empty($marketing_info)) {
			$data['description'] = $marketing_info['description'];
		} else {
			$data['description'] = '';
		}
		
		if (isset($this->request->post['guidelines'])) {
			$data['guidelines'] = $this->request->post['guidelines'];
		} elseif (!empty($marketing_info)) {
			$data['guidelines'] = $marketing_info['guidelines'];
		} else {
			$data['guidelines'] = '';
		}
		
		if (isset($this->request->post['helpline'])) {
			$data['helpline'] = $this->request->post['helpline'];
		} elseif (!empty($marketing_info)) {
			$data['helpline'] = $marketing_info['helpline'];
		} else {
			$data['helpline'] = '';
		}
		
		if (isset($this->request->post['disclaimer'])) {
			$data['disclaimer'] = $this->request->post['disclaimer'];
		} elseif (!empty($marketing_info)) {
			$data['disclaimer'] = $marketing_info['disclaimer'];
		} else {
			$data['disclaimer'] = '';
		}

		/*if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif (!empty($marketing_info)) {
			$data['code'] = $marketing_info['code'];
		} else {
			$data['code'] = uniqid();
		}*/

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/emergencyupload_form', $data));
	}
	
	

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'extension/module/emergencyupload')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['area']) {
			$this->error['area'] = $this->language->get('error_area');
		}
		
		if (!$this->request->post['type']) {
			$this->error['type'] = $this->language->get('error_type');
		}

		$marketing_info = $this->model_extension_module_emergencyupload->getMarketingByCode($this->request->post['marketing_id']);

		if (!isset($this->request->get['marketing_id'])) {
			if ($marketing_info) {
				$this->error['code'] = $this->language->get('error_exists');
			}
		} else {
			if ($marketing_info && ($this->request->get['marketing_id'] != $marketing_info['marketing_id'])) {
				$this->error['code'] = $this->language->get('error_exists');
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'extension/module/emergencyupload')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	
	public function edit() {
		$this->load->language('extension/module/emergencyupload');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/emergencyupload');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_emergencyupload->editMarketing($this->request->get['marketing_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_code'])) {
				$url .= '&filter_code=' . $this->request->get['filter_code'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/emergencyupload', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}
		
		$this->getForm();
	}



}