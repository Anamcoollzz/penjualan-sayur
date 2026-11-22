<?php 
class Model_admin extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function get_summary_counts()
	{
		$sales = $this->db->select('IFNULL(SUM(to_total), 0) as total_sales, COUNT(*) as count_orders', FALSE)
			->where('to_flag', 1)
			->get('t_order')
			->row_array();

		$purchases = $this->db->select('IFNULL(SUM(tp_total), 0) as total_purchases, COUNT(*) as count_purchases', FALSE)
			->where('tp_flag', 1)
			->get('t_purchase')
			->row_array();

		$products = $this->db->where('mp_flag', 1)->count_all_results('m_product');
		$customers = $this->db->where('mc_flag', 1)->count_all_results('m_customer');
		$suppliers = $this->db->where('ms_flag', 1)->count_all_results('m_supplier');
		$deliveries = $this->db->where('td_flag', 1)->count_all_results('t_delivery');

		return [
			'total_sales'      => (float) ($sales['total_sales'] ?? 0),
			'count_orders'     => (int) ($sales['count_orders'] ?? 0),
			'total_purchases'  => (float) ($purchases['total_purchases'] ?? 0),
			'count_purchases'  => (int) ($purchases['count_purchases'] ?? 0),
			'count_products'   => (int) $products,
			'count_customers'  => (int) $customers,
			'count_suppliers'  => (int) $suppliers,
			'count_deliveries' => (int) $deliveries
		];
	}

	public function get_category_distribution()
	{
		return $this->db->select('IFNULL(mp_category, "Lainnya") as category, COUNT(*) as total', FALSE)
			->where('mp_flag', 1)
			->group_by('mp_category')
			->get('m_product')
			->result_array();
	}

	public function get_order_status_distribution()
	{
		return $this->db->select('IFNULL(to_status, "PENDING") as status, COUNT(*) as total', FALSE)
			->where('to_flag', 1)
			->group_by('to_status')
			->get('t_order')
			->result_array();
	}

	public function get_recent_orders($limit = 5)
	{
		return $this->db->select('to_id, to_no, mc_name, to_date, to_total, to_status, to_status_payment')
			->where('to_flag', 1)
			->order_by('to_date', 'DESC')
			->order_by('to_id', 'DESC')
			->limit($limit)
			->get('t_order')
			->result_array();
	}

	public function get_recent_purchases($limit = 5)
	{
		return $this->db->select('tp_id, tp_no, ms_name, tp_date, tp_total, tp_status, tp_status_payment')
			->where('tp_flag', 1)
			->order_by('tp_date', 'DESC')
			->order_by('tp_id', 'DESC')
			->limit($limit)
			->get('t_purchase')
			->result_array();
	}

	public function get_monthly_finance()
	{
		$sales_by_month = $this->db->query("
			SELECT DATE_FORMAT(to_date, '%b %Y') as period, DATE_FORMAT(to_date, '%Y-%m') as sort_key, SUM(to_total) as total
			FROM t_order
			WHERE to_flag = 1
			GROUP BY sort_key, period
			ORDER BY sort_key ASC
			LIMIT 6
		")->result_array();

		$purchases_by_month = $this->db->query("
			SELECT DATE_FORMAT(tp_date, '%b %Y') as period, DATE_FORMAT(tp_date, '%Y-%m') as sort_key, SUM(tp_total) as total
			FROM t_purchase
			WHERE tp_flag = 1
			GROUP BY sort_key, period
			ORDER BY sort_key ASC
			LIMIT 6
		")->result_array();

		return [
			'sales'     => $sales_by_month,
			'purchases' => $purchases_by_month
		];
	}
}