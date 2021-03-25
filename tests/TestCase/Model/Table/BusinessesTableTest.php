<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BusinessesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BusinessesTable Test Case
 */
class BusinessesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BusinessesTable
     */
    protected $Businesses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Businesses',
        'app.Users',
        'app.Cities',
        'app.Sic2categories',
        'app.Sic4categories',
        'app.Sic8categories',
        'app.Industries',
        'app.BusinessRoles',
        'app.Announcements',
        'app.BusinessAdditionals',
        'app.BusinessEdits',
        'app.BusinessHours',
        'app.BusinessPhotos',
        'app.BusinessReviews',
        'app.CollectionItems',
        'app.Ctas',
        'app.FeaturedAds',
        'app.Offers',
        'app.PageViews',
        'app.Questions',
        'app.Reminders',
        'app.ShareClicks',
        'app.Shares',
        'app.Subscriptions',
        'app.Categories',
        'app.Subcategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Businesses') ? [] : ['className' => BusinessesTable::class];
        $this->Businesses = TableRegistry::getTableLocator()->get('Businesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Businesses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
