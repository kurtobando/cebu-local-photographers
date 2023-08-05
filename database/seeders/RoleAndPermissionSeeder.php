<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::create(['name' => UserRoleEnum::SUPER_ADMIN->value]);
        $admin = Role::create(['name' => UserRoleEnum::ADMIN->value]);
        $moderator = Role::create(['name' => UserRoleEnum::MODERATOR->value]);
        $user = Role::create(['name' => UserRoleEnum::USER->value]);

        // post
        Permission::create(['name' => 'store post']);
        Permission::create(['name' => 'update post']);
        Permission::create(['name' => 'delete post']);
        $superAdmin->givePermissionTo(['update post', 'delete post']);
        $admin->givePermissionTo(['store post', 'update post', 'delete post']);
        $moderator->givePermissionTo(['store post', 'update post', 'delete post']);
        $user->givePermissionTo(['store post', 'update post', 'delete post']);

        // comments
        Permission::create(['name' => 'store comment']);
        Permission::create(['name' => 'update comment']);
        Permission::create(['name' => 'delete comment']);
        $superAdmin->givePermissionTo(['update comment', 'delete comment']);
        $admin->givePermissionTo(['store comment', 'update comment', 'delete comment']);
        $moderator->givePermissionTo(['store comment', 'update comment', 'delete comment']);
        $user->givePermissionTo(['store comment', 'update comment', 'delete comment']);

        // followers
        Permission::create(['name' => 'store follow']);
        Permission::create(['name' => 'update follow']);
        Permission::create(['name' => 'delete follow']);
        $admin->givePermissionTo(['store follow', 'update follow', 'delete follow']);
        $moderator->givePermissionTo(['store follow', 'update follow', 'delete follow']);
        $user->givePermissionTo(['store follow', 'update follow', 'delete follow']);

        // likes
        Permission::create(['name' => 'store like']);
        Permission::create(['name' => 'update like']);
        Permission::create(['name' => 'delete like']);
        $admin->givePermissionTo(['store like', 'update like', 'delete like']);
        $moderator->givePermissionTo(['store like', 'update like', 'delete like']);
        $user->givePermissionTo(['store like', 'update like', 'delete like']);

        // save later
        Permission::create(['name' => 'store save-later']);
        Permission::create(['name' => 'update save-later']);
        Permission::create(['name' => 'delete save-later']);
        $admin->givePermissionTo(['store save-later', 'update save-later', 'delete save-later']);
        $moderator->givePermissionTo(['store save-later', 'update save-later', 'delete save-later']);
        $user->givePermissionTo(['store save-later', 'update save-later', 'delete save-later']);

        // events
        Permission::create(['name' => 'store event']);
        Permission::create(['name' => 'update event']);
        Permission::create(['name' => 'delete event']);
        $superAdmin->givePermissionTo(['update event', 'delete event']);
        $admin->givePermissionTo(['store event', 'update event', 'delete event']);
        $moderator->givePermissionTo(['store event', 'update event', 'delete event']);

        // event attendees
        Permission::create(['name' => 'store event-attendee']);
        Permission::create(['name' => 'update event-attendee']);
        Permission::create(['name' => 'delete event-attendee']);
        $user->givePermissionTo(['store event-attendee', 'update event-attendee', 'delete event-attendee']);
        $moderator->givePermissionTo(['store event-attendee', 'update event-attendee', 'delete event-attendee']);
        $admin->givePermissionTo(['store event-attendee', 'update event-attendee', 'delete event-attendee']);

        // users
        Permission::create(['name' => 'store user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        $superAdmin->givePermissionTo(['store user', 'update user', 'delete user']);
        $admin->givePermissionTo(['store user', 'update user']);

        // user profile
        Permission::create(['name' => 'store user-profile']);
        Permission::create(['name' => 'update user-profile']);
        Permission::create(['name' => 'delete user-profile']);
        $superAdmin->givePermissionTo(['store user-profile', 'update user-profile', 'delete user-profile']);
        $admin->givePermissionTo(['store user-profile', 'update user-profile']);
        $moderator->givePermissionTo(['store user-profile', 'update user-profile']);
        $user->givePermissionTo(['store user-profile', 'update user-profile']);
    }
}

