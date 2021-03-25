<?php

namespace App\Controller\Component;

use App\Utility\Custom;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

//for use with custom utility

/**
 * Notify component
 */
class NotifyComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $components = ['Custom', 'Flash', 'Auth'];

    public function newUser($user)
    {
        //$sender = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        $this->notify([
            "user_id" => $user->id,
            "notification_type_id" => 1,
            "message" => "You joined LocalInspire",
            "description" => "",
            "viewed" => "0",
            "url" => "",
        ]);
    }

    public function newMessage($message, $receiver_id)
    {
        //$sender = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        $user = $this->Custom->getUser($message->user_id);
        $this->notify([
            "user_id" => $receiver_id,
            "notification_type_id" => 6,
            // "message" => ucfirst(substr($message->body, 0, 50)),
            "message" => "Message from " . ucwords($user->name_desc),
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $message->user_id,
            "url" => json_encode([
                'prefix' => false,
                'controller' => "account",
                'action' => 'messages',
                $user->id
            ]),
        ]);
    }

    public function follow($follow)
    {
        $follower = $this->Custom->getUser($follow->follow_id);
        $user = $this->Custom->getUser($follow->user_id);
        $this->notify([
            "user_id" => $follow->user_id,
            "notification_type_id" => 5,
            // "message" => ucfirst(substr($message->body, 0, 50)),
            "message" => ucwords($follower->name_desc) . " started following you",
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $follower->id,
            "url" => json_encode([
                'prefix' => false,
                'controller' => "user",
                'action' => 'index',
                $follower->username
            ]),
        ]);
    }

    public function newQuestion($question)
    {
        $asker = $this->Custom->getUser($question->user_id);
        $business = $this->Custom->getBusiness($question->business_id);
        // $business_owner = $this->Custom->getUser($business->user_id);

        if (empty($business->user_id)) {
            return false;
        }
        $this->notify([

            "user_id" => $business->user_id,
            "notification_type_id" => 1,
            "message" => ucwords($asker->name_desc) . " asked a question on " . ucwords($business->name),
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $asker->id,
            "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]),
        ]);
    }

    public function businessEdit($business, $editor_id)
    {
        $editor = $this->Custom->getUser($editor_id);
        if (empty($business->user_id)) {
            return false;
        }
        $this->notify([
            "user_id" => $business->user_id,
            "notification_type_id" => 1,
            "message" => ucwords($editor->name_desc) . " requested an edit on " . ucwords($business->name),
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $editor->id,
            "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]),
        ]);
    }

    public function businessPhotoUpload($business_id, $user_id)
    {
        $uploader = $this->Custom->getUser($user_id);
        $business = $this->Custom->getBusiness($business_id);
        if (empty($business->user_id)) {
            return false;
        }
        $this->notify([
            "user_id" => $business->user_id,
            "notification_type_id" => 1,
            "message" => ucwords($uploader->name_desc) . " added photo(s) on " . ucwords($business->name),
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $uploader->id,
            "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]),
        ]);
    }

    public function newAnswer($question, $answer)
    {
        $user = $this->Custom->getUser($answer->user_id);
        if (empty($question->business->user_id)) {
            return false;
        }
        if ($question->business->user_id != $user->id) {
            $this->notify([
                "user_id" => $question->business->user_id,
                "notification_type_id" => 1,
                "message" => ucwords($user->name_desc) . " answered a question on " . ucwords($question->business->name),
                "description" => "",
                "viewed" => "0",
                "message_user_id" => $answer->user_id,
                "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($question->business->name)), strtolower($question->business->city->name), $question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]),
            ]);
        }
    }

    public function replyReview($business_review_id)
    {
        $review = $this->Custom->getBusinessReviews(null, $business_review_id)->first();
        $this->notify([
            "user_id" => $review->user_id,
            "notification_type_id" => 1,
            "message" => "Your review on " . ucwords($review->business->name) . " has got a new response",
            "description" => "",
            "viewed" => "0",
            "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]),
        ]);
    }

    public function newReview($business_review_id)
    {
        $review = $this->Custom->getBusinessReviews(null, $business_review_id)->first();
        $this->notify([
            "user_id" => $review->business->user_id,
            "notification_type_id" => $review->recommend ? 1 : 3,
            "message" => ucwords($review->user->name_desc) . " posted a review on " . ucwords($review->business->name),
            "description" => "",
            "viewed" => "0",
            "message_user_id" => $review->user_id,
            "url" => json_encode(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]),
        ]);
    }

    public function notify($data)
    {
        $notification = $this->table('Notifications')->newEmptyEntity();
        $notification = $this->table('Notifications')->patchEntity($notification, $data);
        if ($this->table('Notifications')->save($notification)) {
            return true;
        }
        //debug($notification);die();
        return false;
    }
    public function table($model)
    {
        return $this->Custom->table($model);
    }
    public function initialize(array $config): void
    {
        $this->Cu = new Custom();
        // $this->Custom->loadModels($this, $this->getController());

        // $this->table('Notifications') = TableRegistry::get('Notifications');
    }
}
