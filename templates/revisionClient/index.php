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
        left: 75%;    
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
    .btt {
        padding: 5px;    
        margin: 15px;
        position: relative;    
        left: 0%;    
        border: solid 1px black;    
        border-radius: 8px;
        display: inline-block;
        background-color: blanchedalmond;
        color: black;
    }
</style>
<body>
    <h2>Liste des contrats de révision</h2>
    <?= $this->html->link('➕',['controller' => 'revisionClient', 'action' => 'addRv'],['class' => "bttn add", 'title' => 'add']) ?>
    <?= $this->html->link('rolles de revision',['controller' => 'roles', 'action' => 'index'],['class' => "btt", 'title' => 'gestion des rolles de revision']) ?>
    <?php if(!empty($revs)){ ?>
    <table>
    <thead>
        <tr>
            <th colspan='2'>nom société</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($revs as $rev): ?>
            <tr>
                <td><?= h($rev['nom_soc']) ?></td>
                <td>
                    <div style="">
                        <?= $this->html->link('📰',['controller' => 'revisionClient', 'action' => 'print', '?' => ['id' => $rev['id']]],['class' => "bttn edit", 'title' => 'ajouter roles', 'target' => '_blank']) ?>
                        <?= $this->html->link('📝',['controller' => 'revisionClient', 'action' => 'edit', '?' => ['id' => $rev['id']]],['class' => "bttn edit", 'title' => 'edit']) ?>
                        <?= $this->html->link('❌',['controller' => 'revisionClient', 'action' => 'delete', '?' => ['id' => $rev['id']]],['confirm' => 'Êtes-vous sûr de vouloir supprimer ce contrat?','class' => "bttn delete", 'title' => 'delete']) ?>
                    </div>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php }else {
    echo 'No models found';
}?>
</body>
</html>