<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\View\Helper\TextHelper;
use Cake\View\View;

/**
 * AjaxTable Controller
 *
 *
 * @method \App\Model\Entity\AjaxTable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AjaxTableController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['getUsersAjax', 'reviews', 'questions', 'answers', 'businessPhotos', 'reportedAnswers', 'reportedPhotos', 'reportedProfiles', 'reportedQuestions', 'reportedReviewPhotos', 'filters', 'subscriptions', 'reportedReviewResponses', 'reportedReviews', 'businesses', 'cities', 'subcategories', 'businessesEdits', 'reminders', 'claimcity', 'citysubscriptions', 'posts']);
        // if ($this->shouldBeSecure()) {
        //     $this->Security->setConfig('unlockedActions', ['getUsersAjax', 'reviews', 'questions', 'answers', 'businessPhotos', 'reportedAnswers', 'reportedPhotos', 'reportedProfiles', 'reportedQuestions', 'reportedReviewPhotos', 'filters', 'subscriptions', 'reportedReviewResponses', 'reportedReviews', 'Businesses', 'cities', 'subcategories', 'businessesEdits', 'reminders', 'claimcity', 'citysubscriptions', 'posts']);
        // }
    }


    public function posts($city_id = null, $prefix = false)
    {
        if (empty($city_id)) {
            $city_id = $this->currentUser->active_city;
        }

        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);
        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Posts.id";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Posts.title";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Users.firstname";
        } else {
            $orderByColumnIndex = "Posts.id";
        }
        $query = $this->table('Posts')->find('all')->where(['Posts.city_id' => $city_id])
            ->contain(['Users', 'Tags']);
        $query->order([$orderByColumnIndex => $orderType]);

        $tagid = !empty($request['tagid']) ? (int) $request['tagid'] : '';
        if (!empty($tagid)) {
            $query->innerJoinWith('Tags', function ($q) use ($tagid) {
                return $q->where(['Tags.id' => $tagid]);
            });
        }

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);

            $psQuery = $this->Custom->postsFullTextQuery($search_term);
            $query->where([
                // 'OR' => $mergeQuery,
                'OR' => $psQuery,
            ]);
            // $query->where(['LOWER(Images.title) LIKE' => "%" . strtolower($search_term) . "%"]);
        }


        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', $query->toArray());

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            // $random_id_target =  mt_rand(100000, 999999);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            $data_array[] = $item->title;
            // $data_array[] = !empty($item->user) ? $item->user->name_desc : "Author Not Found";
            $data_array[] = '<img class="img lazy"src="' . $this->Cu->dpUrl($item->image, "posts") . '" alt="' . $item->title . '"style="max-height: 100px;">';
            $data_array[] = $this->Cu->showArrayItemsAsString($item->tags);
            // $data_array = \Cake\View\Helper\FormHelper::control('teacher_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' =>  $this->Custom->getTeachersList($this->currentSchool->id), 'empty' => true, 'label' => false, 'class' => 'form-control ', "style" => "width: 100%"]);
            $data_array[] =
                '<a href="' . Router::url(['prefix' => false, 'controller' => "stories", 'action' => 'view', $item->id, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->title)), 70)]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1"  title="View " target="_blank"><i class="fa fa-search"></i></a>' .
                '<a href="' . Router::url(['prefix' => $prefix, 'controller' => 'manager', 'action' => 'editStory', $item['id']]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1"  title="Edit post" ><i class="fa fa-edit"></i></a> ' .
                //$this->userStatusAndEmailLink($item) .                
                '<a data-postid="' . $item->id . '" title="Delete" href="' . Router::url(['prefix' => $prefix, 'controller' => 'manager', 'action' => 'deleteStory', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this post?\')"  class="delete_post btn btn-xs btn btn-raised btn-icon btn-danger mr-1"><i class="fa fa-trash"></i></a>';


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reportedReviewResponses($user_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviewOwnerReports.description";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "BusinessReviews.Businesses.Users.firstname";
            } elseif ($orderByColumnIndex == '5') {
                // $orderByColumnIndex = "BusinessReviews.BusinessReviewReplies.reply";
            } elseif ($orderByColumnIndex == '6') {
                $orderByColumnIndex = "BusinessReviewOwnerReports.treated";
            } else {
                $orderByColumnIndex = "BusinessReviewOwnerReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "BusinessReviewOwnerReports.description";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviews.Businesses.Users.firstname";
            } elseif ($orderByColumnIndex == '4') {
                // $orderByColumnIndex = "BusinessReviews.BusinessReviewReplies.reply";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "BusinessReviewOwnerReports.treated";
            } else {
                $orderByColumnIndex = "BusinessReviewOwnerReports.id";
            }
        }
        $query = $this->Custom->reportedBusinessReviewOwnerReportsQuery($user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $mergeQuery = array_merge($usersQuery, $profileQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->business_review->business_review_replies);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] =  !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : "Profile not found";
            }
            $data_array[] = $item->description;
            $data_array[] = '<a target="_blank" href="' . Router::url([
                'prefix' => false, 'controller' => 'Businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($item->business_review->business->name)),
                strtolower($item->business_review->business->city->name),
                $item->business_review->business->city->state->code, $item->business_review->id
            ]) . '" >' . $item->business_review->title . ' </a>';
            $data_array[] =  !empty($item->business_review->business->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->business_review->business->user->username]) . '" >' . ucwords($item->business_review->business->user->name_desc) . ' </a>' : "Profile not found";

            $data_array[] = !empty($item->business_review->business_review_replies) ? $item->business_review->business_review_replies[0]->reply : "Reply not found";

            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "BusinessReviewOwnerReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                (!empty($item->business_review->business_review_replies) ? '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editReviewResponse', $item->business_review->business_review_replies[0]->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Response" ><i class="fa fa-edit"></i></a>' : "") .
                (!empty($item->business_review->business->user) ? $this->userStatusAndEmailLink($item->business_review->business->user) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteBusinessReviewOwnerReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    private function bizRestrictionManagement($business_id)
    {
        return '<a title="Allow Owner Access" href="' . Router::url(['prefix' => false, 'controller' => 'Api', 'action' => 'removeRestriction', $business_id]) . '" onclick="return confirm(\'Are you sure you want to allow the business owner access ?\')" class="btn btn-xs btn btn-raised btn-icon btn-success mr-1 btn-sm"><i class="fa fa-play"></i></a>' .
            '<a title="Restrict Owner Access" href="' . Router::url(['prefix' => false, 'controller' => 'Api', 'action' => 'restrictAccess', $business_id]) . '" onclick="return confirm(\'Are you sure you want to restrict the business owner access ?\')" class="btn btn-xs btn btn-raised btn-icon btn-dark mr-1 btn-sm"><i class="fa fa-ban"></i></a>';
    }
    private function userStatusAndEmailLink($user)
    {
        return   '<a title="' . ($user->active ? 'Suspend' : 'Activate') . ' ' . $user->name_desc . '?" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'toggleStatus', $user->id]) . '" onclick="return confirm(\'' . ($user->active ? 'Suspend' : 'Activate') . ' ' . $user->name_desc . ' ?\')" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa ' . ($user->active ? 'fa-toggle-off' : 'fa-toggle-on') . '"></i></a> ' .
            '<a title="Send Email to ' . $user->name_desc . '" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'email', $user->id]) . '" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa fa-envelope"></i></a>';
    }
    public function reportedReviews($user_id = null, $business_review_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviewReports.why_do";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "BusinessReviewReports.specific_detail";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "BusinessReviewReports.treated";
            } else {
                $orderByColumnIndex = "BusinessReviewReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviewReports.why_do";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviewReports.specific_detail";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "BusinessReviewReports.treated";
            } else {
                $orderByColumnIndex = "BusinessReviewReports.id";
            }
        }
        $query = $this->Custom->reportedReviewsQuery($user_id, $business_review_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $revQuery = $this->Custom->businessReviewsFullTextQuery($search_term);
            $mergeQuery = array_merge($usersQuery, $revQuery);
            $query->where([
                'OR' => $mergeQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] =  !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : "Profile not found";
            }
            $data_array[] = '<a target="_blank" href="' . Router::url([
                'prefix' => false, 'controller' => 'Businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($item->business_review->business->name)),
                strtolower($item->business_review->business->city->name),
                $item->business_review->business->city->state->code, $item->business_review->id
            ]) . '" >' . $item->business_review->title . ' </a>';


            $data_array[] = $item->why_do;
            $data_array[] = $item->specific_detail;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "BusinessReviewReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editReview', \Cake\Utility\Text::slug(strtolower($item->business_review->business->name)), $item->business_review->business->city->state->code, $item->business_review->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Review" ><i class="fa fa-edit"></i></a>' .
                (!empty($item->business_review->user) ? $this->userStatusAndEmailLink($item->business_review->user) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteBusinessReviewReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reportedQuestions($user_id = null, $question_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Questions.question";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "QuestionReports.why";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "QuestionReports.specific_detail";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "QuestionReports.treated";
            } else {
                $orderByColumnIndex = "QuestionReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Questions.question";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "QuestionReports.why";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "QuestionReports.specific_detail";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "QuestionReports.treated";
            } else {
                $orderByColumnIndex = "QuestionReports.id";
            }
        }
        $query = $this->Custom->reportedQuestionsQuery($user_id, $question_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $mergeQuery = array_merge($usersQuery, $profileQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] =  !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : "Profile not found";
            }

            $data_array[] =  !empty($item->question) ? '<a target="_blank" href="' . Router::url([
                'prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->question->business->name)),
                strtolower($item->question->business->city->name),
                $item->question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question->question)), 70), $item->question->id
            ]) . '" >' . $item->question->question . ' </a>' : "Question not found";


            $data_array[] = $item->why;
            $data_array[] = $item->specific_detail;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "QuestionReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                (!empty($item->question->user) ? $this->userStatusAndEmailLink($item->user)  : '') .
                (!empty($item->question) ? '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editQuestion', $item->question->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Question" ><i class="fa fa-edit"></i></a>'   : '') .
                (!empty($item->question) ? '<a title="Delete Question" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteQuestion', $item->question->id]) . '" onclick="return confirm(\'Are you sure you want to delete this question?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>'  : '') .
                '<a title="Delete Report" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteQuestionReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reportedProfiles($user_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Profiles.firstname";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "ProfileReports.description";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "ProfileReports.treated";
            } else {
                $orderByColumnIndex = "ProfileReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Profiles.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "ProfileReports.description";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "ProfileReports.treated";
            } else {
                $orderByColumnIndex = "ProfileReports.id";
            }
        }
        $query = $this->Custom->reportedProfilesQuery($user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $profileQuery = $this->Custom->userFullTextQuery($search_term, "Profiles");
            $mergeQuery = array_merge($usersQuery, $profileQuery);
            $query->where([
                'OR' => $mergeQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            $data_array[] = !empty($item->profile) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->profile->username]) . '" >' . ucwords($item->profile->name_desc) . ' </a>' : "Profile not found";

            $data_array[] = $item->description;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "ProfileReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                $this->userStatusAndEmailLink($item->profile) .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteProfileReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }
    public function reportedPhotos($user_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessPhotos.caption";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "PhotoReports.why";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "PhotoReports.specific_detail";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "PhotoReports.treated";
            } else {
                $orderByColumnIndex = "PhotoReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "BusinessPhotos.caption";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "PhotoReports.why";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "PhotoReports.specific_detail";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "PhotoReports.treated";
            } else {
                $orderByColumnIndex = "PhotoReports.id";
            }
        }
        $query = $this->Custom->reportedPhotosQuery($user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            // $mergeQuery = array_merge($usersQuery, $bizQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            $data_array[] = !empty($item->business_photo) ? '<img class="img lazy" src="' . $this->Cu->getDp($item->business_photo->photo, 'Businesses', '210x100') . '" alt="' . $item->business_photo->caption . '" style="max-height: 100px;"> <br> ' . $item->business_photo->caption : "Photo removed or not available";
            $data_array[] = $item->why;
            $data_array[] = $item->specific_detail;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "PhotoReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                (!empty($item->business_photo->user) ? $this->userStatusAndEmailLink($item->business_photo->user) : '') .
                (!empty($item->business_photo) ? '<a title="Delete Photo" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteBusinessPhoto', $item->business_photo->id]) . '" onclick="return confirm(\'Are you sure you want to delete this photo?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>' : '') .
                '<a title="Delete Report" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deletePhotoReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }
    public function reportedReviewPhotos($user_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviewPhotos.caption";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "ReviewPhotoReports.why";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "ReviewPhotoReports.specific_detail";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "ReviewPhotoReports.treated";
            } else {
                $orderByColumnIndex = "ReviewPhotoReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "BusinessReviewPhotos.caption";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "ReviewPhotoReports.why";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "ReviewPhotoReports.specific_detail";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "ReviewPhotoReports.treated";
            } else {
                $orderByColumnIndex = "ReviewPhotoReports.id";
            }
        }
        $query = $this->Custom->reportedReviewPhotosQuery($user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            // $mergeQuery = array_merge($usersQuery, $bizQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item->business_photo);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            $data_array[] = !empty($item->business_review_photo) ? '<img class="img lazy" src="' . $this->Cu->getDp($item->business_review_photo->photo, 'reviews', '210x100') . '" alt="' . $item->business_review_photo->caption . '" style="max-height: 100px;"> <br> ' . $item->business_review_photo->caption : "Photo removed or not available";
            $data_array[] = $item->why;
            $data_array[] = $item->specific_detail;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "ReviewPhotoReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                (!empty($item->business_review_photo->user) ? $this->userStatusAndEmailLink($item->business_review_photo->user) : '') .
                (!empty($item->business_review_photo) ? '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteReviewPhoto', $item->business_review_photo->id]) . '" onclick="return confirm(\'Are you sure you want to delete this photo?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>' : '') . '<a title="Delete Report" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteReviewPhotoReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reportedAnswers($user_id = null, $question_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Answers.answer";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "AnswerReports.why";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "AnswerReports.specific_detail";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "AnswerReports.treated";
            } else {
                $orderByColumnIndex = "AnswerReports.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Answers.answer";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "AnswerReports.why";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "AnswerReports.specific_detail";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "AnswerReports.treated";
            } else {
                $orderByColumnIndex = "AnswerReports.id";
            }
        }
        $query = $this->Custom->reportedAnswersQuery($user_id, $question_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            // $mergeQuery = array_merge($usersQuery, $bizQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            // $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question)), 70), $item->id]) . '" >' . $item->question . ' </a>';

            $data_array[] = '<a target="_blank" href="' . Router::url([
                'prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->answer->question->business->name)),
                strtolower($item->answer->question->business->city->name),
                $item->answer->question->business->city->state->code,
                $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->answer->question->question)), 70),
                $item->answer->question->id
            ]) . '" >' . $item->answer->answer . ' </a>';

            $data_array[] = $item->why;
            $data_array[] = $item->specific_detail;
            $data_array[] = $item->treated ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->answer->question->business->name)), $item->answer->question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->answer->question->question)), 70), $item->answer->question->id]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editAnswer', $item->answer->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Answer" ><i class="fa fa-edit"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'reportOkay', $item->id, "AnswerReports"]) . '" class="btn btn-xs btn-raised btn-success btn-icon mr-1 btn-sm"  title="Set to Resolved" ><i class="fa fa-check"></i></a>' .
                (!empty($item->answer->user) ? $this->userStatusAndEmailLink($item->answer->user) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteAnswerReport', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this report?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function businessesEdits()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "BusinessEdits.id";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "BusinessEdits.id";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "BusinessEdits.created";
        } else {
            $orderByColumnIndex = "BusinessEdits.id";
        }
        $query = $this->Custom->getBusinessEdits();

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);


        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>';

            $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';

            $original = json_decode($item->original, true);
            $changes = json_decode($item->changes, true);
            $edits = json_decode($item->edits_json, true);
            $html = '';
            // $html .= '<ul>';
            foreach ($changes as $key => $value) {
                if ($value == "categories") {
                } elseif ($value == "subcategories") {
                } else {

                    $html .= '<strong>' . ucwords(str_replace("_", " ", $value)) . ':</strong> &nbsp;'
                        . '<span class="del">' . $original[$value] . '</span> &nbsp;&nbsp;'
                        . '<span class="new_value">' . $edits[$value] . '</span><br>';
                }
            }
            // $html .= '</ul>';


            $data_array[] = $html;
            $data_array[] =  $this->Custom->cakeTime2($item->created);

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'approveRequest', $item->id]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="Approve " onclick="return confirm(\'Are you sure you want to approve this edit request?\')" ><i class="fa fa-check"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'declineRequest', $item->id]) . '" class="btn btn-xs btn-danger btn-raised btn-icon mr-1 btn-sm"  title="Decline " onclick="return confirm(\'Are you sure you want to decline this edit request?\')" ><i class="fa fa-times"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'modifyEditRequest', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Modify" ><i class="fa fa-edit"></i></a>' .
                $this->userStatusAndEmailLink($item->user) .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteEditRequest', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this edit request?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }
    public function answers($user_id = null, $question_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Questions.question";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "Answers.answer";
            } else {
                $orderByColumnIndex = "Answers.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Questions.question";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Answers.answer";
            } else {
                $orderByColumnIndex = "Answers.id";
            }
        }
        $query = $this->Custom->answersQuery(null, null, $user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            // $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            // $mergeQuery = array_merge($usersQuery, $bizQuery);
            $query->where([
                'OR' => $usersQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->question->business->name)), $item->question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question->question)), 70), $item->question->id]) . '" >' . $item->question->question . ' </a>';

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->question->business->name)), $item->question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question->question)), 70), $item->question->id]) . '" >' . $item->answer . ' </a>';

            $data_array[] =
                '<a href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->question->business->name)), $item->question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question->question)), 70), $item->question->id]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editAnswer', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Answer" ><i class="fa fa-edit"></i></a>' .
                $this->userStatusAndEmailLink($item->user) .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteAnswer', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this answer?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function questions($user_id = null, $business_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "Questions.question";
            } else {
                $orderByColumnIndex = "Questions.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Questions.question";
            } else {
                $orderByColumnIndex = "Questions.id";
            }
        }

        // dd($user_id);
        $query = $this->Custom->getQuestions($business_id, null, false, $user_id, false);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            $mergeQuery = array_merge($usersQuery, $bizQuery);
            $query->where([
                'OR' => $mergeQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            // $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->name)), strtolower($item->city->name), $item->city->state->code, $item->id]) . '" >' . $item->name . ' </a>';

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>';

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question)), 70), $item->id]) . '" >' . $item->question . ' </a>';

            $data_array[] =
                '<a href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($item->question)), 70), $item->id]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                // '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editReview', \Cake\Utility\Text::slug(strtolower($item->business->name)), $item->business->city->state->code, $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .
                $this->userStatusAndEmailLink($item->user) .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteQuestion', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this question?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function businessPhotos($user_id = null, $business_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if (!empty($this->request->getQuery()['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessPhotos.caption";
            } else {
                $orderByColumnIndex = "BusinessPhotos.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessPhotos.caption";
            } else {
                $orderByColumnIndex = "BusinessPhotos.id";
            }
        }
        $query = $this->Custom->getBusinessPhotos($business_id, $user_id);

        $query
            // ->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);


        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {
            // dd($item->user);

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            if (!empty($this->request->getQuery()['showuser'])) {
                $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
            }
            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>';

            $data_array[] =  !empty($item->photo) ? '<img class="img lazy" src="' . $this->Cu->getDp($item['photo'], 'Businesses', '210x100') . '" alt="' . $item['caption'] . '" style="max-height: 100px;">' : "Photo removed or not available";

            $data_array[] = $item['caption'];

            $data_array[] =
                $this->userStatusAndEmailLink($item->user) .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteBusinessPhoto', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this photo?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reviews($user_id = null, $business_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);
        $queryData = $this->Custom->cleanQuery($this->request->getQuery());

        if (!empty($queryData['showuser'])) {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Users.firstname";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "BusinessReviews.star_rating";
            } elseif ($orderByColumnIndex == '5') {
                $orderByColumnIndex = "BusinessReviews.approved";
            } else {
                $orderByColumnIndex = "BusinessReviews.id";
            }
        } else {
            if ($orderByColumnIndex == '1') {
                $orderByColumnIndex = "Businesses.name";
            } elseif ($orderByColumnIndex == '2') {
                $orderByColumnIndex = "BusinessReviews.title";
            } elseif ($orderByColumnIndex == '3') {
                $orderByColumnIndex = "BusinessReviews.star_rating";
            } elseif ($orderByColumnIndex == '4') {
                $orderByColumnIndex = "BusinessReviews.approved";
            } else {
                $orderByColumnIndex = "BusinessReviews.id";
            }
        }
        // dd($queryData['showuser']);
        // dd($orderByColumnIndex);

        if (!empty($queryData['business_id'])) {
            $business_id = $queryData['business_id'];
        }
        if (!empty($queryData['mini'])) {
            $orderByColumnIndex = "BusinessReviews.star_rating";
            $orderType = "DESC";
        }

        $query = $this->Custom->getBusinessReviews($business_id, null, $user_id, null, false);

        // $query = $this->table('Users')->find('all', [
        //     'fields' => array("COUNT('Users.requests') as request_count"),
        //     'group' => array('Users.requests')
        // ]);

        $query
            ->group(['BusinessReviews.id'])
            ->select($this->table('BusinessReviews'))
            ->enableAutoFields(true);
        // ->select(['followers_count' => $query->func()->count('Followers.id')])
        // ->leftJoinWith('Followers')
        // ->select(['business_count' => $query->func()->count('Businesses.id')])
        // ->leftJoinWith('Businesses')
        // ->select(['questions_count' => $query->func()->count('Questions.id')])
        // ->leftJoinWith('Questions');

        $query
            //->contain($this->Custom->businessReviewContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);

            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $reviewsQuery = $this->Custom->businessReviewsFullTextQuery($search_term);
            $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            $mergeQuery = array_merge($usersQuery, $reviewsQuery, $bizQuery);
            $query->where([
                'OR' => $mergeQuery,
            ]);
            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());


        foreach ($itemsArray as $item) {
            // dd($item);
            $data_array = [];

            // dd($queryData);

            if (!empty($queryData['mini'])) {

                $data_array[] = '<div class="row review_row" style="cursor:pointer" data-reviewid="' . $item->id . '">
                <div class="col-md-1" style="padding-right: 0;">
                    <img class="u-avatar rounded-circle float-right" src="' . (!empty($item->user) ?  $this->Custom->getDp($item->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage()) . '" alt="Image Description" style="max-width:50px;">
                </div>
                <div class="col-md-11">' .
                    //'<a class="bold text-dark" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" target="_blank">' . 
                    '<h5 class="mb-0">' . ucfirst($item->user->firstname) . " " . ucfirst(substr($item->user->lastname, 0, 1)) . '</h5>'
                    //.'</a>'.
                    . '<small>' . $this->Custom->truncate($item->title, 100) . '</small>
                </div>
            </div>';
            } else {
                $id = ($index + 1);
                // dd($item);

                $data_array[] = $id;
                if (!empty($queryData['showuser'])) {
                    $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : 'N/A';
                }
                $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>';

                $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->id]) . '" >' . $item->title . ' </a>';
                $data_array[] = !empty($item->star_rating) ? number_format((float) $item->star_rating, 2) : '';
                $data_array[] = $item->approved ? "Yes" : "No";

                $data_array[] =
                    '<a href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->id]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                    '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'editReview', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit Review" ><i class="fa fa-edit"></i></a>' .
                    '<a title="' . (!$item['approved'] ? 'Approve' : 'Disapprove') . '" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'toggleReviewStatus', $item['id']]) . '" onclick="return confirm(\'' . ($item['active'] ? 'Approve this review' : 'Hide this review from the public') . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa ' . ($item['active'] ? 'fa-toggle-off' : 'fa-toggle-on') . '"></i></a> ' .
                    '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'deleteReview', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['title'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';
            }



            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function getUsersAjax()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);


        $orderByColumnIndex = "Users.id";
        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Users.username";
        }
        if ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Users.email";
        }
        if ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Users.firstname";
        }
        if ($orderByColumnIndex == '4') {
            $orderByColumnIndex = "Users.lastname";
        }
        if ($orderByColumnIndex == '5') {
            // $orderByColumnIndex = "business_count";
        }

        if ($orderByColumnIndex == '6') {
            // $orderByColumnIndex = "followers_count";
        }

        if ($orderByColumnIndex == '7') {
            // $orderByColumnIndex = "questions_count";
        }


        $query = $this->table('Users')->find('all');

        // $query = $this->table('Users')->find('all', [
        //     'fields' => array("COUNT('Users.requests') as request_count"),
        //     'group' => array('Users.requests')
        // ]);

        $query
            ->group(['Users.id'])
            ->select($this->table('Users'))
            ->enableAutoFields(true);
        // ->select(['followers_count' => $query->func()->count('Followers.id')])
        // ->leftJoinWith('Followers')
        // ->select(['business_count' => $query->func()->count('Businesses.id')])
        // ->leftJoinWith('Businesses')
        // ->select(['questions_count' => $query->func()->count('Questions.id')])
        // ->leftJoinWith('Questions');

        $query
            ->contain($this->Custom->userContains())
            ->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);

            $query->where([
                'OR' => $this->Custom->userFullTextQuery($search_term),
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            $data_array[] = '<img class="img lazy" src="' . $this->Cu->getDp($item['image'], 'users', '210x100') . '" alt="' . $item['firstname'] . '" style="max-height: 60px;border-radius: 50px;">';
            $data_array[] =  '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item['username']]) . '" >' . $item['username'] . ' </a>';
            // $data_array[] = $item['username'];
            $data_array[] = $item['email'];
            $data_array[] = ucwords($item['firstname']);
            $data_array[] = ucwords($item['lastname']);

            $data_array[] = "Businesses: " . $item['business_count']
                . "<br> Followers: " . $item['followers_count']
                . "<br> Questions: " . $item['questions_count'];
            // $data_array[] = $item['business_count'];
            // $data_array[] = $item['followers_count'];
            // $data_array[] = $item['questions_count'];
            $data_array[] = $item['active'] ? "Yes" : "No";

            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => "users", 'action' => 'view', $item['id']]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                // '<a title="Add Subscribption" href="' . Router::url(['prefix' => false, 'controller' => 'Admins', 'action' => 'subscribe', $item['id']]) . '" onclick="return confirm(\'Add subcription for this admin?\')" class="btn btn-xs btn btn-raised btn-icon btn-success mr-1 btn-sm"><i class="fa fa-plus"></i></a>  ';
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'edit', $item['id']]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit User" ><i class="fa fa-edit"></i></a> ' .
                $this->userStatusAndEmailLink($item) .
                '<a title="Reset Password" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'resetPassword', $item['id']]) . '" onclick="return confirm(\'Reset Password of ' . $item['name_desc'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-warning mr-1 btn-sm"><i class="fa fa-key"></i></a>' .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name_desc'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';


            // debug($data_array);
            // if (empty($created_by)) {
            //     $user_who_created = $this->Custom->getUser($item['created_by']);
            //     $inserted = !empty($user_who_created) ? $user_who_created->name_desc : 'N/A';
            //     array_splice($data_array, 6, 0, $inserted);
            // }


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }
    public function businesses()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        $query = $this->table('Businesses')->find('all')
            ->contain($this->Custom->bizContains())
            ->group(['Businesses.id'])
            ->select($this->table('Businesses'))
            ->distinct('Businesses.id')
            ->enableAutoFields(true);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Businesses.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Businesses.name";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Businesses.email";
        } elseif ($orderByColumnIndex == '4') {
            $orderByColumnIndex = "Users.firstname";
        } elseif ($orderByColumnIndex == '5') {
            $query->leftJoinWith('Cities');
            $orderByColumnIndex = "Cities.name";
        } elseif ($orderByColumnIndex == '6') {
            $orderByColumnIndex = "Sic2categories.name";
            $query->leftJoinWith('Sic2categories');
        } elseif ($orderByColumnIndex == '7') {
            $orderByColumnIndex = "Sic4categories.name";
            $query->leftJoinWith('Sic4categories');
        } elseif ($orderByColumnIndex == '8') {
            $orderByColumnIndex = "Sic8categories.name";
            $query->leftJoinWith('Sic8categories');
        } elseif ($orderByColumnIndex == '9') {
            $orderByColumnIndex = "count_of_reviews";
            $query->leftJoinWith('BusinessReviews');
            $query->select(['count_of_reviews' => $query->func()->count('BusinessReviews.id')]);
        } elseif ($orderByColumnIndex == '10') {
            $orderByColumnIndex = "count_of_questions";
            $query->leftJoinWith('Questions');
            $query->select(['count_of_questions' => $query->func()->count('Questions.id')]);
        } else {
            $orderByColumnIndex = "Businesses.id";
        }


        $query->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            $sicQuery = [
                ["MATCH(Sic2categories.name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                ['LOWER(Sic2categories.name) LIKE' => "%" . $search_term . "%"],
                ["MATCH(Sic4categories.name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                ['LOWER(Sic4categories.name) LIKE' => "%" . $search_term . "%"],
                ["MATCH(Sic8categories.name) AGAINST('{$search_term}'IN BOOLEAN MODE)"],
                ['LOWER(Sic8categories.name) LIKE' => "%" . $search_term . "%"],
            ];
            $mergeQuery = array_merge($usersQuery, $bizQuery, $sicQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            $data_array[] = '<img class="img lazy" src="' . $this->Cu->getBusinessPhotoUrl($item) . '" alt="' . $item['name'] . '" style="max-height: 60px;border-radius: 50px;">';

            $data_array[] = '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->name)), strtolower($item->city->name), $item->city->state->code, $item->id]) . '" >' . $item->name . ' </a>';

            $data_array[] = $item['email'];

            $data_array[] = !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . $item->user->name_desc . ' </a>' : 'N/A';
            $data_array[] = $item->city->name . ", " .  strtoupper($item->city->state->code);

            // $data_array[] = "Review: " . $item['review_count']
            // . "<br> Questions: " . $item['questions_count'];

            $data_array[] = !empty($item->sic2category->name) ? $item->sic2category->name : "";
            $data_array[] = !empty($item->sic4category->name) ? $item->sic4category->name : "";
            $data_array[] = !empty($item->sic8category->name) ? $item->sic8category->name : "";
            $data_array[] = $item['review_count'];
            $data_array[] = $item['questions_count'];

            $data_array[] =
                // '<a href="' . Router::url(['prefix' => "Admin", 'controller' => "users", 'action' => 'view', $item['id']]) . '" class="btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm"  title="View "><i class="fa fa-search"></i></a>' .
                // '<a title="Add Subscribption" href="' . Router::url(['prefix' => false, 'controller' => 'Admins', 'action' => 'subscribe', $item['id']]) . '" onclick="return confirm(\'Add subcription for this admin?\')" class="btn btn-xs btn btn-raised btn-icon btn-success mr-1 btn-sm"><i class="fa fa-plus"></i></a>  ';
                //'<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'edit', $item['id']]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>'.
                //'<a title="' . ($item['active'] ? 'Suspend' : 'Activate') . '" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'toggleStatus', $item['id']]) . '" onclick="return confirm(\'' . ($item['active'] ? 'Suspend' : 'Activate') . ' this user?\')" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa ' . ($item['active'] ? 'fa-toggle-off' : 'fa-toggle-on') . '"></i></a> '.
                //'<a title="Reset Password" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'resetPassword', $item['id']]) . '" onclick="return confirm(\'Reset Password of ' . $item['name_desc'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-warning mr-1 btn-sm"><i class="fa fa-key"></i></a>' .
                //'<a title="Send Email" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Users', 'action' => 'email', $item['id']]) . '" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa fa-envelope"></i></a>' .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'Businesses', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';


            // debug($data_array);
            // if (empty($created_by)) {
            //     $user_who_created = $this->Custom->getUser($item['created_by']);
            //     $inserted = !empty($user_who_created) ? $user_who_created->name_desc : 'N/A';
            //     array_splice($data_array, 6, 0, $inserted);
            // }


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function cities()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Cities.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "States.name";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Cities.image";
        } elseif ($orderByColumnIndex == '4') {
            $orderByColumnIndex = "Cities.featured";
        } elseif ($orderByColumnIndex == '5') {
            $orderByColumnIndex = "search_counts";
        } else {
            // $orderByColumnIndex = "Cities.id";
            $orderByColumnIndex = "search_counts";
            $orderType = "DESC";
        }

        $query = $this->table('Cities')->find('all')
            ->contain($this->Custom->cityContains())
            ->leftJoinWith('CitySearches')
            ->leftJoinWith('States')
            ->group(['Cities.id'])
            ->select($this->table('Cities'))
            ->enableAutoFields(true);


        $query
            ->select(['search_counts' => $query->func()->sum('CitySearches.count')]);
        // ->select(['business_count' => $query->func()->count('Businesses.id')])


        $query->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $statesQuery = $this->Custom->statesFullTextQuery($search_term);
            $citiesQuery = $this->Custom->citesFullTextQuery($search_term);
            $mergeQuery = array_merge($statesQuery, $citiesQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            $data_array[] = ucwords($item->name);
            $data_array[] = '<img class="img lazy" src="' . $this->Cu->getDp($item['image'], 'cities', '210x100') . '"
                alt="' . $item['name'] . '" style="max-height: 100px;">';
            $data_array[] = ucwords($item->state->name) . ", " . strtoupper($item->state->code);

            $data_array[] = $item->featured ? "Yes" : "No";
            // $data_array[] = $item->search_count;
            $data_array[] = !empty($item->search_counts) ? $item->search_counts : "0";
            $data_array[] =

                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .

                '<a title="' . ($item->featured ? 'Unfeature' : 'Feature') . '" href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'togglefeatured', $item['id']]) . '" onclick="return confirm(\'' . (!$item->featured ? 'Feature ' : 'Unfeature ') . $item->name . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa ' . ($item->featured ? 'fa-toggle-off' : 'fa-toggle-on') . '"></i></a> ' .

                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';



            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));
        // dd($response);

        $this->Custom->jsonResponse($response);
    }

    public function claimcity($id = null)
    {

        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $options = $this->Custom->getOptions();
        $city = $this->table('Cities')->find()->where(["id" => $id])->first();
        $query = $this->Custom->getNearbyCities($city, $options->city_radius, false, true)
            ->andWhere(['Cities.id IS NOT' => $city->id]);

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $searchquery = $this->Custom->citiesQuery(true)->limit(100);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            $searchquery->where(['LOWER(Cities.name) LIKE' => strtolower($search_term) . "%"]); //starts with only
        }

        $selections = !empty($request['selections']) ? json_decode($request['selections'], true) : [];
        $selected_cities = null;
        if (!empty($selections)) {
            $selected_cities = $this->Custom->citiesQuery(true)->where(['Cities.id IN' => $selections]);
        }

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        // $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = array_merge(
            $query->toArray(),
            (!empty($searchquery) ? $searchquery->toArray() : []),
            (!empty($selected_cities) ? $selected_cities->toArray() : [])
        );

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        // $iTotalRecords = $query->count() +
        // (!empty($searchquery) ? $searchquery->count() : 0) +
        // (!empty($selected_cities) ? $selected_cities->count() : 0);

        $iTotalRecords = 0;

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());
        $displayedIds = [];

        foreach ($itemsArray as $item) {
            if (!in_array($item->id, $displayedIds)) {
                // $state = $this->table('States')->find()->where(['States.id' => $item->state_id])->first();
                $id = ($index + 1);
                // dd($item);
                $data_array = [];
                $data_array[] = '<span itemid="' . $item->id . '"></span>';
                // $data_array[] = $id;
                // if (is_string($item->price)) {
                //     dd($item);
                // }

                $data_array[] = ucwords($item->name) . (!empty($item->state) ? ", " . strtoupper($item->state->code) : '');
                $data_array[] = !empty($item->population) ? number_format($item->population) : '';
                $data_array[] = "$" . ($item->price ?? number_format((float) $item->price, 2));
                $response["data"][] = $data_array;
                $index++;
                $iTotalRecords++;
                $displayedIds[] = $item->id;
            }
            // dd($data_array);
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    // public function claimcity($id = null)
    // {
    //     $this->response->withDisabledCache();
    //     //$request = $_REQUEST; // cakephp doesn't use this
    //     $request = $this->request->getAttribute('params')['?'];

    //     // $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
    //     //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    //     // $orderType = strtoupper($request['order'][0]['dir']);

    //     // dd($orderByColumnIndex);

    //     // if ($orderByColumnIndex == '1') {
    //     //     $orderByColumnIndex = "Cities.name";
    //     // } elseif ($orderByColumnIndex == '2') {
    //     //     $orderByColumnIndex = "States.name";
    //     // } elseif ($orderByColumnIndex == '3') {
    //     //     $orderByColumnIndex = "Cities.image";
    //     // } elseif ($orderByColumnIndex == '4') {
    //     //     $orderByColumnIndex = "Cities.featured";
    //     // } elseif ($orderByColumnIndex == '5') {
    //     //     $orderByColumnIndex = "search_counts";
    //     // } else {
    //     //     // $orderByColumnIndex = "Cities.id";
    //     //     $orderByColumnIndex = "search_counts";
    //     //     $orderType = "DESC";
    //     // }

    //     $radius = 30;
    //     $city = $this->table('Cities')->find()->where(["id" => $id])->first();
    //     dd($city);
    //     $query = $this->Custom->getNearbyCities($city, $radius, false);

    //     // dd($query->toArray());
    //     // $query = $this->table('Cities')->find('all')
    //     //     ->contain($this->Custom->cityContains())
    //     //     ->leftJoinWith('CitySearches')
    //     //     ->leftJoinWith('States')
    //     //     ->group(['Cities.id'])
    //     //     ->select($this->table('Cities'))
    //     //     ->enableAutoFields(true);


    //     // $query->select(['search_counts' => $query->func()->sum('CitySearches.count')]);
    //     // ->select(['business_count' => $query->func()->count('Businesses.id')])


    //     // $query->order([$orderByColumnIndex => $orderType]);

    //     // dd($query->toArray());

    //     if (isset($request['search']['value']) && !empty($request['search']['value'])) {
    //         // dd($_REQUEST['search']['value']);
    //         $search_term = $this->Custom->escapeString($request['search']['value']);
    //         // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
    //         $statesQuery = $this->Custom->statesFullTextQuery($search_term);
    //         $citiesQuery = $this->Custom->citesFullTextQuery($search_term);
    //         $mergeQuery = array_merge($statesQuery, $citiesQuery);

    //         $query->where([
    //             'OR' => $mergeQuery,
    //         ]);

    //         // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
    //         // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

    //     }
    //     // debug($query);
    //     // debug(intval($request['start']));

    //     $iTotalRecords = $query->count();

    //     /*
    //     we have to do this after the above so as to get the right total number before slicing the result
    //     however it seems the documentation says The count() method will ignore the limit, offset and page clauses
    //     https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
    //      */
    //     $query->limit(intval($request['length']))->offset(intval($request['start']));

    //     $itemsArray = $query->toArray();

    //     // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

    //     $response["data"] = [];

    //     $index = intval($request['start']);
    //     $txt = new TextHelper(new View());

    //     foreach ($itemsArray as $item) {

    //         $id = ($index + 1);
    //         // dd($item);
    //         $data_array = [];
    //         $data_array[] = $id;

    //         $data_array[] = ucwords($item->name);
    //         $data_array[] = '<img class="img lazy" src="' . $this->Cu->getDp($item['image'], 'cities', '210x100') . '"
    //             alt="' . $item['name'] . '" style="max-height: 100px;">';
    //         $data_array[] = ucwords($item->state->name) . ", " . $item->state->code;

    //         $data_array[] = $item->featured ? "Yes" : "No";
    //         // $data_array[] = $item->search_count;
    //         $data_array[] = !empty($item->search_counts) ? $item->search_counts : "0";
    //         $data_array[] =

    //             '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .

    //             '<a title="' . ($item->featured ? 'Unfeature' : 'Feature') . '" href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'togglefeatured', $item['id']]) . '" onclick="return confirm(\'' . (!$item->featured ? 'Feature ' : 'Unfeature ') . $item->name . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-info mr-1 btn-sm"><i class="fa ' . ($item->featured ? 'fa-toggle-off' : 'fa-toggle-on') . '"></i></a> ' .

    //             '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'cities', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';



    //         // dd($data_array);
    //         $response["data"][] = $data_array;
    //         $index++;
    //     }

    //     if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
    //         $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    //         $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
    //     }

    //     $response["draw"] = intval($request['draw']);
    //     $response["recordsTotal"] = $iTotalRecords;
    //     $response["recordsFiltered"] = $iTotalRecords;
    //     $response["request"] = $request;

    //     // $this->Custom->doLog('response.txt', json_encode($response));

    //     $this->set([
    //         'response' => $response,
    //         //'data' => $this->request->getData(),
    //         //'_serialize' => 'response',
    //     ]);
    //     $this->RequestHandler->renderAs($this, 'json');
    // }

    public function subcategories()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Subcategories.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Categories.name";
        } else {
            $orderByColumnIndex = "Subcategories.id";
        }

        $query = $this->table('Subcategories')->find('all')
            ->contain(['Categories', 'Sic4categories']);


        $query->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $catQuery = $this->Custom->catFullTextQuery($search_term);
            $sic4catQuery = $this->Custom->catFullTextQuery($search_term, 'Sic4categories');
            $subcatQuery = $this->Custom->subcatFullTextQuery($search_term);
            $mergeQuery = array_merge($catQuery, $subcatQuery, $sic4catQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            $data_array[] = ucwords($item->name);
            $data_array[] = ucwords($item->category->name);
            $data_array[] = ucwords($item->sic4category->name);
            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'subcategories', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .

                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'subcategories', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function subscriptions($coupon_id = null, $package_id = null, $business_id = null)
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Businesses.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Coupons.code";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Packages.name";
        } elseif ($orderByColumnIndex == '5') {
            $orderByColumnIndex = "Subscriptions.amount";
        } elseif ($orderByColumnIndex == '6') {
            $orderByColumnIndex = "Subscriptions.discount";
        } elseif ($orderByColumnIndex == '7') {
            $orderByColumnIndex = "Subscriptions.created";
        } else {
            $orderByColumnIndex = "Subscriptions.created";
            $orderType = "DESC";
            // $orderByColumnIndex = "Subscriptions.id";
        }

        $query = $this->Custom->subscriptionsQuery();


        $query->order([$orderByColumnIndex => $orderType]);


        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $bizQuery = $this->Custom->businessFullTextQuery($search_term);
            $couponQuery = $this->Custom->couponFullTextQuery($search_term);
            $packagesQuery = $this->Custom->packagesFullTextQuery($search_term);
            $mergeQuery = array_merge($bizQuery, $couponQuery, $packagesQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        if (!empty($coupon_id)) {
            $query->andWhere(['Subscriptions.coupon_id' => $coupon_id]);
        }
        if (!empty($package_id)) {
            $query->andWhere(['Subscriptions.package_id' => $package_id]);
        }
        if (!empty($business_id)) {
            $query->andWhere(['Subscriptions.business_id' => $business_id]);
        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            // $data_array[] = !empty($item->business) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>' : '';

            $data_array[] = !empty($item->business) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), strtolower($item->business->city->name), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>' : '';

            $data_array[] = !empty($item->coupon) ? $item->coupon->code : '';
            $data_array[] = !empty($item->package) ? $item->package->name : '';
            $data_array[] =  $this->Custom->dateFromTimestamp($item->start_timestamp) . '<br> to <br>' . $this->Custom->dateFromTimestamp($item->end_timestamp) . '<br> (' . $item->duration . ' days)';
            $data_array[] = $this->currency . number_format($item->amount, 2);
            $data_array[] = $this->currency . number_format($item->discount, 2);
            $data_array[] =  $this->Custom->cakeTime2($item->created);
            $data_array[] = $item->active ? "YES" : "NO";
            $data_array[] =

                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'subscriptions', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .
                (!empty($item->business_id) ? $this->bizRestrictionManagement($item->business_id) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'subscriptions', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['id'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function citysubscriptions()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Users.firstname";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Cities.name";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Coupons.code";
        } elseif ($orderByColumnIndex == '5') {
            $orderByColumnIndex = "CitySubscriptions.amount";
        } elseif ($orderByColumnIndex == '6') {
            $orderByColumnIndex = "CitySubscriptions.discount";
        } elseif ($orderByColumnIndex == '7') {
            $orderByColumnIndex = "CitySubscriptions.created";
        } else {
            $orderByColumnIndex = "CitySubscriptions.created";
            $orderType = "DESC";
            // $orderByColumnIndex = "Subscriptions.id";
        }

        $query = $this->Custom->citySubscriptionsQuery();


        $query->order([$orderByColumnIndex => $orderType]);


        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $citiesQuery = $this->Custom->citesFullTextQuery($search_term);
            $couponQuery = $this->Custom->couponFullTextQuery($search_term);
            $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $mergeQuery = array_merge($usersQuery, $couponQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);
        }

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            if (empty($item->user)) {
                $item->user = $this->Custom->getUser($item->user_id);
            }

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;
            $data_array[] =  !empty($item->user) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'user', 'action' => 'index', $item->user->username]) . '" >' . ucwords($item->user->name_desc) . ' </a>' : "Profile not found";
            $data_array[] =  $this->Cu->showArrayItemsAsString($item->city_subscription_cities, "city");
            $data_array[] = $item->transactionid;
            // $data_array[] =  !empty($item->city) ? $item->city->name . ", " . $item->city->state->code : "";
            // $data_array[] = !empty($item->coupon) ? $item->coupon->code : '';
            $data_array[] =  $this->Custom->dateFromTimestamp($item->start_timestamp) . '<br> to <br>' . $this->Custom->dateFromTimestamp($item->end_timestamp) . '<br> (' . $item->duration . ' days)';
            $data_array[] = $this->currency . number_format($item->amount, 2);
            $data_array[] = $this->currency . number_format($item->discount, 2);
            $data_array[] = $item->paid ? "YES" : "NO";
            $data_array[] =  $this->Custom->cakeTime2($item->created);
            $data_array[] = $item->active ? "YES" : "NO";
            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'citySubscriptions', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .
                (!empty($item->user) ? $this->userStatusAndEmailLink($item->user) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'citySubscriptions', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['id'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';
            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function reminders()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Businesses.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Reminders.number_of_times";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "Reminders.reminder_status_id";
        } elseif ($orderByColumnIndex == '4') {
            $orderByColumnIndex = "Reminders.reminder_schedule_id";
        } else {
            $orderByColumnIndex = "Reminders.created";
            $orderType = "DESC";
            // $orderByColumnIndex = "Subscriptions.id";
        }

        $query = $this->Custom->remindersQuery();

        $query
            ->group(['Reminders.id'])
            ->select($this->table('Reminders'))
            ->enableAutoFields(true)
            ->select(['sent_count' => $query->func()->count('RemindersSent.id')])
            ->leftJoinWith('RemindersSent');

        $query->order([$orderByColumnIndex => $orderType]);


        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $bizQuery = $this->Custom->businessFullTextQuery($search_term);

            $query->where([
                'OR' => $bizQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }

        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            $data_array[] = !empty($item->business) ? '<a target="_blank" href="' . Router::url(['prefix' => false, 'controller' => 'Businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($item->business->name)), $item->business->city->state->code, $item->business->id]) . '" >' . $item->business->name . ' </a>' : '';
            $data_array[] = !empty($item->number_of_times) ? number_format($item->number_of_times) : "";
            $data_array[] = !empty($item->reminder_status) ? $item->reminder_status->name : '';
            $data_array[] = !empty($item->reminder_schedule) ? $item->reminder_schedule->name : '';
            $data_array[] = number_format($item->sent_count);
            $data_array[] = $item->active ? "YES" : "NO";
            $data_array[] =  !empty($item->business) ? ($item->business->restricted ? "Restricted" : "Allowed") : 'N/A';
            $data_array[] =
                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'reminders', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .
                (!empty($item->business_id) ? $this->bizRestrictionManagement($item->business_id) : '') .
                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'reminders', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete this reminder ' . $item['id'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';

            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }

    public function filters()
    {
        $this->response->withDisabledCache();
        //$request = $_REQUEST; // cakephp doesn't use this
        $request = $this->request->getAttribute('params')['?'];

        $orderByColumnIndex = $request['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
        //$orderBy = $_REQUEST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
        $orderType = strtoupper($request['order'][0]['dir']);

        // dd($orderByColumnIndex);

        if ($orderByColumnIndex == '1') {
            $orderByColumnIndex = "Filters.name";
        } elseif ($orderByColumnIndex == '2') {
            $orderByColumnIndex = "Filters.description";
        } elseif ($orderByColumnIndex == '3') {
            $orderByColumnIndex = "SearchKeywords.name";
        } elseif ($orderByColumnIndex == '4') {
            $orderByColumnIndex = "Categories.name";
        } elseif ($orderByColumnIndex == '5') {
            $orderByColumnIndex = "Filters.key_order";
        } elseif ($orderByColumnIndex == '6') {
            $orderByColumnIndex = "Filters.input_type";
        } elseif ($orderByColumnIndex == '7') {
            $orderByColumnIndex = "Filters.show_business";
        } elseif ($orderByColumnIndex == '8') {
            $orderByColumnIndex = "Filters.show_filter";
        } elseif ($orderByColumnIndex == '9') {
            $orderByColumnIndex = "Filters.active";
        } else {
            $orderByColumnIndex = "Filters.id";
        }

        $query = $this->table('Filters')->find('all')
            ->contain(['SearchKeywords', 'Categories', 'FormTypes']);


        $query->order([$orderByColumnIndex => $orderType]);

        // dd($query->toArray());

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            // dd($_REQUEST['search']['value']);
            $search_term = $this->Custom->escapeString($request['search']['value']);
            // $usersQuery = $this->Custom->userFullTextQuery($search_term, "Users");
            $catQuery = $this->Custom->catFullTextQuery($search_term);
            $filtersQuery = $this->Custom->filtersFullTextQuery($search_term);
            $mergeQuery = array_merge($catQuery, $filtersQuery);

            $query->where([
                'OR' => $mergeQuery,
            ]);

            // $query->andWhere(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)"]);
            // $query->order(["MATCH(Apis.name) AGAINST('{$search_term}' IN BOOLEAN MODE)" => 'DESC']);

        }
        // debug($query);
        // debug(intval($request['start']));

        $iTotalRecords = $query->count();

        /*
        we have to do this after the above so as to get the right total number before slicing the result
        however it seems the documentation says The count() method will ignore the limit, offset and page clauses
        https://book.cakephp.org/3.0/en/orm/query-builder.html#returning-the-total-count-of-records
         */
        $query->limit(intval($request['length']))->offset(intval($request['start']));

        $itemsArray = $query->toArray();

        // $this->Custom->doLog('array.txt', json_encode($query->toArray()));

        $response["data"] = [];

        $index = intval($request['start']);
        $txt = new TextHelper(new View());

        foreach ($itemsArray as $item) {

            $id = ($index + 1);
            // dd($item);
            $data_array = [];
            $data_array[] = $id;

            $data_array[] = ucwords($item->name);
            $data_array[] = $item->description;
            $data_array[] = $item->search_keyword->name;
            $data_array[] = $item->category->name;
            $data_array[] = $item->key_order;
            $data_array[] = ucfirst($item->input_type)
                . (!empty($item->input_class) ? "<br> HTML Classes: " . $item->input_class : '')
                . (!empty($item->placeholder) ? "<br> Placeholder: " . $item->placeholder : '')
                . (!empty($item->options) ? "<br> Options: " . $item->options : "");

            $data_array[] = $item->show_business ? "YES" : "NO";
            $data_array[] = $item->show_filter ? "YES" : "NO";
            $data_array[] = $item->active ? "YES" : "NO";
            $data_array[] =

                '<a href="' . Router::url(['prefix' => "Admin", 'controller' => 'filters', 'action' => 'edit', $item->id]) . '" class="btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm"  title="Edit" ><i class="fa fa-edit"></i></a>' .

                '<a title="Delete" href="' . Router::url(['prefix' => "Admin", 'controller' => 'filters', 'action' => 'delete', $item['id']]) . '" onclick="return confirm(\'Are you sure you want to delete ' . $item['name'] . '?\')" class="btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm"><i class="fa fa-trash"></i></a>';


            // dd($data_array);
            $response["data"][] = $data_array;
            $index++;
        }

        if (isset($request["customActionType"]) && $request["customActionType"] == "group_action") {
            $response["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $response["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $response["draw"] = intval($request['draw']);
        $response["recordsTotal"] = $iTotalRecords;
        $response["recordsFiltered"] = $iTotalRecords;
        $response["request"] = $request;

        // $this->Custom->doLog('response.txt', json_encode($response));

        $this->Custom->jsonResponse($response);
    }
}
