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
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property bool $is_published
 * @property \App\Enums\Status $status
 * @property \App\Enums\Region $region
 * @property int|null $venue_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Speaker> $speakers
 * @property-read int|null $speakers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Talk> $talks
 * @property-read int|null $talks_count
 * @property-read \App\Models\Venue|null $venue
 * @method static \Database\Factories\ConferenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Conference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conference query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereVenueId($value)
 */
	class Conference extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $avatar
 * @property string $email
 * @property array|null $qualifications
 * @property string|null $bio
 * @property string|null $twitter_handle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conference> $conferences
 * @property-read int|null $conferences_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Talk> $talks
 * @property-read int|null $talks_count
 * @method static \Database\Factories\SpeakerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker query()
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereQualifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereTwitterHandle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speaker whereUpdatedAt($value)
 */
	class Speaker extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $abstract
 * @property \App\Enums\TalkLength $length
 * @property \App\Enums\TalkStatus $status
 * @property string $new_talk
 * @property int $speaker_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conference> $conferences
 * @property-read int|null $conferences_count
 * @property-read \App\Models\Speaker|null $speaker
 * @method static \Database\Factories\TalkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Talk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereNewTalk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereSpeakerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talk whereUpdatedAt($value)
 */
	class Talk extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $country
 * @property string $postal_code
 * @property \App\Enums\Region $region
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conference> $conferences
 * @property-read int|null $conferences_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\VenueFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereUpdatedAt($value)
 */
	class Venue extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

