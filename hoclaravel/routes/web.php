<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get("/", function () {
    return '<h1 style="text-align: center;">Trang chủ Hoàng Tú học Lavarel</h1>';
})->name("home");

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', function () {
//     $user = new User();
//     $allUser = $user::all();
//     dd($user);
//     return view('home');
// });

// Route::get('/product', function () {
//     return view('product');
// });

// Route::get("/", function () {
//     $html = "<h1>Đây là trang homepage</h1>";

//     return $html;
// });

// Route::get("/unicode", function () {
    
//     return View('form');
// });


// Route::post("/unicode", function () {
    
//     return "Đây là POST Path";
// });

// Route::put("/unicode", function () {
    
//     return "Đây là PUT Path";
// });

// Route::delete("/unicode", function () {
    
//     return "Đây là DELETE Path";
// });

// Route::match(['get', 'post'], '/unicode', function() {
//     return $_SERVER['REQUEST_METHOD'];
// });

// Route::any('/unicode', function(Request $request) {
//     return $request->method();
// });

// Route::get("/show-form", function() { 
//     return view('form');
// });

// Route::redirect("unicode","show-form",302);

// Route::view("show-form","form");

// Route::get("/home", function() {
//     return view("home");
// })->name("home");

// Route::get("/", function() {
//     return view("home");
// })->name("home");


// Route::get("/",'App\Http\Controllers\HomeController@index')->name("home");

// Route::get("/form", "App\Http\Controllers\HomeController@form")->name("form");

// Route::get("/category", [HomeController::class, 'category'])->name("category");

// Route::prefix("admin")->group(function() {

//     Route::get("/tin-tuc/{id?}/{slug?}.html", function ($id = null, $slug = null) {
//         $content = 'Đây là đường dẫn GET Path có tham số là: ';
//         $content.=' có id = '.$id.'</br>';
//         $content.=' slug ='.$slug.'</br>';
//         return $content;
//     })->where('id', '\d+')->where('slug','.+')->name("admin.tintuc");

//     Route::get("/show-form", function () {
//         return view("form");
//     })->name("admin.show-form");

//     Route::prefix("products")->middleware('checkPermission')->group(function() {

//         Route::get("/", function () {
//             return "Đây là trang danh sách product";
//         });

//         Route::get("/add", function () {
//             return "Đây là add product";
//         })->name("admin.products.add");

//         Route::get("/edit", function () {
//             return "Đây là edit product";
//         });

//         Route::get("/delete", function () {
//             return "Đây là delete product";
//         });
//     });
// });


// Client Route
Route::prefix("categories")->group(function () {
   
    Route::get("/", [CategoriesController::class, "index"])->name("categories.list");

    Route::get("/edit/{id}", [CategoriesController::class, "getCategory"])->name("categories.edit");

    Route::post("/edit/{id}", [CategoriesController::class, "updateCategory"]);

    Route::get("/add", [CategoriesController::class, "addCategory"])->name("categories.add");

    Route::post("/add", [CategoriesController::class, "handleAddCategory"]);

    Route::delete("/delete/{id}", [CategoriesController::class, "deleteCategory"]);

});

// Admin Routes
Route::middleware("auth.admin")->prefix("admin")->group(function () {

    Route::get("/dashboard", [DashboardController::class, "index"])->name("admin.dashboard.index");

    Route::middleware("auth.admin.product")->resource("products", ProductController::class);


});