<?php
class ModelReportOnline extends Model {
	public function getOnline($data = array()) {
		$sql = "SELECT co.ip, co.customer_id, co.url, co.referer, co.date_added FROM " . DB_PREFIX . "customer_online co LEFT JOIN " . DB_PREFIX . "customer c ON (co.customer_id = c.customer_id)";

		$implode = array();

		if (!empty($data['filter_ip'])) {
			$implode[] = "co.ip LIKE '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "co.customer_id > 0 AND CONCAT(c.firstname, ' ', c.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sql .= " ORDER BY co.date_added DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalOnline($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_online` co LEFT JOIN " . DB_PREFIX . "customer c ON (co.customer_id = c.customer_id)";

		$implode = array();

		if (!empty($data['filter_ip'])) {
			$implode[] = "co.ip LIKE '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "co.customer_id > 0 AND CONCAT(c.firstname, ' ', c.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}



	public function initValueProject(){
		//Please not the group by *x*
		$sql  = "select DATE(time) as x, count(view_id) as y from oc_project_viewed GROUP BY time";
		$interestedquery = "select DATE(timestamp) as x, COUNT(user_id) as y from oc_project_interested GROUP BY DATE(timestamp);";

		$query = $this->db->query($sql);
		$interestedResult = $this->db->query($interestedquery);

		echo "<script src='Dependencies/Chart.bundle.js' ></script>
                  <script src='Dependencies/additional.js' ></script>";
		
		foreach ($query->rows as $result) {
			//echo "console.log('You')";
			//echo "<script>console.log('View query: ".$result['x']." , ".$result['y']."')</script>";
			echo "<script>xValue.push('".$result['x']."');</script>";
			echo "<script>yValue.push('".$result['y']."');</script>";
			//echo '<script>console.log(xValue)</script>';
			
		}

		foreach ($interestedResult->rows as $iterator ) {
			//echo "<script>console.log('Interested query: ".$iterator['x']." , ".$iterator['y']."')</script>";
			echo "<script>xInterestedValue.push('".$iterator['x']."');</script>";
			echo "<script>yInterestedValue.push('".$iterator['y']."');</script>";
		}



	
        echo "<script>window.onload = function(){

            loadChartFunction(xValue, yValue, yInterestedValue, 'myChart', ['#000000'],['#000000']);

        };</script>";
        


        /*	
        echo "window.onload = function(){

            loadChartFunction(xValue, yValue, 'myChart',
            ['#813bf0'], 330, 'Views','', '' );

        }";
*/

		//echo '</script>';

	}






}
?>