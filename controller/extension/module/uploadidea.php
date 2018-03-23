<?php

class Controllerextensionmoduleuploadidea extends Controller {
	private $error = array();


	public function index() {
		$this->load->language('extension/module/uploadidea');

		$this->document->setTitle($this->language->get('heading_title'));

		//$this->load->model('extension/module/uploadidea');
		$this->load->model('extension/dashboard/map');

		//$this->getList();
		$data = array();

		$data['normal'] = $this->model_extension_dashboard_map->getUploadedIdeas();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/uploadidea', $data));



	}
}