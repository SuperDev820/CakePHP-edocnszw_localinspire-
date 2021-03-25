<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * ClaimCity Controller
 *
 *
 * @method \App\Model\Entity\ClaimCity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClaimCityController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index']);
        // if ($this->request->getParam('action') == 'index') {
        // }
        $this->set('page', "business");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'add', 'edit', 'addReview', 'addPhotos', 'editReview', 'claimSuccess'
        //     ]);
        // }
    }

    public function index($id, $slug = null)
    {
        // $this->Authentication->allowUnauthenticated();
        $cityToClaim = $this->table('Cities')->find()->where(["Cities.id" => $id])->contain(['States'])->first();
        $this->set('cityToClaim', $cityToClaim);

        // dd($cityToClaim);

        $options = $this->table('Options')->find()->where(['id' => 1])->first();
        $this->set('options', $options);
    }

    public function success()
    {
        // dd($this->request->getQuery());
        $transactionid = !empty($this->request->getQuery()['transactionid']) ? $this->request->getQuery()['transactionid'] : '';
        if (!empty($transactionid)) {
            $citySub = $this->Access->getCitySubs(null, $transactionid);
            $citySub->paid = true;
            if ($this->table('CitySubscriptions')->save($citySub)) {
                $this->Access->claimCities($citySub);
                $this->Flash->success(__('Thank you for subscribing.'));
                return $this->redirect(['controller' => 'manager', 'action' => 'index']);
            }
        }
        $this->Flash->default(__('Something went wrong. Please try again later'));
        return $this->redirect(['controller' => 'account', 'action' => 'index']);
    }


    public function cancel()
    {
        $transactionid = !empty($this->request->getQuery()['transactionid']) ? $this->request->getQuery()['transactionid'] : '';
        if (!empty($transactionid)) {
            $citySub = $this->Access->getCitySubs(null, $transactionid);
            $citySub->active = false;
            if ($this->table('CitySubscriptions')->save($citySub)) {
                // $this->Flash->success(__('Thank you for subscribing.'));
                // return $this->redirect(['controller' => 'manager', 'action' => 'index']);
            }
        }
        $this->Flash->default(__('Subscription cancelled. Please try again later or contact support for assistance'));
        return $this->redirect(['controller' => 'account', 'action' => 'index']);
    }
}
