<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $generated_number
 * @property string $credits_used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereCreditsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereGeneratedNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|History whereUserId($value)
 */
	class History extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $webID
 * @property string|null $website
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG whereWebID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NG whereWebsite($value)
 */
	class NG extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $webID
 * @property string|null $website
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA whereWebID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|USA whereWebsite($value)
 */
	class USA extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $credits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

