<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Sic2categories Controller
 *
 * @property \App\Model\Table\Sic2categoriesTable $Sic2categories
 *
 * @method \App\Model\Entity\Sic2category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sic2categoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "sic2cats");
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

        $sic2categories = $this->table('Sic2categories')->find()->contain(['Sic4categories'])->toArray();
        $this->set(compact('sic2categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Sic2category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $sic2category = $this->table('Sic2categories')->get($id, [
    //         'contain' => ['Filters', 'Sic4categories', 'Businesses'],
    //     ]);

    //     $this->set('sic2category', $sic2category);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $sic2category = $this->table('Sic2categories')->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $sic2category = $this->table('Sic2categories')->patchEntity($sic2category, $this->request->getData());
    //         if ($this->table('Sic2categories')->save($sic2category)) {
    //             $this->Flash->success(__('The sic2category has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The sic2category could not be saved. Please, try again.'));
    //     }
    //     $filters = $this->table('Sic2categories')->Filters->find('list', ['limit' => 200]);
    //     $sic4categories = $this->table('Sic2categories')->Sic4categories->find('list', ['limit' => 200]);
    //     $this->set(compact('sic2category', 'filters', 'sic4categories'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Sic2category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sic2category = $this->table('Sic2categories')->get($id, [
            'contain' => ['Filters', 'Sic4categories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sic2category = $this->table('Sic2categories')->patchEntity($sic2category, $this->request->getData());
            if ($this->table('Sic2categories')->save($sic2category)) {
                $this->Flash->success(__('The sic2category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sic2category could not be saved. Please, try again.'));
        }
        $filters = $this->table('Sic2categories')->Filters->find('list', ['limit' => 2000]);
        $sic4categories = $this->table('Sic2categories')->Sic4categories->find('list', ['limit' => 2000]);
        $this->set(compact('sic2category', 'filters', 'sic4categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sic2category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->default(__('Deleted is disabled'));
        return $this->redirect($this->referer());
        $this->request->allowMethod(['post', 'delete']);
        $sic2category = $this->table('Sic2categories')->get($id);
        if ($this->table('Sic2categories')->delete($sic2category)) {
            $this->Flash->success(__('The sic2category has been deleted.'));
        } else {
            $this->Flash->error(__('The sic2category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
