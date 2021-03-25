<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 *
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController
{
    public $helpers = ['CkEditor.Ck'];
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "packages");
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
        // $packages = $this->paginate($this->table('Packages'));
        $packages = $this->table('Packages')->find()->toArray();
        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $package = $this->table('Packages')->get($id, [
            'contain' => ['Subscriptions'],
        ]);

        $this->set('package', $package);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Flash->default(__('add is disabled'));
        return $this->redirect($this->referer());
        $package = $this->table('Packages')->newEmptyEntity();
        if ($this->request->is('post')) {
            $package = $this->table('Packages')->patchEntity($package, $this->request->getData());
            $package->price_per_year = $this->calculateYearlyPlan($package->price_per_month);
            if ($this->table('Packages')->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $package = $this->table('Packages')->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->table('Packages')->patchEntity($package, $this->request->getData());
            $package->price_per_year = $this->calculateYearlyPlan($package->price_per_month);
            if ($this->table('Packages')->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }



    public function calculateYearlyPlan($price)
    {
        $amount = 0;
        if (!empty($price)) {
            $yearly = ($price * 12);
            $ten_percent = ($yearly / 100) * 10;
            $amount = $yearly - $ten_percent;
        }
        return $amount;
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->Flash->default(__('Deleted is disabled'));
        return $this->redirect($this->referer());
        // $this->request->allowMethod(['post', 'delete']);
        // $package = $this->table('Packages')->get($id);
        // if ($this->table('Packages')->delete($package)) {
        //     $this->Flash->success(__('The package has been deleted.'));
        // } else {
        //     $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    }
}
