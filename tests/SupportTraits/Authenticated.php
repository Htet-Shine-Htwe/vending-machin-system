<?php

namespace Tests\SupportTraits;

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Role;

trait Authenticated {

    protected $admin;
    protected $user;


    /**
    * Seed the given seeder classes.
    *
    * @param string[] ...$seederClasses
    * @return void
    */
    public function seedClasses( ...$seederClasses ) {
        foreach ( $seederClasses as $seederClass ) {
            $this->artisan( 'db:seed', [
                '--class' => $seederClass,
            ] );
        }
    }

    /**
    * Register and create an admin user.
    */
    protected function registerAdmin(): void {
        $this->admin = User::factory()->create();
        $this->admin->assignRole( enum_value( RoleEnum::ADMIN ) );
    }

    /**
    * Set the acting user as a regular user.
    *
    * @return $this
    */

    public function actingAsUser() : self {
        $this->user = User::factory()->create();
        $this->actingAs( $this->user );

        return $this;
    }

    /**
    * Set the acting user as an admin.
    *
    * @return $this
    */

    public function actingAsAdmin() : self {
        if ( !$this->admin ) {
            $this->registerAdmin();
        }

        $this->actingAs( $this->admin );

        return $this;
    }
}
