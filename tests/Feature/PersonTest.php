<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonTest extends TestCase
{
    public function testPerson()
    {
        $person = new Person();
        $person->first_name = 'mursidin';
        $person->last_name = 'mur';
        $person->save();

        self::assertEquals('MURSIDIN mur', $person->full_name);

        $person->full_name = 'joko tingkir';
        $person->save();

        self::assertEquals('JOKO', $person->first_name);
        self::assertEquals('tingkir', $person->last_name);
    }
}
