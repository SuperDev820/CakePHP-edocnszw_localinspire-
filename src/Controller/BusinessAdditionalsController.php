<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * BusinessAdditionals Controller
 *
 * @property \App\Model\Table\BusinessAdditionalsTable $BusinessAdditionals
 *
 * @method \App\Model\Entity\BusinessAdditional[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BusinessAdditionalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Filters', 'Businesses']
        ];
        $businessAdditionals = $this->paginate($this->table('BusinessAdditionals'));

        $this->set(compact('businessAdditionals'));
    }

    /**
     * View method
     *
     * @param string|null $id Business Additional id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $businessAdditional = $this->table('BusinessAdditionals')->get($id, [
            'contain' => ['Filters', 'Businesses']
        ]);

        $this->set('businessAdditional', $businessAdditional);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $businessAdditional = $this->table('BusinessAdditionals')->newEmptyEntity();
        if ($this->request->is('post')) {
            $businessAdditional = $this->table('BusinessAdditionals')->patchEntity($businessAdditional, $this->request->getData());
            if ($this->table('BusinessAdditionals')->save($businessAdditional)) {
                $this->Flash->success(__('The business additional has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business additional could not be saved. Please, try again.'));
        }
        $filters = $this->table('BusinessAdditionals')->Filters->find('list', ['limit' => 200]);
        $businesses = $this->table('BusinessAdditionals')->Businesses->find('list', ['limit' => 200]);
        $this->set(compact('businessAdditional', 'filters', 'businesses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Business Additional id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $businessAdditional = $this->table('BusinessAdditionals')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $businessAdditional = $this->table('BusinessAdditionals')->patchEntity($businessAdditional, $this->request->getData());
            if ($this->table('BusinessAdditionals')->save($businessAdditional)) {
                $this->Flash->success(__('The business additional has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business additional could not be saved. Please, try again.'));
        }
        $filters = $this->table('BusinessAdditionals')->Filters->find('list', ['limit' => 200]);
        $businesses = $this->table('BusinessAdditionals')->Businesses->find('list', ['limit' => 200]);
        $this->set(compact('businessAdditional', 'filters', 'businesses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Business Additional id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $businessAdditional = $this->table('BusinessAdditionals')->get($id);
        if ($this->table('BusinessAdditionals')->delete($businessAdditional)) {
            $this->Flash->success(__('The business additional has been deleted.'));
        } else {
            $this->Flash->error(__('The business additional could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
