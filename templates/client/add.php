<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>textEditor</title>
</head>
<style>
    #cont{
        width: 595px;
        background-color: white;
    }
    .code-container {
        background-color:rgb(255, 255, 255);
        padding: 15px;
        border-radius: 8px;
        overflow: auto;
        font-family: 'Courier New', Courier, monospace;
        font-size: 75%;
    }
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
    <?= $this->Form->create(null, ['url' => ['controller' => 'client', 'action' => 'add'],'type' => 'post']) ?> 
        <label>Matricule Fiscale</label>
        <?= $this->Form->control('mat', ['label' => false, 'type' => 'text', 'required' => true]) ?>
        
        <label>Nom</label>
        <?= $this->Form->control('nom', ['label' => false, 'type' => 'text', 'required' => true]) ?>
        
        <label>Adresse local</label>
        <?= $this->Form->control('add', ['label' => false, 'type' => 'text', 'required' => true]) ?>
        
        <label>Gouvernorat</label>
        <?= $this->Form->control('gov', ['label' => false, 'type' => 'text', 'required' => true]) ?>

        <label>Numero de telephone</label>
        <?= $this->Form->control('num', ['label' => false, 'type' => 'number', 'required' => true]) ?>
        
        <label>fondateur</label>
        <?= $this->Form->control('pres', ['label' => false, 'type' => 'text', 'required' => true]) ?>

        <?= $this->Form->submit('ajouter', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('Annuler',['controller' => 'client', 'action' => 'index'],['class' => "btt", 'title' => 'main menu']) ?>
    <?= $this->Form->end() ?>
            
    
</body>
</html>