<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>

<div class="login-box" xmlns="http://www.w3.org/1999/html">
    <div class="header">

    </div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple']) ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton('Войти', [
                'class' => 'btn btn-primary btn-flat btn-block',
                'name' => 'login-button'
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>

<script>
    var subttitleanim=function(){
        $("#animquest").delay(10).addClass("in").fadeOut();
        $("#animquest").delay(20).addClass("in").fadeIn();
        $("#clickme").delay(10).addClass("in").fadeOut();
        $("#clickme").delay(10).addClass("in").fadeIn();
        setTimeout(arguments.callee,1000);
    };
    setTimeout( subttitleanim,1000 );
</script>
