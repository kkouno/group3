<!-- File: src/Template/Articles/add.ctp -->

<h1>Confirm Article</h1>
<?php use Cake\I18n\Time;?>
<h1><?= h($this->request->getData('title')) ?></h1>
<p><?= h($this->request->getData('body')) ?></p>
<?php $now = Time::parse('1111-11-11'); ?>
<p><small>Created at: <?= $now->format(DATE_RFC850) ?></small></p>
<p><small>modified at: <?= $now->format(DATE_RFC850) ?></small></p>
<?php
    echo $this->Form->create($article);
    // ここにカテゴリのコントロールを追加
    // echo $this->Form->control('user_id');
    echo $this->Form->hidden('title');
    echo $this->Form->hidden('body');
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>
<?= $this->Form->create() ?>
<?= $this->Form->button('Return', ['onclick' => 'history.back()', 'type' => 'button']) ?>
<?= $this->Form->end() ?>
