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
    .bttn {
        padding: 5px;    
        position: relative;    
        left: 80%;    
        border: solid 1px black;    
        border-radius: 8px;
    }
    .edit{
        background-color: rgb(14 89 244);
    }
    .btt {
        padding: 1px; 
        padding-left:3px;
        padding-right:3px;   
        position: absolute;
        right: 30px;
        top: -67px;    
        border: solid 1px black;    
        border-radius: 8px;
        color: black;
        background-color:#ff8b00;
        font-weight: bolder;
    }
    
</style>
<body>
<?= $this->Form->create(null, ['url' => ['controller' => 'textEditor', 'action' => 'modify'],'type' => 'post']) ?> 
        <?= $this->form->control('id',['label' => 'false', 'value' => $contract['id'], 'type' => 'hidden']) ?>
        <?= $this->html->link('📝',['controller' => 'textEditor', 'action' => 'edit', '?' => ['id' => $contract['id']]],['class' => "bttn edit", 'title' => 'edit']) ?>
        <label>Nom du société</label>
        <?= $this->Form->control('soc', ['label' => false, 'value' => $contract['nom_soc'], 'type' => 'text', 'disabled' => true]) ?>
        
        <label>Gouvernorat</label>
        <?= $this->Form->control('gouv', ['label' => false, 'value' => $location_load['gouvernorat'], 'type' => 'text', 'disabled' => true]) ?>

        <label>Localisation</label>
        <?= $this->Form->control('loc', ['label' => false, 'value' => $location_load['addr'], 'type' => 'text', 'disabled' => true]) ?>
        
        <label>Poids d'ascenseur</label>
        <?= $this->Form->control('poids', ['label' => false, 'value' => $contract['poids_assenseur'], 'type' => 'number', 'disabled' => true]) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->create(null, ['url' => ['controller' => 'textEditor', 'action' => 'generatePdf'],'type' => 'post']) ?>
        <div class='code-container'> 
            <?php 
                $contra = $res3;
                $contra= str_replace("[societe]",$contract['nom_soc'],$contra);   
                $contra= str_replace("[presenteur]",$contract['presenter'],$contra);
                $contra= str_replace("[gouvernorat]",$location_load['gouvernorat'],$contra);
                $contra= str_replace("[localisation]",$location_load['addr'].'- '.$location_load['gouvernorat'],$contra);
                $contra= str_replace("[poids]",$contract['poids_assenseur'],$contra);
                echo $contra; 
            ?> 
        </div>
        <?= $this->Form->control('fin', ['label' => false, 'type' => 'hidden', 'value'=>$contra]) ?>
        <?= $this->Form->submit('print', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('❌',['controller' => 'textEditor', 'action' => 'index'],['class' => "btt", 'title' => 'annuler']) ?>

    <?= $this->Form->end(); ?>
    
    
</body>
</html>
</body>
</html>