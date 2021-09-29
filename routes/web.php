<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\Admin\JadwalIbadah;
use App\Http\Livewire\Client\HomeUser;
use App\Http\Livewire\Client\JadwalDetail;
use App\Http\Livewire\CrudGenerator;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Master\Jadwal;
use App\Http\Livewire\Master\TempatIbadah;
use App\Http\Livewire\Master\Petugas;
use App\Http\Livewire\PanduanAdmin;
use App\Http\Livewire\PanduanUmum;
use App\Http\Livewire\Settings\Menu;
use App\Http\Livewire\UserManagement\Permission;
use App\Http\Livewire\UserManagement\PermissionRole;
use App\Http\Livewire\UserManagement\Role;
use App\Http\Livewire\UserManagement\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeUser::class)->name('home');
Route::get('/jadwal/{jadwal_id}', JadwalDetail::class)->name('jadwal.user');
Route::get('/panduan-pengguna', PanduanUmum::class)->name('panduan-pengguna');

Route::post('login', [AuthController::class, 'login'])->name('admin.login');
Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.authorization']], function () {
    // Crud Generator Route
    Route::get('/crud-generator', CrudGenerator::class)->name('crud.generator');

    // user management
    Route::get('/permission', Permission::class)->name('permission');
    Route::get('/permission-role/{role_id}', PermissionRole::class)->name('permission.role');
    Route::get('/role', Role::class)->name('role');
    Route::get('/user', User::class)->name('user');
    Route::get('/menu', Menu::class)->name('menu');

    Route::get('/panduan-admin', PanduanAdmin::class)->name('panduan-admin');

    // App Route
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Master data
    Route::get('/petugas', Petugas::class)->name('petugas');
    Route::get('/tempat-ibadah', TempatIbadah::class)->name('tempat-ibadah');
    Route::get('/jadwal', Jadwal::class)->name('jadwal');
    // jadwal
    Route::get('/data-jadwal', JadwalIbadah::class)->name('data.jadwal');
});
