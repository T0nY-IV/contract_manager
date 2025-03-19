<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AddInstallation Model
 *
 * @method \App\Model\Entity\AddInstallation newEmptyEntity()
 * @method \App\Model\Entity\AddInstallation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AddInstallation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AddInstallation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AddInstallation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AddInstallation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AddInstallation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AddInstallation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AddInstallation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AddInstallation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AddInstallation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AddInstallation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AddInstallation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AddInstallation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AddInstallation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AddInstallation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AddInstallation> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AddInstallationTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('add_installation');
        $this->setDisplayField('mat_fisc');
        $this->setPrimaryKey('mat_fisc');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('mat_fisc')
            ->maxLength('mat_fisc', 50)
            ->requirePresence('mat_fisc', 'create')
            ->notEmptyString('mat_fisc');

        $validator
            ->scalar('add')
            ->maxLength('add', 50)
            ->requirePresence('add', 'create')
            ->notEmptyString('add');

        $validator
            ->scalar('gouvernorat')
            ->maxLength('gouvernorat', 50)
            ->requirePresence('gouvernorat', 'create')
            ->notEmptyString('gouvernorat');

        return $validator;
    }
}
