<?php

use App\Models\Member;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/members/phones', function () {
    $members = Member::query()
        ->with('phone')
        ->orderBy('id')
        ->get();

    return view('member-phones.index', [
        'members' => $members,
    ]);
})->name('members.phones.index');

Route::get('/members', function () {
    $members = Member::query()
        ->withCount('posts')
        ->orderBy('id')
        ->get();

    return view('members.index', [
        'members' => $members,
    ]);
})->name('members.index');

Route::get('/members/{member}', function (Member $member) {
    $member->load([
        'phone',
        'posts' => fn ($query) => $query->orderBy('id'),
    ]);

    return view('members.show', [
        'member' => $member,
    ]);
})->whereNumber('member')->name('members.show');
