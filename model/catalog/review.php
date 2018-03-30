<?php
class ModelCatalogReview extends Model {
	public function addReview($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "survey_questions SET question = '" . $this->db->escape($data['author']) . "'"); //product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = '" . $this->db->escape($data['date_added']) . "'");

		$review_id = $this->db->getLastId();

		$this->cache->delete('review_id');

		return $review_id;
	}

	public function editReview($review_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "survey_questions SET author = '" . $this->db->escape($data['author']) . "', status = '" . (int)$data['status'] . "'");

		$this->cache->delete('product');
	}

	public function deleteReview($review_id) {
		$this->db->query("DELETE q, a FROM " . DB_PREFIX . "survey_questions q LEFT JOIN " . DB_PREFIX . "survey_answers a ON (q.survey_id = a.survey_id) WHERE q.survey_id = '" . (int)$review_id . "'");

		$this->cache->delete('review_id');
	}

	public function getReview($review_id) {
		$query = $this->db->query("SELECT question as author, status FROM " . DB_PREFIX . "survey_questions  WHERE survey_id = '" . (int)$review_id . "'");

		return $query->row;
	}

	public function getReviews($data = array()) {
		$sql = "SELECT pd.survey_id, pd.question, count(r.user_id)as users, avg(r.rating) as avg_rating, pd.date, pd.status FROM " . DB_PREFIX . "survey_questions pd LEFT OUTER JOIN " . DB_PREFIX . "survey_answers r ON (r.survey_id = pd.survey_id) GROUP BY pd.survey_id";// WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		//$sql .= "SELECT r.survey_ans_id, pd.question, count(r.user_id)as users FROM " . DB_PREFIX . "survey_answers r LEFT JOIN " . DB_PREFIX . "survey_questions pd ON (r.survey_id = pd.survey_id) GROUP BY r.user_id";// WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.question LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND users LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}
		
		if (!empty($data['filter_rating'])) {
			$sql .= " AND avg_rating LIKE '" . $this->db->escape($data['filter_rating']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND pd.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(pd.date) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'pd.question',
			'users',
			'avg_rating',
			'status',
			'date'
		);

		/*if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}*/

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
	
	public function getDetails($data = array(), $survey_id) {
		$sql = "SELECT u.firstname, u.contact, a.rating, a.ans FROM " . DB_PREFIX . "survey_answers a LEFT JOIN " . DB_PREFIX . "user u ON (u.user_id = a.user_id) WHERE survey_id = '" . (int)$survey_id . "'";// WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		//$sql .= "SELECT r.survey_ans_id, pd.question, count(r.user_id)as users FROM " . DB_PREFIX . "survey_answers r LEFT JOIN " . DB_PREFIX . "survey_questions pd ON (r.survey_id = pd.survey_id) GROUP BY r.user_id";// WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_product'])) {
			$sql .= " AND user_id LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}
			
		if (!empty($data['filter_rating'])) {
			$sql .= " AND rating LIKE '" . $this->db->escape($data['filter_rating']) . "%'";
		}
		
		
		if (!empty($data['filter_author'])) {
			$sql .= " AND ans LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}
				

		/*if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}*/

		$sort_data = array(
			'firstname',
			'contact',
			'rating',
			'ans',
			//'r.status',
			//'r.date_added'
		);

		/*if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}*/

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

	public function getTotalDetails($data = array(), $survey_id) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "survey_answers WHERE survey_id = '" . (int)$survey_id . "'";

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
		public function getTotalReviews($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "survey_questions";

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
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


		public function getSurveyAnalysis($sid="", $ans){
		
		$sql = "select '".$ans."' as x, If(count(a.survey_ans_id)>0 ,count(a.survey_ans_id), 0) as y from oc_survey_answers as a where survey_ratings = ".$ans." AND survey_id = ".$pid." ;";
               
		$result =  $this->db->query($sql);

		return $result->rows;

	}


}

/*
public function getReviews($data = array()) {
		$sql = "SELECT r.review_id, pd.name, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id)";// WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'pd.name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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
	*/


