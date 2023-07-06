<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Relations\MorphTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
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
        return $this->morphMany(Image::class, 'imageable');
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'nis');
    }
    // public function kunjungan()
    // {
    //     return $this->hasMany(Kunjungan::class, 'nis');
    // }

    // boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($user) {
            $user->nis_nip = request()->nis_nip;
            $user->level = 'siswa';
        });

        self::created(function ($user) {
            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $user->nis_nip,
                    'imageable_type' => "App\Models\User"
                ]);
            }
        });

        self::updating(function ($user) {

            $img_array = explode(',', request()->deleted_images);
            array_pop($img_array);

            // dd($img_array);
            // dd(Image::whereIn('id', $img_array)->get());
            foreach ($img_array as $key => $image_id) {
                $will_deleted_image = Image::find($image_id);
                if (!is_null($will_deleted_image)) {
                    $will_deleted_image->delete();
                }
            }

            foreach (request()->file('images') ?? [] as $key => $image) {
                $uploaded = Image::uploadImage($image);
                Image::create([
                    'thumb' => 'thumbnails/' . $uploaded['thumb']->basename,
                    'src' => 'images/' . $uploaded['src']->basename,
                    'alt' => Image::getAlt($image),
                    'imageable_id' => $user->nis_nip,
                    'imageable_type' => "App\Models\User"
                ]);
            }
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($user) {
            foreach ($user->images as $key => $image) {
                $image->delete();
            }
        });

        self::deleted(function ($user) {
            $user->detail()->delete();
        });
    }
}
