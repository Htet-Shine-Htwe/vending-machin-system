<?php

namespace Tests\SupportTraits;

use App\Enums\RoleEnum;
use Database\Seeders\RolePermissionSeeder;

trait Authenticated
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        $this->registerAdmin();
    }

    public function registerAdmin(): void
    {
       $this->admin = \App\Models\User::factory()->create()->assignRole(enum_value(RoleEnum::ADMIN));
    }

    public function actingAsUser(): void
    {
        $this->actingAs(\App\Models\User::factory()->create());
    }

    public function actingAsAdmin(): void
    {
        $this->actingAs($this->admin);
    }
}
