<?php 
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;
use Dompdf\Dompdf;
use Dompdf\Options;
class textEditorController extends AppController{
    public function home(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = connectionManager::get('default');
        $results = $connection->execute('SELECT mat_fisc, nom FROM soc')->fetchAll('assoc');
        $soci = [];
        foreach ($results as $r) {
            $soci[$r['mat_fisc']] = $r['nom'];
        }
        $this->set(compact('soci'));
        $results2 = $connection->execute('SELECT * FROM models')->fetchAll('assoc');
        $mod = [];
        foreach ($results2 as $r) {
            $mod[$r['id']] = $r['name'];
        }
        $this->set(compact('mod'));
        
    }
    public function getInstallations()
    {
        $this->autoRender = false; 
        $matFisc = $this->request->getQuery('mat_fisc');
        $connection = ConnectionManager::get('default');
        $params = ['mat' => $matFisc];
        $results = $connection->execute('SELECT id, addr, gouvernorat FROM add_installation WHERE mat_fisc = :mat', $params)->fetchAll('assoc');
        $installations = [];
        foreach ($results as $r) {
            $installations[$r['id']] = $r['addr'] . '- ' . $r['gouvernorat'];
        }
        echo json_encode($installations);
    }
    public function index(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
            
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT * FROM contracts');
        $contracts = $results->fetchAll('assoc');
        $this->set(compact('contracts'));
    }
    public function add(){
        if ($this->request->is('post')) {
            $soc = $this->request->getData('soc');
            $connection = ConnectionManager::get('default');
            $results = $connection->execute('SELECT * FROM soc WHERE mat_fisc = :mat', ['mat' => $soc]);
            $con = $results->fetch('assoc');
            $ger = $connection->execute('SELECT founder FROM soc where mat_fisc = :mat', ['mat' => $soc])->fetch('assoc')['founder'];
            $loc = $this->request->getData('loc');
            $poids = $this->request->getData('poids');
            $contract = $this->request->getData('content');
            $query="INSERT INTO contracts(nom_soc, mat_fisc, presenter, loc_id, poids_assenseur, cntrct) VALUES(:soc, :mat, :ger, :loc, :poids, :content)";
            $params=[
                "soc"=>$con['nom'],
                "mat"=>$soc,
                "ger"=>$ger,
                "loc"=>$loc,
                "poids"=>$poids,
                "content"=>$contract
            ];
            try{
                $connection->execute($query,$params);
                $this->Flash->success(__("succée d'enregistrement"));
            }catch(\Exception $e){
                $this->Flash->error(__("echec d'enregistrement: " . $e->getMessage()));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    public function delete(){
        $id = $_GET["id"];
        $connection = ConnectionManager::get('default');
        $query='DELETE FROM contracts WHERE id = :id';
        $params=[":id" => $id];
        try {
            $connection->execute($query,$params);
            $this->Flash->success(__('suppression avec succée'));
        } catch (\Exception $e) {
            $this->Flash->error(__("echec du suppression: " . $e->getMessage()));
        }
        return $this->redirect(['action'=>'index']);
    }
    public function edit(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $id=$_GET['id'];
        $connection = connectionManager::get('default');
        $results = $connection->execute('SELECT mat_fisc, nom FROM soc')->fetchAll('assoc');
        $soci = [];
        foreach ($results as $r) {
            $soci[$r['mat_fisc']] = $r['nom'];
        }
        $this->set(compact('soci'));
        $results1 = $connection->execute('SELECT * FROM add_installation WHERE mat_fisc = (SELECT mat_fisc FROM contracts WHERE id = :id)',['id' => $id])->fetchAll('assoc');
        $loca = [];
        foreach ($results1 as $r) {
            $loca[$r['id']] = $r['addr'] . '- ' . $r['gouvernorat'];
        }
        $this->set(compact('loca'));
        $results2 = $connection->execute('SELECT * FROM models')->fetchAll('assoc');
        $mod = [];
        foreach ($results2 as $r) {
            $mod[$r['id']] = $r['name'];
        }
        $this->set(compact('mod'));
        $query = 'SELECT * FROM contracts WHERE id = :id';
        $params = ['id' => $id];
        try {
            $res = $connection->execute($query, $params);
            $contract = $res->fetch('assoc');
            $this->set(compact('contract'));
            $res2 = $connection->execute('SELECT addr, gouvernorat FROM add_installation WHERE id = :id', ['id' => $contract['loc_id']]);
            $location_load = $res2->fetch('assoc');
            $this->set(compact('location_load'));
        } catch (\Exception $e) {
            $this->Flash->error(__('error getting the needed data: '.$e->getMessage()));
        }
    }
    public function modify(){
        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            $soc = $this->request->getData('soc');
            $ger = $this->request->getData('ger');
            $loc = $this->request->getData('loc');
            $gouv = $this->request->getData('gouv');
            $poids = $this->request->getData('poids');
            $contract = $this->request->getData('content');
            $connection = ConnectionManager::get('default');
            $soc_name= $connection->execute('SELECT nom FROM soc WHERE mat_fisc = :mat', ['mat' => $soc])->fetch('assoc')['nom'];
            $query="UPDATE contracts SET nom_soc = :soc, mat_fisc = :mat, presenter = :ger, loc_id = :loc, poids_assenseur = :poids, cntrct = :content WHERE id = :id";
            $params=[
                "id" => $id,
                "soc" => $soc_name,
                "mat" => $soc,
                "ger" => $ger,
                "loc" => $loc,
                "poids" => $poids,
                "content" => $contract
            ];
            try{
                $connection->execute($query,$params);
                $this->Flash->success(__("succée d'enregistrement"));
            }catch(\Exception $e){
                $this->Flash->error(__("echec d'enregistrement: " . $e->getMessage()));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    public function view(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmlayout');
        $id=$_GET['id'];
        $connection = connectionManager::get('default');
        $query = 'SELECT * FROM contracts WHERE id = :id';
        $params = [':id' => $id];
        try {
            $res = $connection->execute($query, $params);
            $contract = $res->fetch('assoc');
            $this->set(compact('contract'));
            $res2 = $connection->execute('SELECT addr, gouvernorat FROM add_installation WHERE id = :id', ['id' => $contract['loc_id']]);
            $location_load = $res2->fetch('assoc');
            $this->set(compact('location_load'));
            $res3 = $connection->execute('SELECT html FROM models WHERE id = :id',['id' => $contract['cntrct']])->fetch('assoc')['html'];
            $this->set(compact('res3'));
        } catch (\Exception $e) {
            $this->Flash->error(__('error getting the needed data: '.$e->getMessage()));
        }
    }
    public function print(){
        $id = $_GET['id'];
        $connection = connectionManager::get('default');
        $query = 'SELECT * FROM contracts WHERE id = :id';
        $params = [':id' => $id];
        try {
            $res = $connection->execute($query, $params);
            $contract = $res->fetch('assoc');
            $this->set(compact('contract'));
            $res2 = $connection->execute('SELECT addr, gouvernorat FROM add_installation WHERE id = :id', ['id' => $contract['loc_id']]);
            $location_load = $res2->fetch('assoc');
            $this->set(compact('location_load'));
            $contra = $connection->execute('SELECT html FROM models WHERE id = :id',['id' => $contract['cntrct']])->fetch('assoc')['html'];
            $contra= str_replace("[societe]",$contract['nom_soc'],$contra);
            $contra= str_replace("[presenteur]",$contract['presenter'],$contra);
            $contra= str_replace("[gouvernorat]",$location_load['gouvernorat'],$contra);
            $contra= str_replace("[poids]",$contract['poids_assenseur'],$contra);
            $contra= str_replace("[localisation]",$location_load['addr'].'- '.$location_load['gouvernorat'],$contra);
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($contra);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();
            echo '<html><body>';
            echo '<iframe src="data:application/pdf;base64,' . base64_encode($output) . '" style="width:100%; height:100%;" onload="this.contentWindow.print();"></iframe>';
            echo '</body></html>';
        } catch (\Exception $e) {
            $this->Flash->error(__('error getting the needed data: '.$e->getMessage()));
        }
        exit();
    }
    
    public function generatePdf()
    {
        if ($this->request->is('POST')) {
            $contract = $this->request->getData('fin');
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($contract);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('contract.pdf', array('Attachment' => 0)); 

            exit();
        }
    }
}