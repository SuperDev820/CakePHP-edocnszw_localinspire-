<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CitySubscriptions Controller
 *
 * @property \App\Model\Table\CitySubscriptionsTable $CitySubscriptions
 *
 * @method \App\Model\Entity\CitySubscription[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitySubscriptionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "city_subscriptions");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'edit']
        //     );
        // }
    }
    public function index()
    {
    
    }

    /**
     * View method
     *
     * @param string|null $id City Subscription id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $citySubscription = $this->table('CitySubscriptions')->get($id, [
            'contain' => ['Users', 'Cities', 'Coupons'],
        ]);

        $this->set('citySubscription', $citySubscription);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $citySubscription = $this->table('CitySubscriptions')->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $citySubscription = $this->table('CitySubscriptions')->patchEntity($citySubscription, $this->request->getData());
    //         if ($this->table('CitySubscriptions')->save($citySubscription)) {
    //             $this->Flash->success(__('The city subscription has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The city subscription could not be saved. Please, try again.'));
    //     }
    //     $users = $this->table('CitySubscriptions')->Users->find('list', ['limit' => 200]);
    //     $cities = $this->table('CitySubscriptions')->Cities->find('list', ['limit' => 200]);
    //     $coupons = $this->table('CitySubscriptions')->Coupons->find('list', ['limit' => 200]);
    //     $this->set(compact('citySubscription', 'users', 'cities', 'coupons'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id City Subscription id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $citySubscription = $this->table('CitySubscriptions')->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $citySubscription = $this->table('CitySubscriptions')->patchEntity($citySubscription, $this->request->getData());
            if ($this->table('CitySubscriptions')->save($citySubscription)) {
                $this->Flash->success(__('The city subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city subscription could not be saved. Please, try again.'));
        }
        $users = $this->table('CitySubscriptions')->Users->find('list', ['limit' => 200]);
        $cities = $this->table('CitySubscriptions')->Cities->find('list', ['limit' => 200]);
        $coupons = $this->table('CitySubscriptions')->Coupons->find('list', ['limit' => 200]);
        $this->set(compact('citySubscription', 'users', 'cities', 'coupons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City Subscription id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $citySubscription = $this->table('CitySubscriptions')->get($id);
        if ($this->table('CitySubscriptions')->delete($citySubscription)) {
            $this->Flash->success(__('The city subscription has been deleted.'));
        } else {
            $this->Flash->error(__('The city subscription could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
