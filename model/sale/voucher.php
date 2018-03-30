<?php
class ModelSaleVoucher extends Model {
	public function addVoucher($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "voucher SET code = '" . $this->db->escape($data['code']) . "', from_name = '" . $this->db->escape($data['from_name']) . "', from_email = '" . $this->db->escape($data['from_email']) . "', to_name = '" . $this->db->escape($data['to_name']) . "', to_email = '" . $this->db->escape($data['to_email']) . "', voucher_theme_id = '" . (int)$data['voucher_theme_id'] . "', message = '" . $this->db->escape($data['message']) . "', amount = '" . (float)$data['amount'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		return $this->db->getLastId();
	}

	public function getRecentProject(){
		$sql = "SELECT project_id as pid, title as title, department as department, last_modified as last_modified, image as image, (SELECT COUNT(view_id) FROM oc_project_viewed WHERE project_id=pid) as view, (SELECT COUNT(user_id) FROM oc_project_interested WHERE project_id=pid) as interested FROM `oc_project` ORDER BY last_modified LIMIT 4";
		$result = $this->db->query($sql);
		return $result->rows;
	}	

	public function getNewsInfo(){
		$sql = "SELECT headline as headline from oc_project_news limit 4";
		$result = $this->db->query($sql);
		return $result->rows;
	}

}
