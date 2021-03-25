<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Filters Controller
 *
 * @property \App\Model\Table\FiltersTable $Filters
 *
 * @method \App\Model\Entity\Filter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FiltersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "filters");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'toggleStatus', 'edit']
        //     );
        // }

        $subcategory = $this->table('Subcategories')->newEmptyEntity();
        $this->set('subcategory', $subcategory);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['SearchKeywords', 'Categories', 'FormTypes'],
        // ];
        // $filters = $this->paginate($this->table('Filters'));

        // $this->set(compact('filters'));
    }

    /**
     * View method
     *
     * @param string|null $id Filter id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $filter = $this->table('Filters')->get($id, [
            'contain' => ['SearchKeywords', 'Categories', 'FormTypes', 'Sic2categories', 'Sic4categories', 'Sic8categories', 'Subcategories', 'BusinessAdditionals'],
        ]);

        $this->set('filter', $filter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $filter = $this->table('Filters')->newEmptyEntity();
        if ($this->request->is('post')) {
            $filter = $this->table('Filters')->patchEntity($filter, $this->request->getData());
            if ($this->table('Filters')->save($filter)) {
                $this->Flash->success(__('The filter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The filter could not be saved. Please, try again.'));
        }
        $searchKeywords = $this->table('Filters')->SearchKeywords->find('list', ['limit' => 200]);
        $categories = $this->table('Filters')->Categories->find('list', ['limit' => 200]);
        $formTypes = $this->table('Filters')->FormTypes->find('list', ['limit' => 200]);
        $sic2categories = $this->table('Filters')->Sic2categories->find('list', ['limit' => 200]);
        $sic4categories = $this->table('Filters')->Sic4categories->find('list', ['limit' => 200]);
        $sic8categories = $this->table('Filters')->Sic8categories->find('list', ['limit' => 200]);
        $subcategories = $this->table('Filters')->Subcategories->find('list', ['limit' => 2000]);
        $this->set(compact('filter', 'searchKeywords', 'categories', 'formTypes', 'sic2categories', 'sic4categories', 'sic8categories', 'subcategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Filter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $filter = $this->table('Filters')->get($id, [
            'contain' => ['Sic2categories', 'Sic4categories', 'Sic8categories', 'Subcategories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $filter = $this->table('Filters')->patchEntity($filter, $this->request->getData());
            if ($this->table('Filters')->save($filter)) {
                $this->Flash->success(__('The filter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The filter could not be saved. Please, try again.'));
        }
        $searchKeywords = $this->table('Filters')->SearchKeywords->find('list', ['limit' => 200]);
        $categories = $this->table('Filters')->Categories->find('list', ['limit' => 200]);
        $formTypes = $this->table('Filters')->FormTypes->find('list', ['limit' => 200]);
        $sic2categories = $this->table('Filters')->Sic2categories->find('list', ['limit' => 200]);
        $sic4categories = $this->table('Filters')->Sic4categories->find('list', ['limit' => 200]);
        $sic8categories = $this->table('Filters')->Sic8categories->find('list', ['limit' => 200]);
        $subcategories = $this->table('Filters')->Subcategories->find('list', ['limit' => 2000]);
        $this->set(compact('filter', 'searchKeywords', 'categories', 'formTypes', 'sic2categories', 'sic4categories', 'sic8categories', 'subcategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Filter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $filter = $this->table('Filters')->get($id);
        if ($this->table('Filters')->delete($filter)) {
            $this->Flash->success(__('The filter has been deleted.'));
        } else {
            $this->Flash->error(__('The filter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
