<?php

namespace App\Console\Commands;

use App\Models\ManageUser\Permission\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CreatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permessions command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) { return $route->getAction(); });
        foreach ($routes as $route) {
           $this->storePermission($route);
        }
    }

    private function storePermission($route)
    {
        if(Arr::has($route, 'controller')) {
            $str = $this->normalizePermission($route['controller']);
            if(! $this->permissionAlreadyExists($str)) {
                $permission = new Permission();
                $permission->controller = $this->getController($str);
                $permission->action = $this->getAction($str);
                $permission->slug = $this->getSlug($str);
                $permission->save();
            }
        }

    }

    private function getIndexRoutes()
    {
        return collect(Route::getRoutes())
            ->map(function ($route) { return $route->getName(); });
    }

    private function normalizePermission($route)
    {
        return explode('@', $route);
    }

    private function getController($str)
    {
        $str = str_replace('App\Http\Controllers\\', '', $str[0]);
        return $str;
    }

    private function getAction($str)
    {
        return $str[1];
    }

    private function getSlug($str)
    {
        $controller = explode('\\', $this->getController($str));
        $controller = count($controller) ? $controller[count($controller) -1 ] : $controller[0];
        return Str::slug(str_replace('Controller', '', $controller) . '-' . $this->getAction($str), '-');
    }

    private function permissionAlreadyExists($str)
    {
        $permission = Permission::where('controller', $this->getController($str))->where('action', $this->getAction($str))->get();

        return !! count($permission);
    }
}
