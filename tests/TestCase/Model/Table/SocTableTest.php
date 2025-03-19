<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SocTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SocTable Test Case
 */
class SocTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SocTable
     */
    protected $Soc;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Soc',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Soc') ? [] : ['className' => SocTable::class];
        $this->Soc = $this->getTableLocator()->get('Soc', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Soc);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SocTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
