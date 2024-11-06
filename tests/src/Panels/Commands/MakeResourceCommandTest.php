<?php

use Filament\Support\Config\FileGenerationFlag;
use Filament\Tests\TestCase;

use function PHPUnit\Framework\assertFileDoesNotExist;
use function PHPUnit\Framework\assertFileExists;

uses(TestCase::class);

it('can generate a resource class', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource form', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Schemas/PostForm.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource infolist', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Schemas/PostInfolist.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource table', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Tables/PostsTable.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource list page', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/ListPosts.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource create page', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/CreatePost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource edit page', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/EditPost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource view page', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/ViewPost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource class with embedded form', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--embed-schemas' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource class with embedded infolist', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--embed-schemas' => true,
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource class with embedded table', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--embed-table' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate the resource form content', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--generate' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Schemas/PostForm.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate the resource table content', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--generate' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Tables/PostsTable.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate the form and table content embedded in a resource class', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--embed-schemas' => true,
        '--embed-table' => true,
        '--generate' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource class with soft deletes', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--soft-deletes' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource table with soft deletes', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--soft-deletes' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Tables/PostsTable.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource edit page with soft deletes', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--soft-deletes' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/EditPost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a simple resource class', function () {
    foreach ([
        app_path('Filament/Resources/Posts/Schemas/PostForm.php'),
        app_path('Filament/Resources/Posts/Schemas/PostInfolist.php'),
        app_path('Filament/Resources/Posts/Tables/PostsTable.php'),
    ] as $path) {
        if (! file_exists($path)) {
            continue;
        }

        unlink($path);
    }

    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--simple' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();

    assertFileDoesNotExist(app_path('Filament/Resources/Posts/Schemas/PostForm.php'));
    assertFileDoesNotExist(app_path('Filament/Resources/Posts/Schemas/PostInfolist.php'));
    assertFileDoesNotExist(app_path('Filament/Resources/Posts/Tables/PostsTable.php'));
});

it('can generate a simple resource manage page', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--simple' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/Pages/ManagePosts.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a simple resource class without embedded schemas and table', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Post',
        '--not-embedded' => true,
        '--simple' => true,
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource class in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/PostResource.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource form in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Schemas/PostForm.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource infolist in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Schemas/PostInfolist.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource table in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Tables/PostsTable.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource list page in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Pages/ListPosts.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource create page in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Pages/CreatePost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource edit page in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Pages/EditPost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a resource view page in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--view' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Pages/ViewPost.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});

it('can generate a simple resource manage page in a nested directory', function () {
    $this->artisan('make:filament-resource', [
        'name' => 'Blog/Post',
        '--simple' => true,
        '--model-namespace' => 'Filament\Tests\Models',
        '--panel' => 'admin',
    ])->assertExitCode(0);

    assertFileExists($path = app_path('Filament/Resources/Blog/Posts/Pages/ManagePosts.php'));
    expect(file_get_contents($path))
        ->toMatchSnapshot();
});
