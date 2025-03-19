<?php 
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;


class clientController extends AppController{
    public function index(){
        $this->viewBuilder()->setLayout('hmLayout');
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT * FROM soc ');
        $soc = $results->fetchAll('assoc');
        $this->set(compact('soc'));
    }
    public function add(){
        $this->viewBuilder()->setLayout('hmLayout');
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        if($this->request->is('post')){
            $mat = $this->request->getData('mat');
            $nom = $this->request->getData('nom');
            $add = $this->request->getData('add');
            $gov = $this->request->getData('gov');
            $num = $this->request->getData('num');
            $pres = $this->request->getData('pres');
            $connection = ConnectionManager::get('default');
            $query = "INSERT INTO soc(mat_fisc, nom, add_loc, gouvernorat, num_tel, founder) VALUES(:mat, :nom, :add, :gov, :num, :pres)";
            $query2 = "INSERT INTO Add_installation(mat_fisc, addr, gouvernorat) VALUES(:mat, :add, :gov)";
            $params = [
                "mat" => $mat,
                "nom" => $nom,
                "add" => $add,
                "gov" => $gov,
                "num" => $num,
                "pres" => $pres
            ];
            $params2 = [
                "mat" => $mat,
                "add" => $add,
                "gov" => $gov
            ];
            try{
                $connection->execute($query, $params);
                $connection->execute($query2, $params2);
                $this->Flash->success(__("succée d'enregistrement"));
                return $this->redirect(['action' => 'index']);
            }catch(\Exception $e){
                $this->Flash->error(__("echec d'enregistrement: " . $e->getMessage()));
            }
        }
    }
    public function addLocation(){
        $this->viewBuilder()->setLayout('hmLayout');
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $mat = $_GET['mat'];
        $connection = ConnectionManager::get('default');
        $query = "SELECT * FROM add_installation WHERE mat_fisc = :mat";
        $params = [
            "mat" => $mat
        ];
        $results = $connection->execute($query, $params);
        $loc = $results->fetchAll('assoc');
        $this->set(compact('loc'));
    }
    public function addloc(){
        $this->viewBuilder()->setLayout('hmLayout');
        if($this->request->is('post')){
            $mat = $this->request->getData('mat');
            $location = $this->request->getData('location');
            $gouv = $this->request->getData('gouv');
            $connection = ConnectionManager::get('default');
            $query = "INSERT INTO add_installation(mat_fisc, addr, gouvernorat) VALUES(:mat, :location, :gouv)";
            $params = [
                "mat" => $mat,
                "location" => $location,
                "gouv" => $gouv
            ];
            try {
                $connection->execute($query, $params);
                $this->Flash->success(__("succée d'enregistrement"));
            } catch (\Exeption $e) {
                $this->Flash->error(__("echec d'enregistrement: " . $e->getMessage()));
            }
            return $this->redirect(['action' => 'addLocation', '?' => ['mat' => $mat]]);
        }
    }
    public function deleteLoc(){
        $this->viewBuilder()->setLayout('hmLayout');
        $mat = $_GET['id'];
        $connection = ConnectionManager::get('default');
        $query = "DELETE FROM add_installation WHERE id = :mat";
        $params = [
            "mat" => $mat
        ];
        try {
            $connection->execute($query, $params);
            $this->Flash->success(__("succée de suppression"));
        } catch (\Exeption $e) {
            $this->Flash->error(__("echec de suppression: " . $e->getMessage()));
        }
        $query2 = "SELECT * FROM add_installation WHERE id = :mat";
        $params2 = [
            "mat" => $mat
        ];
        return $this->redirect(['action' => 'addLocation', '?' => ['mat' => $_GET['mat']]]);
    }   
    public function delete(){
        $this->viewBuilder()->setLayout('hmLayout');
        $mat = $_GET['mat'];
        $connection = ConnectionManager::get('default');
        $query = "DELETE FROM soc WHERE mat_fisc = :mat";
        $query2= "DELETE FROM add_installation WHERE mat_fisc = :mat";
        $params = [
            "mat" => $mat
        ];
        try {
            $connection->execute($query2, $params);
            $connection->execute($query, $params);
            $this->Flash->success(__("succée de suppression"));
        } catch (\Exeption $e) {
            $this->Flash->error(__("echec de suppression: " . $e->getMessage()));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function edit(){  
        $this->viewBuilder()->setLayout('hmLayout');
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $mat = $_GET['mat'];
        $connection = ConnectionManager::get('default');
        $query = "SELECT * FROM soc WHERE mat_fisc = :mat";
        $params = [
            "mat" => $mat
        ];
        $results = $connection->execute($query, $params);
        $soc = $results->fetch('assoc');
        $this->set(compact('soc'));
        
    }
    public function update(){
        if($this->request->is('post')){
            $mat = $this->request->getData('mat');
            $new_mat = $this->request->getData('New_mat');
            $nom = $this->request->getData('nom');
            $add = $this->request->getData('add');
            $gov = $this->request->getData('gov');
            $num = $this->request->getData('num');
            $pres = $this->request->getData('pres');
            $connection = ConnectionManager::get('default');
            $query = "UPDATE soc SET mat_fisc = :new_mat, nom = :nom, add_loc = :add, gouvernorat = :gov, num_tel = :num, founder = :pres WHERE mat_fisc = :mat";
            $params = [
                "new_mat" => $new_mat,
                "mat" => $mat,
                "nom" => $nom,
                "add" => $add,
                "gov" => $gov,
                "num" => $num,
                "pres" => $pres
            ];
            
            try {
                $connection->execute($query, $params);
                $this->Flash->success(__("succée de modification"));
                return $this->redirect(['action' => 'index']);
            } catch (\Exeption $e) {
                $this->Flash->error(__("echec de modification: " . $e->getMessage()));
            }
        }
    }
        
}