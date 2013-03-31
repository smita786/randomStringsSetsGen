<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'admin';

    /**
     * Default helper
     *
     * @var array
     */
    public $helpers = array('Html', 'Session');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array("profileName");

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function index(){
        $p_names = array();
            Controller::loadModel('profileName');
            $profile_model = $this->profileName;
            $profiles = $profile_model->find("all");
            foreach ($profiles as $profile){
                $p_names[] = $profile['profileName']['name'];
            }
            $this->set('p_names',$p_names);
    }
    public function addProfileNames(){
        Controller::loadModel('profileName');
        $profile_model = $this->profileName;
        $nameVal = $_POST['nameVal'];
        $profile_name = $_POST['pname'];
        $definition = serialize($nameVal);
        $data = array();
        $data['profileName']['name'] = $profile_name;
        $data['profileName']['defination'] = (String)$definition;
        $profile_model->save($data);
        $this->redirect("/admin");
    }
    public function deleteProfileNames(){
        Controller::loadModel('profileName');
        $profile_model = $this->profileName;
        $profile_name = $_POST['sel_pname'];
        $query = "delete from profile_names where name = ".'"'.$profile_name.'"';
        $profile_model->query($query);
        $this->redirect("/admin");
    }
}
?>
