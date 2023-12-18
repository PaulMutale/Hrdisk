<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class Employee extends Authenticatable implements HasMedia 
{
    use InteractsWithMedia,SoftDeletes,Notifiable;
    

    //use HasMediaTrait;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'birthdate',
        'employee_start_date',
        'employee_end_date',
        'media_id',
        'address',
        'gender',
        'remark',
        'position_id',
        'schedule_id',
        'rate_per_hour',
        'salary',
        'is_active',
        'tpin',
        'branch_name',
        'security_number',
        'password'
        

    ];

    protected $hidden = [
        'avatarMedia',
    ];

    protected $appends = ['media_url','created_on','total_working_hour','gross_amount'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];







    public function getRouteKeyName()
    {
        return 'employee_id';
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }

   
  /*  
    public static function boot()
{
    parent::boot();
    self::creating(function ($model) {
        $model->employee_id = IdGenerator::generate(['table' => 'employees','field'=>'employee_id', 'length' => 7, 'prefix' =>'STAFF']);
    });
}
   */ 
  

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                ->format('png')
                ->width(128)
                ->height(128);
            });
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class, 'employee_id', 'id');
    }

    public function cashAdvances()
    {
        return $this->hasMany(CashAdvance::class, 'employee_id', 'id');
    }

    public function leave_days()
    {
        return $this->hasMany(leave_days::class, 'employee_id', 'id');
    }

    public function getTotalWorkingHourAttribute()
    {
        return $this->attendances->sum('num_hour');
    }

    public function getGrossAmountAttribute()
    {
        return ($this->attendances->sum('num_hour') * $this->attributes['rate_per_hour'])/60;
    }

    protected function avatarMedia()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }

    public function getMediaUrlAttribute()
    {
        $avatar = strtolower($this->attributes['gender'].'.png');
        $url = [
            'original' => url('admin_assets/avatars/employee/'.$avatar),
            'thumb' => url('admin_assets/avatars/employee/thumb/'.$avatar),
        ];
        if (!is_null($this->attributes['media_id']) && !is_null($this->avatarMedia)) {
            $imgurl = $this->avatarMedia->getFullUrl();
            // $imgHeaders = @get_headers( str_replace(" ", "%20", $imgurl) )[0];
            // if(file_exists($this->avatarMedia->getPath()) && ($imgHeaders != 'HTTP/1.1 404 Not Found')){
            $url = [
                'original' => $this->avatarMedia->getFullUrl(),
                'thumb' => $this->avatarMedia->getFullUrl('thumb'),
            ];
            // }
        }
        return $url;
    }

    public function getCreatedOnAttribute()
    {
        $dt = $this->attributes['created_at'];
        $date = date('M d, Y', strtotime($dt));
        return $date;
    }
  
  
  
  


    public function getCreatedAtAttribute()
    {
        $dt = $this->attributes['created_at'];
        $date = date('M d, Y', strtotime($dt));
        return $date;
    }
}