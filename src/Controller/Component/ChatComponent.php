<?php

namespace App\Controller\Component;

use App\Utility\Custom;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\TextHelper;
use Cake\View\View;

/**
 * Chat component
 */
class ChatComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $components = ['Flash', 'Auth', 'Notify', 'Email', 'Access', 'Custom'];

    public $Cu; //for use with custom utility

    public function submitChat($user_id, $conversation, $body)
    {
        $message = $this->table('Messages')->newEmptyEntity();
        $message->conversation_id = $conversation->id;
        $message->user_id = $user_id;
        // $message->receiver_id = $receiver_id;
        $message->body = $body;
        if ($this->table('Messages')->save($message)) {
            //we update the conversation, so that if user goes to message view
            //they will see their active conversations at the top
            $conversation->updated = time();
            $this->Conversations->save($conversation);

            return $message;
        }

        // pr(\Cake\Error\Debugger::trace());

        return false;
    }

    public function makeMessageLine($message, $user_id = null)
    {
        // debug($host);
        $txt = new TextHelper(new View());
        $message = $this->Cu->varToArray($message);
        // $user = $this->Custom->getUser($message->user_id);
        $user = $this->table('Users')->find()->where(['Users.id' => $message['user_id']])->first();
        return [
            'message' => $txt->autoParagraph($this->Cu->makeLinks($message['body'])),
            'messageid' => $message['id'],
            'userid' => $message['user_id'],
            // 'chatclass' => $message['user_id'] == $user_id ? 'left float-left' : 'right',
            'chatclass' => '',
            'avatar' => !empty($user) ? $this->Cu->dpUrl($user->image, 'users', '50x50') : 'https://www.placehold.it/50x50/EFEFEF/AAAAAA&amp;text=LI',
            // 'time' => "asdasdasdasd",
            'time' => $this->Custom->cakeTime($message['created']),
        ];
    }

    public function lastMessages($user_id, $receiver_id)
    {
        // debug($host);
        $response = [];
        $last_messages = $this->getLastMessages($user_id, $receiver_id);
        if (!empty($last_messages)) {
            $response['success'] = true;
            $response['message'] = "Got some messages";
            $response['receiverid'] = $receiver_id;
            $response['last_message_id'] = $last_messages[0]['id'];
            foreach (array_reverse($last_messages) as $message) {
                // $response['body'][] = $this->makeMessageLine($message, $user_id);
                $response['body'][] = $this->makeMessageLine($message, null);
            }
        }
        return $response;
    }

    public function getLastMessages($user_id, $receiver_id) //this is supposed to be the user id and the last chat user
    {

        $conversation = $this->getActiveConversation($user_id, $receiver_id);
        if (!empty($conversation)) {
            return $this->table('Messages')->find()
                ->contain(['Users'])
                ->where(['conversation_id' => $conversation->id])
                // ->where([
                //     'OR' => [
                //         ['user_id' => $user_id, 'receiver_id' => $receiver_id],
                //         ['receiver_id' => $user_id, 'user_id' => $receiver_id],
                //     ],
                // ])
                ->order(['Messages.created' => 'DESC'])->limit(700)->toArray();
        }
        return [];
    }


    public function indexAction($query)
    {
        $empty_result = false;
        try {
            $conversations = $this->_registry->getController()->paginate($query, ['limit' => 5]);
            if (empty($query->count())) {
                $empty_result = true;
            }

            if (!$empty_result) {

                $first_conversation = $conversations->first();
                if ($this->Authentication->getIdentity()->getIdentifier() == $first_conversation->user->id) {
                    $first_conversation_user = $first_conversation->receiver;
                } else {
                    $first_conversation_user = $first_conversation->user;
                }
                $first_conversation_user->blockedUser = $this->Custom->blockedUser($this->Authentication->getIdentity()->getIdentifier(), $first_conversation_user->id);
                $this->_registry->getController()->set('first_conversation_user', $first_conversation_user);
            } else {
                $this->Flash->default(__('You have no open conversations'));
                return $this->_registry->getController()->redirect(['prefix'=>false,'controller' => 'account', 'action' => 'index']);
            }

            $this->_registry->getController()->set('checking_time', time());
        } catch (\Cake\Http\Exception\NotFoundException $e) {


            $requestQuery = $this->_registry->getController()->getRequest()->getQuery();
            $requestQuery['page'] = $this->_registry->getController()->getRequest()->getParam('paging')['Conversations']['pageCount'];

            return $this->_registry->getController()->redirect([
                'prefix' => false, 'controller' => $this->_registry->getController()->getRequest()->getParam('controller'), 'action' => $this->_registry->getController()->getRequest()->getParam('action'),
                // !empty($this->request->getParam('pass')[0]) ? $this->request->getParam('pass')[0] : '',
                // !empty($this->request->getParam('pass')[1]) ? $this->request->getParam('pass')[1] : '',
                '?' => $requestQuery,
            ]);
        }

        $this->_registry->getController()->set(compact('conversations', 'first_conversation', 'empty_result'));
    }


    public function getUserConversations($search_term = null)
    {
        // dd($this->Authentication->getIdentity()->getIdentifier());
        // $user_conversations =
        $query =  $this->Conversations->find()
            ->contain([
                'Users' => $this->Custom->userContains(),
                'Receivers' => $this->Custom->userContains(),
            ])
            ->order(['Conversations.modified' => "DESC"])
            ->where([
                'OR' => [
                    ['Conversations.user_id' => $this->Authentication->getIdentity()->getIdentifier()],
                    ['Conversations.receiver_id' => $this->Authentication->getIdentity()->getIdentifier()],
                ],
            ]);

        if (!empty($search_term)) {
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $receiversQuery = $this->Custom->userFullTextQuery($search_term, "Receivers");
            $mergeQuery = array_merge($usersQuery, $receiversQuery);
            $query->where([
                'OR' => $mergeQuery,
            ]);
        }

        return $query;
    }

    public function getActiveConversation($user_id, $receiver_id)
    {
        $conversation = $this->Conversations->find()->where([
            'OR' => [
                ['user_id' => $user_id, 'receiver_id' => $receiver_id],
                ['user_id' => $receiver_id, 'receiver_id' => $user_id],
            ],
        ])->first();

        if (empty($conversation)) {
            $conversation = $this->Conversations->newEmptyEntity();
            $conversation->user_id = $user_id;
            $conversation->receiver_id = $receiver_id;
            $this->Conversations->save($conversation);
        }

        return $conversation;

        // $conversation = $this->Conversations->find()
        //     ->where(['receiver_id' => $id1, 'sender_id' => $id2])
        //     ->orWhere(['receiver_id' => $id2, 'sender_id' => $id1])->first();

        // return $conversation;

    }
    public function table($model)
    {
        return $this->Custom->table($model);
    }
    public function getMessageNotifications($id, $startDate = null, $endDate = null)
    {
        return !empty($startDate) && !empty($endDate)
            ?
            $this->table('Notifications')->find('all', [
                'order' => ['Notifications.created' => 'DESC'],
                'limit' => 50,
            ])->where(['user_id' => $id, 'notification_type_id' => 5, "viewed" => 0, function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Notifications.created', $startDate, $endDate);
            }])->contain(['Users'])
            :
            $this->table('Notifications')->find('all', [
                'order' => ['Notifications.created' => 'DESC'],
                'limit' => 50,
            ])->where(['user_id' => $id, "viewed" => 0, 'notification_type_id' => 5])->contain(['Users']);
    }

    public function initialize(array $config): void
    {
        $this->Cu = new Custom();
        // $this->Custom->loadModels($this, $this->getController());
    }
}
