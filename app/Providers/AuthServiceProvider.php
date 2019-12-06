<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Muc;
use App\Models\ChuyenMuc;
use App\Models\BaiViet;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\Slide;
use App\Models\User;
use App\Models\TaiLieu;
use App\Policies\MucPolicy;
use App\Policies\ChuyenMucPolicy;
use App\Policies\BaiVietPolicy;
use App\Policies\GiangVienPolicy;
use App\Policies\SinhVienPolicy;
use App\Policies\SlidePolicy;
use App\Policies\UserPolicy;
use App\Policies\TaiLieuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Muc::class => MucPolicy::class,
        ChuyenMuc::class => ChuyenMucPolicy::class,
        BaiViet::class => BaiVietPolicy::class,
        GiangVien::class => GiangVienPolicy::class,
        SinhVien::class => SinhVienPolicy::class,
        Slide::class => SlidePolicy::class,
        User::class => UserPolicy::class,
        TaiLieu::class => TaiLieuPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
