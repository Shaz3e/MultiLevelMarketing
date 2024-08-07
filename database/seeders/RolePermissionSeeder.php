<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = [
            ['guard_name' => 'admin', 'name' => 'superadmin'],
            ['guard_name' => 'admin', 'name' => 'tester'],
            ['guard_name' => 'admin', 'name' => 'developer'],
            ['guard_name' => 'admin', 'name' => 'admin'],
            ['guard_name' => 'admin', 'name' => 'manager'],
            ['guard_name' => 'admin', 'name' => 'staff'],
        ];

        foreach ($roles as $role) {
            $newRole = Role::create($role);

            // Assign Roles to Users
            if ($newRole->name === 'superadmin') {
                $admin = Admin::where('email', 'superadmin@shaz3e.com')->first();
                $admin->assignRole($newRole);
            } elseif ($newRole->name === 'tester') {
                $admin = Admin::where('email', 'tester@shaz3e.com')->first();
                $admin->assignRole($newRole);
            } elseif ($newRole->name === 'developer') {
                $admin = Admin::where('email', 'developer@shaz3e.com')->first();
                $admin->assignRole($newRole);
            }elseif ($newRole->name === 'admin') {
                $admin = Admin::where('email', 'admin@shaz3e.com')->first();
                $admin->assignRole($newRole);
            } elseif ($newRole->name === 'manager') {
                $admin = Admin::where('email', 'manager@shaz3e.com')->first();
                $admin->assignRole($newRole);
            } elseif ($newRole->name === 'staff') {
                $admin = Admin::where('email', 'staff@shaz3e.com')->first();
                $admin->assignRole($newRole);
            }
        }

        // Create all permissions
        $permissions = [
            // User
            ['guard_name' => 'admin', 'name' => 'user.list'],
            ['guard_name' => 'admin', 'name' => 'user.create'],
            ['guard_name' => 'admin', 'name' => 'user.read'],
            ['guard_name' => 'admin', 'name' => 'user.update'],
            ['guard_name' => 'admin', 'name' => 'user.delete'],
            ['guard_name' => 'admin', 'name' => 'user.restore'],
            ['guard_name' => 'admin', 'name' => 'user.force.delete'],
            // Company
            ['guard_name' => 'admin', 'name' => 'company.list'],
            ['guard_name' => 'admin', 'name' => 'company.create'],
            ['guard_name' => 'admin', 'name' => 'company.read'],
            ['guard_name' => 'admin', 'name' => 'company.update'],
            ['guard_name' => 'admin', 'name' => 'company.delete'],
            ['guard_name' => 'admin', 'name' => 'company.restore'],
            ['guard_name' => 'admin', 'name' => 'company.force.delete'],
            // staff
            ['guard_name' => 'admin', 'name' => 'staff.list'],
            ['guard_name' => 'admin', 'name' => 'staff.create'],
            ['guard_name' => 'admin', 'name' => 'staff.read'],
            ['guard_name' => 'admin', 'name' => 'staff.update'],
            ['guard_name' => 'admin', 'name' => 'staff.delete'],
            ['guard_name' => 'admin', 'name' => 'staff.restore'],
            ['guard_name' => 'admin', 'name' => 'staff.force.delete'],
            // Department
            ['guard_name' => 'admin', 'name' => 'department.list'],
            ['guard_name' => 'admin', 'name' => 'department.create'],
            ['guard_name' => 'admin', 'name' => 'department.read'],
            ['guard_name' => 'admin', 'name' => 'department.update'],
            ['guard_name' => 'admin', 'name' => 'department.delete'],
            ['guard_name' => 'admin', 'name' => 'department.restore'],
            ['guard_name' => 'admin', 'name' => 'department.force.delete'],
            // Promotion
            ['guard_name' => 'admin', 'name' => 'promotion.list'],
            ['guard_name' => 'admin', 'name' => 'promotion.create'],
            ['guard_name' => 'admin', 'name' => 'promotion.read'],
            ['guard_name' => 'admin', 'name' => 'promotion.update'],
            ['guard_name' => 'admin', 'name' => 'promotion.delete'],
            ['guard_name' => 'admin', 'name' => 'promotion.restore'],
            ['guard_name' => 'admin', 'name' => 'promotion.force.delete'],
            // Role
            ['guard_name' => 'admin', 'name' => 'role.list'],
            ['guard_name' => 'admin', 'name' => 'role.create'],
            ['guard_name' => 'admin', 'name' => 'role.read'],
            ['guard_name' => 'admin', 'name' => 'role.update'],
            ['guard_name' => 'admin', 'name' => 'role.delete'],
            ['guard_name' => 'admin', 'name' => 'role.restore'],
            ['guard_name' => 'admin', 'name' => 'role.force.delete'],
            // Permission
            ['guard_name' => 'admin', 'name' => 'permission.list'],
            ['guard_name' => 'admin', 'name' => 'permission.create'],
            ['guard_name' => 'admin', 'name' => 'permission.read'],
            ['guard_name' => 'admin', 'name' => 'permission.update'],
            ['guard_name' => 'admin', 'name' => 'permission.delete'],
            ['guard_name' => 'admin', 'name' => 'permission.restore'],
            ['guard_name' => 'admin', 'name' => 'permission.force.delete'],
            // Todo
            ['guard_name' => 'admin', 'name' => 'todo.list'],
            ['guard_name' => 'admin', 'name' => 'todo.create'],
            ['guard_name' => 'admin', 'name' => 'todo.read'],
            ['guard_name' => 'admin', 'name' => 'todo.update'],
            ['guard_name' => 'admin', 'name' => 'todo.delete'],
            ['guard_name' => 'admin', 'name' => 'todo.restore'],
            ['guard_name' => 'admin', 'name' => 'todo.force.delete'],
            // Todo Label
            ['guard_name' => 'admin', 'name' => 'todo-label.list'],
            ['guard_name' => 'admin', 'name' => 'todo-label.create'],
            ['guard_name' => 'admin', 'name' => 'todo-label.read'],
            ['guard_name' => 'admin', 'name' => 'todo-label.update'],
            ['guard_name' => 'admin', 'name' => 'todo-label.delete'],
            ['guard_name' => 'admin', 'name' => 'todo-label.restore'],
            ['guard_name' => 'admin', 'name' => 'todo-label.force.delete'],
            // Task
            ['guard_name' => 'admin', 'name' => 'task.list'],
            ['guard_name' => 'admin', 'name' => 'task.create'],
            ['guard_name' => 'admin', 'name' => 'task.read'],
            ['guard_name' => 'admin', 'name' => 'task.update'],
            ['guard_name' => 'admin', 'name' => 'task.delete'],
            ['guard_name' => 'admin', 'name' => 'task.restore'],
            ['guard_name' => 'admin', 'name' => 'task.force.delete'],
            // Task Label
            ['guard_name' => 'admin', 'name' => 'task-label.list'],
            ['guard_name' => 'admin', 'name' => 'task-label.create'],
            ['guard_name' => 'admin', 'name' => 'task-label.read'],
            ['guard_name' => 'admin', 'name' => 'task-label.update'],
            ['guard_name' => 'admin', 'name' => 'task-label.delete'],
            ['guard_name' => 'admin', 'name' => 'task-label.restore'],
            ['guard_name' => 'admin', 'name' => 'task-label.force.delete'],
            // Pin Codes
            ['guard_name' => 'admin', 'name' => 'pin-code.list'],
            ['guard_name' => 'admin', 'name' => 'pin-code.create'],
            ['guard_name' => 'admin', 'name' => 'pin-code.read'],
            ['guard_name' => 'admin', 'name' => 'pin-code.update'],
            ['guard_name' => 'admin', 'name' => 'pin-code.delete'],
            ['guard_name' => 'admin', 'name' => 'pin-code.restore'],
            ['guard_name' => 'admin', 'name' => 'pin-code.force.delete'],
            // Ranking
            ['guard_name' => 'admin', 'name' => 'ranking.list'],
            ['guard_name' => 'admin', 'name' => 'ranking.create'],
            ['guard_name' => 'admin', 'name' => 'ranking.read'],
            ['guard_name' => 'admin', 'name' => 'ranking.update'],
            ['guard_name' => 'admin', 'name' => 'ranking.delete'],
            ['guard_name' => 'admin', 'name' => 'ranking.restore'],
            ['guard_name' => 'admin', 'name' => 'ranking.force.delete'],
            // Ledger
            ['guard_name' => 'admin', 'name' => 'ledger.list'],
            ['guard_name' => 'admin', 'name' => 'ledger.create'],
            ['guard_name' => 'admin', 'name' => 'ledger.read'],
            ['guard_name' => 'admin', 'name' => 'ledger.update'],
            ['guard_name' => 'admin', 'name' => 'ledger.delete'],
            ['guard_name' => 'admin', 'name' => 'ledger.restore'],
            ['guard_name' => 'admin', 'name' => 'ledger.force.delete'],
            // Support Ticket
            ['guard_name' => 'admin', 'name' => 'support-ticket.list'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.create'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.read'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.update'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.delete'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.restore'],
            ['guard_name' => 'admin', 'name' => 'support-ticket.force.delete'],
            // Support Ticket Status
            ['guard_name' => 'admin', 'name' => 'ticket-status.list'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.create'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.read'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.update'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.delete'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.restore'],
            ['guard_name' => 'admin', 'name' => 'ticket-status.force.delete'],
            // Support Ticket Priority
            ['guard_name' => 'admin', 'name' => 'ticket-priority.list'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.create'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.read'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.update'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.delete'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.restore'],
            ['guard_name' => 'admin', 'name' => 'ticket-priority.force.delete'],
            // Knowledgebase Category
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.list'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.create'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.read'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.update'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.delete'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.restore'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-category.force.delete'],
            // Knowledgebase Article
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.list'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.create'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.read'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.update'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.delete'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.restore'],
            ['guard_name' => 'admin', 'name' => 'knowledgebase-article.force.delete'],
            
            // Company Account
            ['guard_name' => 'admin', 'name' => 'company-account.list'],
            ['guard_name' => 'admin', 'name' => 'company-account.create'],
            ['guard_name' => 'admin', 'name' => 'company-account.read'],
            ['guard_name' => 'admin', 'name' => 'company-account.update'],
            ['guard_name' => 'admin', 'name' => 'company-account.delete'],
            ['guard_name' => 'admin', 'name' => 'company-account.restore'],
            ['guard_name' => 'admin', 'name' => 'company-account.force.delete'],
            
            // General Setting
            ['guard_name' => 'admin', 'name' => 'general-setting.list'],
            ['guard_name' => 'admin', 'name' => 'general-setting.read'],
            ['guard_name' => 'admin', 'name' => 'general-setting.update'],
            
            // Authentication Setting
            ['guard_name' => 'admin', 'name' => 'authentication-setting.list'],
            ['guard_name' => 'admin', 'name' => 'authentication-setting.read'],
            ['guard_name' => 'admin', 'name' => 'authentication-setting.update'],
            
            // Dashboard Setting
            ['guard_name' => 'admin', 'name' => 'dashboard-setting.list'],
            ['guard_name' => 'admin', 'name' => 'dashboard-setting.read'],
            ['guard_name' => 'admin', 'name' => 'dashboard-setting.update'],
            
            // Payment Method Setting
            ['guard_name' => 'admin', 'name' => 'payment-method-setting.list'],
            ['guard_name' => 'admin', 'name' => 'payment-method-setting.read'],
            ['guard_name' => 'admin', 'name' => 'payment-method-setting.update'],
            // Payment Method
            ['guard_name' => 'admin', 'name' => 'payment-method.list'],
            ['guard_name' => 'admin', 'name' => 'payment-method.create'],
            ['guard_name' => 'admin', 'name' => 'payment-method.read'],
            ['guard_name' => 'admin', 'name' => 'payment-method.update'],
            ['guard_name' => 'admin', 'name' => 'payment-method.delete'],
            ['guard_name' => 'admin', 'name' => 'payment-method.restore'],
            ['guard_name' => 'admin', 'name' => 'payment-method.force.delete'],
            
            // Mail Setting
            ['guard_name' => 'admin', 'name' => 'mail-setting.list'],
            ['guard_name' => 'admin', 'name' => 'mail-setting.read'],
            ['guard_name' => 'admin', 'name' => 'mail-setting.update'],
            
            // Currency Setting
            ['guard_name' => 'admin', 'name' => 'currency-setting.list'],
            ['guard_name' => 'admin', 'name' => 'currency-setting.read'],
            ['guard_name' => 'admin', 'name' => 'currency-setting.update'],

            // Currency Article
            ['guard_name' => 'admin', 'name' => 'currency.list'],
            ['guard_name' => 'admin', 'name' => 'currency.create'],
            ['guard_name' => 'admin', 'name' => 'currency.read'],
            ['guard_name' => 'admin', 'name' => 'currency.update'],
            ['guard_name' => 'admin', 'name' => 'currency.delete'],
            ['guard_name' => 'admin', 'name' => 'currency.restore'],
            ['guard_name' => 'admin', 'name' => 'currency.force.delete'],
            
            // SMS Setting
            ['guard_name' => 'admin', 'name' => 'sms-setting.list'],
            ['guard_name' => 'admin', 'name' => 'sms-setting.read'],
            ['guard_name' => 'admin', 'name' => 'sms-setting.update'],

            // Add more permissions here...
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to superadmin
        $superAdminRole = Role::where('guard_name', 'admin')->where('name', 'superadmin')->first();
        $superAdminRole->givePermissionTo(Permission::all());
        $superAdminRole = Role::where('guard_name', 'admin')->where('name', 'tester')->first();
        $superAdminRole->givePermissionTo(Permission::all());
        $superAdminRole = Role::where('guard_name', 'admin')->where('name', 'developer')->first();
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign permissions to admin
        $adminRole = Role::where('guard_name', 'admin')->where('name', 'admin')->first();
        $adminRole->givePermissionTo(
            Permission::where('name', 'NOT LIKE', '%restore%')
                ->where('name', 'NOT LIKE', '%force.delete%')
                ->get()
        );

        $managerRole = Role::where('guard_name', 'admin')->where('name', 'manager')->first();
        $managerRole->givePermissionTo(
            Permission::where('name', 'NOT LIKE', '%delete%')
                ->where('name', 'NOT LIKE', '%restore%')
                ->where('name', 'NOT LIKE', '%force.delete%')
                ->get()
        );

        $staffRole = Role::where('guard_name', 'admin')->where('name', 'staff')->first();
        $staffRole->givePermissionTo(
            Permission::where('name', 'NOT LIKE', '%create%')
                ->where('name', 'NOT LIKE', '%update')
                ->where('name', 'NOT LIKE', '%delete')
                ->where('name', 'NOT LIKE', '%restore')
                ->where('name', 'NOT LIKE', '%force.delete%')
                ->get()
        );
    }
}
