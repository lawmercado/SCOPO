<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$menu = [
    "Categoria" => Url::toRoute(['categoria/index']),
    "Produtos" => Url::toRoute(['produto/index']),
    "Produtor" => Url::toRoute(['produtor/index']),
];

$hotlinks = [
    "Produtos" => Url::toRoute(['produto/index']),
    "Produtor" => Url::toRoute(['produtor/index'])
];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" />
        
        <title><?= Html::encode(Yii::$app->name) ?></title>
        
        <?php $this->head() ?>
        
        <link rel="stylesheet" href="css/modules/base/main.css" type="text/css" />
    </head>
    <body>
    <?php $this->beginBody() ?>
        <header>
            <div class="menu-controller row-left">
                <h1><?= Html::encode(Yii::$app->name) ?></h1>
            </div>

            <div class="row-right">
                <?php foreach($hotlinks as $label => $link): ?>
                    <a href="<?= $link?>"><?= Html::encode($label) ?></a>
                <?php endforeach ?>
            </div>

            <nav class="menu">
                <ul>
                    <?php foreach($menu as $label => $link): ?>
                        <li><a href="<?= $link?>"><?= Html::encode($label) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </nav>
        </header>

        <section>
            <div>
                <div class="container">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>
                </div>
            </div>

        </section>
        
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                // Cria o handler para o menu
                document.querySelector(".menu-controller").addEventListener("click", function() {
                    this.classList.toggle("menu-controller-active");
                    this.parentElement.classList.toggle("menu-active");
                });
                
            });
        </script>
        
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
