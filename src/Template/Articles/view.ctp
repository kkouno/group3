<!-- File: src/Template/Articles/view.ctp -->

<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created at: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><small>modified at: <?= $article->modified->format(DATE_RFC850) ?></small></p>

<h1>Comment</h1>
<?php
//コメントの新規追加 と　コメントの表示
    echo $this ->Form ->create($comment_entity, ['url'=>'/articles/comment']);
    echo $this ->Form ->input('name');
    echo $this ->Form ->input('body', ['rows'=>'3']);
    echo $this ->Form ->input('password');
    echo $this ->Form ->button(__('Save Comment'));
    echo $this ->Form ->hidden('article_id', array('value'=>$article ->id));
    echo $this ->Form ->end();
 ?>
 <?= $this->Form->create() ?>
 <?= $this->Form->button('Return', ['onclick' => 'history.back()', 'type' => 'button']) ?>
 <?= $this->Form->end() ?>
<table>
 <tr>
 <th>名前</th>
 <th>コメント</th>
 <th>日付</th>
 </tr>
 <?php foreach ($article->comments as $comment): ?>
 <tr>
 <td><?php echo $comment->name; ?>
</td>
 <td><?= $comment->body ?></td>
 <td><?= $comment->created->format(DATE_RFC850) ?></td>
 </tr>
 <?php endforeach; ?>
</table>
