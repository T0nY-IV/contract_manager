<?php 
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;

class homeScreenController extends AppController{
    public function index(){
        session_start();
        $this->viewBuilder()->setLayout('locLayout');
        if (!isset($_SESSION['id'])){
            return $this->redirect(['action' => 'connection']);
            
        }
    }
    public function connection(){
        $this->viewBuilder()->setLayout('error');
    }
    public function verify(){
        session_start();
        $this->viewBuilder()->setLayout('error');
        if($this->request->is('post')){
            $connection = connectionManager::get('default');
            $user = $this->request->getData('username');
            $pass = $this->request->getData('password');
            $query = 'SELECT * FROM usersafef WHERE login = :login';
            $res = $connection->execute($query,['login'=>$user])->fetch('assoc');
            if ($res) {
                if($pass == $res['password']){
                    $_SESSION['id'] = $res['id'];
                    $_SESSION['role'] = $res['name'];
                    return $this->redirect(['action' => 'index']);
                }
            }else{
                $this->Flash->error(__("nom d'utilisateur ou mot de passe est incorrect"));
                return $this->redirect(['action' => 'index']);
            }
            
        }
    }
    public function deconnect(){
        session_start();
        session_destroy();
        return $this->redirect(['action' => 'connection']);
    }

        
}