

<?php

class Pages extends Controller
{

  private $teamModel;


  public function __construct()
  {
    $this->teamModel = $this->model('TeamModel');
  }
  public function index()
  {
    $data = [
      'title' => 'Welcome',
      'name' => 'PHP test',
      'group' => '1'
    ];

    $data['team'] = $this->teamModel->getTeam();

    $this->view('pages/index', $data);
  }

  public function searchById()
  {
    // var_dump($_POST);  print data array

    if ($_POST['act'] == 'DO-search') {


      $data = [
        'title' => 'Searching',
        'name' => 'PHP  test',
        'group' => '2'
      ];
      // echo 'id :' ,$_POST['search-id'];
      $data['team'] = $this->teamModel->getTeamById($_POST['search-id']);
      if (empty($data['team'])) {
        $data['error'] = 'nothing';
        $this->redirect();
      }
      // var_dump($data);
      $this->view('pages/search', $data);
    } else {

      $this->redirect();
    }
  }

  public function addTeam(){
    if ($_POST['act'] == 'DO-add') {

      $data['result']=$this->teamModel->createTeam($_POST['new_id'],$_POST['new_name'],$_POST['new_mobile'],$_POST['new_role']  );
      $data = [
        'title' => 'Welcome',
        'name' => 'PHP add test',
        'group' => '3'
      ];
      
      $data['team'] = $this->teamModel->getTeam();
      $this->view('pages/index', $data);
    }
    else{
      $this->redirect();
    }
  }

  public function editTeam($id = 0){
    $action = $_POST['act'];

    if ( $action == 'DO-UPDATE' ) {
      $data['team'] = (object) $_POST;
      $result = $this->teamModel->updateTeam($_POST);
      if ( $result['status'] == 0 ) {
        $data['success'] = 'Team has been saved';
      } else {
        $data['error'] = 'Error while saving to database ['.$result['error'].']';
      }
      // var_dump($data);

      $this->view('pages/editTeam', $data);
      // $this->redirect('');
    } else if (  $action == 'DO-CANCEL' ) {
      $data['team'] = (object) $_POST;

      $this->redirect('');
    } else {
      // Load notice record then display edit form
      $data['team'] = $this->teamModel->getTeamById($id);
      // var_dump($data);
      if ( !empty($data['team']) ) {
      
        $this->view('pages/editTeam', $data);
      } else {
        $this->redirect('');
      }
    }
  }

  public function deleteTeam(){
    if ($_POST['act'] == 'DO-delete') {
    
      // var_dump($_POST['del_id']);
      $result=$this->teamModel->delTeamById($_POST['del_id']);
      if($result['status']==0){
        // echo 'Notice has been deleted';
      }
      $data = [
        'title' => 'Deleted',
        'name' => 'PHP del test',
        'group' => '5'
      ];
      
      $data['team'] = $this->teamModel->getTeam();
      // var_dump($data);
      $this->view('pages/index', $data);
    }
    else{
      $this->redirect();
    }
  }

  public function about()
  {
    $data = [
      'title' => 'About'
    ];
    $this->view('pages/about', $data);
  }
}
