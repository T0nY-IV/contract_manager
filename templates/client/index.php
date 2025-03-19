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
        display: inline;
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
    .map{
        background-color: lightgrey;
        color: black;
    }    
    table{
        border: solid 1px lightgrey;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }
</style>
<body>
    <h2>Liste des Société</h2>
    <?= $this->html->link('➕',['controller' => 'client', 'action' => 'add'],['class' => "bttn add", 'title' => 'add']) ?>
    <?php if(!empty($soc)){ ?>
    <table>
    <thead>
        <tr>
            <th colspan='2'>nom société</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($soc as $s): ?>
            <tr>
                <td><?= h($s['nom']) ?></td>
                <td>
                    <div>
                        <?= $this->html->link('🌍',['controller' => 'client', 'action' => 'add_location', '?' => ['mat' => $s['mat_fisc']]],['class' => "bttn map", 'title' => 'ajouter localisation']) ?>
                        <?= $this->html->link('📝',['controller' => 'client', 'action' => 'edit', '?' => ['mat' => $s['mat_fisc']]],['class' => "bttn edit", 'title' => 'modifier']) ?>
                        <?= $this->html->link('❌',['controller' => 'client', 'action' => 'delete', '?' => ['mat' => $s['mat_fisc']]],['confirm' => 'Êtes-vous sûr de vouloir supprimer ce contrat?','class' => "bttn delete", 'title' => 'supprimer']) ?>
                    </div>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php }else {
    echo 'No company found';
}?>
</body>
</html>