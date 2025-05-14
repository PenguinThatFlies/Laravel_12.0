<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->name('home');

//  იყენებს GET მეთოდს და გადაეცემა მოთხოვნა მისამართზე /product/1/title

Route::get('/product/{id}/{title}', [MainController::class, 'product']);

/*
    name('product.details') - მისი გამოყენება გვაძლევს საშუალებას URL routes გამოყენების გარეშე. მაგ.:
    <a href="{{ route('product.details', [$id, $title]) }}">
        .../product/32/Samsung S23
    </a>
*/

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->name('product.details');

//  ეს უზრუნველყოფს, რომ მხოლოდ ავტორიზებულ მომხმარებლებს ექნებათ წვდომა.

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->middleware('auth');

/*
    ეს ავტომატურად გადასცემს currency პარამეტრს, მიუხედავად იმისა, არის თუ არა მოთხოვნაში.
    .../product/23/Samsung S23?currency=USD
*/

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->defaults('currency', 'USD');

/*
    ყველა როუტს, რომელიც ამ ჯგუფშია, წინ დაუმატებს /shop პრეფიქსს.
    თუ როუტი /product/{id}/{title} იყო, მაშინ ის გახდება /shop/product/{id}/{title}.
    group(function () { ... }) — როუტების დაჯგუფება
*/


Route::prefix('shop')->middleware('auth')->group(function () {
    Route::get('/product/{id}/{title}', [MainController::class, 'product'])->name('shop.product');
});

/*
    HTTP მეთოდების შეზღუდვა (match, any):
    ეს საშუალებას იძლევა, რომ მოთხოვნები მიიღოს GET და POST მეთოდებზე.
    ჩვეულებრივ კი ნებისმიერ HTTP მეთოდს (GET, POST, PUT, DELETE და ა.შ.) მიიღებს.
*/

Route::match(['get', 'post'], '/product/{id}/{title}', [MainController::class, 'product']);

/*
    ეს მუშაობს, როგორც 404 გვერდი, თუ როუტი ვერ მოიძებნა.
*/

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

/*
    api Middleware ჯგუფი:
    1. იყენებს throttle middleware-ს (შეზღუდავს მოთხოვნების რაოდენობას).
    2. ავტომატურად ხსნის CSRF დაცვას, რადგან API-სთვის CSRF ტოკენი საჭირო არ არის.
*/

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/product/{id}/{title}', [MainController::class, 'product'])->name('api.product.details');
});

/*
    withTrashed() მეთოდი Eloquent-ის Soft Deletes ფუნქციას იყენებს და საშუალებას გვაძლევს,
    დავაბრუნოთ მონაცემთა ბაზიდან არა მხოლოდ არსებული (აქტიური) ჩანაწერები, არამედ "რბილად წაშლილი" ჩანაწერებიც.

    ჩვეულებრივი წაშლა (delete()) მონაცემებს სამუდამოდ შლის.
    Soft Delete უბრალოდ "ნიშნავს" ჩანაწერს, რომ ის წაშლილია, მაგრამ რეალურად მონაცემთა ბაზაში რჩება.
    ამის შემდეგ, withTrashed()-ის გამოყენებით, შესაძლებელია "წაშლილი" მონაცემების ჩვენება.

    ! აუცილებელია ცხრილში deleted_at სვეტის არსებობა !
*/

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->withTrashed();


// ეს საშუალებას გაძლევს გამოიყენო ენის კოდი (მაგალითად en, ka, ru) URL-ში.

Route::get('/{locale}/product/{id}/{title}', [MainController::class, 'product'])
    ->where('locale', 'en|ka|ru')
    ->name('localized.product');

/*
    {id} → პროდუქტის უნიკალური ID (მხოლოდ რიცხვები).
    {slug} → პროდუქტის SEO-friendly სახელწოდება (მცირე ასოები, რიცხვები და ტირე).
    .../product/12-laptop-dell-xps
*/

Route::get('/product/{id}-{slug}', [MainController::class, 'product'])
    ->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9-]+',
    ]);

