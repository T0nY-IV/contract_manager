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
    <h2>Liste des rôles</h2>
    <?= $this->html->link('➕',['controller' => 'roles', 'action' => 'add'],['class' => "bttn add", 'title' => 'add']) ?>
    <?php if(!empty($roles)){ ?>
    <table>
    <thead>
        <tr>
            <th colspan='2'>nom du rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= h($role['name']) ?></td>
                <td>
                    <div>
                        <?= $this->html->link('📝',['controller' => 'roles', 'action' => 'edit', '?' => ['idp' => $role['id']]],['class' => "bttn edit", 'title' => 'edit']) ?>
                        <?= $this->html->link('❌',['controller' => 'roles', 'action' => 'delete', '?' => ['id' => $role['id']]],['confirm' => 'Êtes-vous sûr de vouloir supprimer ce contrat?','class' => "bttn delete", 'title' => 'delete']) ?>
                    </div>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php }else {
    echo 'No roles found';
}?>
</body>
</html>