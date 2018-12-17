<?php

namespace Users\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Contracts\{LoginRegisterInterface,UserInterface};

class LoginRegister extends Model implements LoginRegisterInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'success', 'details'
    ];

    /**
     * LoginRegister constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->checkId();
    }

    /**
     * get user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Users\Models\User');
    }

    /**
     * set new id (part of composed PK) if not set
     */
    private function checkId()
    {
        if (empty($this->id)) {
            $this->id = $this->getNextId(null);
        }
    }

    /**
     * get new id (part of PK)
     *
     * @param null|UserInterface $user
     * @return int
     */
    public function getNextId(?UserInterface $user): int
    {
        $id = 1;
        if ($user instanceof UserInterface) {
            $max = LoginRegister::where('user_id', $user->getId())->max('id');
            if (!empty($max)) {
                $id = $max+1;
            }
        } elseif (!empty($this->user())) {
            $max = LoginRegister::where('user_id', $this->user->getId())->max('id');
            if (!empty($max)) {
                $id = $max+1;
            }
        }
        return $id;
    }

    /**
     * Save the model to the database.
     *
     * @param  array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->checkId();
        return parent::save($options);
    }
}