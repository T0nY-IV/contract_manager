<?php
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;


class revisionClientController extends AppController{
    public function index(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmLayout');
        $connection = connectionManager::get('default');
        $revs = $connection->execute('SELECT R.id, C.nom_soc FROM rev_clt R, contracts C WHERE R.idContract = C.id')->fetchAll('assoc');
        $this->set(compact('revs'));
    }
    public function delete(){
        $this->viewBuilder()->setLayout('hmLayout');
        $connection = connectionManager::get('default');
        $id = $this->request->getQuery('id');
        $connection->execute('DELETE FROM rev_clt WHERE id = :id',['id' => $id]);
        $this->redirect(['action' => 'index']);
    }
    public function addRv(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmLayout');
        $connection = connectionManager::get('default');
        $results = $connection->execute('SELECT C.id, C.mat_fisc, C.poids_assenseur, S.nom, S.add_loc FROM contracts C, soc S WHERE C.mat_fisc = S.mat_fisc')->fetchAll('assoc');
        $soci = [];
        foreach ($results as $r) {
            $soci[$r['id']] = $r['id'].'-'.$r['nom'].'-'.$r['add_loc'].'_'.$r['poids_assenseur'];
        }
        $this->set(compact('soci'));
        $roels = $connection->execute('SELECT * from roles')->fetchAll('assoc');
        $this->set(compact('roels'));
        
    }
    public function add(){
        if($this->request->is('post')){
            $connection = connectionManager::get('default');
            try {
                $params = [
                    'idContract' => $this->request->getData('idContract'),
                    'date' => $this->request->getData('date'),
                    'nb_stop' => $this->request->getData('nb_stop'),
                    'poids' => $this->request->getData('poids'),
                    'mark' => $this->request->getData('mark'),
                    'typ' => $this->request->getData('typ'),
                    'typ_rev' => $this->request->getData('typ_rev'),
                    'num_asc' => $this->request->getData('num_asc'),
                    'ing' => $this->request->getData('ing')
                ];
                $connection->execute('INSERT INTO rev_clt (idContract, dat_rev, nb_stp, mark, poids, typ, typ_rev, num_asc, ing) VALUES (:idContract, :date, :nb_stop, :mark, :poids, :typ, :typ_rev, :num_asc, :ing)',$params);
                $selectedRoles = $this->request->getData('roles');
                $l = [];
                foreach ($selectedRoles as $roleId) {
                    if($roleId != 0){
                        $l[] = $roleId;
                    }
                }
                if (!empty($l)) {
                    $k = $connection->execute('SELECT id FROM rev_clt WHERE idContract = :idContract AND dat_rev = :date AND nb_stp = :nb_stop AND mark = :mark AND poids = :poids AND typ = :typ AND typ_rev = :typ_rev AND num_asc = :num_asc AND ing = :ing',$params)->fetch('assoc')['id'];
                    foreach ($l as $roleId) {
                        $connection->execute('INSERT INTO ck_rls (id_R, id_RC) VALUES (:id_R, :id_RC)',['id_R' => $roleId, 'id_RC' => $k]);
                    }
                    $this->Flash->success(__('Roles saved successfully.'));
                }

                $this->Flash->success(__('Revision ajouté avec succès'));
                $this->redirect(['action' => 'index']);
            } catch (\Exception $e) {
                $this->Flash->error(__('erreur: '.$e->getMessage()));
                $this->redirect(['action' => 'addRv']);
            }
        }
    }
    public function edit(){
        session_start();
        if (!isset($_SESSION['id'])){
            return $this->redirect(['controller' => 'homeScreen', 'action' => 'connection']);
        }
        $this->viewBuilder()->setLayout('hmLayout');
        $Mo = [];
        $connection = connectionManager::get('default');
        $results = $connection->execute('SELECT C.id, C.mat_fisc, C.poids_assenseur, S.nom, S.add_loc FROM contracts C, soc S WHERE C.mat_fisc = S.mat_fisc')->fetchAll('assoc');
        $soci = [];
        foreach ($results as $r) {
            $soci[$r['id']] = $r['id'].'-'.$r['nom'].'-'.$r['add_loc'].'_'.$r['poids_assenseur'];
        }
        $this->set(compact('soci'));
        $selectedOption = $connection->execute('SELECT * FROM rev_clt WHERE id = :id',['id' => $_GET['id']])->fetch('assoc');
        $this->set(compact('selectedOption'));
        $roels = $connection->execute('SELECT * from roles')->fetchAll('assoc');
        $this->set(compact('roels'));
        $slctd = $connection->execute('SELECT * from ck_rls WHERE id_RC = :id',['id' => $_GET['id']])->fetchAll('assoc');
        $this->set(compact('slctd'));   
        
    }
    public function update(){
        if($this->request->is('post')){
            $connection = connectionManager::get('default');
            try {
                $params = [
                    'id' => $this->request->getData('id'),
                    'idContract' => $this->request->getData('idContract'),
                    'date' => $this->request->getData('date'),
                    'nb_stop' => $this->request->getData('nb_stop'),
                    'poids' => $this->request->getData('poids'),
                    'mark' => $this->request->getData('mark'),
                    'typ' => $this->request->getData('typ'),
                    'typ_rev' => $this->request->getData('typ_rev'),
                    'num_asc' => $this->request->getData('num_asc')
                ];
                $connection->execute('UPDATE rev_clt SET idContract = :idContract, dat_rev = :date, nb_stp = :nb_stop, mark = :mark, poids = :poids, typ = :typ, typ_rev = :typ_rev, num_asc = :num_asc WHERE id = :id',$params);
                $selectedRoles = $this->request->getData('roles');
                $l = [];
                foreach ($selectedRoles as $roleId) {
                    if($roleId != 0){
                        $l[] = $roleId;
                    }
                }
                if (!empty($l)) {
                    $k = $connection->execute('SELECT id FROM rev_clt WHERE idContract = :idContract AND dat_rev = :date AND nb_stp = :nb_stop AND mark = :mark AND poids = :poids AND typ = :typ AND typ_rev = :typ_rev AND num_asc = :num_asc',[
                        'idContract' => $this->request->getData('idContract'),
                        'date' => $this->request->getData('date'),
                        'nb_stop' => $this->request->getData('nb_stop'),
                        'poids' => $this->request->getData('poids'),
                        'mark' => $this->request->getData('mark'),
                        'typ' => $this->request->getData('typ'),
                        'typ_rev' => $this->request->getData('typ_rev'),
                        'num_asc' => $this->request->getData('num_asc')
                    ])->fetch('assoc')['id'];
                    $connection->execute('DELETE FROM ck_rls WHERE id_RC = :id_RC',['id_RC' => $k]);
                    foreach ($l as $roleId) {
                        $connection->execute('INSERT INTO ck_rls (id_R, id_RC) VALUES (:id_R, :id_RC)',['id_R' => $roleId, 'id_RC' => $k]);
                    }
                    $this->Flash->success(__('Roles saved successfully.'));
                }
                $this->Flash->success(__('Revision modifié avec succès'));
            } catch (\Exception $e) {
                $this->Flash->error(__('erreur: '.$e->getMessage()));
            }
            $this->redirect(['action' => 'index']);
        }
    }
    public function print() {
        $this->viewBuilder()->setLayout('hmLayout');
        $connection = ConnectionManager::get('default');
        $roles = $connection->execute('SELECT * FROM roles')->fetchAll('assoc');
        $slctd = $connection->execute('SELECT * from ck_rls WHERE id_RC = :id',['id' => $_GET['id']])->fetchAll('assoc');

        $text = '
        <!DOCTYPE html>
        <html dir="rtl" lang="ar">
        <head>
            <meta charset="UTF-8">
            <style>
                @font-face {
                    font-family: "DejaVu Sans";
                    src: url("' . WWW_ROOT . 'font/DejaVuSans.ttf") format("truetype");
                    font-weight: normal;
                    font-style: normal;
                }
                * {
                    font-family: "DejaVu Sans", Arial, sans-serif;
                }
                body {
                    direction: rtl;
                    text-align: right;
                    font-size: 14px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 5px;
                    
                }
                th, td {
                    border: 2px solid black;
                    padding: 6px;
                    text-align: right;
                    font-size: 12px;
                }
                .ar {
                    direction: rtl;
                    text-align: left;
                    display: inline-block;
                    width: 100%;
                }
                .label {
                    float: right;
                }
                .a{
                    font-size: 15px;
                }  
            </style>
        </head>
        <body>
            <table>
                <tr>
                    <td><div class="ar"><span class="value">نوع المصعد </span><span class="label"> :[typ] </span></div></td>
                    <td><div class="ar"><span class="value">عدد الوقفات</span><span class="label"> :[nb_stp] </span></div></td>
                    <td><div class="ar"><span class="value">اسم العميل</span><span class="label"> :[client] </span></div></td>
                </tr>
                <tr>
                    <td><div class="ar"><span class="value">نوع الزيارة</span><span class="label"> :[typ_rev] </span></div></td>
                    <td><div class="ar"><span class="value">ماركة المصعد</span><span class="label"> :[mark] </span></div></td>
                    <td><div class="ar"><span class="value">اسم المبنى</span><span class="label"> :[place] </span></div></td>
                </tr>
                <tr>
                    <td><div class="ar"><span class="value">رقم المصعد</span><span class="label"> :[num] </span></div></td>
                    <td><div class="ar"><span class="value">حمولة المصعد</span><span class="label"> :[poids] </span></div></td>
                    <td><div class="ar"><span class="value">تاريخ الزيارة</span><span class="label"> :[date] </span></div></td>
                </tr>
            </table>
            <table>
                <tbody>';

        $data = $connection->execute('SELECT r.*, c.presenter, c.nom_soc FROM rev_clt r, contracts c WHERE r.id = :id and c.id = r.idContract', ['id' => $_GET['id']])->fetch('assoc');
        $text = str_replace('[typ]', $data['typ'], $text);
        $text = str_replace('[nb_stp]', $data['nb_stp'], $text);
        $text = str_replace('[client]', $data['presenter'], $text);
        $text = str_replace('[typ_rev]', $data['typ_rev'], $text);
        $text = str_replace('[mark]', $data['mark'], $text);
        $text = str_replace('[place]', $data['nom_soc'], $text);
        $text = str_replace('[num]', $data['num_asc'], $text);
        $text = str_replace('[poids]', $data['poids'], $text);
        $text = str_replace('[date]', $data['dat_rev'], $text);

        $halfCount = floor(count($roles) / 2);
        for ($i = 0; $i < $halfCount; $i++) {
            if (in_array($roles[$i]['id'], array_column($slctd, 'id_R'))) {
                $text .= '<tr><td><span class="a">☑</span>' . $roles[$i]['name'] . '</td>';
            } else {
                $text .= '<tr><td><span class="a">▢</span>' . $roles[$i]['name'] . '</td>';
            }
            if (in_array($roles[$halfCount + $i]['id'], array_column($slctd, 'id_R'))) {
                $text .= '<td><span class="a">☑</span>' . $roles[$halfCount + $i]['name']. '</td></tr>';
            } else {
                $text .= '<td><span class="a">▢</span>' . $roles[$halfCount + $i]['name'] . '</td></tr>';
            }
            
        }
        $text .= '</tbody></table>
            <table>
                <tr>
                    <td colspan="2">
                        <h4 style="margin: 1px; padding:1px;"> الملاحظات: </h4>
                        <p>....................................................................................................................................................................................................................</p>
                        <p>....................................................................................................................................................................................................................</p>
                        <p>....................................................................................................................................................................................................................</p>
                    </td>                
                </tr>
                <tr>
                    <td >
                        <h4 style="margin: 1px; padding:1px;"> اسم المهندس: <span> [ing] </span></h4>
                        
                    </td>  
                    <td >
                        <h4 style="margin: 1px; padding:1px;"> اسم العميل: <span> [client] </span></h4>
                        
                    </td>
                </tr>
                <tr>
                    <td >
                        <h4 style="margin: 1px; padding:1px;"> التوقيع</h4>
                        <p >_________________________________________________________</p>
                    </td>  
                    <td >
                        <h4 style="margin: 1px; padding:1px;">  التوقيع</h4>
                        <p >_________________________________________________________</p>
                    </td>
                </tr>

            </table>
            </body></html>';
            $text = str_replace('[client]', $data['presenter'], $text);
            $text = str_replace('[ing]', $data['ing'], $text);

        $mpdf = new Mpdf(['default_font' => 'DejaVu Sans']);
        $mpdf->WriteHTML($text);
        $mpdf->Output('document.pdf', 'I');
    }
    
}
?>