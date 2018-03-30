
<script src='Dependencies/Chart.bundle.js' ></script>
<script src='Dependencies/add.js'></script>


<?php
class ControllerReportReport extends Controller {
	public function index() {
		$this->load->language('report/report');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/report', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->get['code'])) {
			$data['code'] = $this->request->get['code'];
		} else {
			$data['code'] = '';
		}



		
		$this->load->model('setting/extension');

		// Get a list of installed modules
		$extensions = $this->model_setting_extension->getInstalled('report');
		
		// Add all the modules which have multiple settings for each module
		foreach ($extensions as $code) {
			if ($this->config->get('report_' . $code . '_status') && $this->user->hasPermission('access', 'extension/report/' . $code)) {
				$this->load->language('extension/report/' . $code, 'extension');
				
				$data['reports'][] = array(
					'text'       => $this->language->get('extension')->get('heading_title'),
					'code'       => $code,
					'sort_order' => $this->config->get('report_' . $code . '_sort_order'),
					'href'       => $this->url->link('report/report', 'user_token=' . $this->session->data['user_token'] . '&code=' . $code, true)
				);
			}
		}
		
		$sort_order = array();

		foreach ($data['reports'] as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $data['reports']);	
		
		if (isset($this->request->get['code'])) {
			$data['report'] = $this->load->controller('extension/report/' . $this->request->get['code'] . '/report');
		} elseif (isset($data['reports'][0])) {
			$data['report'] = $this->load->controller('extension/report/' . $data['reports'][0]['code'] . '/report');
		} else {
			$data['report'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		//////////// Model //////////

		$this->load->model('report/online');
		
        $data['filte_url'] = $this->url->link('report/report', 'user_token=' . $this->session->data['user_token'] , true);

        //Load the DDs

        //Option dropdown

        
        //Project DD
        //$sql = "select project_id as id, title from oc_project ORDER BY title";
        $sql = "select project_id as id, title from oc_project  ";
        echo "<script>alert('Filter started');</script>";
        	
        
		$answer = $this->model_report_online->sqlExecutor($sql);
		
		$data['projectlist'] = array();

		$data['projectlist'][] = array(
			'id' => -1,
			'item' => 'All project',
			'selected' => 1
		);

		$maxlen = 20;
		foreach ($answer as $r) {
			$temp = $r['title'];

			if(strlen($temp)>$maxlen)
				$temp = substr($temp, 0, $maxlen)."...";

			$data['projectlist'][] = array(
				'id' => $r['id'],
				'item' =>  $temp,
				'selected' => 0
			);

		}


		//Country DD
		$answer = $this->model_report_online->get_Cities_Project();
		
		$data['countrylist'] = array();

		$data['countrylist'][] = array(
			'id' => -1,
			'item' => 'All country',
			'selected' => 1
		);

		$maxlen = 20;
		$itr=1;
		foreach ($answer as $r) {
			$temp = $r['city'];

			if(strlen($temp)>$maxlen)
				$temp = substr($temp, 0, $maxlen)."...";

			$data['countrylist'][] = array(
				'id' => $itr++,
				'item' =>  $temp,
				'selected' => 0
			);

		}

		//Date DDs
		$datelist = $this->model_report_online->get_Date_Project();

		$data['datelist'] = array();

		$data['datelist'][] = array(
			'id' => -1,
			'item' => 'All time',
			'selected' => 1
		);

		$maxlen = 20;
		$itr=1;
		foreach ($datelist as $r) {
			//$temp = $r['column_name'];

			//if(strlen($temp)>$maxlen)
				//$temp = substr($temp, 0, $maxlen)."...";

			$data['datelist'][] = array(
				'id' => $itr++,
				'item' =>  $r,
				'selected' => 0
			);

		}
		
		//Creating the chart
		
		//getting the sql data
		
		//$queryview = "select DATE(viewtable.time) as x, count(viewtable.view_id) as y from oc_project_viewed as viewtable INNER JOIN oc_project as project ON viewtable.project_id=project.project_id   ";

		$queryview   = "select DATE(time) as x, count(view_id) as y from oc_project_viewed ";
		$queryinterested = "select DATE(timestamp) as x, COUNT(user_id) as y from oc_project_interested   ";


		if(	isset($this->request->post["startDate"]) &&   isset($this->request->post["endDate"])    )
        {
        	//$queryview .= " where  project.last_added between  '".$this->request->post["startDate"]."%' and '".$this->request->post["endDate"]."%' ";
        	$queryview .= " where DATE(time)>='".$this->request->post["startDate"]."%' and DATE(time)<='".$this->request->post["endDate"]."%'  ";
        	$queryinterested .= "   where  DATE(timestamp)>='".$this->request->post["startDate"]."%' and DATE(timestamp)<='".$this->request->post["endDate"]."%'   ";
        	echo "<script>alert('".$queryview."');</script>";
        }

        //$queryview .= " GROUP BY viewtable.time";
        $queryview .= " GROUP BY  DATE(time) ORDER BY DATE(time) ";
        $queryinterested .= "  GROUP BY DATE(timestamp) ORDER BY DATE(timestamp) ";
        echo "<script>alert('".$queryinterested."');</script>";
		echo "<script>alert('".$queryview."');</script>";
		$result1 = $this->model_report_online->sqlExecutor($queryview);
		
		$result2 = $this->model_report_online->sqlExecutor($queryinterested);

		//converting into php array
		$chartData1 = array();	
		foreach($result1 as $result){
			$chartData1[] = $result;
		}

		$chartdata2 = array();
		foreach ($result2 as $iterator ){
			$chartdata2[] = $iterator;
		}

		//encoding into json array
		$chart1_json = json_encode($chartData1);
		$chart2_json = json_encode($chartdata2);

		
		//Loading the weeklyy chart
		$weekdata = $this->model_report_online->getWeekView();

		//converting into php array
		$weekly = array();	
		foreach($weekdata as $result){
			$weekly[] = $result;
		}			

		//encoding into json array
		$weekly_json = json_encode($weekly);
		
		//passing to the function defined in add.js file include at top of this file.
		echo "<script>window.onload = function(){
			loadChartFunction( 'myChart', ['#6fd4f5'],['#e05549'],'".$chart1_json."','".$chart2_json."');
            singleChart( 'weeklychart', ['#6fd4f5'],['#e05549'],'".$weekly_json."',1);
        };</script>";

		$this->response->setOutput($this->load->view('report/report', $data));

	}



}