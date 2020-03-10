<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\PostCommentsTable&\Cake\ORM\Association\HasMany $PostComments
 * @property \App\Model\Table\PostLikesTable&\Cake\ORM\Association\HasMany $PostLikes
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PostComments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('PostLikes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');
        /**
         * Username
         */
        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add(
                'username',
                [
                    'unique' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'Already taken'
                    ],
                    'custom' => [
                        'rule' => ['custom', '/^[a-z0-9-_]*$/i'],
                        'message' => 'Alphabets, numbers, dash and underscore allowed'
                    ],
                    'length' => [
                        'rule' => ['minLength', 8],
                        'message' => 'Username need to be at least 8 characters long',
                    ]
                ]
            );
        /**
         * Password
         */
        $validator
            ->scalar('password')
            ->add(
                'password',
                [
                    'minLength' => [
                        'rule' => ['minLength', 8],
                        'last' => true,
                        'message' => 'Password need to be at leat 8 characters long'
                    ],
                    'oneCaps' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[A-Z]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 capital letter'
                    ],
                    'oneLower' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[a-z]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 small case letter'
                    ],
                    'oneNumber' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[0-9]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 number'
                    ]
                ]
            )
            ->requirePresence('password', 'create')
            ->notEmptyString('password');
        /**
         * Fullname
         */
        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 45)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');
        /**
         * Age
         */
        $validator
            ->integer('age')
            ->requirePresence('age', 'create')
            ->notEmptyString('age');
        /**
         * Address
         */
        $validator
            ->scalar('address')
            ->maxLength('address', 45)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');
        /**
         * Email
         */
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add(
                'email',
                'unique',
                [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Already taken'
                ]
            );
        /**
         * Image
         */
        $validator
            ->scalar('image')
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image');
        /**
         * Bio
         */
        $validator
            ->scalar('bio')
            ->maxLength('bio', 140)
            ->requirePresence('bio', 'create')
            ->notEmptyString('bio');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
