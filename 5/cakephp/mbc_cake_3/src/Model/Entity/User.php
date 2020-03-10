<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $change_password_activation
 * @property string|null $password_to_be_use
 * @property string $fullname
 * @property int $age
 * @property string $address
 * @property string $email
 * @property string $image
 * @property string $bio
 * @property string $activation_code
 * @property int $activated
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\PostComment[] $post_comments
 * @property \App\Model\Entity\PostLike[] $post_likes
 * @property \App\Model\Entity\Post[] $posts
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'fullname' => true,
        'age' => true,
        'address' => true,
        'email' => true,
        'image' => true,
        'bio' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    /**
     * Hide the password in the field
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    /**
     * Hash the password before saving
     *
     * @param  [type] $value
     * @return void
     */
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
