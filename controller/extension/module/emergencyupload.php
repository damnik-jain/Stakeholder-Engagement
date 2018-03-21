<?php 


class Controllerextensionmoduleemergencyupload extends Controller {
	
	private $error = array();


	public function index() {
		$this->load->language('extension/module/emergencyupload');

		$this->document->setTitle($this->language->get('heading_title'));

		//$this->load->model('uploadidea/uploadidea');

		//$this->getList();
		$data = array();

		$data['normal'] = 'Start the emergency page in twig langugae from here';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/emergencyupload', $data));
	}



}