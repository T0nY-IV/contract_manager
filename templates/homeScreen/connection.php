<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LOGIN</h1>
    <?= $this->Form->create(null,['url'=>['controller' => 'homeScreen', 'action'=>'verify'],'type'=>'post']) ?>
        <label>Nom d'utilisateur</label>
        <?= $this->Form->control('username',['label' => false, 'type' => 'text', 'required' => true]) ?>
        <label>Mot de passe</label>
        <?= $this->Form->control('password',['label' => false, 'type' => 'password', 'required' => true]) ?>
        <?= $this->Form->submit('connecter', ['style' => 'margin-top: 25px;']) ?>
    <?= $this->Form->end ?>
</body>
</html>