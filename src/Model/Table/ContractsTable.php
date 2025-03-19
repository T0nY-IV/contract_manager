<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contracts Model
 *
 * @method \App\Model\Entity\Contract newEmptyEntity()
 * @method \App\Model\Entity\Contract newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contract> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contract get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contract findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contract patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contract> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contract|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contract saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contract>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contract> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ContractsTable extends Table
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

        $this->setTable('contracts');
        $this->setDisplayField('nom_soc');
        $this->setPrimaryKey('id');
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
            ->scalar('nom_soc')
            ->maxLength('nom_soc', 50)
            ->requirePresence('nom_soc', 'create')
            ->notEmptyString('nom_soc');

        $validator
            ->scalar('presenter')
            ->maxLength('presenter', 50)
            ->requirePresence('presenter', 'create')
            ->notEmptyString('presenter');

        $validator
            ->scalar('gouvernorat')
            ->maxLength('gouvernorat', 50)
            ->requirePresence('gouvernorat', 'create')
            ->notEmptyString('gouvernorat');

        $validator
            ->scalar('poids_assenseur')
            ->maxLength('poids_assenseur', 50)
            ->requirePresence('poids_assenseur', 'create')
            ->notEmptyString('poids_assenseur');

        $validator
            ->scalar('cntrct')
            ->maxLength('cntrct', 16777215)
            ->allowEmptyString('cntrct');

        return $validator;
    }
}
