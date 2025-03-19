<?php
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;

class ModTypesController extends AppController{
    public function index(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT * FROM models');
        $models = $results->fetchAll('assoc');
        $this->set(compact('models'));
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
            $html = $this->request->getData('content');
            $connection->execute('INSERT INTO models (name,html) VALUES (:name, :html)',['name'=>$name, 'html'=>$html]);
            $this->Flash->success('Model added successfully');
            return $this->redirect(['action' => 'index']);
        }
    }
    public function edit(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = ConnectionManager::get('default');
        $id = $_GET['id'];
        $results = $connection->execute('SELECT * FROM models WHERE id = :id',['id'=>$id]);
        $model = $results->fetch('assoc');
        $this->set(compact('model'));
        
    }
    public function modify(){
        $connection = ConnectionManager::get('default');
        if($this->request->is('post')){
            $id = $this->request->getData('id');
            $name = $this->request->getData('name');
            $html = $this->request->getData('content');
            $connection->execute('UPDATE models SET name = :name, html = :html WHERE id = :id',['name'=>$name, 'html'=>$html, 'id'=>$id]);
            $this->Flash->success("succée d'enregistrement");
            return $this->redirect(['action' => 'index']);
        }
    }
    public function delete(){
        $connection = ConnectionManager::get('default');
        $id = $_GET['id'];
        $connection->execute('DELETE FROM models WHERE id = :id',['id'=>$id]);
        $this->Flash->success('Model deleted successfully');
        return $this->redirect(['action' => 'index']);
    }
}