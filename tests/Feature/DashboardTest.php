<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated admin is redirected to admin dashboard', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('admin.dashboard'));
});

test('authenticated tutor is redirected to tutor dashboard', function () {
    $user = User::factory()->tutor()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('tutor.dashboard'));
});

test('admin can access admin dashboard', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->get(route('admin.dashboard'));
    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Admin/Dashboard'));
});

test('tutor can access tutor dashboard', function () {
    $user = User::factory()->tutor()->create();

    $response = $this->actingAs($user)->get(route('tutor.dashboard'));
    $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Tutor/Dashboard'));
});

test('tutor cannot access admin dashboard', function () {
    $user = User::factory()->tutor()->create();

    $response = $this->actingAs($user)->get(route('admin.dashboard'));
    $response->assertForbidden();
});

test('admin cannot access tutor dashboard', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->get(route('tutor.dashboard'));
    $response->assertForbidden();
});
