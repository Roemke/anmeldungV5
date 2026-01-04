<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org), modified by KaRo
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Online Anmeldung Glasfachschule
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake','admin']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class = "admin">
    <header class="main-header">
        <h1>Online Anmeldung &ndash; Glasfachschule</h1>
        <?=  $this->Html->image('230905_Wort-Bild-Marke_GFS_invertiert.png',
            ['alt' => 'Logo Glasfachschule NRW',]) ?>

    </header>
    <header class="admin-header">
        <nav class="admin-nav">
            <ul class="admin-menu">
                <li><?= $this->Html->link('Anträge', ['controller' => 'Antrags', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Schulformen', ['controller' => 'Schulforms', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Konfessionen', ['controller' => 'Konfessions', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Staatsangehörigkeiten', ['controller' => 'Staats', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Letzte Schulformen', ['controller' => 'LastSchulForms', 'action' => 'index']) ?></li>
            </ul>

            <div class="admin-user">
                <?= $this->Form->postLink(
                    'Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'logout-button']
                ) ?>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer class="site-footer">
       <div> © Karsten Römke, Glasfachschule NRW </div>
       <div>·</div>
        <a href="https://glasfachschule.de/impressum.html" target="_blank">Impressum</a>
        <p>·</p>
        <a href="https://glasfachschule.de/datenschutzerklaerung.html" target="_blank">Datenschutzerklärung</a>
        <p>·</p>
        <div>(Neuentwicklung 2025/26, CakePHP 5.x)</div>
    </footer>

</body>
</html>
