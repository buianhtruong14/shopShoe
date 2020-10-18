<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

//Frontend

Route::get('/', [HomeController::class, 'index'] );
Route::get('/trang-chu', [HomeController::class, 'index'] );
Route::post('/search', [HomeController::class, 'search'] );

//FF   Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'showCategoryHome'] );
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'showBrandHome'] );
Route::get('/chi-tiet-san-pham/{pro_id}', [Product::class, 'showProductDetail'] );

//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class,'showDashBoard']);
Route::get('/logout',[AdminController::class,'logOut']);
Route::post('/admin-dashboard',[AdminController::class,'dashBoard']);

//Category Product

Route::get('/add-category-product',[CategoryProduct::class,'addCategoryProduct']);
Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class,'editCategoryProduct']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class,'deleteCategoryProduct']);
Route::get('/all-category-product',[CategoryProduct::class,'allCategoryProduct']);

Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class,'activeCategoryProduct']);
Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class,'unactiveCategoryProduct']);

Route::post('/save-category-product',[CategoryProduct::class,'saveCategoryProduct']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class,'updateCategoryProduct']);

//Brand Product

Route::get('/add-brand-product',[BrandProduct::class,'addBrandProduct']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class,'editBrandProduct']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class,'deleteBrandProduct']);
Route::get('/all-brand-product',[BrandProduct::class,'allBrandProduct']);

Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class,'activeBrandProduct']);
Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class,'unactiveBrandProduct']);

Route::post('/save-brand-product',[BrandProduct::class,'saveBrandProduct']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class,'updateBrandProduct']);

// Product

Route::get('/add-product',[Product::class,'addProduct']);
Route::get('/edit-product/{product_id}',[Product::class,'editProduct']);
Route::get('/delete-product/{product_id}',[Product::class,'deleteProduct']);
Route::get('/all-product',[Product::class,'allProduct']);

Route::get('/active-product/{product_id}',[Product::class,'activeProduct']);
Route::get('/unactive-product/{product_id}',[Product::class,'unactiveProduct']);

Route::post('/save-product',[Product::class,'saveProduct']);
Route::post('/update-product/{product_id}',[Product::class,'updateProduct']);


// Cart
Route::post('/save-cart',[CartController::class,'saveCart']);
Route::post('/update-cart-quantity',[CartController::class,'updateCartQuantity']);
Route::get('/show-cart',[CartController::class,'showcart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class,'deleteToCart']);

//Checkout 
Route::get('/login-checkout',[CheckoutController::class,'loginCheckout']);
Route::get('/logout-checkout',[CheckoutController::class,'logoutCheckout']);
Route::get('/checkout',[CheckoutController::class,'checkout']);

// User
Route::get('/login',[CheckoutController::class,'loginCheckout']);
Route::get('/register',[CheckoutController::class,'register']);
Route::post('/add-customer',[CheckoutController::class,'addCustomer']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::post('/save-checkout-customer',[CheckoutController::class,'saveCheckoutCustomer']);
Route::post('/login-customer',[CheckoutController::class,'loginCustomer']);