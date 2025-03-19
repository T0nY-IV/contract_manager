<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contracts</title>
</head>
<style>
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
<body >
    <?= $this->html->link('Client',['controller' => 'client', 'action' => 'index'],['class' => "btt", 'title' => 'gestion des clients']) ?>
    <?= $this->html->link('Modelle de contrat',['controller' => 'ModTypes', 'action' => 'index'],['class' => "btt", 'title' => 'gestion des modelles']) ?>
    <?= $this->html->link('affecter un contrat',['controller' => 'textEditor', 'action' => 'index'],['class' => "btt", 'title' => 'gestion des contrats']) ?>
    <?= $this->html->link('Ajouter une revision',['controller' => 'revisionClient', 'action' => 'index'],['class' => "btt", 'title' => 'gestion des revisions']) ?>
</body>
</html>