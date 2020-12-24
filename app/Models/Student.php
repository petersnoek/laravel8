<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Student extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['student_code', 'voornaam', 'tussenvoegsel', 'achternaam', 'avatar'
        ,'created_by'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->useDisk('avatars')
            ->singleFile()
            ->useFallbackUrl('/images/avatars/anonymous.jpg')
            ->useFallbackPath(public_path('/images/avatars/anonymous.jpg'))
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb128')
                    ->fit("crop", 128, 128)
                    ->width(128)
                    ->height(128);
                $this
                    ->addMediaConversion('thumb256')
                    ->fit("crop", 256, 256)
                    ->width(256)
                    ->height(256);
            });
        ;
    }

    function avatar_url() {
        return $this->getFirstMediaUrl('avatar', 'thumb128');
    }

    function groups() {
        return $this->belongsToMany(Group::class, 'group_student');
    }

    function GetVoornaamTvAchternaam() {
        return $this->voornaam . " " . (strlen($this->tussenvoegsel)>0 ? $this->tussenvoegsel . " " : "") . $this->achternaam;
    }
}
