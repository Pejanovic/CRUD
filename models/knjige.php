<?php 
namespace app\models;
use yii\db\ActiveRecord;

class knjige extends ActiveRecord
{
private $naziv;
private $autor;
private $datum;

public function rules(){
    return [
[['naziv','autor','datum'], 'required']
    ];
}
}

?>