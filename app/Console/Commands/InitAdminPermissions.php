<?php

namespace App\Console\Commands;

use App\Models\ManageUser\Permission\Permission;
use App\Models\ManageUser\Role\Role;
use Illuminate\Console\Command;

class InitAdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:admin-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->call('create:permissions');

        $id_permissions = Permission::select('id')->get();

        $admin = Role::where('normalizeName', 'admin')->first();

        foreach ($id_permissions as $index => $id_permission) {
            $admin->permissions()->attach($id_permission);
        }
    }
}
