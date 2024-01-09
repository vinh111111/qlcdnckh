<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
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
    return  redirect()->route('getHomepage');
});

Route::get('/home-page',[PageController::class,'getHomepage'])->name('getHomepage');
Route::get('/category-type/{id}',[PageController::class,'getTypepage'])->name('getTypepage');
Route::get('/detail-page/{id}',[PageController::class,'getProjectdetail'])->name('getProjectdetail');
Route::get('/about',[PageController::class,'getAbout'])->name('getAbout');
Route::get('/category-search', [PageController::class, 'search'])->name('search');
Route::get('/home-contact',[PageController::class,'getContact'])->name('getContact');
Route::post('/home-contact',[PageController::class,'postContact'])->name('postContact');
Route::get('/request-email/{projectLinkType}/{projectId}', [PageController::class, 'requestEmail'])->name('requestEmail');
Route::post('/save-email-content/{projectLinkType}/{projectId}', [PageController::class, 'saveEmailContent'])->name('saveEmailContent');

Route::get('/log-in',[UserController::class,'getLogin'])->name('getLogin');
Route::post('/log-in',[UserController::class,'postLogin'])->name('postLogin');
Route::get('/log-out',[UserController::class,'getLogout'])->name('getLogout');
Route::get('/profile',[UserController::class,'getMyprofile'])->name('getMyprofile');
Route::post('/post-profile/{id}',[UserController::class,'postEditprofile'])->name('postEditprofile');
Route::post('/post-change-password/{id}',[UserController::class,'changepassword'])->name('changepassword');
Route::get('/list-posts',[UserController::class,'getPost'])->name('getPost');
Route::get('/add-posts',[UserController::class,'getPostAdd'])->name('getPostAdd');
Route::post('/add-posts',[UserController::class,'postPostAdd'])->name('postPostAdd');
Route::get('/edit-posts/{id}', [UserController::class, 'getPostEdit'])->name('getPostEdit');
Route::put('/edit-posts/{id}', [UserController::class, 'postPostEdit'])->name('postPostEdit');
Route::delete('delete-posts/{id}',[UserController::class,'deletetProject'])->name('deletetProject');
Route::get('/posts-search', [UserController::class, 'searchPost'])->name('searchPost');
Route::get('/list-approval',[UserController::class,'getApproval'])->name('getApproval');
Route::get('/post-approval/{id}', [UserController::class, 'getApprovalPost'])->name('getApprovalPost');
Route::delete('delete-approval/{id}',[UserController::class,'deletetApproval'])->name('deletetApproval');
Route::delete('delete-notification/{id}',[UserController::class,'deleteNotification'])->name('deleteNotification');
Route::get('/list-approval-view',[UserController::class,'getApproveViewList'])->name('getApproveViewList');
Route::delete('delete-approval-view/{id}',[UserController::class,'deleteApprovalView'])->name('deleteApprovalView');


Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => 'posts'], function () 
    {
        Route::get('admin-list-post', [AdminController::class, 'getAdminPost'])->name('admin.getAdminPost');
        Route::get('admin-add-posts',[AdminController::class,'getAdminPostAdd'])->name('admin.getAdminPostAdd');
        Route::post('admin-add-posts',[AdminController::class,'postAdminPostAdd'])->name('admin.postAdminPostAdd');
        Route::get('admin-edit-posts/{id}', [AdminController::class, 'getAdminPostEdit'])->name('admin.getAdminPostEdit');
        Route::put('admin-edit-posts/{id}', [AdminController::class, 'postAdminPostEdit'])->name('admin.postAdminPostEdit');
        Route::delete('delete-admin-posts/{id}',[AdminController::class,'deletetAdminPost'])->name('admin.deletetAdminPost');
        Route::get('admin-posts-search', [AdminController::class, 'searchAdminPost'])->name('admin.searchAdminPost');
    });
    Route::group(['prefix' => 'profile'], function () 
    {
        Route::get('admin-profile',[AdminController::class,'getMyprofileAdmin'])->name('admin.getMyprofileAdmin');
        Route::post('admin-post-profile/{id}',[AdminController::class,'postEditprofileAdmin'])->name('admin.postEditprofileAdmin');
        Route::post('admin-post-change-password/{id}',[AdminController::class,'changepasswordAdmin'])->name('admin.changepasswordAdmin');
    });
    Route::group(['prefix'=>'category'],function(){
        Route::get('admin-category',[AdminController::class,'getCategoryList'])->name('admin.getCategoryList');
        Route::get('admin-add-category',[AdminController::class,'getCategoryAdd'])->name('admin.getCategoryAdd');
        Route::post('admin-add-category',[AdminController::class,'postCategoryAdd'])->name('admin.postCategoryAdd');
        Route::get('admin-edit-category/{id}',[AdminController::class,'getCategoryEdit'])->name('admin.getCategoryEdit');
        Route::put('admin-edit-category/{id}',[AdminController::class,'postCategoryEdit'])->name('admin.postCategoryEdit');
        Route::delete('admin-delete-category/{id}',[AdminController::class,'deletetCategory'])->name('admin.deletetCategory');
    });
    Route::group(['prefix' => 'user'], function () 
    {
        Route::get('admin-list-user',[AdminController::class,'getUserList'])->name('admin.getUserList');
        Route::get('admin-add-user',[AdminController::class,'getAddUser'])->name('admin.getAddUser');
        Route::post('admin-add-user',[AdminController::class,'postAddUser'])->name('admin.postAddUser');
        Route::get('admin-profile-user/{id}',[AdminController::class,'getUser'])->name('admin.getUser');
        Route::delete('admin-delete-user/{id}',[AdminController::class,'deletetUser'])->name('admin.deletetUser');
        Route::get('admin-users-search', [AdminController::class, 'searchAdminUser'])->name('admin.searchAdminUser');
    });
    Route::group(['prefix' => 'approve'], function () 
    {
        Route::get('admin-approve-project-list',[AdminController::class,'getApproveProjectList'])->name('admin.getApproveProjectList');
        Route::get('admin-approve-project/{id}',[AdminController::class,'getApproveProject'])->name('admin.getApproveProject');
        Route::put('admin-approve-project/{id}',[AdminController::class,'postApproveOrCancelProject'])->name('admin.postApproveOrCancelProject');
    });
    Route::group(['prefix' => 'approve-view'], function () 
    {
        Route::get('admin-approve-view-list',[AdminController::class,'getApproveViewList'])->name('admin.getApproveViewList');
        Route::get('admin-approve-view/{id}',[AdminController::class,'getApproveView'])->name('admin.getApproveView');
        Route::put('admin-approve-view/{id}',[AdminController::class,'postApproveOrCancelView'])->name('admin.postApproveOrCancelView');
        Route::delete('admin-delete-approve-view/{id}',[AdminController::class,'deletetApproveOrCancelView'])->name('admin.deletetApproveOrCancelView');
    });
});
