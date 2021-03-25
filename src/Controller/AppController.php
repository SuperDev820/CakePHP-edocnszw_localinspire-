<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use App\Utility\Custom;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    // public $helpers = ['AssetCompress.AssetCompress', 'Shim.Form'];
    public $currentUser;
    public $notifications_unread;
    public $notifications_unread_messages;
    public $isUserBirthday = false;
    public $isUserAnniversary = false;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Custom');
        $this->loadComponent('Access');
        $this->loadComponent('Chat');
        $this->loadComponent('Notify');


        $this->viewBuilder()->setHelpers(['AssetCompress.AssetCompress', 'Shim.Form']);
        $this->loadComponent('Authentication.Authentication');
        $this->Cu = new Custom();
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');


        $this->viewBuilder()->setLayout('frontend');
        $this->session = $this->request->getSession();

        // $this->Auth->logout();
        if (!empty($this->Authentication->getIdentity())) {
            $this->currentUser = $this->Custom->getUser($this->Authentication->getIdentity()->getIdentifier());

            if ($this->request->is(['get'])) { //ignore the background ajax calls
                $this->currentUser->last_active_time = time();
                $this->table('Users')->save($this->currentUser);
            }
            if (!$this->currentUser->active and $this->request->getParam('action') != 'suspended') {
                $this->Custom->goToSuspendAction();
            }

            $this->notifications_unread = $this->Custom->unreadUserNotifications($this->Authentication->getIdentity()->getIdentifier());
            $this->notifications_unread_messages = $this->Custom->unreadUserMessages($this->Authentication->getIdentity()->getIdentifier());

            $this->isUserBirthday = $this->Cu->timestampIsToday($this->Cu->convertToTimestamp($this->currentUser->dob));
            $this->set('birthdayTimestamp', $this->Cu->convertToTimestamp($this->currentUser->dob));
            $this->isUserAnniversary = $this->Cu->timestampIsToday($this->Cu->convertToTimestamp($this->currentUser->anniversary));
        }
        $this->set('notifications_unread', $this->notifications_unread);
        $this->set('notifications_unread_messages', $this->notifications_unread_messages);
        $this->set('currentUser', $this->currentUser);
        $this->set('isUserBirthday', $this->isUserBirthday);
        $this->set('isUserAnniversary', $this->isUserAnniversary);

        // $this->session->delete('currentLocation');
        $this->currentLocation = null;
        if ($this->session->check("currentLocation")) {
            $this->currentLocation = $this->session->read("currentLocation");
        } else {
            // $this->currentLocation = $this->Cu->getUserLocation("75.175.204.60");
            $this->currentLocation = $this->Cu->getUserLocation($this->request->clientIp());
            // dd($this->currentLocation);
            $this->session->write('currentLocation', $this->currentLocation);
        }
        $this->set('currentLocation', $this->currentLocation);

        $redirectUrl = !empty($this->Authentication) ? $this->Authentication->getLoginRedirect() : '/';
        $this->set('redirectUrl', $redirectUrl);
        $this->isBusinessOwner = false;
        $this->isCityOwner = false;
        $this->visitor_info =  [
            "token" => $this->request->getParam('_csrfToken'), //always the same for same visitor
            "ip" => $this->request->clientIp(),
            "referer" => $this->request->referer(),
            "host" => $this->request->host(),
            "domain" => $this->request->domain(),
            "http_host" => $this->request->getEnv('HTTP_HOST'),
            "user_agent" => $this->request->getEnv('HTTP_USER_AGENT'),
        ];

        if (!empty($this->Authentication->getIdentity())) {
            if (($this->request->getParam('prefix') == 'Admin')) {
                $this->viewBuilder()->setLayout('backend');

                if (!$this->currentUser->sa and !$this->currentUser->admin) {
                    // return $this->redirect($this->referer());
                    $this->Custom->goToHome();
                }
                $this->viewCounts = $this->getViewCounts();
                $this->set("viewCounts", $this->viewCounts);
            }

            $this->isCityOwner = $this->Access->isCityOwner();
            $this->userCities = $this->Access->userCities();
            $this->set("userCities", $this->userCities);

            $this->isBusinessOwner = $this->Access->isBusinessOwner();
            $this->userBusinesses = $this->Access->userBusinesses();
            $this->set("userBusinesses", $this->userBusinesses);

            $this->active_business = $this->Custom->getBusiness($this->currentUser->active_business);
            $this->set('active_business', $this->active_business);
        }
        $this->set("isBusinessOwner", $this->isBusinessOwner);
        $this->set("isCityOwner", $this->isCityOwner);
        $this->currency = '<i class="fa fa-usd"></i>';
        $this->set("currency", $this->currency);


        $this->set("api_pub_key", $this->Access->api_pub_key);
    }

    public function table($model)
    {
        return $this->Custom->table($model);
    }
    private function getViewCounts()
    {
        return [
            'users' => $this->table('Users')->find()->count(),
            'cities' => $this->table('Cities')->find()->count(),
            // 'businesses' => $this->table('Businesses')->find()->count(),
            'packages' => $this->table('Packages')->find()->count(),
            'coupons' => $this->table('Coupons')->find()->count(),
            'subscriptions' => $this->table('Subscriptions')->find()->count(),
            'city_subscriptions' => $this->table('CitySubscriptions')->find()->count(),
            'reminders' => $this->table('Reminders')->find()->where(['active' => true])->count(),
            'search_keywords' => $this->table('SearchKeywords')->find()->count(),
            'filters' => $this->table('Filters')->find()->count(),
            'categories' => $this->table('Categories')->find()->count(),
            'subcategories' => $this->table('Subcategories')->find()->count(),
            'sic2cats' => $this->table('Sic2categories')->find()->count(),
            'sic4cats' => $this->table('Sic4categories')->find()->count(),
            'sic8cats' => $this->table('Sic8categories')->find()->count(),
            'reviews' => $this->table('BusinessReviews')->find()->count(),
            'questions' => $this->table('Questions')->find()->count(),
            'report_profiles' => $this->table('ProfileReports')->find()->count(),
            'report_profiles_untreated' => $this->table('ProfileReports')->find()->where(['treated' => false])->count(),
            'report_questions' => $this->table('QuestionReports')->find()->count(),
            'report_questions_untreated' => $this->table('QuestionReports')->find()->where(['treated' => false])->count(),
            'report_photos' => $this->table('PhotoReports')->find()->count(),
            'report_photos_untreated' => $this->table('PhotoReports')->find()->where(['treated' => false])->count(),
            'report_review_photos' => $this->table('ReviewPhotoReports')->find()->count(),
            'report_review_photos_untreated' => $this->table('ReviewPhotoReports')->find()->where(['treated' => false])->count(),
            'report_review_responses' => $this->table('BusinessReviewOwnerReports')->find()->count(),
            'report_review_responses_untreated' => $this->table('BusinessReviewOwnerReports')->find()->where(['treated' => false])->count(),
            'report_reviews' => $this->table('BusinessReviewReports')->find()->count(),
            'report_reviews_untreated' => $this->table('BusinessReviewReports')->find()->where(['treated' => false])->count(),
            'report_answers' => $this->table('AnswerReports')->find()->count(),
            'report_answers_untreated' => $this->table('AnswerReports')->find()->where(['treated' => false])->count(),
            'edit_requests' => $this->table('BusinessEdits')->find()->where(['approved' => false, 'declined' => false])->count(),
        ];
    }
}
