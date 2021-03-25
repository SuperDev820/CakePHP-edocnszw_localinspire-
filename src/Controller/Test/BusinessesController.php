<?php
declare(strict_types=1);

namespace App\Controller\Test;

use App\Controller\AppController;

/**
 * Businesses Controller
 *
 * @property \App\Model\Table\BusinessesTable $Businesses
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BusinessesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Cities', 'Sic2categories', 'Sic4categories', 'Sic8categories', 'Industries', 'BusinessRoles'],
        ];
        $businesses = $this->paginate($this->Businesses);

        $this->set(compact('businesses'));
    }

    /**
     * View method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $business = $this->Businesses->get($id, [
            'contain' => ['Users', 'Cities', 'Sic2categories', 'Sic4categories', 'Sic8categories', 'Industries', 'BusinessRoles', 'Categories', 'Subcategories', 'Announcements', 'BusinessAdditionals', 'BusinessEdits', 'BusinessHours', 'BusinessPhotos', 'BusinessReviews', 'CollectionItems', 'Ctas', 'FeaturedAds', 'Offers', 'PageViews', 'Questions', 'Reminders', 'ShareClicks', 'Shares', 'Subscriptions'],
        ]);

        $this->set(compact('business'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $business = $this->Businesses->newEmptyEntity();
        if ($this->request->is('post')) {
            $business = $this->Businesses->patchEntity($business, $this->request->getData());
            if ($this->Businesses->save($business)) {
                $this->Flash->success(__('The business has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business could not be saved. Please, try again.'));
        }
        $users = $this->Businesses->Users->find('list', ['limit' => 200]);
        $cities = $this->Businesses->Cities->find('list', ['limit' => 200]);
        $sic2categories = $this->Businesses->Sic2categories->find('list', ['limit' => 200]);
        $sic4categories = $this->Businesses->Sic4categories->find('list', ['limit' => 200]);
        $sic8categories = $this->Businesses->Sic8categories->find('list', ['limit' => 200]);
        $industries = $this->Businesses->Industries->find('list', ['limit' => 200]);
        $businessRoles = $this->Businesses->BusinessRoles->find('list', ['limit' => 200]);
        $categories = $this->Businesses->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->Businesses->Subcategories->find('list', ['limit' => 200]);
        $this->set(compact('business', 'users', 'cities', 'sic2categories', 'sic4categories', 'sic8categories', 'industries', 'businessRoles', 'categories', 'subcategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $business = $this->Businesses->get($id, [
            'contain' => ['Categories', 'Subcategories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $business = $this->Businesses->patchEntity($business, $this->request->getData());
            if ($this->Businesses->save($business)) {
                $this->Flash->success(__('The business has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business could not be saved. Please, try again.'));
        }
        $users = $this->Businesses->Users->find('list', ['limit' => 200]);
        $cities = $this->Businesses->Cities->find('list', ['limit' => 200]);
        $sic2categories = $this->Businesses->Sic2categories->find('list', ['limit' => 200]);
        $sic4categories = $this->Businesses->Sic4categories->find('list', ['limit' => 200]);
        $sic8categories = $this->Businesses->Sic8categories->find('list', ['limit' => 200]);
        $industries = $this->Businesses->Industries->find('list', ['limit' => 200]);
        $businessRoles = $this->Businesses->BusinessRoles->find('list', ['limit' => 200]);
        $categories = $this->Businesses->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->Businesses->Subcategories->find('list', ['limit' => 200]);
        $this->set(compact('business', 'users', 'cities', 'sic2categories', 'sic4categories', 'sic8categories', 'industries', 'businessRoles', 'categories', 'subcategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $business = $this->Businesses->get($id);
        if ($this->Businesses->delete($business)) {
            $this->Flash->success(__('The business has been deleted.'));
        } else {
            $this->Flash->error(__('The business could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
