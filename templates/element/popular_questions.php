<!-- Reviews -->
<div class="mb-5">
    <!-- Author -->
    <div class="media mb-3">
        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
            <img class="u-avatar rounded-circle border mr-3" src="<?= !empty($question->user) ?  $this->Custom->getDp($question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="">
        </a>

        <div class="media-body align-self-center">
            <span class="d-inline-block small mb-0">
                Asked by <a class="mb-0 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>"><?= ucfirst($question->user->firstname) . " " . ucfirst(substr($question->user->lastname, 0, 1)) ?>.</a>
                <br><?= !empty($question->user->city) ? $question->user->city->name . ", " . strtoupper($question->user->city->state->code) : ""; ?>
            </span>
        </div>

        <div class="media-body text-right">
            <small class="d-block text-muted small"><?= $this->Custom->niceDateMonthDayYear($question->created) ?></small>
        </div>
    </div>
    <!-- End Author -->
    <p class="small">
        <?= $this->Custom->truncate($question->question, 70, true) ?>
        <div class="mt-3">
            <a class="small" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>">View <?= $question->total_answers > 1 ? "all " . $question->total_answers . " answers" : $question->total_answers . " answer" ?>
            </a>
        </div>
    </p>
</div>
<!-- End Reviews -->