<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomesliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;

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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('frontend.index');
// });

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Admin All route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
        Route::get('/edit/profile', 'Editprofile')->name('edit.profile');
        Route::POST('/store/profile', 'storeprofile')->name('store.profile');
        Route::get('/change/password', 'changepassword')->name('change.password');
        Route::post('/update/password', 'updatepassword')->name('update.password');
    });

});


// Home slider route
Route::controller(HomesliderController::class)->group(function(){
    Route::get('/home/slide', 'homeslider')->name('home.slide');
    Route::post('/update/slide/{id?}', 'updateslider')->name('update.silder');
    Route::get('/', 'homeMain')->name('home');

});

// About page route
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/slide', 'aboutslider')->name('about.slider');
    Route::post('/update/about/{id?}', 'updateabout')->name('update.about');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/about/multi/image', 'aboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'storemultiimage')->name('store.multi.image');
    Route::get('/all/multi/image', 'allmultiimage')->name('all.multi.image');
    Route::get('/all/multi/image/{id}', 'editmultiimage')->name('edit.mutli.image');
    Route::post('/update/multi/image/{id}', 'updatemultiimage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'deletemultiimage')->name('delete.mutli.image');

});

 // portfolio route
Route::controller(PortfolioController::class)->group(function(){
    Route::get('/all/portfolio', 'allPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'addPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'storePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}','editPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio/{id}','updatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}','deletePortfolio')->name('delete.portfolio');
    Route::get('/portfolio/details/{id}','detailsPortfolio')->name('portfolio.details');
    Route::get('/portfolio','HomePortfolio')->name('home.portfolio');

});
// BlogCategory  route
Route::controller(BlogCategoryController::class)->group(function(){
    Route::get('/all/blog/category', 'allblogcategory')->name('all.blog.category');
    Route::get('/add/blog/category', 'addblogcategory')->name('add.blog.category');
    Route::post('/store/blog/category', 'storeblogcategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}','editblogcategory')->name('edit.blog.category');
    Route::post('/update/blog/category/{id}','updateblogcategory')->name('update.blog.category');
    Route::get('/delete/blog/category/{id}','deleteblogcategory')->name('delete.blog.category');


});

// Blog  route
Route::controller(BlogController::class)->group(function(){
    Route::get('/all/blog', 'allblog')->name('all.blog');
    Route::get('/add/blog', 'addblog')->name('add.blog');
    Route::post('/store/blog', 'storeblog')->name('store.blog');
    Route::get('/edit/blog/{id}', 'editblog')->name('edit.blog');
    Route::post('/update/blog/{id}', 'updateblog')->name('update.blog');
    Route::get('/delete/blog/{id}', 'deleteblog')->name('delete.blog');
    Route::get('/blog/details/{id}', 'blogdetails')->name('blog.details');
    Route::get('/category/blog/{id}', 'categoryblog')->name('category.blog');
    Route::get('/blog', 'homeblog')->name('home.blog');


});

// footer route
Route::controller(FooterController::class)->group(function(){
    Route::get('/footer/setup', 'footersetup')->name('footer.setup');
    Route::post('/footer/setup/{id}', 'UpdateFooter')->name('update.footer');


});
// contact route
Route::controller(ContactController::class)->group(function(){
    Route::get('/contact', 'contact')->name('contact.me');
    Route::post('/store/message', 'storemessage')->name('store.message');
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');
    Route::get('/delete/message/{id}', 'deletemessage')->name('delete.message');

});

require __DIR__.'/auth.php';
