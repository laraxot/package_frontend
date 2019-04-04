<?php



namespace XRA\Frontend;

use Illuminate\Support\ServiceProvider;
use XRA\Extend\Traits\ServiceProviderTrait;

class FrontendServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    protected $defer = true;
}
