<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Utility\Custom;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

// use Stripe\Stripe;
// use Stripe\Customer;
// use Stripe\Error\Card;
// use Stripe\Error\InvalidRequest;
// use Stripe\Error\Authentication;
// use Stripe\Error\ApiConnection;
// use Stripe\Error\Base;
// use Stripe\Charge;
// use Stripe\Plan;
// use Stripe\Coupon;
// use Stripe\Event;


/**
 * Access component
 */
class AccessComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $components = ['Custom', 'Flash', 'Auth', 'Notify', 'Chat', 'Authentication'];
    public $free_plan = 1;
    public $enhanced_plan = 2;
    public $sponsored_plan = 3;
    public $city_product = "prod_HOHZOClfWffRaH";
    public $api_pub_key = "pk_test_J2RPMaEvAyZjkkrkhGzmMbpX"; //test
    public $api_secret_key = "sk_test_GtYUoogozemuYUeN7zrWr0kw"; //test

    public function table($model)
    {
        return $this->Custom->table($model);
    }
    public function initialize(array $config): void
    {
        $this->Cu = new Custom();
        // $this->Custom->loadModels($this, $this->getController());
        // $this->table('Subscriptions') = TableRegistry::get('Subscriptions');
        // $this->table('Cities') = TableRegistry::get('Cities');
        // $this->table('CityOwnerEarnings') = TableRegistry::get('CityOwnerEarnings');
        // $this->table('CitySubscriptions') = TableRegistry::get('CitySubscriptions');
        // $this->table('CitySubscriptionCities') = TableRegistry::get('CitySubscriptionCities');
        // $this->table('Packages') = TableRegistry::get('Packages');
        // $this->table('Businesses') = TableRegistry::get('Businesses');
        // $this->table('StripeCustomers') = TableRegistry::get('StripeCustomers');
        $this->initStripe();
    }


    public function initStripe()
    {
        require_once ROOT . DS . 'vendor' . DS . 'stripe' . DS . 'stripe-php' . DS . 'init.php';
        \Stripe\Stripe::setApiKey($this->api_secret_key);
        // \Stripe\Stripe::setApiKey($this->api_pub_key);
    }

    public function cancelSubscription($subscription_id)
    {
        $subscription = $this->table('Subscriptions')->find()->where(['id' => $subscription_id])->first();
        if (!$this->getController()->shouldBeSecure()) {
            $subscription->active = false;
            if ($this->table('Subscriptions')->save($subscription)) {
                $this->Custom->addReminder($subscription->business_id, 1);
            }
            return true;
        }
        if (!empty($subscription) and !empty($subscription->stripe_info)) {
            $stripeInfo = json_decode($subscription->stripe_info, true);
            // dd($stripeInfo);
            try {
                $stripeSubscription = \Stripe\Subscription::retrieve(
                    $stripeInfo['id']
                    // ,['cancel_at_period_end' => true]
                );
                $stripeSubscription->delete();
                // $subscription->jsonSerialize();
                $subscription->active = false;
                if ($this->table('Subscriptions')->save($subscription)) {
                    $this->Custom->addReminder($subscription->business_id, 1);
                }
                return true;
            } catch (\Exception $e) {
                // $api_error = $e->getMessage();
            }
        }
        return false;
    }

    public function citySubscribeAjax($user_id, $cities, $price, $savings)
    {
        $response = ['success' => false];
        $customer = $this->getStripeCustomer($this->_registry->getController()->currentUser);
        if ($customer) {
            // $this->Custom->doLog('subscribe.txt', 'plan: ' . $planid);

            $transactionid = date("ymd") . $this->Custom->randomString(8, true);

            try {
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'customer' =>  $customer->stripeid,
                    // 'customer_email' =>  $this->_registry->getController()->currentUser->email,
                    'client_reference_id' =>  $transactionid, //trasnsaction id
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            // 'product' => $this->city_product,
                            'product_data' => [
                                'name' => 'Subscription for ' . count($cities) . (count($cities) > 1 ? ' cities' : ' city'),
                            ],
                            'unit_amount' => (int) ($price * 100),
                        ],
                        'quantity' => 1,
                        // 'quantity' => $quantity,
                    ]],
                    'mode' => 'payment',
                    // 'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
                    // 'cancel_url' => 'https://example.com/cancel',
                    'success_url' => \Cake\Routing\Router::url(['prefix' => false, 'controller' => 'ClaimCity', 'action' => 'success'], true) . "?transactionid=" . $transactionid . "&session_id={CHECKOUT_SESSION_ID}",
                    'cancel_url' => \Cake\Routing\Router::url(['prefix' => false, 'controller' => 'ClaimCity', 'action' => 'cancel'], true) . "?transactionid=" . $transactionid . "&session_id={CHECKOUT_SESSION_ID}"
                ]);
            } catch (\Exception $e) {
                $api_error = $e->getMessage();
                // dd($api_error);
            }
            if (empty($api_error) && $session) {
                $response['success'] = true;
                // $response['session'] = $session;
                $response['session'] = $session->jsonSerialize();
                $response['citysub'] = $this->addCitySubscription($user_id, $cities, $price, $savings, $response['session'], $transactionid);
            }
        }
        return $response;
    }


    public function checkUserCityAccess($city_id, $user_city_id)
    {
        if ($city_id  != $user_city_id) {
            return $this->getController()->redirect($this->getController()->referer());
        }
    }
    public function claimCities($citySub)
    {
        if (!empty($citySub->city_subscription_cities)) {
            foreach ($citySub->city_subscription_cities as $key => $citysubcity) {
                $city = $this->table('Cities')->get($citysubcity->city_id);
                $city->user_id = $citySub->user_id;
                if ($this->table('Cities')->save($city)) {
                    $this->Custom->setActiveCity($city->id);
                } else {
                    // dd($city);
                }
            }
        }
    }
    public function getCitySubs($id = null, $transactionid = null, $sessionid = null)
    {
        $query = $this->table('CitySubscriptions')->find()->contain(['CitySubscriptionCities']);
        if (!empty($id)) {
            $query->where(['CitySubscriptions.id' => $id]);
        }
        if (!empty($transactionid)) {
            $query->andWhere(['CitySubscriptions.transactionid' => $transactionid]);
        }
        if (!empty($sessionid)) {
            $query->andWhere(['CitySubscriptions.sessionid' => $sessionid]);
        }
        return $query->first();
    }

    public function addCitySubscription($user_id, $cities, $amount, $discount, $stripeSession = null, $transactionid, $active = true)
    {
        $duration = 30;
        $start_timestamp = strtotime("+1 day");;
        $end_timestamp = strtotime("+" . $duration . " day", $start_timestamp);
        $citySub = $this->addCitySub([
            "user_id" => $user_id,
            "duration" => $duration,
            "amount" => $amount,
            "discount" => $discount,
            "start_timestamp" => $start_timestamp,
            "end_timestamp" => $end_timestamp,
            "sessionid" => !empty($stripeSession) ? $stripeSession['id'] : '',
            "transactionid" => !empty($transactionid) ? $transactionid : '',
            "active" => $active,
            "stripe_info" => json_encode($stripeSession),
        ]);
        if (!empty($citySub)) {
            foreach ($cities as $city) {
                $citysubcity = $this->table('CitySubscriptionCities')->find()->where([
                    'city_subscription_id' => $citySub->id, 'city_id' => $city->id
                ])->first();
                if (empty($citysubcity)) {
                    $citysubcity = $this->table('CitySubscriptionCities')->newEmptyEntity();
                }
                $citysubcity->city_subscription_id = $citySub->id;
                $citysubcity->city_id = $city->id;
                if ($this->table('CitySubscriptionCities')->save($citysubcity)) {
                }
            }
            return true;
        }
        return false;
    }

    public function subscribeAjax($package, $payment_method, $pricing, $duration = null)
    {
        // debug("creating subscribeAjax");
        $customer = $this->getStripeCustomer($this->_registry->getController()->currentUser, $payment_method);
        if (!$customer) {
            // $this->Custom->doLog('subscribe.txt', 'no customer');
            return false;
        }

        // $this->Custom->doLog('subscribe.txt', 'has customer');
        // $priceCents = round($pricing * 100);
        $planid =  $duration == "yearly" ? $package->stripe_yearly_plan : $package->stripe_monthly_plan;
        // $this->Custom->doLog('subscribe.txt', 'plan: ' . $planid);
        try {
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->stripeid,
                "items" => [["plan" => $planid]],
                'expand' => ['latest_invoice.payment_intent'],
            ]);
        } catch (\Exception $e) {
            $api_error = $e->getMessage();
            $this->Custom->doLog('subscribe.txt', 'api_error: ' . $api_error);
        }
        if (empty($api_error) && $subscription) {
            // $this->Custom->doLog('subscribe.txt', 'success on stripe');
            // Retrieve subscription data 
            return $subscription->jsonSerialize();
        }
        // $this->Custom->doLog('subscribe.txt', 'stripe failure');
        return false;
    }
    public function updateStripeCustomer($customerid, $token)
    {
        try {
            $customer = \Stripe\Customer::update($customerid, [
                'payment_method' => $token,
                // 'email' => 'jenny.rosen@example.com',
                'invoice_settings' => [
                    'default_payment_method' => $token
                ]
            ]);
            return $customer;
        } catch (\Exception $e) {
            // dd($e);
            return false;
        }
    }
    public function createStripeCustomer($user, $token = null)
    {
        $customerArray = [
            'email' => $user->email,
            'name'  => $user->name_desc
        ];
        if (!empty($token)) {
            $customerArray['payment_method'] = $token;
            $customerArray['invoice_settings'] = [
                'default_payment_method' => $token
            ];
        }
        try {
            // Add customer to stripe 
            $customer = \Stripe\Customer::create($customerArray);
            // debug("creating customer");
            // dd($customer);
            return $customer;
        } catch (\Exception $e) {
            // dd($e);
            return false;
        }
    }
    public function getStripeCustomer($user, $token = null)
    {

        $customer = $this->table('StripeCustomers')->find()->where(['user_id' => $user->id])->first();
        if (!empty($customer) and !empty($token)) {
            // return \Stripe\Customer::retrieve($customer->stripeid);
            $this->updateStripeCustomer($customer->stripeid, $token);
            return $customer;
        }
        // debug("no customer in db");
        $stripeCustomer = $this->createStripeCustomer($user, $token);
        // debug($stripeCustomer);
        if ($stripeCustomer) {
            $customer = $this->table('StripeCustomers')->newEmptyEntity();
            $customer->user_id = $user->id;
            $customer->stripeid = $stripeCustomer->id;
            if ($this->table('StripeCustomers')->save($customer)) {
                return $customer;
            }
        }
        return false;
    }

    public function userCitiesIDs($type = 'all')
    {
        $cities = $this->userCities();
        $ids = [];
        foreach ($cities as $key => $city) {
            if (!in_array($city->id, $ids)) {
                $ids[] = $city->id;
            }
        }
        return $ids;
    }
    public function userCities($type = 'all')
    {
        if (!empty($this->Authentication->getIdentity())) {
            return $this->table('Cities')->find($type)->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        }
        return [];
    }

    public function userBusinesses($type = 'all')
    {
        if (!empty($this->Authentication->getIdentity())) {
            return $this->table('Businesses')->find($type)->where(['user_id' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        }
        return [];
    }

    public function hasEnhanced($business_id)
    {
        if ($this->activeSubscriptions($business_id, false, $this->enhanced_plan)->count() > 0) {
            return true;
        }
        return false;
    }

    public function hasSponsored($business_id)
    {
        if ($this->activeSubscriptions($business_id, false, $this->sponsored_plan)->count() > 0) {
            return true;
        }
        return false;
    }
    public function businessHasAccess($business_id, $package_id, $ajax = false)
    {
        $package = $this->table('Packages')->find()->where(['id' => $package_id])->first();
        $hasAcess = false;
        $active_subscriptions = $this->activeSubscriptions($business_id)->toArray();
        if (!empty($active_subscriptions)) {
            foreach ($active_subscriptions as $subscription) {
                if ($subscription->package_id >= $package_id) {
                    $hasAcess = true;
                }
            }
        }
        // $business = $this->Custom->getBusiness($business_id);
        // if (!empty($business->current_subscription)) {
        //     if ($business->current_subscription->package_id >= $package_id) {
        //         $hasAcess = true;
        //     }
        // }
        if (!$hasAcess) {
            $this->Flash->default(__('Upgrade your business to ' . $package->name . ' to proceed'));
            if ($ajax) {
                return false;
            }
            return $this->_registry->getController()->redirect(['controller' => 'biz', 'action' => 'upgrade']);
        }
        if ($ajax) {
            return true;
        }
        return true;
    }

    public function isBusinessOwner()
    {
        $businesses = $this->userBusinesses();
        if (!empty($businesses)) {
            return true;
        }
        return false;
    }

    public function isCityOwner()
    {
        $cities = $this->userCities();
        if (!empty($cities)) {
            return true;
        }
        return false;
    }

    public function lastActiveSubscriptions($business_id = null)
    {
        return $this->activeSubscriptions($business_id, true);
    }
    public function currentSubscription($business_id)
    {
        return $this->activeSubscriptions($business_id, false, null, true);
    }
    public function UpdateCityOwnerEarnings($subscription)
    {
        $business = $this->Custom->getBusiness($subscription->business_id);
        $active_city_subscription = $this->activeCitySubscriptions($business->city_id, true);
        if (!empty($active_city_subscription)) {
            $city_earning = $this->table('CityOwnerEarnings')->newEmptyEntity();
            $city_earning->subscription_id = $$subscription->id;
            $city_earning->city_id = $business->city_id;
            if ($this->table('CitySubscriptions')->save($city_earning)) {
                return $city_earning;
            }
        }
        return false;
    }

    public function confirmSubscription($id)
    {
        $subscription = $this->table('Subscriptions')->find()->where(['Subscriptions.id' => $id])->contain(['Packages'])->first();
        if (!empty($subscription)) {
            $subscription->active = true;
            $subscription->package_percent = $subscription->package->percentage;
            $subscription->city_owner_amount = $this->Custom->getPercentage($subscription->amount, $subscription->package->percentage);
            if ($this->table('Subscriptions')->save($subscription)) {
                $this->UpdateCityOwnerEarnings($subscription);
                $business = $this->Custom->getBusiness($subscription->business_id);
                $business->restricted = false;
                if ($this->table('Businesses')->save($business)) {
                }
                return true;
            }
        }
        return false;
    }

    public function CityBusinesses($city_id, $startDate =  null, $endDate = null, $cities_id = null)
    {
        $query =  $this->table('Businesses')->find();
        if (!empty($startDate) and !empty($endDate)) {
            $query->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Businesses.created', $startDate, $endDate);
            }]);
        }
        if (!empty($cities_id)) {
            $query->andWhere(['Businesses.city_id IN' => $cities_id]);
        } else {
            $query->andWhere(['Businesses.city_id' => $city_id]);
        }
        return $query;
    }
    public function CityEarnings($city_id, $startDate =  null, $endDate = null, $cities_id = null)
    {
        return $this->CitySubscriptions($city_id, $startDate, $endDate, $cities_id)->sumOf('city_owner_amount');
    }
    public function CitySubscriptions($city_id, $startDate =  null, $endDate = null, $cities_id = null)
    {
        $query = $this->table('Subscriptions')->find();
        if (!empty($startDate) and !empty($endDate)) {
            $query->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Subscriptions.created', $startDate, $endDate);
            }]);
        }
        $query->innerJoinWith('CityOwnerEarnings', function ($q) use ($city_id, $cities_id) {
            if (!empty($cities_id)) {
                return $q->where(['CityOwnerEarnings.city_id IN' => $cities_id]);
            }
            return $q->where(['CityOwnerEarnings.city_id' => $city_id]);
        });
        return $query;
    }

    public function activeCitySubscriptions($city_id = null, $last = false, $first = false)
    {
        $query = $this->table('CitySubscriptions')->find()
            ->where([
                'active' => true, 'paid' => true,
                'CitySubscriptions.end_timestamp >=' => strtotime("now"),
            ])->order(['CitySubscriptions.created' => 'ASC']);

        $query->innerJoinWith('CitySubscriptionCities', function ($q) use ($city_id) {
            return $q->where(['CitySubscriptionCities.city_id' => $city_id]);
        });

        if ($last) {
            $sub = $query->last();
            if (!empty($sub)) {
                $sub->days_left = (int) $this->secondsToDays(($sub->end_timestamp - strtotime("now")));
            }
            return $sub;
        }
        if ($first) {
            $sub = $query->first();
            if (!empty($sub)) {
                $sub->days_left = (int) $this->secondsToDays(($sub->end_timestamp - strtotime("now")));
            }
            return $sub;
        }
        return $query;
    }
    public function activeSubscriptions($business_id = null, $last = false, $package_id = null, $first = false)
    {
        $query = $this->table('Subscriptions')->find()
            ->where([
                'active' => true,
                // 'business_id' => $business_id,
                'Subscriptions.end_timestamp >=' => strtotime("now"),
            ])->order(['Subscriptions.created' => 'ASC'])->contain([
                'Packages', //'Businesses' => $this->Custom->bizContains()
            ]);

        if ($business_id) {
            $query->andWhere(['Subscriptions.business_id' => $business_id]);
        }
        if ($package_id) {
            $query->andWhere(['Subscriptions.package_id' => $package_id]);
        }

        if ($last) {
            $sub = $query->last();
            if (!empty($sub)) {
                $sub->days_left = (int) $this->secondsToDays(($sub->end_timestamp - strtotime("now")));
            }
            return $sub;
        }
        if ($first) {
            $sub = $query->first();
            if (!empty($sub)) {
                $sub->days_left = (int) $this->secondsToDays(($sub->end_timestamp - strtotime("now")));
            }
            return $sub;
        }
        return $query;
    }

    public function secondsToDays($seconds)
    {
        return $this->Cu->secondsToDays($seconds);
    }

    public function subscribe($business_id, $package_id, $duration = null, $stripeSubscription = null, $active = true)
    {
        return $this->addSubscription($business_id, $package_id, $duration, null, $stripeSubscription, $active);

        // $subscription = $this->lastActiveSubscriptions($business_id);
        // if (!empty($subscription)) {
        //     //has existing active subscription, so we add a new one from the end of the existing
        //     //whether or not they are upgrading or downgrading
        //     return $this->addSubscription($business_id, $package_id, $duration, $subscription->end_timestamp);
        // } else {
        //     return $this->addSubscription($business_id, $package_id, $duration);
        // }
    }

    public function addSubscription($business_id, $package_id, $duration = null, $starting_time = null, $stripeSubscription = null, $active = true)
    {
        $package = $this->table('Packages')->find()->where(['id' => $package_id])->first();
        if (!empty($package)) {

            $days = $duration == "yearly" ? 365 : 30;
            $amount = $duration == "yearly" ? $package->price_per_year : $package->price_per_month;

            // $start = !empty($starting_time) ? $starting_time : strtotime("now");
            $start = !empty($starting_time) ? $starting_time : strtotime("+1 day");
            $start_timestamp = !empty($stripeSubscription['current_period_start']) ? $stripeSubscription['current_period_start'] : $start;
            $end_timestamp = !empty($stripeSubscription['current_period_end']) ? $stripeSubscription['current_period_end'] : strtotime("+" . $days . " day", $start);
            return $this->add([
                "business_id" => $business_id,
                "package_id" => $package_id,
                "duration" => $days,
                "amount" => $amount,
                "start_timestamp" => $start,
                "end_timestamp" => $end_timestamp,
                "active" => $active,
                "stripe_info" => json_encode($stripeSubscription),
            ]);
        }
        return false;
    }

    public function addCitySub($data)
    {
        $subscription = $this->table('CitySubscriptions')->newEmptyEntity();
        $subscription = $this->table('CitySubscriptions')->patchEntity($subscription, $data);
        if ($this->table('CitySubscriptions')->save($subscription)) {
            return $subscription;
        }
        // debug($subscription);die();
        return false;
    }
    public function add($data)
    {
        $subscription = $this->table('Subscriptions')->newEmptyEntity();
        $subscription = $this->table('Subscriptions')->patchEntity($subscription, $data);
        if ($this->table('Subscriptions')->save($subscription)) {
            return $subscription;
        }
        // debug($subscription);die();
        return false;
    }
}
