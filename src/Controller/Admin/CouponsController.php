<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Coupons Controller
 *
 * @property \App\Model\Table\CouponsTable $Coupons
 *
 * @method \App\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouponsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "coupons");
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
        //     'contain' => ['Users'],
        // ];
        // $coupons = $this->paginate($this->table('Coupons'));
        $coupons = $this->table('Coupons')->find()->contain(['Users'])->toArray();

        $this->set(compact('coupons'));
    }

    /**
     * View method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coupon = $this->table('Coupons')->get($id, [
            'contain' => ['Users', 'Subscriptions'],
        ]);

        $this->set('coupon', $coupon);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coupon = $this->table('Coupons')->newEmptyEntity();
        if ($this->request->is('post')) {
            $coupon = $this->table('Coupons')->patchEntity($coupon, $this->request->getData());
            if ($this->checkVoucherInput($coupon)) {
                if ($this->table('Coupons')->save($coupon)) {
                    $this->Flash->success(__('The coupon has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $users = $this->table('Coupons')->Users->find('list', ['limit' => 200]);
        $this->set(compact('coupon', 'users'));
    }

    public function checkVoucherInput($coupon)
    {
        // dd($voucher);

        if ($coupon->percentage_voucher && empty($coupon->percent)) {
            $this->Flash->default(__('You selected the percentage option but did not assign a percentage for this voucher'));
            return false;
        }
        if (!$coupon->percentage_voucher && empty($coupon->amount)) {
            $this->Flash->default(__('You did not enter an amount for this voucher. Is this a percentage voucher?'));
            return false;
        }

        return true;
    }

    /**
     * Edit method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coupon = $this->table('Coupons')->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coupon = $this->table('Coupons')->patchEntity($coupon, $this->request->getData());
            if ($this->checkVoucherInput($coupon)) {
                if ($this->table('Coupons')->save($coupon)) {
                    $this->Flash->success(__('The coupon has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $users = $this->table('Coupons')->Users->find('list', ['limit' => 200]);
        $this->set(compact('coupon', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->table('Coupons')->get($id);
        if ($this->table('Coupons')->delete($coupon)) {
            $this->Flash->success(__('The coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
