<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contracts</title>
</head>
<style>
    .bttn {
        padding: 5px;    
        position: relative;    
        left: 70%;    
        border: solid 1px black;    
        border-radius: 8px;
    }
    .add{
        background-color: rgb(4 212 0);
        position: relative;
        left: 95%;
    }
    .delete{
        background-color: red;
    }
    .edit{
        background-color: rgb(14 89 244);
    }
    
    table{
        border: solid 1px lightgrey;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }
</style>
<body>
    <h2>Liste des contrats</h2>
    <?= $this->html->link('➕',['controller' => 'textEditor', 'action' => 'home'],['class' => "bttn add", 'title' => 'add']) ?>
    <?php if(!empty($contracts)){ ?>
    <table>
    <thead>
        <tr>
            <th colspan='2'>nom société</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contracts as $contract): ?>
            <tr>
                <td><?= h($contract['nom_soc']) ?></td>
                <td>
                    <div style="">
                        <?= $this->html->link('📰',['controller' => 'textEditor', 'action' => 'print', '?' => ['id' => $contract['id']]],['class' => "bttn ", 'title' => 'print', 'target' => '_blank']) ?>
                        <?= $this->html->link('📑',['controller' => 'textEditor', 'action' => 'view', '?' => ['id' => $contract['id']]],['class' => "bttn edit", 'title' => 'view']) ?>
                        <?= $this->html->link('📝',['controller' => 'textEditor', 'action' => 'edit', '?' => ['id' => $contract['id']]],['class' => "bttn edit", 'title' => 'edit']) ?>
                        <?= $this->html->link('❌',['controller' => 'textEditor', 'action' => 'delete', '?' => ['id' => $contract['id']]],['confirm' => 'Êtes-vous sûr de vouloir supprimer ce contrat?','class' => "bttn delete", 'title' => 'delete']) ?>
                    </div>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php }else {
    echo 'No contracts found';
}?>
</body>
</html>