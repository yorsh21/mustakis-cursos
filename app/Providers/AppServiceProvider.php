<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Solicitude;
use App\Models\Postulation;
use App\Models\Parameter;
use App\Models\Event;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    private $allow_view = false;

    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        Carbon::setUtf8(true);

        Blade::if('roles', function ($arguments) {
            $roles = explode(",", $arguments);
            $rol_user_current = User::find(Auth::user()->id)->rol->name;

            if (in_array($rol_user_current, $roles)) {
                return true;
            } else {
                return false;
            }
        });

        Blade::if('noroles', function ($arguments) {
            $roles = explode(",", $arguments);
            $rol_user_current = User::find(Auth::user()->id)->rol->name;

            if (in_array($rol_user_current, $roles)) {
                return false;
            } else {
                return true;
            }
        });

        Blade::if('postulations', function () {
            $today = date('Y-m-d');
            $postulation = Postulation::whereDate('start_date','<=', $today)->whereDate('end_date','>=', $today)->count();
            if($postulation != 0)
                return true;
            else
                return false;
        });

        Blade::if('compareparameter', function ($key, $val) {
            $entry = str_replace("'", "", $key);
            $value = str_replace("'", "", $val);
            $texto = Parameter::where('key', $entry)->first();
            if(!is_null($texto) && $texto->value == $value)
                return true;
            else{
                return false;
            }
        });

        Blade::directive('parameter', function ($key) {
            $entry = str_replace("'", "", $key);
            $texto = Parameter::where('key', $entry)->first();
            if(is_null($texto))
                return '';
            else
                return $texto->value;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
