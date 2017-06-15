<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Article</h1>
<?php
    echo $this->Form->create($comment);
    echo $this->Form->control('name');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Comments'));
    echo $this->Form->end();
?>
<?= $this->Form->create() ?>
<?= $this->Form->button('Return', ['onclick' => 'history.back()', 'type' => 'button']) ?>
<?= $this->Form->end() ?>
