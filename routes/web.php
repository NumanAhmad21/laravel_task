<?php

use App\Http\Controllers\Admin\Category\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\BrandController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\PostController;


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
    return view('pages.index');
});
Route::get('/home', function () {
    return view('home');
});

// ####admin routes @#### user not login so redirect to the login page
Route::group(['middleware' => ['admin']], function(){
    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
});


// Admin Section starts here

Route::get('admin', [LoginController::class, 'index'])->name('admin.login');
// Route::get('login', [LoginController::class, 'index'])->name('  login');
Route::post('admin', [LoginController::class, 'login'])->name('login');
// Password Reset Routes...
Route::get('admin/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('admin-password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('admin/reset/password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('admin/update/reset', [ResetPasswordController::class, 'reset'])->name('admin.reset.update');
Route::get('/admin/Change/Password', [AdminController::class, 'ChangePassword'])->name('admin.password.change');
Route::post('/admin/password/update', [AdminController::class, 'Update_pass'])->name('admin.password.update'); 
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// categories
Route::get('admin/categories', [CategoryController::class, 'category'])->name('categories');
Route::post('admin/store/category', [CategoryController::class, 'storecategory'])->name('store.category');
Route::get('delete/category/{id}', [CategoryController::class, 'Deletecategory']);
Route::get('edit/category/{id}', [CategoryController::class, 'Editcategory']);
Route::post('update/category/{id}', [CategoryController::class, 'Updatecategory']);

// Brands
/// Brand 
Route::get('admin/brands', [BrandController::class, 'brand'])->name('brands');
Route::post('admin/store/brand', [BrandController::class, 'storebrand'])->name('store.brand');
Route::get('delete/brand/{id}', [BrandController::class, 'DeleteBrand']);
Route::get('edit/brand/{id}', [BrandController::class, 'EditBrand']);
Route::post('update/brand/{id}', [BrandController::class, 'UpdateBrand']);

// Sub Categories
Route::get('admin/sub/category', [SubCategoryController::class, 'subcategories'])->name('sub.categories');
Route::post('admin/store/subcat', [SubCategoryController::class, 'storesubcat'])->name('store.subcategory');
Route::get('delete/subcategory/{id}', [SubCategoryController::class, 'DeleteSubcat']);
Route::get('edit/subcategory/{id}', [SubCategoryController::class, 'EditSubcat']);

Route::post('update/subcategory/{id}', [SubCategoryController::class, 'UpdateSubcat']);
// end sub categories

// Coupons All 
Route::get('admin/sub/coupon', [CouponController::class, 'Coupon'])->name('admin.coupon');
Route::post('admin/store/coupon', [CouponController::class, 'StoreCoupon'])->name('store.coupon');
Route::get('delete/coupon/{id}', [CouponController::class, 'DeleteCoupon']);
Route::get('edit/coupon/{id}', [CouponController::class, 'EditCoupon']);
Route::post('update/coupon/{id}', [CouponController::class, 'UpdateCoupon']);
//end coupons
// Newslater

Route::get('admin/newslater', [CouponController::class, 'Newslater'])->name('admin.newslater');
Route::get('delete/sub/{id}', [CouponController::class, 'DeleteSub']);
//end newslatter

// Product All Route
 // For Show Sub category with ajax
 Route::get('get/subcategory/{category_id}', [ProductController::class, 'GetSubcat']);

Route::get('admin/product/all', [ProductController::class, 'index'])->name('all.product');
Route::get('admin/product/add', [ProductController::class, 'create'])->name('add.product');
Route::post('admin/store/product', [ProductController::class, 'store'])->name('store.product');

Route::get('inactive/product/{id}', [ProductController::class, 'inactive']);
Route::get('active/product/{id}', [ProductController::class, 'active']);
Route::get('delete/product/{id}', [ProductController::class, 'DeleteProduct']);

Route::get('view/product/{id}', [ProductController::class, 'ViewProduct']);
Route::get('edit/product/{id}', [ProductController::class, 'EditProduct']);

Route::post('update/product/withoutphoto/{id}', [ProductController::class, 'UpdateProductWithoutPhoto']);

Route::post('update/product/photo/{id}', [ProductController::class, 'UpdateProductPhoto']);

//end product routes
// Blog Admin All
//for post category
Route::get('blog/category/list', [PostController::class, 'BlogCatList'])->name('add.blog.categorylist');
Route::post('admin/store/blog', [PostController::class, 'BlogCatStore'])->name('store.blog.category');
Route::get('delete/blogcategory/{id}', [PostController::class, 'DeleteBlogCat']);
Route::get('edit/blogcategory/{id}', [PostController::class, 'EditBlogCat']);
Route::post('update/blog/category/{id}', [PostController::class, 'UpdateBlogCat']);

//for posts
Route::get('admin/add/post', [PostController::class, 'Create'])->name('add.blogpost');
Route::get('admin/all/post', [PostController::class, 'index'])->name('all.blogpost');

Route::post('admin/store/post', [PostController::class, 'store'])->name('store.post');

Route::get('delete/post/{id}', [PostController::class, 'DeletePost']);
Route::get('edit/post/{id}', [PostController::class, 'EditPost']);

Route::post('update/post/{id}', [PostController::class, 'UpdatePost']);

// Admin section ends here

// Frontend All Routes
Route::post('store/newslater', [FrontController::class, 'StoreNewslater'])->name('store.newslater');





