<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

// use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

class CommentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index','view']);
    }

    //コメントの削除
    public function delete($comment_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        //$comment = $this->Articles->comments->get($comment_id);
        $comment = $this->Comments->get($comment_id);
        if($this->Comments->delete($comment)){
            $this->Flash->success(__('The comment with id: {0} has been deleted.', h($comment_id)));
            return $this->redirect(['controller' => 'articles','action' => 'view',$comment->article_id]);
        }
    }

    //コメントの機能の追加
    public function add(){
        $comment = $this ->Comments ->newEntity($this ->request ->data);
        if($this ->request ->is('post')){
            if($this->Comments->save($comment)) {
                $this->Flash->success(__('YOUR comment has been saved.'));
                //return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('UNABLE to add your comment.'));
            }
        }
            return $this ->redirect('/articles/view/' .$comment->article_id);

    }
    //コメントの編集
    public function edit($id = null)
    {
        //$this->loadModel('Comments');
        $comment = $this->Comments->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Your comment has been updated.'));
                return $this->redirect(['controller'=>'articles','action' => 'view',$comment->article_id]);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('comment', $comment);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

    // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'view','comment'])) {
            return true;
        }
    // All other actions require an id.
        if (!$this->request->getParam('pass.0')) {
            return false;
        }

    // Check that the bookmark belongs to the current user.
        $id = $this->request->getParam('pass.0');
        $article = $this->Articles->get($id);
        if ($article->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}
?>
