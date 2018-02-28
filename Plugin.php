<?php namespace PopcornPHP\RedirectToHTTPS;

use BackendAuth;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'RedirectToHTTPS',
            'description' => 'Simple plugin for redirect all request to HTTPS',
            'author'      => 'Alexander Shapoval',
            'icon'        => 'icon-exchange',
            'homepage'    => 'https://github.com/PopcornPHP/oc-redirect-to-https'
        ];
    }

    public function boot()
    {
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->prependMiddleware('PopcornPHP\RedirectToHTTPS\Classes\HTTPSMiddleware');
	}
	
    public function registerSettings()
    {
     $user = BackendAuth::getUser();
      if($user->is_superuser){
        return [
            'redirect_to_https_settings' => [
                'label'       => 'Redirect to https',
                'description' => 'Redirect to https management',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-refresh',
                'class'       => 'PopcornPHP\RedirectToHTTPS\Models\Settings',
                'order'       => 500,
                'keywords'    => 'https redirect'
            ]
        ];
      }
      return [];
    }
}
