<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 */
class ReportsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->set('page', "reports");
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig(
        //         'unlockedActions',
        //         ['editReview', 'toggleReviewStatus']
        //     );
        // }
    }

    public function answers()
    {
        $this->set('page', "report_answers");
    }
    public function reviews()
    {
        $this->set('page', "report_reviews");
    }
    public function reviewResponses()
    {
        $this->set('page', "report_review_response");
    }
    public function reviewPhotos()
    {
        $this->set('page', "report_review_photo");
    }
    public function photos()
    {
        $this->set('page', "report_photo");
    }
    public function questions()
    {
        $this->set('page', "report_question");
    }
    public function profiles()
    {
        $this->set('page', "report_profile");
    }
}
