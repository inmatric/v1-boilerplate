<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SidebarMenus extends Component
{
    public $menus;

    public function __construct()
    {
$role = Auth::check() ? Auth::user()->role_name : null;
        $allMenus = [
            ['name' => 'Dashboard', 'href' => '/dashboard', 'roles' => ['admin', 'hrd', 'user']], //
            ['name' => 'Users', 'href' => '/users', 'roles' => ['admin']], //
            ['name' => 'Cooperations', 'href' => '/cooperations', 'roles' => ['admin']],//
            ['name' => 'Employee', 'href' => '/employees', 'roles' => ['hrd','admin']],
            ['name' => 'Employee Contract', 'href' => '/employee-contracts', 'roles' => ['hrd','admin']],
            ['name' => 'Work Table', 'href' => '/works', 'roles' => ['hrd','admin']],
            ['name' => 'Work Equipment', 'href' => '/work_equipments', 'roles' => ['user','admin']],
            ['name' => 'SOP', 'href' => '/worktools', 'roles' => ['hrd','admin','user']],
            ['name' => 'Location', 'href' => '/locations', 'roles' => ['admin']],
            ['name' => 'Location Division', 'href' => '/location-divisions', 'roles' => ['admin','user']],
            ['name' => 'Attendance', 'href' => '/attendances', 'roles' => ['admin', 'hrd', 'user']],
            ['name' => 'Work Tracking', 'href' => '/processing_wds', 'roles' => ['hrd','admin','user']],
            ['name' => 'Complaint', 'href' => '/complaints', 'roles' => ['admin', 'user']],
            ['name' => 'Complaint Resolutions', 'href' => '/complaint_resolutions', 'roles' => ['admin','user']],
            ['name' => 'Employee Evaluations', 'href' => '/employeeevaluations', 'roles' => ['hrd','admin','user']],
            ['name' => 'Offence', 'href' => '/offences', 'roles' => ['hrd','admin','user']],
            ['name' => 'Report', 'href' => '/workreports', 'roles' => ['admin', 'hrd', 'user']],
            ['name' => 'Lost/Found', 'href' => '/lostitems', 'roles' => ['admin','user']],
            ['name' => 'Permission', 'href' => '/permission-requests', 'roles' => ['admin', 'hrd', 'user']],
            ['name' => 'Fund', 'href' => '/funds', 'roles' => ['admin', 'hrd']],
        ];

        $this->menus = collect($allMenus)->filter(function ($menu) use ($role) {
            return in_array($role, $menu['roles']);
        })->toArray();
    }

    public function render()
    {
        return view('components.sidebar-menus');
    }
}
