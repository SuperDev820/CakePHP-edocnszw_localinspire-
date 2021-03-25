<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 *
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubcategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "subcategories");
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
        // $this->paginate = [
        //     'contain' => ['Categories'],
        // ];
        // $subcategories = $this->paginate($this->table('Subcategories'));
        $subcategories = $this->table('Subcategories')->find()->toArray();


        $this->set(compact('subcategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $subcategory = $this->table('Subcategories')->get($id, [
    //         'contain' => ['Categories', 'Sic4categories', 'Businesses', 'Filters', 'Titles'],
    //     ]);

    //     $this->set('subcategory', $subcategory);
    // }

    public function fix()
    {
        $subcategories = $this->table('Subcategories')->find()->contain(['Categories'])->toArray();
        foreach ($subcategories as $key => $subcat) {
            if (!empty($subcat->category)) {
                // $sic4category = $this->table('Sic4categories')->find()->where(['name LIKE' => "%" .  $subcat->category->name . "%"])->first()
                $sic4category = $this->table('Sic4categories')->find()->where(['name' => $subcat->category->name])->first();
                // dd($sic4category);
                if (!empty($sic4category)) {
                    $subcat->sic4category_id = $sic4category->id;
                    if ($this->table('Subcategories')->save($subcat)) {
                    }
                }
            }
        }
        // dd($subcategories);
        $this->Flash->success(__('All done'));

        return $this->redirect(['action' => 'index']);
    }
    public function fix2()
    {
        $this->loadModel('FiltersSic4categories');
        $filters = $this->table('Filters')->find()->contain(['Categories'])->toArray();
        foreach ($filters as $key => $filter) {
            if (!empty($filter->category)) {
                $sic4category = $this->table('Sic4categories')->find()->where(['name' => $filter->category->name])->first();
                if (!empty($sic4category)) {
                    $rel = $this->table('Filters')Sic4categories->find()
                        ->where(['filter_id' => $filter->id, 'sic4category_id' => $sic4category->id])->first();
                    if (empty($rel)) {
                        $rel = $this->table('Filters')Sic4categories->newEmptyEntity();
                        $rel->sic4category_id = $sic4category->id;
                        $rel->filter_id = $filter->id;
                        if ($this->table('Filters')Sic4categories->save($rel)) {
                        }
                    }
                }
            }
        }
        // dd($subcategories);
        $this->Flash->success(__('All done'));

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subcategory = $this->table('Subcategories')->newEmptyEntity();
        if ($this->request->is('post')) {
            $subcategory = $this->table('Subcategories')->patchEntity($subcategory, $this->request->getData());
            if ($this->table('Subcategories')->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }
        $categories = $this->table('Subcategories')->Categories->find('list', ['limit' => 200]);
        $sic4categories = $this->table('Subcategories')->Sic4categories->find('list', ['limit' => 200]);
        $businesses = $this->table('Subcategories')->Businesses->find('list', ['limit' => 200]);
        $filters = $this->table('Subcategories')->Filters->find('list', ['limit' => 200]);
        $titles = $this->table('Subcategories')->Titles->find('list', ['limit' => 200]);
        $this->set(compact('subcategory', 'categories', 'sic4categories', 'businesses', 'filters', 'titles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subcategory = $this->table('Subcategories')->get($id, [
            'contain' => ['Businesses', 'Filters', 'Titles'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subcategory = $this->table('Subcategories')->patchEntity($subcategory, $this->request->getData());
            if ($this->table('Subcategories')->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }
        $categories = $this->table('Subcategories')->Categories->find('list', ['limit' => 2000]);
        $sic4categories = $this->table('Subcategories')->Sic4categories->find('list', ['limit' => 2000]);
        $businesses = $this->table('Subcategories')->Businesses->find('list', ['limit' => 2000]);
        $filters = $this->table('Subcategories')->Filters->find('list', ['limit' => 2000]);
        $titles = $this->table('Subcategories')->Titles->find('list', ['limit' => 2000]);
        $this->set(compact('subcategory', 'categories', 'sic4categories', 'businesses', 'filters', 'titles'));
    }



    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->table('Subcategories')->get($id);
        if ($this->table('Subcategories')->delete($subcategory)) {
            $this->Flash->success(__('The subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
