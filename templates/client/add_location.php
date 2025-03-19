<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>textEditor</title>
</head>
<style>
    .btt {
        padding: 6px;    
        position: absolute;
        left: 150px;
        bottom: 14px;    
        border: solid 1px black;    
        border-radius: 8px;
        color: black;
        background-color:#ff8b00;
        font-weight: bolder;
    }
</style>
<body>
    <h2>ajouter localisation</h2>
    <table>
    <thead>
        <tr>
            <th colspan='2'>les localisation</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($loc as $s): ?>
            <tr>
                <td><?= h($s['addr']) ?></td>
                <td><?= h($s['gouvernorat']) ?></td>
                <td><?= $this->Html->link('❌', ['controller' => 'client', 'action' => 'deleteLoc', '?' => ['id' => $s['id'],'mat' => $s['mat_fisc']]], ['confirm' => 'Êtes-vous sûr de vouloir supprimer ce contrat?', 'class' => 'bttn delete', 'title' => 'supprimer']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->Form->create(null, ['url' => ['controller' => 'client', 'action' => 'addloc'],'type' => 'post']) ?> 
        <?= $this->Form->control('mat', ['label' => false, 'type' => 'hidden', 'value' => $_GET['mat']]) ?> 
        <label>localisation</label>
        <?= $this->Form->control('location', ['label' => false, 'type' => 'text', 'required' => true]) ?>
        
        <label>gouvernorat</label>
        <?= $this->Form->control('gouv', ['label' => false, 'type' => 'text', 'required' => true]) ?>

        <?= $this->Form->submit('ajouter', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('Annuler',['controller' => 'client', 'action' => 'index'],['class' => "btt", 'title' => 'main menu']) ?>
    <?= $this->Form->end() ?>
    
            
    
</body>
</html>