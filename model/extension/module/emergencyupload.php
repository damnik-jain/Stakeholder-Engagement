<?php
class ModelExtensionModuleemergencyupload extends Model {
	public function addMarketing($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "alerts SET title = '" . $this->db->escape($data['name']) . "', description = '" . $this->db->escape($data['description']) . "', area = '" . $this->db->escape($data['area']) . "', type = '" . $this->db->escape($data['type']) . "', guidelines = '" . $this->db->escape($data['guidelines']) . "', helpline = '" . $this->db->escape($data['helpline']) . "', disclaimer = '" . $this->db->escape($data['disclaimer']) . "', date = NOW(), time = NOW()");

		return $this->db->getLastId();
	}

	public function editMarketing($marketing_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "alerts SET title = '" . $this->db->escape($data['name']) . "', description = '" . $this->db->escape($data['description']) . "', area = '" . $this->db->escape($data['area']) . "', type = '" . $this->db->escape($data['type']) . "', guidelines = '" . $this->db->escape($data['guidelines']) . "', helpline = '" . $this->db->escape($data['helpline']) . "', disclaimer = '" . $this->db->escape($data['disclaimer']) . "'  WHERE alert_id = '" . (int)$marketing_id . "'");
	}

	public function deleteMarketing($marketing_id) {
		$this->db->query("DELETE a, v FROM " . DB_PREFIX . "alerts a LEFT JOIN " . DB_PREFIX . "volunteer v ON (a.alert_id = v.alert_id) WHERE a.alert_id = '" . (int)$marketing_id . "'");
	}

	public function getMarketing($marketing_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "alerts WHERE alert_id = '" . (int)$marketing_id . "'");

		return $query->row;
	}

	public function getMarketingByCode($marketing_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "alerts WHERE alert_id = '" . $this->db->escape($marketing_id) . "'");

		return $query->row;
	}

	public function getMarketings($data = array()) {
		//$implode = array();

		//$order_statuses = $this->config->get('config_complete_status');

		/*foreach ($order_statuses as $order_status_id) {
			$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
		}*/

		$sql = "SELECT a.alert_id, a.title, a.area, a.type, a.date, count(v.volunteer_id) as vol FROM " . DB_PREFIX . "alerts a LEFT JOIN " . DB_PREFIX . "volunteer v ON (a.alert_id = v.alert_id) GROUP BY v.alert_id";

		//$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "a.title LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_area'])) {
			$implode[] = "a.area LIKE '" . $this->db->escape($data['filter_area']) . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$implode[] = "a.type LIKE '" . $this->db->escape($data['filter_type']) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "a.date LIKE '" . $this->db->escape($data['filter_date_added']) . "'";
		}
		
		if (!empty($data['filter_vol'])) {
			$implode[] = "v.vol LIKE '" . $this->db->escape($data['filter_vol']) . "'";
		}

		$sort_data = array(
			'title',
			'area',
			'type',
			'date',
			'vol'
		);

		/*if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY a.title";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}*/

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getVolunteers($data = array(), $marketing_id) {
		//$implode = array();

		//$order_statuses = $this->config->get('config_complete_status');

		/*foreach ($order_statuses as $order_status_id) {
			$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
		}*/

		$sql = "SELECT v.user_id, v.volunteer_name, v.volunteer_contact FROM " . DB_PREFIX . "alerts a LEFT JOIN " . DB_PREFIX . "volunteer v ON (a.alert_id = v.alert_id) WHERE v.alert_id = '" . (int)$marketing_id . "'";

		//$implode = array();

		if (!empty($data['filter_name'])) {
			$sql.= "v.user_id LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_area'])) {
			$sql.= "v.volunteer_name LIKE '" . $this->db->escape($data['filter_area']) . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$sql.= "v.volunteer_contact LIKE '" . $this->db->escape($data['filter_type']) . "'";
		}

		/*if (!empty($data['filter_date_added'])) {
			$implode[] = "a.date LIKE '" . $this->db->escape($data['filter_date_added']) . "'";
		}
		
		if (!empty($data['filter_vol'])) {
			$implode[] = "v.vol LIKE '" . $this->db->escape($data['filter_vol']) . "'";
		}*/

		$sort_data = array(
			'user_id',
			'volunteer_name',
			'volunteer_contact'
			
		);

		/*if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY a.title";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}*/

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalMarketings($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "alerts";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "title LIKE '" . $this->db->escape($data['filter_name']) . "'";
		}

		if (!empty($data['filter_area'])) {
			$implode[] = "area = '" . $this->db->escape($data['filter_code']) . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$implode[] = "type = '" . $this->db->escape($data['filter_type']) . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "date = '" . $this->db->escape($data['filter_type']) . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getTotalVolunteers($data = array(), $marketing_id) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "volunteer WHERE alert_id = '" . (int)$marketing_id . "'";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "user_id LIKE '" . $this->db->escape($data['filter_name']) . "'";
		}

		if (!empty($data['filter_area'])) {
			$implode[] = "volunteer_name = '" . $this->db->escape($data['filter_code']) . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$implode[] = "volunteer_contact = '" . $this->db->escape($data['filter_type']) . "'";
		}

		/*if (!empty($data['filter_date_added'])) {
			$implode[] = "date = '" . $this->db->escape($data['filter_type']) . "'";
		}*/

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}