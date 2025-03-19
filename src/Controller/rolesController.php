<?php
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;

class rolesController extends AppController{
    public function index(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = connectionManager::get('default');
        $roles = $connection->execute('SELECT * FROM roles')->fetchAll('assoc');
        $this->set(compact('roles'));

    }
    public function add(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = ConnectionManager::get('default');
        if($this->request->is('post')){
            $name = $this->request->getData('name');
            try {
                $connection->execute('INSERT INTO roles (name) VALUES (:name)',['name'=>$name]);
                $this->Flash->success(__('role added successfully'));
                return $this->redirect(['action' => 'index']);
            } catch (\Exception $e) {
                $this->Flash->error(__('erreur lors de l\'ajout du role'.$e->getMessage()));
            }
        }
    }
    public function edit(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = connectionManager::get('default');
        $idp = $_GET['idp'];
        $role = $connection->execute('SELECT * FROM roles WHERE id = :id',['id' => $idp])->fetch('assoc');
        $this->set(compact('role'));
        
    }
    public function modify(){
        $connection = connectionManager::get('default');
        if($this->request->is('post')){
            $name = $this->request->getData('name');
            $id = $this->request->getData('id');
            $query = 'UPDATE roles SET name = :name WHERE id = :id';
            try {
                $connection->execute($query,['id' => $id, 'name' => $name]);
                $this->Flash->success(__('role a été modifier avec succée'));
            } catch (\Exception $e) {
                $this->Flash->error(__('erreur de modification: '.$e->getMessage()));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    public function delete(){
        $connection = ConnectionManager::get('default');
        $id = $_GET['id'];
        $connection->execute('DELETE FROM roles WHERE id = :id',['id'=>$id]);
        $this->Flash->success('le rolle a été supprimé avec succée');
        return $this->redirect(['action' => 'index']);
    }
}