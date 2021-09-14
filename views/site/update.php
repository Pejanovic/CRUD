<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1 >Create Post</h1>
    <div class="body-content">
<?php 
$form = ActiveForm::begin()
?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-12">
        <?= $form->field($knjiga, 'naziv');?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-12">
        <?= $form->field($knjiga, 'autor');?>
                </div>
            </div>
        </div>
                <div class="row">
            <div class="form-group">
                <div class="col-lg-12">
        <?= $form->field($knjiga, 'datum')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-12">
                <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary']);?>
                </div>
                <div class="col-lg-12">
               <a href= <?php echo yii::$app->homeUrl;?> class="btn btn-primary">Vrati se nazad</a>
                </div>
            </div>
        </div>
<?php ActiveForm::end() ?>
    </div>
</div>