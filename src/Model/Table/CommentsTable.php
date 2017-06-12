<?php
//コメントのテーブル
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table{
    public function initialize(array $config){
        $this -> addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
    $validator
        -> notEmpty('name')
        -> notEmpty('body')
        -> notEmpty('password');
    return $validator;
    }
}
?>
