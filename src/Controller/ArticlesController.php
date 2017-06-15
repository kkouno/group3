<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

// use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

class ArticlesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index','view']);
    }

    public function index()
    {
        $this->set('articles', $this->Articles->find('all')-> contain(['Comments']));
    }

    public function view($id = null)
    {
        if(!$id){
            throw new NotFoundException(__('Invalid article'));
        }
        //コメント機能追加のため書き換え
        //$article = $this->Articles->get($id);
        $article = $this ->Articles -> find('all')-> contain(['Comments'])
        ->where(['id'=>$id])->first();

        $this->set(compact('article'));

        // $this ->loadModel('Comments');//Modelの中にあるCommentsにアクセス
        // $comment_entity = $this ->Comments ->newEntity($this ->request ->data);//＄comment_entityをnewEntityに継承
        // $this ->set('comment_entity', $comment_entity);
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        // if ($this->request->is('post')) {
        //     $article = $this->Articles->patchEntity($article, $this->request->getData());
        //     if ($this->Articles->save($article)) {
        //         $this->Flash->success(__('Your article has been saved.'));
        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('Unable to add your article.'));
        // }
        $this->set('article', $article);

        // 記事のカテゴリを１つ選択するためにカテゴリの一覧を追加
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }
    public function confirm()
    {
        $article = $this->Articles->newEntity();

        if ($this->request->is('post') and $this->referer() == Router::url(null,true)) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));

                return $this->redirect(['action' => 'view/'.$article->id]);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);

        // 記事のカテゴリを１つ選択するためにカテゴリの一覧を追加
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }
    public function edit($id = null)
    {
        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('article', $article);
    }
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    // //コメントの削除
    // public function commentDelete($comment_id)
    // {
    //     $this->request->allowMethod(['post', 'commentDelete']);
    //     $comment = $this->Articles->comments->get($comment_id);
    //     if($this->Articles->comments->delete($comment)){
    //         $this->Flash->success(__('The comment with id: {0} has been deleted.', h($comment_id)));
    //         return $this->redirect(['action' => 'view/'.$comment->article_id]);
    //     }
    // }
    //
    // //コメントの機能の追加
    // public function comment(){
    //     $this->loadModel('Comments');
    //     $comment = $this ->Comments ->newEntity($this ->request ->data);
    //     if($this ->request ->is('post')){
    //         if($this->Comments->save($comment)) {
    //             $this->Flash->success(__('Your comment has been saved.'));
    //             //return $this->redirect(['action' => 'index']);
    //         }else{
    //             $this->Flash->error(__('Unable to add your comment.'));
    //         }
    //     }
    //         return $this ->redirect('/articles/view/' .$this ->request ->data['article_id']);
    // }

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
