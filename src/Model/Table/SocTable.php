<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Soc Model
 *
 * @method \App\Model\Entity\Soc newEmptyEntity()
 * @method \App\Model\Entity\Soc newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Soc> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Soc get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Soc findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Soc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Soc> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Soc|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Soc saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Soc>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Soc>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Soc>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Soc> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Soc>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Soc>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Soc>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Soc> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SocTable extends Table
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

        $this->setTable('soc');
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
            ->scalar('nom')
            ->maxLength('nom', 50)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('add_loc')
            ->maxLength('add_loc', 50)
            ->requirePresence('add_loc', 'create')
            ->notEmptyString('add_loc');

        $validator
            ->scalar('gouvernorat')
            ->maxLength('gouvernorat', 50)
            ->requirePresence('gouvernorat', 'create')
            ->notEmptyString('gouvernorat');

        $validator
            ->integer('num_tel')
            ->requirePresence('num_tel', 'create')
            ->notEmptyString('num_tel');

        $validator
            ->scalar('presenteur')
            ->maxLength('presenteur', 50)
            ->requirePresence('presenteur', 'create')
            ->notEmptyString('presenteur');

        return $validator;
    }
}
