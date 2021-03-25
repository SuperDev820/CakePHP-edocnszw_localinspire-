<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Reminders Controller
 *
 * @property \App\Model\Table\RemindersTable $Reminders
 *
 * @method \App\Model\Entity\Reminder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemindersController extends AppController
{
    // public $helpers = ['CkEditor.Ck'];
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "reminders");
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
     * Edit method
     *
     * @param string|null $id Reminder id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reminder = $this->table('Reminders')->get($id, [
            'contain' => ['Businesses'],
        ]);

        $sendCount = $this->table('RemindersSent')->find()->where(['reminder_id' => $reminder->id])->count();
        // dd($reminder);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reminder = $this->table('Reminders')->patchEntity($reminder, $this->request->getData());
            if ($this->table('Reminders')->save($reminder)) {
                $this->Flash->success(__('The reminder has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reminder could not be saved. Please, try again.'));
        }
        $businesses = $this->table('Reminders')->Businesses->find('list', ['limit' => 200]);
        $reminderStatuses = $this->table('Reminders')->ReminderStatuses->find('list', ['limit' => 200]);
        $reminderSchedules = $this->table('Reminders')->ReminderSchedules->find('list', ['limit' => 200]);
        $this->set(compact('reminder', 'businesses', 'reminderStatuses', 'reminderSchedules', 'sendCount'));
    }


    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $reminder = $this->table('Reminders')->get($id);
        if ($this->table('Reminders')->delete($reminder)) {
            $this->Flash->success(__('The reminder has been deleted.'));
        } else {
            $this->Flash->error(__('The reminder could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
