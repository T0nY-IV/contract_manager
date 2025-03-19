<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AddInstallationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AddInstallationTable Test Case
 */
class AddInstallationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AddInstallationTable
     */
    protected $AddInstallation;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.AddInstallation',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AddInstallation') ? [] : ['className' => AddInstallationTable::class];
        $this->AddInstallation = $this->getTableLocator()->get('AddInstallation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AddInstallation);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AddInstallationTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
