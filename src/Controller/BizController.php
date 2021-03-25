<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Biz Controller
 *
 *
 * @method \App\Model\Entity\Biz[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BizController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        if (!$this->isBusinessOwner) {
            $this->Custom->goToAccount();
        }
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', ['settings', 'addSpecialOffer', 'editSpecialOffer', 'addAnnouncement', 'editAnnouncement', 'editCallToAction']);
        // }

        // upgrade
        if (!empty($this->currentUser)) {
            $active_business = $this->Custom->getBusiness($this->currentUser->active_business);
            if ($active_business->restricted and $this->getRequest()->getParam('action') != 'upgrade') {
                $this->Flash->default(__('Please upgrade your account to proceed'));
                $this->Custom->goToUpgrade();
            }
        }
    }

    public function switch($id)
    {
        $this->Custom->setActiveBusiness($id);
        $business = $this->Custom->getBusiness($id);
        $this->Flash->success(__('You\'re now managing ' . $business->name));
        return $this->redirect($this->referer());
        // return $this->redirect(['controller' => 'account', 'action' => 'index']);
    }

    public function index()
    {
    }

    public function activity()
    {
        $views_total = $this->Custom->bizViewsCount($this->currentUser->active_business);
        $views_today = $this->Custom->bizViewsCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $views_this_week = $this->Custom->bizViewsCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $views_this_month = $this->Custom->bizViewsCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $this->set(compact('views_total', 'views_today', 'views_this_week', 'views_this_month'));


        $reviews_total =  $this->Custom->bizReviewsCount($this->currentUser->active_business);
        $reviews_today = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $reviews_this_week = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $reviews_this_month = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $this->set(compact('reviews_total', 'reviews_today', 'reviews_this_week', 'reviews_this_month'));


        $male_reviews_total =  $this->Custom->bizReviewsCount($this->currentUser->active_business, null, null, true);
        $male_reviews_today = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $male_reviews_this_week = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $male_reviews_this_month = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $male_recommends = $this->Custom->bizReviewsCount($this->currentUser->active_business, null, null, true, false, true);

        $this->set(compact('male_reviews_total', 'male_reviews_today', 'male_reviews_this_week', 'male_reviews_this_month', 'male_recommends'));


        $female_reviews_total =  $this->Custom->bizReviewsCount($this->currentUser->active_business, null, null, false, true);
        $female_reviews_today = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $female_reviews_this_week = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $female_reviews_this_month = $this->Custom->bizReviewsCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $female_recommends = $this->Custom->bizReviewsCount($this->currentUser->active_business, null, null, false, true, true);

        $this->set(compact('female_reviews_total', 'female_reviews_today', 'female_reviews_this_week', 'female_reviews_this_month', 'female_recommends'));



        $saves_total =  $this->Custom->bizSavesCount($this->currentUser->active_business);
        $saves_today = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $saves_count_this_week = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $saves_count_this_month = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        $this->set(compact('saves_total', 'saves_today', 'saves_count_this_week', 'saves_count_this_month'));

        $male_saves_total =  $this->Custom->bizSavesCount($this->currentUser->active_business, null, null, true);
        $male_saves_today = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $male_saves_this_week = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $male_saves_this_month = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), true);
        $this->set(compact('male_saves_total', 'male_saves_today', 'male_saves_this_week', 'male_saves_this_month'));

        $female_saves_total =  $this->Custom->bizSavesCount($this->currentUser->active_business, null, null, false, true);
        $female_saves_today = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $female_saves_this_week = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $female_saves_this_month = $this->Custom->bizSavesCount($this->currentUser->active_business, (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"), false, true);
        $this->set(compact('female_saves_total', 'female_saves_today', 'female_saves_this_week', 'female_saves_this_month'));




        $business_review_shares = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_id' => true]);
        $business_review_shares_facebook = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_id' => true, 'facebook' => true]);
        $business_review_shares_twitter = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_id' => true, 'twitter' => true]);
        $this->set(compact('business_review_shares', 'business_review_shares_facebook', 'business_review_shares_twitter'));

        $business_question_shares = $this->Custom->bizSharesCount($this->currentUser->active_business, ['question_id' => true]);
        $business_question_shares_facebook = $this->Custom->bizSharesCount($this->currentUser->active_business, ['question_id' => true, 'facebook' => true]);
        $business_question_shares_twitter = $this->Custom->bizSharesCount($this->currentUser->active_business, ['question_id' => true, 'twitter' => true]);
        $this->set(compact('business_question_shares', 'business_question_shares_facebook', 'business_question_shares_twitter'));


        $business_photo_shares = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_photo_id' => true, 'business_photo_id' => true]);
        $business_photo_shares_facebook = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_photo_id' => true, 'business_photo_id' => true, 'facebook' => true]);
        $business_photo_shares_twitter = $this->Custom->bizSharesCount($this->currentUser->active_business, ['business_review_photo_id' => true, 'business_photo_id' => true, 'twitter' => true]);
        $this->set(compact('business_photo_shares', 'business_photo_shares_facebook', 'business_photo_shares_twitter'));


        $this->Custom->businessSharesAndClicks($this->currentUser->active_business);

        // $shares_count =  $this->Custom->bizSharesCount($this->currentUser->active_business);
        // $shares_count_today =  $this->Custom->bizSharesCount($this->currentUser->active_business, (new \DateTime('today'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        // $shares_count_this_week = $this->Custom->bizSharesCount($this->currentUser->active_business, (new \DateTime('first day of this week'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        // $this->set(compact('shares_count', 'shares_count_today', 'shares_count_this_week'));

        $this->Custom->getNotificationsLogic($this->getRequest()->getQuery());
    }

    public function photos()
    {
        $my_added_photos = $this->Custom->getBusinessPhotos($this->currentUser->active_business)
            ->where(['BusinessPhotos.user_id' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        $this->set('my_added_photos', $my_added_photos);

        $my_review_photos = $this->Custom->getBusinessReviewPhotos($this->currentUser->active_business, false)
            ->andWhere(['BusinessReviewPhotos.user_id' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        $this->set('my_review_photos', $my_review_photos);

        $all_my_photos = array_merge($my_added_photos, $my_review_photos);
        $this->set('all_my_photos', $all_my_photos);

        $users_added_photos = $this->Custom->getBusinessPhotos($this->currentUser->active_business)
            ->where(['BusinessPhotos.user_id IS NOT' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        $this->set('users_added_photos', $users_added_photos);

        $review_photos = $this->Custom->getBusinessReviewPhotos($this->currentUser->active_business, false)
            ->andWhere(['BusinessReviewPhotos.user_id IS NOT' => $this->Authentication->getIdentity()->getIdentifier()])->toArray();
        $this->set('review_photos', $review_photos);

        $all_business_photos_unsorted = array_merge($users_added_photos, $review_photos);
        $this->set('all_business_photos_unsorted', $all_business_photos_unsorted);
    }


    public function reviews()
    {
        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);
        $this->Custom->getBusinessReviewsLogic($active_business->id, null, null, $this->request->getQueryParams());
    }

    public function feature()
    {
        // $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan);

        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);
        $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->sponsored_plan);
        // if (!$active_business->sponsored) {
        //     $this->Flash->default(__('Please upgrade to a sponsored listing plan to be able to create a featured ad'));
        //     return $this->redirect(['action' => 'upgrade']);
        // }
        $featuredReview = $this->Custom->getfeaturedReview($this->currentUser->active_business);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $active_business->featured_ad = true;
            $active_business->description = $this->request->getData()['description'];
            if ($this->table('Businesses')->save($active_business)) {
                $this->Flash->success(__('Your featured Business Ad has been activated'));
                return $this->redirect(['action' => 'feature']);
            }
            $this->Flash->error(__('Your featured Business Ad could not be activated. Please, try again.'));
        }


        $business_photos = $this->Custom->getBusinessPhotos($active_business->id)->toArray();
        $this->set('business_photos', $business_photos);

        $review_photos = $this->Custom->getBusinessReviewPhotos($active_business->id);
        $this->set('review_photos', $review_photos);

        $all_business_photos_unsorted = array_merge($business_photos, $review_photos);
        // $this->set('all_business_photos_unsorted', $all_business_photos_unsorted);
        // $this->set('all_business_photos', $all_business_photos_unsorted);

        $collection = new \Cake\Collection\Collection($all_business_photos_unsorted);
        $all_business_photos = array_values($collection->sortBy('slide', SORT_DESC)->toArray());


        $this->set('all_business_photos', $all_business_photos);
        // dd($all_business_photos);

        $featured_ad = $this->Custom->getFeaturedAd($active_business->id)->first();

        $this->set(compact('featuredReview', 'active_business', 'featured_ad'));
    }

    public function featureReview($id)
    {
        $this->request->allowMethod('post');
        $active_business = $this->Custom->getBusiness($this->currentUser->active_business);
        $this->table('BusinessReviews')->updateAll(
            ['featured' => false], // fields
            ['business_id' => $active_business->id]
        );

        $this->table('BusinessReviews')->updateAll(
            ['featured' => true], // fields
            ['BusinessReviews.id' => $id]
        );
        $this->table('Businesses')->updateAll(
            ['featured_ad' => true], // fields
            ['Businesses.id' => $id]
        );
        $this->Flash->success(__('Featured review has been updated'));
        return $this->redirect($this->referer());
    }

    public function callToAction()
    {
        $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan);
    }

    public function editCallToAction()
    {
        $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan);
        $cta = $this->table('Ctas')->find()->where(['business_id' => $this->currentUser->active_business, 'active' => true])->first();
        if (empty($cta)) {
            $cta = $this->table('Ctas')->newEmptyEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cta = $this->table('Ctas')->patchEntity($cta, $this->request->getData());
            $cta->business_id = $this->currentUser->active_business;
            if ($this->table('Ctas')->save($cta)) {
                $this->Flash->success(__('call to action button has been saved'));
                return $this->redirect(['action' => 'callToAction']);
            }
        }
        $this->set(compact('cta'));
    }


    public function specialOffers()
    {
        $this->Custom->getBusinessOffersLogic($this->currentUser->active_business, $this->request->getQueryParams());
    }

    public function addSpecialOffer()
    {
        $offer = $this->table('Offers')->newEmptyEntity();
        if ($this->request->is('post')) {

            $offer = $this->table('Offers')->patchEntity($offer, $this->request->getData());
            $offer->business_id = $this->active_business->id;
            $offer->start_date = $this->Custom->convertToTimestamp($this->request->getData()['start_date']);
            $offer->stop_date = $this->Custom->convertToTimestamp($this->request->getData()['stop_date']);
            if ($this->table('Offers')->save($offer)) {
                $this->Flash->success(__('The offer has been saved.'));

                return $this->redirect(['action' => 'specialOffers']);
            }
            $this->Flash->error(__('The offer could not be saved. Please, try again.'));
        }
        $this->set(compact('offer'));
    }


    public function editSpecialOffer($id)
    {
        $offer = $this->table('Offers')->get($id, [
            'contain' => ['Businesses'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $offer = $this->table('Offers')->patchEntity($offer, $this->request->getData());
            $offer->start_date = $this->Custom->convertToTimestamp($this->request->getData()['start_date']);
            $offer->stop_date = $this->Custom->convertToTimestamp($this->request->getData()['stop_date']);
            if ($this->table('Offers')->save($offer)) {
                $this->Flash->success(__('Offer has been saved'));
                return $this->redirect(['action' => 'specialOffers']);
            }
        }
        $this->set(compact('offer'));
    }

    public function activateOffer($id = null)
    {
        $this->request->allowMethod(['post']);
        $offer = $this->table('Offers')->get($id);
        $offer->active = true;
        if ($this->table('Offers')->save($offer)) {
            $this->Flash->success(__('The offer has been activated.'));
        } else {
            $this->Flash->error(__('The offer could not be activated. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function pauseOffer($id = null)
    {
        $this->request->allowMethod(['post']);
        $offer = $this->table('Offers')->get($id);
        $offer->active = false;
        if ($this->table('Offers')->save($offer)) {
            $this->Flash->success(__('The offer has been deactivated.'));
        } else {
            $this->Flash->error(__('The offer could not be deactivated. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function deleteOffer($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $offer = $this->table('Offers')->get($id);
        if ($this->table('Offers')->delete($offer)) {
            $this->Flash->success(__('The offer has been deleted.'));
        } else {
            $this->Flash->error(__('The offer could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function announcements()
    {
        $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan);
        $this->Custom->getBusinessAnnouncementsLogic($this->currentUser->active_business, $this->request->getQueryParams());
    }

    public function addAnnouncement()
    {
        $this->Access->businessHasAccess($this->currentUser->active_business, $this->Access->enhanced_plan);

        $announcement = $this->table('Announcements')->newEmptyEntity();
        if ($this->request->is('post')) {

            $announcement = $this->table('Announcements')->patchEntity($announcement, $this->request->getData());
            $announcement->business_id = $this->active_business->id;
            $announcement->start_date = $this->Custom->convertToTimestamp($this->request->getData()['start_date']);
            $announcement->stop_date = $this->Custom->convertToTimestamp($this->request->getData()['stop_date']);
            if ($this->table('Announcements')->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));

                return $this->redirect(['action' => 'announcements']);
            }
            $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
        }
        $this->set(compact('announcement'));
    }

    public function editAnnouncement($id)
    {
        $announcement = $this->table('Announcements')->get($id, [
            'contain' => ['Businesses'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $announcement = $this->table('Announcements')->patchEntity($announcement, $this->request->getData());
            $announcement->start_date = $this->Custom->convertToTimestamp($this->request->getData()['start_date']);
            $announcement->stop_date = $this->Custom->convertToTimestamp($this->request->getData()['stop_date']);
            if ($this->table('Announcements')->save($announcement)) {
                $this->Flash->success(__('Announcement has been saved'));
                return $this->redirect(['action' => 'announcements']);
            }
        }
        $this->set(compact('announcement'));
    }

    public function activateAnnouncement($id = null)
    {
        $this->request->allowMethod(['post']);
        $announcement = $this->table('Announcements')->get($id);
        $announcement->active = true;
        if ($this->table('Announcements')->save($announcement)) {
            $this->Flash->success(__('The announcement has been activated.'));
        } else {
            $this->Flash->error(__('The announcement could not be activated. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function pauseAnnouncement($id = null)
    {
        $this->request->allowMethod(['post']);
        $announcement = $this->table('Announcements')->get($id);
        $announcement->active = false;
        if ($this->table('Announcements')->save($announcement)) {
            $this->Flash->success(__('The announcement has been deactivated.'));
        } else {
            $this->Flash->error(__('The announcement could not be deactivated. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function deleteAnnouncement($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $announcement = $this->table('Announcements')->get($id);
        if ($this->table('Announcements')->delete($announcement)) {
            $this->Flash->success(__('The announcement has been deleted.'));
        } else {
            $this->Flash->error(__('The announcement could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function share()
    {
        // $this_month = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier(), (new \DateTime('first day of this month'))->format("Y-m-d H:i:s"), (new \DateTime())->format("Y-m-d H:i:s"));
        // $last_month = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier(), (new \DateTime('first day of last month'))->format("Y-m-d H:i:s"), (new \DateTime('last day of last month'))->format("Y-m-d H:i:s"));
        // $overall = $this->Custom->getUserReferralCount($this->Authentication->getIdentity()->getIdentifier());

        // $this->set('this_month', $this_month);
        // $this->set('last_month',  $last_month);
        // $this->set('overall', $overall);

        $this->Custom->businessSharesAndClicks($this->currentUser->active_business);
    }

    public function upgrade()
    {
        $packages = $this->table('Packages')->find('all')->toArray();
        $this->set('packages', $packages);
    }
}
