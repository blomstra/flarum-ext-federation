<?php

namespace Blomstra\Federation\Types;

use Flarum\User\User;

class Person extends \ActivityPhp\Type\Extended\Actor\Person
{
    public static function fromUser(User $user): Person
    {
        $person = new Person;
        $person->name = $user->display_name;
        $person->preferredUsername = $user->username;
        $person->slug = $user->slug;
        $person->image = $user->avatar_url;
        $person->published = $user->joined_at->toAtomString();

        return $person;
    }
}
