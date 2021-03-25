<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Sic8categories Controller
 *
 * @property \App\Model\Table\Sic8categoriesTable $Sic8categories
 *
 * @method \App\Model\Entity\Sic8category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Sic8categoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "sic8cats");
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

        $sic8categories = $this->table('Sic8categories')->find()->contain(['Sic4categories'])->toArray();
        $this->set(compact('sic8categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Sic8category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $sic8category = $this->table('Sic8categories')->get($id, [
    //         'contain' => ['Filters', 'Sic4categories', 'Businesses'],
    //     ]);

    //     $this->set('sic8category', $sic8category);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sic8category = $this->table('Sic8categories')->newEmptyEntity();
        if ($this->request->is('post')) {
            $sic8category = $this->table('Sic8categories')->patchEntity($sic8category, $this->request->getData());
            if ($this->table('Sic8categories')->save($sic8category)) {
                $this->Flash->success(__('The sic8category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sic8category could not be saved. Please, try again.'));
        }
        $filters = $this->table('Sic8categories')->Filters->find('list', ['limit' => 200]);
        $sic4categories = $this->table('Sic8categories')->Sic4categories->find('list', ['limit' => 200]);
        $this->set(compact('sic8category', 'filters', 'sic4categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sic8category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sic8category = $this->table('Sic8categories')->get($id, [
            'contain' => ['Filters', 'Sic4categories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sic8category = $this->table('Sic8categories')->patchEntity($sic8category, $this->request->getData());
            if ($this->table('Sic8categories')->save($sic8category)) {
                $this->Flash->success(__('The sic8category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sic8category could not be saved. Please, try again.'));
        }
        $filters = $this->table('Sic8categories')->Filters->find('list', ['limit' => 2000]);
        $sic4categories = $this->table('Sic8categories')->Sic4categories->find('list', ['limit' => 2000]);
        $this->set(compact('sic8category', 'filters', 'sic4categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sic8category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->default(__('Deleted is disabled'));
        return $this->redirect($this->referer());
        $this->request->allowMethod(['post', 'delete']);
        $sic8category = $this->table('Sic8categories')->get($id);
        if ($this->table('Sic8categories')->delete($sic8category)) {
            $this->Flash->success(__('The sic8category has been deleted.'));
        } else {
            $this->Flash->error(__('The sic8category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
