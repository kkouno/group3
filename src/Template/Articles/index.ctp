<!-- File: src/Template/Articles/index.ctp (delete links added) -->

<!-- <h1>Blog articles</h1> -->

<?php $login = $this->request->session()->read('Auth.User.id');?> <!--ログイン状態-->
<p>
    <?php if(!$login):?>
        <?= $this->Html->link("Login", ['action' => '../login']) ?>
    <?php endif?>
    <?php if($login):?>
        <?= $this->Html->link("Logout", ['action' => '../logout']) ?>
    <?php endif?>
</p>
<p>
    <?php if($login):?>
        <?= $this->Html->image("add.png", ['url'=>['action' => 'add']]) ?>
    <?php endif?>
</p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <!-- <th>Modified</th> -->
        <th> </th>
    </tr>

    <!-- ここから、$articles のクエリオブジェクトをループして、投稿記事の情報を表示 -->
    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
            <?= $article->created->format('Y/m/d H:i:s') ?>
        </td>
        <td>
            <?= "(+".count($article->comments).")"?>
        </td>

        <td>
            <!-- ログインしていたら表示 -->
            <?php if($login):?>
                <?= $this->Html->link($this->Html->image('edit.png'), ['action' => 'edit', $article->id],['escape' => false]) ?>
                <?=
                    $this->Form->postLink(
                    $this->Html->image('delete.png'),
                    ['action' => 'delete', $article->id],
                    ['confirm' => 'Are you sure?','escape' => false]
                    )
                ?>
            <?php endif?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
