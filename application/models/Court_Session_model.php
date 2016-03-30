<?php defined('BASEPATH') OR exit('No direct script access allowed');
   
class Court_Session_model extends CI_Model {

    // table name
    private $tableName= 'court_session';

    function __construct() {
        parent::__construct();
    }

    // get record by id
    function get_by_id($id, $column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get record by id with joins
    function get_by_id_with_joins($id){
        $this->db->select('`court_session`.`id` AS `id`,`court_session`.`crime_id` AS `crime_id`,`court_session`.`court_decision_type_id` AS `court_decision_type_id`,`court_decision_type`.`decision_type_name` AS `court_decision_type`,`court_session`.`decision_date` AS `decision_date`, `court_session`.`decision` AS `decision`,`court_session`.`defence_lawyer_name` AS `defence_lawyer_name`,`court_session`.`defence_lawyer_certificate_id` AS `defence_lawyer_certificate_id`, `court_session`.`sentence_execution_date` AS `sentence_execution_date`');
        $this->db->from($this->tableName);
        $this->db->join('court_decision_type', 'court_decision_type.id =  court_session.court_decision_type_id', 'inner');
        $this->db->where($this->tableName . '.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get all records
    function get_all($column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query->result();
    }

    // add new record
    function create($record){
        $this->db->insert($this->tableName, $record);
        return $this->db->insert_id();
    }

    // update the record by id
    function update_by_id($id, $person){
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $person);
    }

    public function update($where, $data)
    {
        $this->db->update($this->tableName, $data, $where);
        return $this->db->affected_rows();
    }

    // delete person by id
    function delete_by_id($id){
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);
    }
}