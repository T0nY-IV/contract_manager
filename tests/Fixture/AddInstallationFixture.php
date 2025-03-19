<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddInstallationFixture
 */
class AddInstallationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'add_installation';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'mat_fisc' => 'Lorem ipsum dolor sit amet',
                'add' => 'Lorem ipsum dolor sit amet',
                'gouvernorat' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
