<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Sic4categories Controller
 *
 * @property \App\Model\Table\Sic4categoriesTable $Sic4categories
 *
 * @method \App\Model\Entity\Sic4category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sic4categoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "sic4cats");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'edit']
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
        // $sic2categories = $this->paginate($this->table('Sic2categories'));

        $sic4categories = $this->table('Sic4categories')->find()->contain(['Sic2categories', 'Sic8categories'])->toArray();
        $this->set(compact('sic4categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Sic4category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $sic4category = $this->table('Sic4categories')->get($id, [
    //         'contain' => ['Filters', 'Sic2categories', 'Sic8categories', 'Businesses', 'SearchKeywords'],
    //     ]);

    //     $this->set('sic4category', $sic4category);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sic4category = $this->table('Sic4categories')->newEmptyEntity();
        if ($this->request->is('post')) {
            $sic4category = $this->table('Sic4categories')->patchEntity($sic4category, $this->request->getData());
            if ($this->table('Sic4categories')->save($sic4category)) {
                $this->Flash->success(__('The sic4category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sic4category could not be saved. Please, try again.'));
        }
        $filters = $this->table('Sic4categories')->Filters->find('list', ['limit' => 200]);
        $sic2categories = $this->table('Sic4categories')->Sic2categories->find('list', ['limit' => 200]);
        $sic8categories = $this->table('Sic4categories')->Sic8categories->find('list', ['limit' => 200]);
        $this->set(compact('sic4category', 'filters', 'sic2categories', 'sic8categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sic4category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sic4category = $this->table('Sic4categories')->get($id, [
            'contain' => ['Filters', 'Sic2categories', 'Sic8categories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sic4category = $this->table('Sic4categories')->patchEntity($sic4category, $this->request->getData());
            if ($this->table('Sic4categories')->save($sic4category)) {
                $this->Flash->success(__('The sic4category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sic4category could not be saved. Please, try again.'));
        }
        $filters = $this->table('Sic4categories')->Filters->find('list', ['limit' => 2000]);
        $sic2categories = $this->table('Sic4categories')->Sic2categories->find('list', ['limit' => 2000]);
        $sic8categories = $this->table('Sic4categories')->Sic8categories->find('list', ['limit' => 2000]);
        $this->set(compact('sic4category', 'filters', 'sic2categories', 'sic8categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sic4category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->default(__('Deleted is disabled'));
        return $this->redirect($this->referer());
        $this->request->allowMethod(['post', 'delete']);
        $sic4category = $this->table('Sic4categories')->get($id);
        if ($this->table('Sic4categories')->delete($sic4category)) {
            $this->Flash->success(__('The sic4category has been deleted.'));
        } else {
            $this->Flash->error(__('The sic4category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
