<?php

namespace Azizner\Providers;

use Azizner\Message;
use Azizner\Policies\MessagePolicy;
use Azizner\Policies\PostPolicy;
use Azizner\Post;
use Azizner\Policies\AnnouncementPolicy;
use Azizner\Announcement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'Azizner\Model' => 'Azizner\Policies\ModelPolicy',
        Post::class =>PostPolicy::class,
        Announcement::class =>AnnouncementPolicy::class,
        Message::class=>MessagePolicy::class,
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
