<?php

namespace Forphp\Blogify\Console\Commands;

use Forphp\Blogify\Events\RoleAssigned;
use Illuminate\Console\Command;

class AssignRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogify:assign-role {user_email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user for the Blogify package';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userEmail = $this->argument('user_email');
        $role = $this->argument('role');

        $userModelClass = config('blogify.author.model');
        $roleColumn = config('blogify.author.role_column', 'role');

        $user = $userModelClass::where('email', $userEmail)->first();

        if (! $user) {
            $this->error("User with email {$userEmail} not found.");
            return;
        }

        $user->{$roleColumn} = $role;
        $user->save();

        event(new RoleAssigned($user, $role));
        $this->info("Successfully assigned role '{$role}' to user {$user->email}.");
    }
}