<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 *
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "cities");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'toggleStatus','edit']
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
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $city = $this->table('Cities')->get($id, [
    //         'contain' => ['States', 'Businesses', 'CitySearches', 'Users'],
    //     ]);

    //     $this->set('city', $city);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $city = $this->table('Cities')->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $city = $this->table('Cities')->patchEntity($city, $this->request->getData());
    //         if ($this->table('Cities')->save($city)) {
    //             $this->Flash->success(__('The city has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The city could not be saved. Please, try again.'));
    //     }
    //     $states = $this->table('Cities')->States->find('list', ['limit' => 200]);
    //     $this->set(compact('city', 'states'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->table('Cities')->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->table('Cities')->patchEntity($city, $this->request->getData());
            // dd($this->request->getData());
            $upload = $this->Custom->uploadFileLaminas($this->request->getData()['img_upload1'], "cities");
            if ($upload['success']) {
                $city->image = $upload['filename'];
                if ($this->table('Cities')->save($city)) {
                    $this->Flash->success(__('The city has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            } else {
                //dd($upload);
                $this->Flash->error(__($upload['message']));
            }
            if ($this->table('Cities')->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->table('Cities')->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
    }


    public function togglefeatured($id)
    {
        $city = $this->table('Cities')->get($id);
        $city->featured = !$city->featured;
        if ($this->table('Cities')->save($city)) {
            if ($city->featured) {
                $this->Flash->success(__($city->name . ' has been marked as featured.'));
            } else {
                $this->Flash->default(__($city->name . ' has been removed as featured.'));
            }
        }
        return $this->redirect($this->referer());
    }
    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     // $this->request->allowMethod(['post', 'delete']);
    //     $city = $this->table('Cities')->get($id);
    //     if ($this->table('Cities')->delete($city)) {
    //         $this->Flash->success(__('The city has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The city could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
