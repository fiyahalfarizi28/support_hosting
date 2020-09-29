<?php
class Daily_report_model extends ci_model{
    
    function __construct() {
        parent::__construct();
    }
	
	public function get_crud($data)
    {
        if (is_array($data)) {
            if(array_key_exists('select', $data)) {
                $this->db->select($data['select']);
            }
			
			if (array_key_exists('insert', $data)) {
				$this->db->insert($data['insert']);
			}

            if(array_key_exists('table', $data)) {
                $this->db->from($data['table']);
            }

            if(array_key_exists('where', $data)) {
                $this->db->where($data['where']);
            }

            if(array_key_exists('or_where', $data)) {
                $this->db->or_where($data['or_where']);
            }

            if(array_key_exists('like', $data)) {
                $this->db->like($data['like']);
            }

            if(array_key_exists('or_like', $data)) {
                $this->db->or_like($data['or_like']);
            }

            if(array_key_exists('order_by', $data)) {
                $this->db->order_by($data['order_by']);
            }

            return $this->db->get();
        }
    }
	
}