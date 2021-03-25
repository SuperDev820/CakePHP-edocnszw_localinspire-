<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Manager Controller
 *
 *
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManagerController extends AppController

{
    // public $helpers = ['CkEditor.Ck'];
    public function initialize(): void
    {
        parent::initialize();
        // $this->Authentication->allowUnauthenticated();
        $this->set('page', "business");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', [
        //         'cityDetails', 'editStory', 'addStory'
        //     ]);
        // }
        if (!empty($this->Authentication->getIdentity())) {
            $userCities = $this->Access->userCities();
            if (empty($userCities)) {
                $this->Flash->default(__('You  currently do not have any cities to manage. Please claim a city or contact support for assistance'));
                $this->Custom->goToAccount();
            }
            // dd($userCities[0]->id);
            if (empty($this->currentUser->active_city)) {
                $this->Custom->setActiveCity($userCities[0]->id, $this->Authentication->getIdentity()->getIdentifier());
                $this->currentUser = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
            }
            // dd($this->currentUser);
            if (!empty($this->currentUser->active_city)) {
                $this->active_city =  $this->Custom->getCity($this->currentUser->active_city);
                $this->set('active_city', $this->active_city);

                $featured_businesses_count = $this->Custom->getFeaturedAd(null, $this->currentUser->active_city, false, false, false)->count();
                $business_subscriptions_count = $this->Access->CitySubscriptions($this->currentUser->active_city)->count();
                $total_city_income = $this->Access->CityEarnings($this->currentUser->active_city);

                $this->set(compact('total_city_income', 'business_subscriptions_count', 'featured_businesses_count'));
            } else {
                $this->Flash->default(__('You  currently do not have any cities to manage. Please claim a city or contact support for assistance'));
                $this->Custom->goToAccount();
            }
            $this->userCitiesList = $this->Access->userCities("list");
            $this->set("userCitiesList", $this->userCitiesList);
        }
    }


    public function index()
    {
    }



    public function earnings()
    {
        $startDate = (new \DateTime('2017-01-01 00:00:00'))->format("Y-m-d H:i:s");
        $endDate = (new \DateTime())->format("Y-m-d H:i:s");
        $label = "All Time";

        if ($this->request->is(['patch', 'post', 'put'])) { //date range 

            $startDate = $this->request->getData()['startDate'];
            $endDate = $this->request->getData()['endDate'];
            $label = $this->request->getData()['label'];
        }

        $businesses_count = $this->Access->CityBusinesses($this->currentUser->active_city, $startDate, $endDate)->count();
        $subscription_count = $this->Access->CitySubscriptions($this->currentUser->active_city, $startDate, $endDate)->count();
        $earnings = $this->Access->CityEarnings($this->currentUser->active_city, $startDate, $endDate);


        $userCitiesIds = $this->Access->userCitiesIDs();

        $biz_count_user_cities = $this->Access->CityBusinesses($this->currentUser->active_city, $startDate, $endDate, $userCitiesIds)->count();
        $sub_count_user_cities = $this->Access->CitySubscriptions($this->currentUser->active_city, $startDate, $endDate, $userCitiesIds)->count();
        $earnings_user_cities = $this->Access->CityEarnings($this->currentUser->active_city, $startDate, $endDate, $userCitiesIds);


        $this->set(compact('label', 'startDate', 'endDate', 'businesses_count', 'subscription_count', 'earnings', 'biz_count_user_cities', 'sub_count_user_cities', 'earnings_user_cities'));
    }

    public function stories()
    {
    }

    public function deleteStory($id)
    {
        $post = $this->table('Posts')->get($id);
        $this->Access->checkUserCityAccess($post->city_id, $this->currentUser->active_city);
        if ($this->table('Posts')->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'stories']);
    }
    public function paymentSettings()
    {
        return $this->redirect(['action' => 'index']);
    }

    public function cityDetails()
    {
        $city = $this->table('Cities')->get($this->currentUser->active_city, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->table('Cities')->patchEntity($city, $this->request->getData());
            // dd($this->request->getData());

            $upload = $this->Custom->uploadFileLaminas($this->request->getData()['img_upload1'], "cities");
            if ($upload['success']) {
                $city->image = $upload['filename'];
                if ($this->table('Cities')->save($city)) {
                    $this->Flash->success(__($city->name . ' has been updated.'));

                    return $this->redirect(['action' => 'cityDetails']);
                }
            } else {
                //dd($upload);
                $this->Flash->error(__($upload['message']));
            }

            if ($this->table('Cities')->save($city)) {
                $this->Flash->success(__($city->name . ' has been updated.'));

                return $this->redirect(['action' => 'cityDetails']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->table('Cities')->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
    }


    public function editStory($id)
    {
        $post = $this->table('Posts')->get($id, [
            'contain' => ['Tags']
        ]);
        $this->Access->checkUserCityAccess($post->city_id, $this->currentUser->active_city);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->table('Posts')->patchEntity($post, $this->request->getData());
            $upload = $this->Custom->uploadFileLaminas($this->request->getData()['img_upload1'], "posts");
            if ($upload['success']) {
                $post->image = $upload['filename'];
            }
            if ($this->table('Posts')->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'stories']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $tags = $this->Custom->getCityTags($this->currentUser->active_city);
        $this->set(compact('post', 'tags'));
    }
    public function addStory()
    {
        $post = $this->table('Posts')->newEmptyEntity();
        if ($this->request->is('post')) {
            $post = $this->table('Posts')->patchEntity($post, $this->request->getData());
            $post->city_id = $this->currentUser->active_city;
            $post->user_id = $this->Authentication->getIdentity()->getIdentifier();

            $upload = $this->Custom->uploadFileLaminas($this->request->getData()['img_upload1'], "posts");
            if ($upload['success']) {
                $post->image = $upload['filename'];
            }
            if ($this->table('Posts')->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'stories']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $tags = $this->Custom->getCityTags($this->currentUser->active_city);
        $this->set(compact('post', 'tags'));
    }
    public function switch($id = null)
    {
        $city_id = !empty($this->request->getQuery()['city_id']) ? $this->request->getQuery()['city_id'] : $id;
        $this->Custom->setActiveCity($city_id);
        $city = $this->Custom->getCity($city_id);
        $this->Flash->success(__('You\'re now managing ' . $city->name));
        return $this->redirect($this->referer());
        // return $this->redirect(['controller' => 'account', 'action' => 'index']);
    }
}
