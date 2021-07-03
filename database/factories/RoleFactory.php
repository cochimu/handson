<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * @return RoleFactory
     */
    public function admin(): RoleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 1,
                'name' => 'Admin',
            ];
        });
    }

    /**
     * @return RoleFactory
     */
    public function manager(): RoleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 2,
                'name' => 'Manager'
            ];
        });
    }

    /**
     * @return RoleFactory
     */
    public function staff(): RoleFactory
    {
        return$this->state(function (array $attributes) {
            return [
                'id' => 3,
                'name' => 'Staff'
            ];
        });
    }
}
