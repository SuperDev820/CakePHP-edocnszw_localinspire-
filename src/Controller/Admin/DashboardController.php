<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "dashboard");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', ['index']);
        // }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        // $startDate = (new \DateTime('first day of this month'))->format("Y-m-d H:i:s");
        // $endDate = (new \DateTime())->format("Y-m-d H:i:s");
        // $label = "This Month";

        // $startDate = (new \DateTime('first day of last year'))->format("Y-m-d H:i:s");
        $startDate = (new \DateTime('2017-01-01 00:00:00'))->format("Y-m-d H:i:s");
        $endDate = (new \DateTime())->format("Y-m-d H:i:s");
        $label = "All Time";
        // dd($startDate);

        if ($this->request->is(['patch', 'post', 'put'])) { //date range 

            $startDate = $this->request->getData()['startDate'];
            $endDate = $this->request->getData()['endDate'];
            $label = $this->request->getData()['label'];
        }
        $this->set('label', $label);

        $users_count = $this->table('Users')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Users.created', $startDate, $endDate);
            }])->count();

        $total_reviews = $this->table('BusinessReviews')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('BusinessReviews.created', $startDate, $endDate);
            }])->count();


        $total_answers = $this->table('Answers')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Answers.created', $startDate, $endDate);
            }])->count();

        $total_questions = $this->table('Questions')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Questions.created', $startDate, $endDate);
            }])->count();

        $helpful_reviews = $this->table('HelpfulReviews')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('HelpfulReviews.created', $startDate, $endDate);
            }])->count();

        $helpful_questions = $this->table('HelpfulReviews')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('HelpfulReviews.created', $startDate, $endDate);
            }])->count();

        $messages_count = $this->table('Messages')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Messages.created', $startDate, $endDate);
            }])->count();

        $businesses_count = $this->table('Businesses')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Businesses.created', $startDate, $endDate);
            }])->count();

        $subscription_payments = $this->table('Subscriptions')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Subscriptions.created', $startDate, $endDate);
            }])->sumOf('amount');

        $subscription_discounts = $this->table('Subscriptions')->find()
            ->where([function ($exp, $q) use ($startDate, $endDate) {
                return $exp->between('Subscriptions.created', $startDate, $endDate);
            }])->sumOf('discount');

        $profit = ($subscription_payments - $subscription_discounts);
        // $total_visitors = 
        // $active_visitors

        $this->set(compact('users_count', 'total_reviews', 'total_questions', 'total_answers', 'startDate', 'endDate', 'helpful_questions', 'helpful_reviews', 'messages_count', 'businesses_count','subscription_payments','subscription_discounts','profit'));
    }
}
