<!-- File: src/Template/Articles/view.ctp -->

<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created at: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><small>modified at: <?= $article->modified->format(DATE_RFC850) ?></small></p>

<h1>Comment</h1>
<?php
//コメントの新規追加 と　コメントの表示
    //echo $this ->Form ->create($comment_entity, ['url'=>'/articles/comment']);
    echo $this ->Form ->create(null, ['url'=>['controller'=>'comments','action'=>'add']]);
    //echo $this ->Form ->create($comment_entity, ['url'=>['controller'=>'comments','action'=>'add']]);
    echo $this ->Form ->input('name');
    echo $this ->Form ->input('body', ['rows'=>'3']);
    echo $this ->Form ->input('password');
    echo $this ->Form ->button(__('Save Comment'));
    echo $this ->Form ->hidden('article_id', array('value'=>$article ->id));
    echo $this ->Form ->end();
 ?>
 <?= $this->Form->create(null,['url'=>['action' => 'index']]) ?>
 <?= $this->Form->button('Return') ?>
 <?= $this->Form->end() ?>
<table>
 <tr>
 <th>名前</th>
 <th>コメント</th>
 <th>日付</th>
 <th></th>
 </tr>
 <?php foreach ($article->comments as $comment): ?>
 <tr>
 <td><?php echo $comment->name; ?>
</td>
 <td><?= $comment->body ?></td>
 <td><?= $comment->created->format(DATE_RFC850) ?></td>
 <td>
     <?=
        $this->Form->postLink(
        'Delete',
        //['action' => 'delete', $comment->id],
        ['controller'=>'comments','action'=>'delete',$comment->id],
        //['onClick' => 'dialog()'],
        ['confirm' => 'Are you sure?'])
     ?>
     <?= $this->Html->link('Edit', ['controller'=>'comments','action' => 'edit', $comment->id]) ?>
     <!-- <button type="submit" name="action" value="test" onClick="dialog()">Delete</button> -->
 </td>
 </tr>
 <?php endforeach; ?>
</table>

<script type="text/javascript">
    function dialog(){
        var pass=prompt("Enter your password.", "");
    }
</script>
