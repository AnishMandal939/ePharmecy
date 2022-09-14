<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// recommendation system
Route::get('/recommend', function () {
    $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
    $selectedId      = intval(app('request')->input('id') ?? '8');
    $selectedProduct = $products[0];

    $selectedProducts = array_filter($products, function ($product) use ($selectedId) { return $product->id === $selectedId; });
    if (count($selectedProducts)) {
        $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
    }

    $productSimilarity = new App\ProductSimilarity($products);
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);

    return view('welcome', compact('selectedId', 'selectedProduct', 'products'));
});

// recommendation system route

// Auth::routes();
// // Frontend Routes
// Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
// Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
// Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);

// Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);

// Route::middleware(['auth'])->group(function(){
//     Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
//     Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);

// });

// // wishlist



// // Backend Routes

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// // Route::prefix('admin')->group(function(){
// //     Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'] );
// // });

// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
//     Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

//     // for slider route
//     Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function (){
//         Route::get('/sliders', 'index');
//         Route::get('/sliders/create', 'create');
//         Route::post('/sliders/create', 'store');
//         Route::get('/sliders/{slider}/edit', 'edit');
//         Route::put('/sliders/{slider}', 'update');
//         Route::get('/sliders/{slider}/delete','destroy');


//     });

//     // using route group controller for reducing repeating same route url for controller
//     Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function (){
//         Route::get('/category', 'index');
//         Route::get('/category/create', 'create');
//         Route::post('/category', 'store');
//         Route::get('/category/{category}/edit', 'edit');
//         Route::put('/category/{category}', 'update');


//     });
//     // Category Routes moded to group controller
//     // Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
//     // Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
//     // Route::post('category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);

//     // for brands
//     Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
    
//     // using route group controller for reducing repeating same route url for controller
//     Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function (){
//         Route::get('/products', 'index');
//         Route::get('/products/create', 'create');
//         Route::post('/products', 'store');
//         Route::get('/products/{product}/edit', 'edit');
//         Route::put('/products/{product}', 'update');
//         Route::get('/products/{product_id}/delete','destroy');
//         // for delete image 
//         Route::get('/product-image/{product_image_id}/delete', 'destroyImage');

//         // for color update controller
//         Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
//         Route::get('/product-color/{prod_color_id}/delete', 'deleteProdColor');

//         // /product-color/"+prod_color_id+"/delete
//     });

//         // for colors
//         Route::get('/colors', App\Http\Livewire\Admin\Brand\Index::class);
    
//         // using route group controller for reducing repeating same route url for controller
//         Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function (){
//             Route::get('/colors', 'index');
//             Route::get('/colors/create', 'create');
//             Route::post('/colors/create', 'store');
//             Route::get('/colors/{color}/edit', 'edit');
//             Route::put('/colors/{color_id}', 'update');
//             Route::get('/colors/{color_id}/delete','destroy');
//             // for delete image 
//             // Route::get('/product-image/{product_image_id}/delete', 'destroyImage');
//         });
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
