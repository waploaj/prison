<?php defined('BASEPATH') OR exit('No direct script access allowed');
   
class Crime_model extends CI_Model {

    // table name
    private $tableName= 'crime';

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
        $this->db->select('`crime`.`id` AS `id`,`crime`.`crime_date` AS `crime_date`,`crime`.`crime_location` AS `crime_location`,`crime`.`arrest_location` AS `arrest_location`,`crime`.`police_custody` AS `police_custody`,`crime`.`crime_province_id` AS `crime_province_id`,`crime_province`.`name` AS `crime_province`,`crime`.`crime_district_id` AS `crime_district_id`,`crime_district`.`name` AS `crime_district`,`crime`.`arrest_province_id` AS `arrest_province_id`,`arrest_province`.`name` AS `arrest_province`,`crime`.`arrest_district_id` AS `arrest_district_id`,`arrest_district`.`name` AS `arrest_district`, `crime`.`time_spent_in_prison` AS `time_spent_in_prison`,`crime`.`remaining_jail_term` AS `remaining_jail_term`,`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,`crime`.`command_issue_date` AS `command_issue_date`,`crime`.`commission_proposal` AS `commission_proposal`,`crime`.`prisoner_request` AS `prisoner_request`,`crime`.`commission_member` AS `commission_member`');
        $this->db->from($this->tableName);
        $this->db->join('province AS crime_province', 'crime_province.id = crime.crime_province_id', 'inner');
        $this->db->join('district AS crime_district', 'crime_district.id = crime.crime_district_id', 'inner');
        $this->db->join('province AS arrest_province', 'arrest_province.id = crime.arrest_province_id', 'inner');
        $this->db->join('district AS arrest_district', 'arrest_district.id = crime.arrest_district_id', 'inner');
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