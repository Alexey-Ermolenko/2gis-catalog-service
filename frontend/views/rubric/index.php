<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Rubric;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Rubric */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Rubrics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'options'   => ['width' => '70px'],
            ],
            'name',
            [
                'attribute' => 'tree',
                'label'     => 'Root',
                'filter'    => Rubric::find()->roots()->select('name, id')->indexBy('id')->column(),
                'value'     => function ($model) {
                    if (!$model->isRoot())
                        return $model->parents()->one()->name;

                    return 'No Parent';
                },
            ],
            'parent.name',
            // 'lft',
            // 'rgt',
            // 'depth',
            'position',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {link}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>