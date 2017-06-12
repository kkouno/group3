<!-- File: src/Template/Articles/add.ctp -->

<h1>Add Article</h1>
<?php
    echo $this->Form->create($article,["url"=>["action" => "confirm"]]);
    //echo $this->Form->create($article);
    // ここにカテゴリのコントロールを追加
    // echo $this->Form->control('user_id');
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    // echo $this->Form->button(__('Save Article'));
    echo $this->Form->button('confirm');
    echo $this->Form->end();
?>
<?= $this->Form->create() ?>
<?= $this->Form->button('Return', ['onclick' => 'history.back()', 'type' => 'button']) ?>
<?= $this->Form->end() ?>
