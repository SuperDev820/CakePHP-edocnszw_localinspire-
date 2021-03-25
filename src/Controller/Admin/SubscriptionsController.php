<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Subscriptions Controller
 *
 * @property \App\Model\Table\SubscriptionsTable $Subscriptions
 *
 * @method \App\Model\Entity\Subscription[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubscriptionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "subscriptions");
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
        // $this->paginate = [
        //     'contain' => ['Businesses', 'Coupons', 'Packages'],
        // ];
        // $subscriptions = $this->paginate($this->table('Subscriptions'));

        // $this->set(compact('subscriptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscription = $this->table('Subscriptions')->get($id, [
            'contain' => ['Businesses', 'Coupons', 'Packages'],
        ]);

        $this->set('subscription', $subscription);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $subscription = $this->table('Subscriptions')->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $subscription = $this->table('Subscriptions')->patchEntity($subscription, $this->request->getData());
    //         if ($this->table('Subscriptions')->save($subscription)) {
    //             $this->Flash->success(__('The subscription has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
    //     }
    //     $businesses = $this->table('Subscriptions')->Businesses->find('list', ['limit' => 200]);
    //     $coupons = $this->table('Subscriptions')->Coupons->find('list', ['limit' => 200]);
    //     $packages = $this->table('Subscriptions')->Packages->find('list', ['limit' => 200]);
    //     $this->set(compact('subscription', 'businesses', 'coupons', 'packages'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscription = $this->table('Subscriptions')->get($id, [
            'contain' => ['Businesses'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscription = $this->table('Subscriptions')->patchEntity($subscription, $this->request->getData());
            if ($this->table('Subscriptions')->save($subscription)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
        }
        $businesses = $this->table('Subscriptions')->Businesses->find('list', ['limit' => 200]);
        $coupons = $this->table('Subscriptions')->Coupons->find('list', ['limit' => 200]);
        $packages = $this->table('Subscriptions')->Packages->find('list', ['limit' => 200]);
        $this->set(compact('subscription', 'businesses', 'coupons', 'packages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $subscription = $this->table('Subscriptions')->get($id);
        if ($this->table('Subscriptions')->delete($subscription)) {
            $this->Flash->success(__('The subscription has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
