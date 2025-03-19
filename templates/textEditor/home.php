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
<?= $this->Form->create(null, ['url' => ['controller' => 'textEditor', 'action' => 'add'],'type' => 'post']) ?> 
        
        <?= $this->Form->control('soc', [
            'type' => 'select',
            'label' => 'Nom du société',
            'options' => $soci, 
            'empty' => 'Selectionner le nom du société',
            'class' => 'form-control',
            'id' => 'societe'
        ]) ?>
        
        <?= $this->Form->control('loc', [
            'type' => 'select',
            'label' => 'Localisation',
            'options' => [], 
            'empty' => '--- --- --- --- --- --- --- ---',
            'class' => 'form-control',
            'id' => 'installation'
        ]) ?>
        
        <label>Gouvernorat</label>
        <?= $this->Form->control('gouv', ['label' => false, 'type' => 'text', 'required' => true, 'id' => 'gouv']) ?>
        
        <label>Poids d'ascenseur</label>
        <?= $this->Form->control('poids', ['label' => false, 'type' => 'number', 'required' => true]) ?>
        
        <?= $this->Form->control('content', [
            'type' => 'select',
            'label' => 'modelle du contrat',
            'options' => $mod, 
            'empty' => 'Selectionner le modelle du contrat',
            'class' => 'form-control',
            'id' => 'contract'
        ]) ?>
        
        <?= $this->Form->submit('ajouter', ['style' => 'margin-top: 25px;']) ?>
        <?= $this->html->link('annuler',['controller' => 'textEditor', 'action' => 'index'],['class' => "btt", 'title' => 'annuler']) ?>

    <?= $this->Form->end() ?>
    
    <script>
    document.getElementById('societe').addEventListener('change', function() {
        const selectedMatFisc = this.value;
        const installationSelect = document.getElementById('installation');
        installationSelect.innerHTML = '<option value="">--- --- --- --- --- --- ---</option>';
        if (selectedMatFisc) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= $this->Url->build(['controller' => 'textEditor', 'action' => 'getInstallations']) ?>?mat_fisc=' + selectedMatFisc, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const installations = JSON.parse(xhr.responseText);
                    for (const [key, value] of Object.entries(installations)) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = value;
                        option.name= 'installation';
                        installationSelect.appendChild(option);
                    }
                } else {
                    console.error('Failed to fetch installations');
                }
            };
            xhr.send();
        }
    });
    document.getElementById('installation').addEventListener('change', function() {
        const selectedOption = this.selectedOptions[0];
        if (selectedOption) {
            const text = selectedOption.textContent;
            document.getElementById('gouv').value = text.substr(text.indexOf('-') + 1).trim();
        }
    });
</script>
</body>
</html>