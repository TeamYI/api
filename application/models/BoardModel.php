<?php

class BoardModel extends CI_Model{

    public function __construct(){
        parent::__construct();

    }

    function noticeList(){

      $query = $this->db->query("select board_code, board_title, DATE_FORMAT(board_date, '%Y-%m-%d') as date from board order by board_date desc");

      return $query->result_array();
    }

    function noticeContent($code){
      $query = $this->db->query("select board_code, board_title, board_content ,DATE_FORMAT(board_date, '%Y-%m-%d') as board_date
                                 from board where board_code = '$code'");

      return $query->result_array();
    }

}

?>
