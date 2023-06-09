<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "model",
        "make",
        "reg",
        "location_lat",
        "location_lng",
        "featured_photo_url"
    ];

    /**
     * Creates a one-to-one relationship between Aircraft and User.
     * An aircraft belongs to one user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Inverse side of 1:1 relationship;
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Creates a one-to-many relationship between Aircraft and Comments.
     * An aircraft has many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 1:Many relationship.
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    /**
     * Creates a one-to-many relationship between Aircraft and Opinions.
     * An aircraft has many opinions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 1:Many relationship.
     */
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    /**
     * Creates a one-to-many relationship between Aircraft and Notifications.
     * An aircraft belongs to many notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany 1:Many relationship
     */
    public function notifications() {
        return $this->hasMany(Notifications::class);
    }

    /**
     * Create a many-to-many relationship between Tags and Aircraft.
     * An aircraft has many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany Many:Many relationship.
     */
    public function tags()
    {
        return $this->belongsToMany(Aircraft::class, "aircraft_tags", "aircraft_id", "tag_id");
    }

}
