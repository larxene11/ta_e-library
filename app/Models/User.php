<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Relations\MorphTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    protected $primaryKey = 'nis_nip';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis_nip',
        'alamat',
        'tlp',
        'jurusan_jabatan',
        'name',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relation
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'nis');
    }
    // public function kunjungan()
    // {
    //     return $this->hasMany(Kunjungan::class, 'nis');
    // }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

    // boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($user) {
            $user->level = 'siswa';
        });
        
        self::updating(function ($user) {
            $new_image = request()->file('image');
            if (request()->hasFile('image')) {
                $user->images()->delete();
                $updated = Image::uploadImage($new_image);
                Image::create([
                    'thumb' => 'thumbnails/' . $updated['thumb']->basename,
                    'src' => 'images/' . $updated['src']->basename,
                    'alt' => Image::getAlt($new_image),
                    'imageable_id' => $user->nis_nip,
                    'imageable_type' => "App\Models\User"
                ]);
            }else{
                $uploaded = Image::uploadImage($new_image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($new_image),
                    'imageable_id' => $user->nis_nip,
                    'imageable_type' => "App\Models\User"
                ]);
            }
        });

        self::deleted(function ($user) {
            $user->images()->delete();
        });
    }
}
