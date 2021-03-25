<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * SearchKeywords Controller
 *
 * @property \App\Model\Table\SearchKeywordsTable $SearchKeywords
 *
 * @method \App\Model\Entity\SearchKeyword[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SearchKeywordsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "keywords");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'toggleStatus']
        //     );
        // }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $searchKeywords = $this->paginate($this->table('SearchKeywords'));
        $searchKeywords = $this->table('SearchKeywords')->find()->contain(['Sic4categories'])
            ->leftJoinWith('Sic4categories')->toArray();
        $this->set(compact('searchKeywords'));
    }

    /**
     * View method
     *
     * @param string|null $id Search Keyword id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $searchKeyword = $this->table('SearchKeywords')->get($id, [
            'contain' => ['Sic4categories', 'Filters'],
        ]);

        $this->set('searchKeyword', $searchKeyword);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $searchKeyword = $this->table('SearchKeywords')->newEmptyEntity();
        if ($this->request->is('post')) {
            $searchKeyword = $this->table('SearchKeywords')->patchEntity($searchKeyword, $this->request->getData());
            if ($this->table('SearchKeywords')->save($searchKeyword)) {
                $this->Flash->success(__('The search keyword has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The search keyword could not be saved. Please, try again.'));
        }
        $sic4categories = $this->table('SearchKeywords')->Sic4categories->find('list', ['limit' => 200]);
        $this->set(compact('searchKeyword', 'sic4categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Search Keyword id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $searchKeyword = $this->table('SearchKeywords')->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $searchKeyword = $this->table('SearchKeywords')->patchEntity($searchKeyword, $this->request->getData());
            if ($this->table('SearchKeywords')->save($searchKeyword)) {
                $this->Flash->success(__('The search keyword has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The search keyword could not be saved. Please, try again.'));
        }
        $sic4categories = $this->table('SearchKeywords')->Sic4categories->find('list', ['limit' => 200]);
        $this->set(compact('searchKeyword', 'sic4categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Search Keyword id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $searchKeyword = $this->table('SearchKeywords')->get($id);
        if ($this->table('SearchKeywords')->delete($searchKeyword)) {
            $this->Flash->success(__('The search keyword has been deleted.'));
        } else {
            $this->Flash->error(__('The search keyword could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
