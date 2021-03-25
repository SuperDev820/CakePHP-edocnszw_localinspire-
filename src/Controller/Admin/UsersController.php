<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "users");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['add', 'toggleStatus', 'edit']
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user = $this->table('Users')->get($id, [
            // 'contain' => $this->Custom->userContains()
        ]);
        // dd($user);
        // $this->Aws->checkUserAccess($user->created_by);
        if (!$this->currentUser->sa || !$this->currentUser->admin) {
            return $this->redirect($this->referer());
        }

        $this->set('user', $user);
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->table('Users')->get($id, [
            'contain' => []
        ]);

        // $this->Aws->checkUserAccess($user->created_by);
        if (!$this->currentUser->sa) {
            $this->Flash->default(__('Only a super admin can modify user record'));
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->table('Users')->patchEntity($user, $this->request->getData());
            if ($this->table('Users')->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function resetPassword($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $user = $this->table('Users')->get($id);
        // $this->Aws->checkUserAccess($user->created_by);
        if (!$this->currentUser->sa || !$this->currentUser->admin) {
            return $this->redirect($this->referer());
        }
        $random_string = strtolower($this->Custom->randomString(10));
        $user->password = $random_string;
        if ($this->table('Users')->save($user)) {
            $this->Flash->success('The password reset to ' . $random_string);
        } else {
            $this->Flash->error(__('The password could not be changed'));
        }
        // return $this->redirect(['action' => 'index']);
        return $this->redirect($this->referer());
    }

    public function email($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $user = $this->table('Users')->get($id);
        if (!$this->currentUser->sa || !$this->currentUser->admin) {
            return $this->redirect($this->referer());
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->table('Users')->patchEntity($user, $this->request->getData());
            if ($this->Custom->sendUserEmail($user, $this->request->getData())) {
                $this->Flash->success(__('Email has been sent to ' . ucwords($user->name_desc)));
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('user'));
    }


    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        if (!$this->currentUser->sa || !$this->currentUser->admin) {
            return $this->redirect($this->referer());
        }
        $user = $this->table('Users')->get($id);
        if ($this->table('Users')->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());

        // $this->Aws->userDelete($id);
    }


    public function toggleStatus($user_id)
    {
        $user = $this->table('Users')->get($user_id);
        // $this->Aws->checkUserAccess($user->created_by);
        if ($user->id == 1) {
            return $this->redirect($this->referer());
        }
        $user->active = !$user->active;
        if ($this->table('Users')->save($user)) {
            if ($user->active) {
                $this->Flash->success(__('The user has been activated.'));
            } else {
                $this->Flash->default(__('The user has been deactivated.'));
            }
        }
        return $this->redirect($this->referer());
    }
}
