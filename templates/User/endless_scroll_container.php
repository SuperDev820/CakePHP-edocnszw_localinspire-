<?php $this->disableAutoLayout(); ?>
<?php echo $this->element('user_activities', ['activitiesArray' => $activitiesArray, 'activities_total_count' => $activities_total_count]) ?>