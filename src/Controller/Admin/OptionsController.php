<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Options Controller
 *
 * @property \App\Model\Table\OptionsTable $Options
 *
 * @method \App\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "options");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['index']
        //     );
        // }
    }
    public function index()
    {
        $option = $this->table('Options')->find()->where(['id' => 1])->first();
        if (empty($option)) {
            $option = $this->table('Options')->newEmptyEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $option = $this->table('Options')->patchEntity($option, $this->request->getData());
            if ($this->table('Options')->save($option)) {
                $this->Flash->success(__('Site options have been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The option could not be saved. Please, try again.'));
        }
        $this->set(compact('option'));
    }
}
