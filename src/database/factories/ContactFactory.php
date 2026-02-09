<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
  protected $model = Contact::class;

    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'gender' =>$this->faker->numberBetween(1,3),
            'email' => $this->faker->safeEmail(),
           'tel' => $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->realText(120),

        ];
    }
}
