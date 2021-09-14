
<?php
use yii\helpers\html;
$this->title = 'My Yii Application';
?>
<div class="site-index">
<?php if(yii::$app->session->hasFlash('message')):?>
    <?php echo yii::$app->session->getFlash('message');?>
<?php endif; ?>
    <div class="jumbotron text-center bg-transparent">
        <h1 >CRUD APPLICATION - BOOKS</h1>
    </div>
<div class="row">
<span style="margin:5px;"><?= Html::a('Create', ['/site/create'], ['class' => 'btn btn-primary']) ?></span>
</div>
    <div class="body-content">

        <div class="row">
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Naziv knjige</th>
      <th scope="col">Pisac knjige</th>
      <th scope="col">Godina izdanja</th>
      <th scope="col">Poziv</th>
    </tr>
  </thead>
  <tbody>
      <?php if(count($knjige)> 0):?>
        <?php foreach($knjige as $knjiga): ?>
    <tr class="table-active">
      <th scope="row"><?php echo $knjiga->id; ?></th>
      <td><?php echo $knjiga->naziv; ?></td>
      <td><?php echo $knjiga->autor; ?></td>
      <td><?php echo $knjiga->datum; ?></td>
      <td><span><?= Html::a('Update',['update', 'id' => $knjiga->id],['class' => 'btn btn-primary'])?></span>
      <span><?= Html::a('Delete', ['delete', 'id' => $knjiga->id],['class' => 'btn btn-primary'])?></span>
    </td>
    </tr>
    <?php  endforeach; ?>
 <?php  else: ?>
<tr>
    <td>Ne postoji!</td>
</tr>
<?php  endif; ?>
  </tbody>
</table>
        </div>

    </div>
</div>