/*
    Laravel 8+ ვერსიაში შესაძლებელია controller()-ის გამოყენება.
    მისი გმაოყენებით შეგიძლია ერთ კონტროლერში განსაზღვრო რამდენიმე როუტი.
*/

Route::controller(MainController::class)->group(function () {
    Route::get('/product/{id}/{title}', 'product')->name('product.details');
    Route::get('/products', 'index')->name('products.list');
});


/*
    Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->middleware('cache.headers:public;max_age=3600');

    middleware('cache.headers:public;max_age=3600') → ამატებს ქეშირების სათაურებს (Cache Headers),
    რათა სერვერსა და მომხმარებლის ბრაუზერს ქეში უფრო ეფექტურად გამოიყენონ.

    max_age=3600 ნიშნავს, რომ გვერდი ქეშში 1 საათით (3600 წამი) იქნება შენახული.
*/

Route::get('/product/{id}/{title}', [MainController::class, 'product'])
    ->middleware('cache.headers:public;max_age=3600');


// ეს ავტომატურად გადაამისამართებს ძველ URL-ს ახალზე.

Route::redirect('/old-product/{id}/{title}', '/new-product/{id}/{title}', 301);

// ეს პირდაპირ resources/views/about.blade.php-ს გამოიტანს.

Route::view('/about', 'about', ['title' => 'About Us']);

// თუ მომხმარებელი არაა ადმინი, მაშინ დააბრუნებს 403 შეცდომას.

Route::get('/admin', function () {
    abort_if(!auth()->user()->isAdmin(), 403);
});

/*
    ეს საშუალებას გაძლევს, რომ თითოეული account-ის (მაგალითად shop1.example.com, shop2.example.com)
    შესაბამისი მონაცემები გამოიტანო.
*/

Route::domain('{account}.example.com')->group(function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard']);
});

/*
    /users/{user}/posts/{post} — ეს არის URL-პატერნი.
    {user} და {post} პარამეტრები წარმოდგენილია როგორც "ზრალი" (placeholders).
    Laravel ავტომატურად გაიგებს, რომ ეს ცვლილებადია და გამოიძახებს შესაბამისი Controller-ის მეთოდს.
    მაგალითად, /users/5/posts/10 გამოიძახებს UserController-ის show მეთოდს,
    სადაც {user} იქნება 5, ხოლო {post} 10
*/

Route::get('/users/{user}/posts/{post}', [UserController::class, 'show'])
    ->scopeBindings();

/*
    ეს ამ როუტზე "auth" Middleware-ს გამორთავს, რათა ყველას შეეძლოს წვდომა.

    ->middleware('guest') - guest – გამოიყენება იმისთვის, რომ მხოლოდ სტუმრებმა
    (მიუხედავად იმისა, რომ არ არის ავტორიზებული მომხმარებელი)
    შეძლონ წვდომა ამ როუტზე. მაგალითად:

    ->middleware('throttle:10,1'); // 10 მოთხოვნა 1 წუთში
    throttle – ეს Middleware განსაზღვრავს მოთხოვნების რაოდენობას
    გარკვეული დროის შუალედში (rate limiting). მაგალითად:

    ->middleware('verified')
    verified – ეს Middleware მხოლოდ იმ მომხმარებლებს აძლევს წვდომას,
    რომლებიც ელ.ფოსტით გადამოწმებულნი არიან. მაგალითად:

    ->middleware('can:view,product');
    can – გამოიყენება იმისთვის, რომ კონტროლირებდეს,
    აქვს თუ არა მომხმარებელს გარკვეული უფლებები/როლები. მაგალითად:

*/

Route::get('/public-product/{id}/{title}', [MainController::class, 'product'])
    ->withoutMiddleware(['auth']);

/* 
    ->where() მეთოდი გამოიყენება რომ განსაზღვროს როუტის პარამეტრების ტიპი.
    მაგალითად, ამ შემთხვევაში თუ გვინდა რომ მომხმარებელს შეუძლია ყოველგვარი 
    სიმბოლოთი შემდაგენელი ტექსტის ძიება გამოიყენება ეს პარამეტრი.
*/

Route::get('/search/{search}', function ($search) {
    return "You are searching for {$search}";
})->where(["search" => '.*']);
