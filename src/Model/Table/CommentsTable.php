<?php
//コメントのテーブル
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

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

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                //$data[$key] = trim($value);
                $data[$key] = preg_replace('/^[ 　]+/u', '', $value);
            }
        }
    }
}
?>
