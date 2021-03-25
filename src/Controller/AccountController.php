<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Account Controller
 *
 *
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->addUnauthenticatedActions(['confirmEmail']);
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', ['settings', 'password', 'editCollection', 'newCollection']);
        // }
    }

    public function index()
    {

        $city = $this->Custom->getCityByOptions($this->currentUser, $this->request->getQuery());
        if (!empty($city)) {
            // dd($city);
            $this->Custom->getNotificationsLogic($this->getRequest()->getQuery());
            $announcements = $this->Custom->getBusinessAnnouncements()
                ->where(['Announcements.active' => true])
                ->andWhere(['Businesses.city_id' => $city->id])->toArray();

            $featured_ads = [];

            $featured_ads = $this->Custom->getFeaturedAd(null, $city->id, false, true, 6)->toArray();
            $this->set(compact('announcements', 'featured_ads'));
        }
    }


    public function settings()
    {
        $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        // dd($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // dd($this->request->getData());
            $user = $this->table('Users')->patchEntity($user, $this->request->getData());
            $upload = $this->Custom->uploadFileLaminas($this->request->getData()['uploadphoto'], "users");
            if ($upload['success']) {
                $user->image = $upload['filename'];
            } else {
                //dd($upload);
                if(!empty($upload['size'])){
                    $this->Flash->error(__($upload['message']));
                }
            }

            if ($this->table('Users')->save($user)) {
                $this->Flash->success(__('Your profile has been updated'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $cities = $this->table('Cities')->find('list', ['limit' => 2000]);
        $states = $this->table('States')->find('list', ['limit' => 2000]);
        $this->set(compact('user', 'cities', 'states'));
    }
    public function password()
    {
        $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        // $this->Custom->dolog("text.txt", \json_encode($this->request->getData()));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->table('Users')->patchEntity($user, [
                'old_password' => $this->request->getData()['old_password'],
                'password' => $this->request->getData()['password1'],
                'password1' => $this->request->getData()['password1'],
                'password2' => $this->request->getData()['password2'],
            ], ['validate' => 'password']);
            if ($this->table('Users')->save($user)) {
                $this->Flash->success('Your password has been successfully changed!');
                // $this->Custom->sendLog("changed their password", 1);
                return $this->redirect([
                    'controller' => 'Dashboard',
                    'action' => 'index',
                ]);
            } else {
                // dd($user);
                $this->Flash->error('There was an error during the save!');
                // return $this->redirect($this->referer());
            }
        }
        $this->set(compact('user'));
    }

    public function notificationSettings()
    {
        $userEmails = $this->table('UserEmails')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()]);
        $this->set('userEmails', $userEmails);

        $notification_settings = $this->table('NotificationSettings')->find()->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()])->first();
        if (empty($notification_settings)) {
            $notification_settings = $this->table('NotificationSettings')->newEmptyEntity();
            $notification_settings->user_id = $this->Authentication->getIdentity()->getIdentifier();
            $this->table('NotificationSettings')->save($notification_settings);
        }
        $this->set('notification_settings', $notification_settings);
    }

    public function notifications()
    {
        $this->Custom->getNotificationsLogic($this->getRequest()->getQuery());

        if ($this->request->is('ajax')) {
            $this->render('notification_endless_scroll');
        }
    }

    public function setPrimaryEmail($id)
    {
        $userEmail = $this->table('UserEmails')->find()->where(['id' => $id])->first();
        if (!empty($userEmail)) {
            if ($userEmail->verified) {
                $checkEmail = $this->table('Users')->find()->where(['email' => $userEmail->email])->first();
                if (empty($checkEmail)) {
                    $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
                    $user->email = $userEmail->email;
                    $this->table('Users')->save($user);
                    $this->Flash->success(__('Your primary email has been updated'));
                } else {
                    $this->Flash->default(__('This email is already asssociated with an account on localinspire. You can merge the account into yours if you own both accounts'));
                }
            } else {
                $this->Flash->error(__('This email has not been verified!'));
            }
        }
        return $this->redirect($this->referer());
    }

    public function deleteEmail($id)
    {
        $userEmail = $this->table('UserEmails')->find()->where(['id' => $id])->first();
        if (!empty($userEmail) and $userEmail->user_id == $this->Authentication->getIdentity()->getIdentifier()) {
            if ($this->table('UserEmails')->delete($userEmail)) {
                $this->Flash->success(__('Your secondary email has been removed.'));
            }
        }
        return $this->redirect($this->referer());
    }

    public function requestMerge()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $merge_user = $this->table('Users')->find()->where(['email' => $this->request->getData()['email']])->first();
        if (empty($merge_user)) {
            $this->Flash->error(__('No account exists with the email address: <strong>' . $this->request->getData()['email'] . '</strong>'), ['escape' => false]);
        } else {
            if ($this->currentUser->id != $merge_user->id) {
                $data = $this->request->getData();
                $data['user_id'] = $this->Authentication->getIdentity()->getIdentifier();
                $data['merge_user_id'] = $merge_user->id;
                if ($this->Custom->saveMergeRequest($data)) {
                    if ($this->Custom->sendMergeEmail($this->currentUser, $this->request->getData()['email'])) {
                        $this->Flash->success(__('A merge reqeust email has been sent to ' . $this->request->getData()['email']));
                    }
                }
            }
        }
        return $this->redirect($this->referer());
    }

    public function merge($passkey, $token)
    {
        $mergeRequest = $this->table('Merges')->find()->where(['passkey' => $passkey, 'token' => $token])
            //->contain(['MergeUsers'])
            ->first();
        if (!empty($mergeRequest)) {
            if ($mergeRequest->merged) {
                return $this->redirect(['action' => 'index']);
            }
            $user = $this->Custom->getUser($mergeRequest->user_id);
            $merge_user = $this->Custom->getUser($mergeRequest->merge_user_id);
            if ($this->Custom->mergeAccount($mergeRequest)) {

                $this->Auth->setUser($user);
                $this->Flash->success(__('The </strong>' . $merge_user->email . '</strong> account has been successfully merged into yours'), ['escape' => false]);
                return $this->redirect(['action' => 'index']);
            }
        }
        return $this->redirect('/');
    }

    public function specials()
    {
        $keywords =  $this->table('SearchKeywords')->find()->toArray();
        $this->set('keywords', $keywords);


        $this->Custom->getBusinessOffersLogic(null, $this->request->getQueryParams(), $this->currentUser->city_id);

        if ($this->request->is('ajax')) {
            $this->render('offer_endless_scroll_container');
        }
    }
    public function connections()
    {
    }
    public function suspended()
    {
    }
    public function reviews()
    {
        // die("asdasd");
        // dd("sadsa");
        // dd($this->request->getQueryParams());
        $this->Custom->getBusinessReviewsLogic(null, null, $this->Authentication->getIdentity()->getIdentifier(), $this->request->getQueryParams());
    }

    public function questions()
    {
        $this->Custom->getQuestionsLogic(null, $this->Authentication->getIdentity()->getIdentifier());
    }

    public function collections()
    {
        $this->Custom->getUserCollectionsLogic($this->currentUser->id);
    }

    public function messages($user_id = null)
    {
        $search_term = !empty($this->request->getData()['search']) ? $this->request->getData()['search'] : '';
        $query = $this->Chat->getUserConversations(strtolower($search_term));
        // if ($this->request->is(['patch', 'post', 'put'])) {
        //     dd($this->request->getData()['search']);
        // }
        $this->Chat->indexAction($query);
    }

    public function inviteFriends()
    {

        $this_month = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier(), (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $last_month = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier(), (new \DateTime('first day of last month'))->format("Y-m-d H:i:s"), (new \DateTime('last day of last month'))->format("Y-m-d H:i:s"));
        $overall = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier());

        $this->set('this_month', $this_month);
        $this->set('last_month',  $last_month);
        $this->set('overall', $overall);
    }

    public function facebookFriends()
    {
    }

    public function inviteViaFacebook()
    {
    }
    public function inviteViaEmail()
    {
    }

    public function followers()
    {
        $this->Custom->followersLogic($this->currentUser->id);

        $this->set('following', false);
        if ($this->request->is('ajax')) {
            $this->render('followers_container');
        }
    }


    public function following()
    {
        $this->Custom->followersLogic($this->currentUser->id, true);

        $this->set('following', true);

        if ($this->request->is('ajax')) {
            $this->render('followers_container');
        }
    }

    public function newCollection()
    {
        $collection = $this->table('Collections')->newEmptyEntity();
        if ($this->request->is('post')) {
            $collection = $this->table('Collections')->patchEntity($collection, $this->request->getData());
            $collection->user_id = $this->Authentication->getIdentity()->getIdentifier();
            // dd($collection);
            if ($this->table('Collections')->save($collection)) {
                $this->Flash->success(__('The collection has been saved.'));

                return $this->redirect(['action' => 'collections']);
            }
            $this->Flash->error(__('The collection could not be saved. Please, try again.'));
        }
        $users = $this->table('Collections')->Users->find('list', ['limit' => 200]);
        $this->set(compact('collection', 'users'));
    }

    public function editCollection($id)
    {
        $collection = $this->table('Collections')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $collection = $this->table('Collections')->patchEntity($collection, $this->request->getData());
            if ($this->table('Collections')->save($collection)) {
                $this->Flash->success(__('The collection has been saved.'));

                return $this->redirect(['action' => 'collections']);
            }
            $this->Flash->error(__('The collection could not be saved. Please, try again.'));
        }
        $users = $this->table('Collections')->Users->find('list', ['limit' => 200]);
        $this->set(compact('collection', 'users'));
    }


    public function twitterLogin()
    {
        if (isset($this->request->getQuery()['type'])) {
            $this->session->write('twitter_login_type', "1");
        }

        // Important: screenname instead of TwitterEmail
        $data = [];

        include_once APP . DS . "Utility" . DS . "twitter-oauth-php-codexworld" . DS . "twitteroauth.php";
        $consumerKey = '1hBHL9gAnz7Ejerp4fwl1COgB'; //New
        $consumerSecret = '16qwasUuZR6eGx5E74R7aKIfH8EIWcTGaJQTfIt0I6fehV7t69';
        // $oauthCallback = base_url() . "Account/TwitterLogin";
        $oauthCallback = \Cake\Routing\Router::url(['controller' => "Account", 'action' => 'twitterLogin'], true);

        $userData = array();
        // print_r($this->request->getQuery()['oauth_token']);exit;
        // Get existing token and token secret from session
        $sessToken = $this->session->read('twitter_token');
        $sessTokenSecret = $this->session->read('twitter_token_secret');

        if (isset($this->request->getQuery()['oauth_token']) && $sessToken == $this->request->getQuery()['oauth_token']) {

            //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new \TwitterOAuth($consumerKey, $consumerSecret, $sessToken, $sessTokenSecret);
            $accessToken = $connection->getAccessToken($this->request->getQuery()['oauth_verifier']);
            if ($connection->http_code == '200') {
                // Get the user's twitter profile info
                $userInfo = $connection->get('account/verify_credentials');

                // Preparing data for database insertion
                $name = explode(" ", $userInfo->name);
                $first_name = isset($name[0]) ? $name[0] : '';
                $last_name = isset($name[1]) ? $name[1] : '';
                if ($this->session->check("twitter_login_type")) {
                    $this->session->delete('twitter_login_type');
                    // $this->session->write('twitter_profile_image', $userInfo->profile_image_url);
                    $script = '<script>window.opener.twitter_for_profile2("' . $userInfo->profile_image_url . '"); window.close();</script>';
                    echo $script;
                    exit;
                    // $this->render('followers_container');


                } else {

                    $updateData - [
                        "is_connect_twitter" => 1,
                        "twitter_email" => $userInfo->screen_name,
                        "twitterid" => $userInfo->id,
                        "twitter_image" => $userInfo->profile_image_url,
                    ];
                    $userUpdate = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
                    $userUpdate = $this->table('Users')->patchEntity($user, $updateData);
                    if ($this->table('Users')->save($user)) {
                    }
                }


                //$this->session_account_data = $this->account_model->setting_data($this->session->read('Member_ID'));

                // Get latest tweets
                // $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $userInfo->screen_name, 'count' => 5));

                // Store the status and user profile info into session
                $userData['accessToken'] = $accessToken;
                $this->session->write('is_twitter_verify', 'verified');
                $this->session->write('twitterData', $userData);
            } else {
                $data['error_msg'] = 'Authentication failed, please try again later!';
            }
        } else {


            //Fresh authentication
            $this->session->delete('twitter_token');
            $this->session->delete('twitter_token_secret');

            $connection = new \TwitterOAuth($consumerKey, $consumerSecret);
            // print_r($oauthCallback);exit;
            $requestToken = $connection->getRequestToken($oauthCallback);
            // print_r($requestToken);exit;

            $this->session->write('twitter_token', $requestToken['oauth_token']);
            $this->session->write('twitter_token_secret', $requestToken['oauth_token_secret']);

            if ($connection->http_code == '200') {
                //Get twitter oauth url
                $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
                // $data['oauthURL'] = $twitterUrl;
                // print_r($twitterUrl);exit;
                // redirect($twitterUrl);
                $this->redirect($twitterUrl);
            } else {
                // $oauthCallback = \Cake\Routing\Router::url(['controller' => "Account", 'action' => 'twitterLogin'], true);
                $data['oauthURL'] = \Cake\Routing\Router::url(['controller' => "Account", 'action' => 'twitterLogin'], true);
                $data['error_msg'] = 'Error connecting to twitter! try again later!';
            }
        }
        if (isset($data['error_msg'])) {
            echo $data['error_msg'];
        } else {
            echo "<script>window.opener.connect_load_for_childwindow();window.close(); </script>";
        }
    }


    public function profile()
    {
        // return \Cake\Routing\Router::url(['controller' => "Account", 'action' => 'twitterLogin'], true);

        if (!empty($this->Authentication->getIdentity())) {
            return $this->redirect(['prefix' => false, 'controller' => 'user', 'action' => 'index', $this->currentUser->username]);
        }
        return $this->redirect($this->referer());
    }

    public function addEmail()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        // dd($this->request->getData());
        $user = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());
        if ((new \Cake\Auth\DefaultPasswordHasher)->check($this->request->getData()['password'], $user->password)) {
            $user_email = $this->table('Users')->find()->where(['email' => $this->request->getData()['email']])->first();
            if (empty($user_email)) {
                $user_email = $this->table('UserEmails')->find()->where(['email' => $this->request->getData()['email']])->first();
                if (empty($user_email)) {
                    $data = $this->request->getData();
                    if ($this->Custom->saveUserEmail($data)) {
                        $sendEmail = $this->Custom->sendConfirmationEmail($user, $user_email);

                        $data['email'] =  $user->email; //save default email
                        $this->Custom->saveUserEmail($data, true);

                        $this->Flash->success(__('Check your email for a confirmation link.'));
                    }
                } else {
                    if ($user_email->user_id == $this->Authentication->getIdentity()->getIdentifier()) {
                        $this->Flash->default(__('This email has already been added to your account'));
                    } else {
                        $this->Flash->default(__('This email has already been added to another user\'s  account'));
                    }
                }
            } else {
                if ($user_email->email == $user->email) {
                    $this->Flash->default(__('This email is already added as the primary email on your account'));
                } else {
                    $this->Flash->default(__('This email is already asssociated with an account on localinspire. You can merge the account into yours if you own both accounts'));
                }
            }
        } else {
            $this->Flash->error(__('Incorrect password'));
        }
        return $this->redirect($this->referer());
    }
}
