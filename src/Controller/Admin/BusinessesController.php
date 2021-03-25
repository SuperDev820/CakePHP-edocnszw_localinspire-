<?php
declare(strict_types=1);

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Businesses Controller
 *
 * @property \App\Model\Table\BusinessesTable $Businesses
 *
 * @method \App\Model\Entity\Business[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BusinessesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "businesses");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['editReview', 'toggleReviewStatus']
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

    public function editRequests()
    {

        $this->set('page', "businessesedits");
    }

    public function toggleReviewStatus($id)
    {
        $review = $this->table('BusinessReviews')->get($id);
        $review->approved = !$review->approved;
        if ($this->table('BusinessReviews')->save($review)) {
            if ($review->approved) {
                $this->Flash->success(__('The review has been approved.'));
            } else {
                $this->Flash->default(__('The review has been disapproved.'));
            }
        }
        return $this->redirect($this->referer());
    }

    public function reportOkay($id, $model)
    {
        $report = $this->table($model)->get($id);
        // $report->treated = !$treated->treated;
        $report->treated = true;
        if ($this->$model->save($report)) {
            $this->Flash->success(__('Done'));
        }
        return $this->redirect($this->referer());
    }




    public function deleteReview($id)
    {
        $review = $this->table('BusinessReviews')->find()->where(['id' => $id])->contain([])->first();
        if (empty($review)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessReviews')->delete($review)) {
            $this->Flash->success(__('The review has been removed.'));
        }
        return $this->redirect($this->referer());
    }

    public function deletePhotoReport($id)
    {
        $report = $this->table('PhotoReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('PhotoReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteProfileReport($id)
    {
        $report = $this->table('ProfileReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('ProfileReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteQuestionReport($id)
    {
        $report = $this->table('QuestionReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('QuestionReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteReviewPhoto($id)
    {
        $photo = $this->table('BusinessReviewPhotos')->find()->where(['id' => $id])->contain([])->first();
        if (empty($photo)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessReviewPhotos')->delete($photo)) {
            $this->table('ReviewPhotoReports')->deleteAll(['business_review_photo_id' => $photo->id]);
            $this->Flash->success(__('The photo and all associated reports have been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteReviewPhotoReport($id)
    {
        $report = $this->table('ReviewPhotoReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('ReviewPhotoReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteBusinessReviewOwnerReport($id)
    {
        $report = $this->table('BusinessReviewOwnerReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessReviewOwnerReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }

    public function deleteBusinessReviewReport($id)
    {
        $report = $this->table('BusinessReviewReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessReviewReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }

    public function deleteQuestion($id)
    {
        $question = $this->table('Questions')->find()->where(['id' => $id])->contain([])->first();
        if (empty($question)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('Questions')->delete($question)) {
            $this->table('QuestionReports')->deleteAll(['question_id' => $question->id]);
            $this->Flash->success(__('The question and all associated reports have been removed.'));
        }
        return $this->redirect($this->referer());
    }


    public function editAnswer($id)
    {
        $answer = $this->table('Answers')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->table('Answers')->patchEntity($answer, $this->request->getData());
            if ($this->table('Answers')->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                $this->table('AnswerReports')->updateAll(
                    ['treated' => 1], // fields
                    ['answer_id' => $id]
                );

                return $this->redirect(['action' => 'editAnswer', $id]);
            }
            $this->Flash->error(__('The answer could not be saved. Please, try again.'));
        }
        $this->set(compact('answer'));
    }

    public function editQuestion($id)
    {
        $question = $this->table('Questions')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->table('Questions')->patchEntity($question, $this->request->getData());
            if ($this->table('Questions')->save($question)) {
                $this->Flash->success(__('The question has been saved.'));
                $this->table('QuestionReports')->updateAll(
                    ['treated' => 1], // fields
                    ['question_id' => $id]
                );

                return $this->redirect(['action' => 'editQuestion', $id]);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    public function editReviewResponse($id)
    {
        $reply = $this->table('BusinessReviewReplies')->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reply = $this->table('BusinessReviewReplies')->patchEntity($reply, $this->request->getData());
            if ($this->table('BusinessReviewReplies')->save($reply)) {
                $this->Flash->success(__('The reply has been saved.'));
                $this->table('BusinessReviewOwnerReports')->updateAll(
                    ['treated' => 1], // fields
                    ['business_review_id' => $reply->business_review_id]
                );

                return $this->redirect(['action' => 'editReviewResponse', $id]);
            }
            $this->Flash->error(__('The reply could not be saved. Please, try again.'));
        }
        $this->set(compact('reply'));
    }


    public function deleteAnswer($id)
    {
        $answer = $this->table('Answers')->find()->where(['id' => $id])->contain([])->first();
        if (empty($answer)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('Answers')->delete($answer)) {
            $this->table('AnswerReports')->deleteAll(['answer_id' => $answer->id]);
            $this->Flash->success(__('The question has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteAnswerReport($id)
    {
        $report = $this->table('AnswerReports')->find()->where(['id' => $id])->contain([])->first();
        if (empty($report)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('AnswerReports')->delete($report)) {
            $this->Flash->success(__('The report has been removed.'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteBusinessPhoto($id)
    {
        $photo = $this->table('BusinessPhotos')->find()->where(['id' => $id])->contain([])->first();
        if (empty($photo)) {
            return $this->redirect($this->referer());
        }
        if ($this->table('BusinessPhotos')->delete($photo)) {
            $this->table('PhotoReports')->deleteAll(['business_photo_id' => $photo->id]);
            $this->Flash->success(__('The photo and all associated reports have been removed.'));
        }
        return $this->redirect($this->referer());
    }

    public function editReview($slug = null, $city = null, $statecode = null, $id = null)
    {
        $this->viewBuilder()->setLayout('Theme.theme');
        // $this->viewBuilder()->setTheme("Theme");

        $review = $this->Custom->getBusinessReviews(null, $id)->first();
        $this->set('review', $review);
        if (empty($review)) {
            return $this->redirect($this->referer());
        }
        $business = $this->Custom->getBusiness($review->business_id);
        $this->set('business', $business);

        $recent_reviews = $this->Custom->getBusinessReviews($business->id)->limit(10)->toArray();
        $this->set('recent_reviews', $recent_reviews);

        $review_options = $this->Custom->getReviewOptions(!empty($business->categories[0]) ? $business->categories[0] : null);
        $this->set('review_options', $review_options);


        $this->Custom->recommendLogic($review, $this->request->getQuery());

        // dd($this->request->getParam('_csrfToken'));

    }

    public function declineRequest($id)
    {
        $business_edit = $this->Custom->getBusinessEdits($id)->first();
        $business_edit->declined = true;
        if ($this->table('BusinessEdits')->save($business_edit)) {
            $this->Flash->success(__('Edit request declined'));
        }
        return $this->redirect($this->referer());
    }
    public function deleteEditRequest($id)
    {
        $business_edit = $this->Custom->getBusinessEdits($id)->first();
        if ($this->table('BusinessEdits')->delete($business_edit)) {
            $this->Flash->success(__('Edit request declined'));
        }
        return $this->redirect($this->referer());
    }
    public function approveRequest($id)
    {
        $business_edit = $this->Custom->getBusinessEdits($id)->first();
        $business = $this->Custom->getBusiness($business_edit->business_id);
        $edits = json_decode($business_edit->edits_json, true);
        $business = $this->table('Businesses')->patchEntity($business, $edits);
        if ($this->table('Businesses')->save($business)) {
            $business_edit->approved = true;
            $this->table('BusinessEdits')->save($business_edit);
            if (!empty($edits['additionals'])) {
                $this->Custom->saveAdditionals($business, $edits['additionals']);
            }
            if (!empty($edits['hours'])) {
                $this->Custom->saveHours($business, $edits['hours']);
            }
            $this->Flash->success(__('The business has been saved.'));

            // return $this->redirect(["prefix" => false,  "controller" => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
        }
        return $this->redirect($this->referer());
    }
    public function modifyEditRequest($id)
    {
        $this->viewBuilder()->setLayout('Theme.theme');
        // $this->viewBuilder()->setTheme("Theme");

        $business_edit = $this->Custom->getBusinessEdits($id)->first();
        // dd($business_edit);
        $business = $this->Custom->getBusiness($business_edit->business_id);
        $business = $this->table('Businesses')->patchEntity($business, json_decode($business_edit->edits_json, true));
        if ($this->request->is(['patch', 'post', 'put'])) {

            $business = $this->table('Businesses')->patchEntity($business, $this->request->getData());
            if ($this->table('Businesses')->save($business)) {

                if (!empty($this->request->getData()['additionals'])) {
                    $this->Custom->saveAdditionals($business, $this->request->getData()['additionals']);
                }
                if (!empty($this->request->getData()['hours'])) {
                    $this->Custom->saveHours($business, $this->request->getData()['hours']);
                }
                $this->Flash->success(__('The business has been saved.'));

                return $this->redirect(["prefix" => false,  "controller" => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);
            }
        }
        $days = $this->table('Days')->find('list', ['limit' => 200]);
        $cities = $this->table('Businesses')->Cities->find('list', ['limit' => 2000]);
        $states = $this->table('States')->find('list', ['limit' => 2000]);
        $categories = $this->table('Businesses')->Categories->find('list', ['limit' => 2000]);
        $subcategories = $this->table('Businesses')->Subcategories->find('list', ['limit' => 2000]);
        $this->set(compact('business_edit', 'business', 'cities', 'states', 'categories', 'subcategories', 'days'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Business id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $business = $this->table('Businesses')->get($id);
        if ($this->table('Businesses')->delete($business)) {
            $this->Flash->success(__('The business has been deleted.'));
        } else {
            $this->Flash->error(__('The business could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
