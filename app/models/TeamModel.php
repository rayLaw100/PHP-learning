<?php 
class TeamModel {

    private $db;

    public function __construct() {
        $this->db = new Database;
      }

    public function getTeam(){
        $sql = "SELECT * FROM team ";
        $this->db->query($sql);
        return $this->db->resultSet();

        // $data =['role'=>'sales'];
        // return $data;
    }
    public function getTeamById($id){
      //echo & print example
        // echo ' 1. id :', $id;
        // print ' 2. id: '.$id;
        // print " 3. id: $id";
        $sql = "SELECT * FROM team  WHERE  id = :id ";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        //PDO:PARAM_STR
        $rs = $this->db->single();
        var_dump($rs);
       
        if ( is_null($rs) ) {

            return null;
          } else {

            return $rs;
          }

    }

    public function createTeam($id, $name, $mobile, $role ){
        $sql =  "INSERT INTO team (id, mobile, fullname, role) VALUES ( :id , :mobile , :name , :role )";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':mobile', $mobile);
        $this->db->bind(':name', $name);
        $this->db->bind(':role', $role);

        if ( $this->db->execute() ) {
          $data['status'] = 0;
        } else {
            
          $error = $this->db->getError();
          $data['status'] = -1;
          $data['error'] = $error;
          // $this->log->error("Error when checkin to duty_record: ".$error);
        }
        // var_dump($data);
        return $data;
    }

    public function updateTeam($data){
      $sql ="UPDATE team SET mobile= :mobile , role =:role , fullname = :fullname WHERE id = :id";
      $this->db->query($sql);
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':mobile', $data['mobile']);
      $this->db->bind(':fullname',$data['fullname'] );
      $this->db->bind(':role', $data['role']);


      if ( $this->db->execute() ) {
        $data['status'] = 0;
      } else {
          
        $error = $this->db->getError();
        $data['status'] = -1;
        $data['error'] = $error;
        // $this->log->error("Error when checkin to duty_record: ".$error);
      }
      // var_dump($data);
      return $data;
    }

    public function delTeamById($id){
      $sql = "DELETE FROM team  WHERE  id = :id ";
      $this->db->query($sql);
      $this->db->bind(':id', $id);

      if ( $this->db->execute() ) {
        $data['status'] = 0;
        // var_dump($data);
      } else {
          
        $error = $this->db->getError();
        $data['status'] = -1;
        $data['error'] = $error;
        // var_dump($data);

      }
      return $data;
    }

}