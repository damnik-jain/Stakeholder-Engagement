<?php
class ModelCatalogInformation extends Model {
	public function addReview($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "poll_questions SET question = '" . $this->db->escape($data['author']) . "', status = '" . (int)$data['status'] . "', date = NOW()");

		$review_id = $this->db->getLastId();

		//$this->cache->delete('product');

		return $review_id;
	}

	public function editReview($review_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "poll_questions SET question = '" . $this->db->escape($data['author']) . "', status = '" . (int)$data['status'] . "' WHERE poll_id = '" . (int)$review_id . "'");

		//$this->cache->delete('product');
	}

	public function deleteReview($review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "poll_questions WHERE poll_id = '" . (int)$review_id . "'");

		$this->cache->delete('product');
	}

	public function getReview($review_id) {
		$query = $this->db->query("SELECT question as author, status FROM " . DB_PREFIX . "poll_questions r WHERE poll_id = '" . (int)$review_id . "'");

		return $query->row;
	}

	public function getReviews($data = array()) {
		$sql = "SELECT q.poll_id, q.question, count(a.poll_ans_id) as users,  q.date, q.status FROM " . DB_PREFIX . "poll_questions q LEFT JOIN " . DB_PREFIX . "poll_answers a ON (q.poll_id = a.poll_id) GROUP BY a.poll_id";

		if (!empty($data['filter_poll'])) {
			$sql .= " AND q.question LIKE '" . $this->db->escape($data['filter_poll']) . "%'";
		}

		if (!empty($data['filter_users'])) {
			$sql .= " AND users LIKE '" . $this->db->escape($data['filter_users']) . "%'";
		}
		
		/*if (!empty($data['filter_yes'])) {
			$sql .= " AND yes LIKE '" . $this->db->escape($data['filter_yes']) . "%'";
		}*/

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND q.date LIKE '" . $this->db->escape($data['filter_date_added']) . "%'";
		}
		
		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND q.status = '" . (int)$data['filter_status'] . "%'";
		}

		

		$sort_data = array(
			'question',
			'users',
			'date',
			'status',
			
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY q.question";
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
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getNos($data = array(), $review_id) {
		$sql = "SELECT u.firstname, u.contact, a.poll_ans from  " . DB_PREFIX . "poll_answers a LEFT JOIN  " . DB_PREFIX . "user u ON (a.user_id = u.user_id) WHERE a.poll_id = '" . (int)$review_id . "'";

		if (!empty($data['filter_poll'])) {
			$sql .= " AND u.firstname LIKE '" . $this->db->escape($data['filter_poll']) . "%'";
		}

		if (!empty($data['filter_users'])) {
			$sql .= " AND u.contact LIKE '" . $this->db->escape($data['filter_users']) . "%'";
		}
		
		/*if (!empty($data['filter_yes'])) {
			$sql .= " AND yes LIKE '" . $this->db->escape($data['filter_yes']) . "%'";
		}*/

		if (!empty($data['filter_yes'])) {
			$sql .= " AND a.poll_ans LIKE '" . $this->db->escape($data['filter_yes']) . "%'";
		}
		
		/*if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND q.status = '" . (int)$data['filter_status'] . "%'";
		}*/

		

		$sort_data = array(
			'firstname',
			'contact',
			'poll_ans'
			
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY u.firstname";
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
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalReviews($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "poll_questions q";

		/*if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}*/

		if (!empty($data['filter_author'])) {
			$sql .= " AND question LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= "AND q.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
		public function getTotalNos($data = array(), $review_id) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "poll_answers  WHERE poll_id = '" . (int)$review_id . "'";

		/*if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}*/

		if (!empty($data['filter_author'])) {
			$sql .= " AND question LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= "AND q.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review WHERE status = '0'");

		return $query->row['total'];
	}


	public function getPollAnalysis($pid="", $ans){
		$temp = "";

		if($ans==1){
			$temp = "Yes";
		}
		elseif ($ans==2) {
			$temp = "No";
		}elseif($ans==3)
		{
			$temp = "Dont say";
		}
		
		$sql = "select '".$temp."' as x, If(count(a.poll_ans_id)>0 ,count(a.poll_ans_id), 0) as y from oc_poll_answers as a where poll_ans = ".$ans." AND poll_ans_id = ".$pid;
               
		$result =  $this->db->query($sql);
        return $result->rows;

	}	



}
