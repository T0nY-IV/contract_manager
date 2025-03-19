<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/ckeditor/ckeditor.js"></script>
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
    <?= $this->Form->create(null, ['url' => ['controller' => 'ModTypes', 'action' => 'add'],'type' => 'post']) ?> 
        
        <label>nom du modelle</label>
        <?= $this->Form->control('name', ['label' => false, 'type' => 'text', 'required' => true, 'id' => 'gouv']) ?>
        
        <textarea name="content" id="editor"></textarea>
        <?= $this->Form->submit('ajouter', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('Annuler',['controller' => 'ModTypes', 'action' => 'index'],['class' => "btt", 'title' => 'main menu']) ?>

    <?= $this->Form->end() ?>
    <script>
        CKEDITOR.replace('editor',{
                height: 1000,
            });
    </script>
    
</body>
</html>