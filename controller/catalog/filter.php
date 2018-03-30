<?php
class ControllerCatalogFilter extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/filter');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/filter');
		$this->getList();
	}

	
	public function edit() {
		$this->load->language('catalog/filter');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/filter');
		$this->getForm();
	}


	public function approve() {
		$this->load->language('catalog/filter');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/filter');
		$this->db->query("UPDATE oc_upload_idea SET status=1 where idea_id=".$this->request->get['filter_group_id'].";"); 
		$this->response->redirect($this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}

	public function reject(){
		
		$this->load->language('catalog/filter');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/filter');
		$this->db->query("UPDATE oc_upload_idea SET status=0 where idea_id=".$this->request->get['filter_group_id'].";"); 
		$this->response->redirect($this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}



	public function delete() {
		$this->load->language('catalog/filter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/filter');


		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			//$str ='';
			foreach ($this->request->post['selected'] as $filter_group_id) {

				$this->model_catalog_filter->deleteFilter($filter_group_id);
				
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
/*
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}*/

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
	
		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_upl'),
			'href' => $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		//$data['add'] = $this->url->link('catalog/filter/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/filter/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['edit'] = $this->url->link('catalog/filter/edit', 'user_token=' . $this->session->data['user_token'] . $url, true);

	
		$idealist = $this->model_catalog_filter->getIdeaList();
		$count=1;
		$min = $count;
		$max = 1;
		foreach ($idealist as $result) {
			$max = $count;
			$data['filters'][] = array(
				'number' => $count++,
				'username'   =>  $result['username'],
				'title'      => $result['title'],
				'uid' => $result['uid'],
				'email' => $result['email'],
				'status' => $result['status'],
				'edit'            => $this->url->link('catalog/filter/edit', 'user_token=' . $this->session->data['user_token'] . '&filter_group_id=' . $result['uid'] . $url, true)
			);

		}

		
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

/*		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

*/		$url = '';

/*		$pagination = new Pagination();
		$pagination->total = $filter_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($filter_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($filter_total - $this->config->get('config_limit_admin'))) ? $filter_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $filter_total, ceil($filter_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		*/

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/filter_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['filter_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['group'])) {
			$data['error_group'] = $this->error['group'];
		} else {
			$data['error_group'] = array();
		}

		if (isset($this->error['filter'])) {
			$data['error_filter'] = $this->error['filter'];
		} else {
			$data['error_filter'] = array();
		}

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['filter_group_id'])) {
			$data['approvedUrl'] = $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['rejectedUrl'] = $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true);
	
		} else {

			$data['approvedUrl'] = $this->url->link('catalog/filter/approve', 'user_token=' . $this->session->data['user_token'] . '&filter_group_id=' . $this->request->get['filter_group_id'] . $url, true);
			$data['rejectedUrl'] = $this->url->link('catalog/filter/reject', 'user_token=' . $this->session->data['user_token'].'&filter_group_id=' . $this->request->get['filter_group_id'] . $url, true);
	

			
			$result1 = $this->model_catalog_filter->getValueForId($this->request->get['filter_group_id']);

			foreach($result1 as $result){

				$data['title_value'] = $result['title'];
				$data['description_value'] = $result['description'];
				$data['file_value'] = $result['file'];

				$statusVal = $result['status'];
				if($statusVal==-1)
					$data['status_value'] = $this->language->get('status-1');
				elseif ($statusVal==0)
					$data['status_value'] = $this->language->get('status0');
				elseif ($statusVal==1)
					$data['status_value'] = $this->language->get('status1');
				else
					echo "";
				
				$data['name_value'] = $result['username'];
				$data['email_value'] = $result['email'];

			}
		}

		$data['cancel'] = $this->url->link('catalog/filter', 'user_token=' . $this->session->data['user_token'] . $url, true);

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/filter_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/filter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['filter_group_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 64)) {
				$this->error['group'][$language_id] = $this->language->get('error_group');
			}
		}

		if (isset($this->request->post['filter'])) {
			foreach ($this->request->post['filter'] as $filter_id => $filter) {
				foreach ($filter['filter_description'] as $language_id => $filter_description) {
					if ((utf8_strlen($filter_description['name']) < 1) || (utf8_strlen($filter_description['name']) > 64)) {
						$this->error['filter'][$filter_id][$language_id] = $this->language->get('error_name');
					}
				}
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/filter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/filter');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$filters = $this->model_catalog_filter->getFilters($filter_data);

			foreach ($filters as $filter) {
				$json[] = array(
					'filter_id' => $filter['filter_id'],
					'name'      => strip_tags(html_entity_decode($filter['group'] . ' &gt; ' . $filter['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}