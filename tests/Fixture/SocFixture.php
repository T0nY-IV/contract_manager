<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SocFixture
 */
class SocFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'soc';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'mat_fisc' => 'e2b1d80c-2714-40a6-a865-3367e003ee5a',
                'nom' => 'Lorem ipsum dolor sit amet',
                'add_loc' => 'Lorem ipsum dolor sit amet',
                'gouvernorat' => 'Lorem ipsum dolor sit amet',
                'num_tel' => 1,
                'presenteur' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
