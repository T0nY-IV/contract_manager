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
    .checkbox-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
    }
    .checkbox-container span {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
</style>
<body>
<?= $this->Form->create(null, ['url' => ['controller' => 'revisionClient', 'action' => 'update'],'type' => 'post']) ?> 
        
        <?= $this->Form->control('id', ['type' => 'hidden', 'value' => $selectedOption['id']]) ?>

        <?= $this->Form->control('idContract', [
            'type' => 'select',
            'label' => 'Nom du société',
            'options' => $soci, 
            'empty' => 'Selectionner le nom du société',
            'class' => 'form-control',
            'id' => 'idContract',
            'default' => $selectedOption['idContract']
        ]) ?>
        
        <label>Poids d'ascenseur</label>
        <?= $this->Form->control('poids', ['label' => false, 'value' => $selectedOption['poids'], 'type' => 'number', 'required' => true, 'id' => 'gouv']) ?>

        <label>Date</label>
        <?= $this->Form->control('date', ['label' => false, 'value' => $selectedOption['dat_rev'], 'type' => 'date', 'required' => true]) ?> 

        <label>ingenieur</label>
        <?= $this->Form->control('ing', ['label' => false, 'value' => $selectedOption['ing'], 'type' => 'text', 'required' => true]) ?>
        
        <label>nombre de stop</label>
        <?= $this->Form->control('nb_stop', ['label' => false, 'value' => $selectedOption['nb_stp'], 'type' => 'number', 'required' => true]) ?>
        
        <label>marque</label>
        <?= $this->Form->control('mark', ['label' => false, 'value' => $selectedOption['mark'], 'type' => 'text', 'required' => true]) ?>

        <label>type d'ascenceur</label>
        <?= $this->Form->control('typ', ['label' => false, 'value' => $selectedOption['typ'], 'type' => 'text', 'required' => true]) ?>
        
        <label>type de revision</label>
        <?= $this->Form->control('typ_rev', ['label' => false, 'value' => $selectedOption['typ_rev'], 'type' => 'text', 'required' => true]) ?>

        <label>numéro d'ascenceur</label>
        <?= $this->Form->control('num_asc', ['label' => false, 'value' => $selectedOption['num_asc'], 'type' => 'number', 'required' => true]) ?>

        <div class="checkbox-container">
        <?php foreach ($roels as $rev): ?>
            <span>
            <?= $this->Form->control('roles[]', [
                'type' => 'checkbox',
                'value' => $rev['id'],
                'label' => false,
                'checked' => in_array($rev['id'], array_column($slctd, 'id_R'))
            ]) ?>
            <?= h($rev['name']  ) ?>
            </span>
        <?php endforeach; ?>
        </div>

        <?= $this->Form->submit('modifier', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('annuler',['controller' => 'revisionClient', 'action' => 'index'],['class' => "btt", 'title' => 'annuler']) ?>

    <?= $this->Form->end() ?>
    
    

</body>
<script>
    document.getElementById('idContract').addEventListener('change', function() {
        const selectedOption = this.selectedOptions[0];
        if (selectedOption) {
            const text = selectedOption.textContent;
            document.getElementById('gouv').value = text.substr(text.indexOf('_') + 1).trim();
        }
    });
</script>
</html>