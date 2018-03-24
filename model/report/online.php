<script src='Dependencies/Chart.bundle.js' ></script>
<script src='Dependencies/add.js' ></script>


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


	public function getViewDataForProject(){
		$sql  = "select DATE(time) as x, count(view_id) as y from oc_project_viewed GROUP BY time";
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getInterDataForProject(){
		$interestedquery = "select DATE(timestamp) as x, COUNT(user_id) as y from oc_project_interested GROUP BY DATE(timestamp);";
		$interestedResult = $this->db->query($interestedquery);
		return $interestedResult->rows;
	}


	public function getDataOfFilters(){
		$sql = "select project_id as id, title from oc_project";
		$result = $this->db->query($sql);
		return $result->rows;
	}	

	public function sqlexecutor($sql){
		if($sql!=undefined)
			$result = $this->db->query($sql);
		return $result->rows;
	}



}
?>