<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\BalanceController;

Route::get('/', function () {
    return view('home.home', [
        'hiw' => [
            [
                'id' => 1,
                'image' => asset('images/HIW1.png'),
                'name' => 'Order',
            ],
            [
                'id' => 2,
                'image' => asset('images/HIW2.png'),
                'name' => 'Pickup',
            ],
            [
                'id' => 3,
                'image' => asset('images/HIW3.png'),
                'name' => 'Wash & Dry',
            ],
            [
                'id' => 4,
                'image' => asset('images/HIW4.png'),
                'name' => 'Fold & Iron',
            ],
            [
                'id' => 5,
                'image' => asset('images/HIW5.png'),
                'name' => 'Delivery',
            ],
        ],
        'services' => [
            [
                'image' => asset('images/service1.svg'),
                'name' => 'Cuci Saja',
                'list' => ['Layanan 1 Hari Selesai','Cuci kering','Termasuk packing dan parfum'],
                'price' => 6000,
            ],
            [
                'image' => asset('images/service2.svg'),
                'name' => 'Cuci Lipat Rapi',
                'list' => ['Layanan 2 Hari Selesai','Dilipat Rapi, tanpa setrika','Termasuk packing dan parfum'],
                'price' => 7000,
            ],
            [
                'image' => asset('images/service3.svg'),
                'name' => 'Cuci Lipat Setrika',
                'list' => ['Layanan 3 Hari Selesai','Dilipat Rapi dan disetrika','Termasuk packing dan parfum'],
                'price' => 9000,
            ],
        ],
        'location' => [
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Seturan',
                'address' => 'Jl. Seturan I, Kledokan, Caturtunggal',
            ],
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Kledokan',
                'address' => 'Jl. Seturan II, Kledokan, Caturtunggal',
            ],
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Caturtunggal',
                'address' => 'Jl. Seturan III, Kledokan, Caturtunggal',
            ],
        ]
    ]);
});

Route::get('/homeTemplate', function () {
    return view('home.index');
});

Route::get('/home', function () {
    return view('home.home', [
        'hiw' => [
            [
                'id' => 1,
                'image' => asset('images/HIW1.png'),
                'name' => 'Order',
            ],
            [
                'id' => 2,
                'image' => asset('images/HIW2.png'),
                'name' => 'Pickup',
            ],
            [
                'id' => 3,
                'image' => asset('images/HIW3.png'),
                'name' => 'Wash & Dry',
            ],
            [
                'id' => 4,
                'image' => asset('images/HIW4.png'),
                'name' => 'Fold & Iron',
            ],
            [
                'id' => 5,
                'image' => asset('images/HIW5.png'),
                'name' => 'Delivery',
            ],
        ],
        'services' => [
            [
                'image' => asset('images/service1.svg'),
                'name' => 'Cuci Saja',
                'list' => ['Layanan 1 Hari Selesai','Cuci kering','Termasuk packing dan parfum'],
                'price' => 6000,
            ],
            [
                'image' => asset('images/service2.svg'),
                'name' => 'Cuci Lipat Rapi',
                'list' => ['Layanan 2 Hari Selesai','Dilipat Rapi, tanpa setrika','Termasuk packing dan parfum'],
                'price' => 7000,
            ],
            [
                'image' => asset('images/service3.svg'),
                'name' => 'Cuci Lipat Setrika',
                'list' => ['Layanan 3 Hari Selesai','Dilipat Rapi dan disetrika','Termasuk packing dan parfum'],
                'price' => 9000,
            ],
        ],
        'location' => [
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Seturan',
                'address' => 'Jl. Seturan I, Kledokan, Caturtunggal',
            ],
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Kledokan',
                'address' => 'Jl. Seturan II, Kledokan, Caturtunggal',
            ],
            [
                'image' => asset('images/lokasi.svg'),
                'place' => 'Atma Laundry Caturtunggal',
                'address' => 'Jl. Seturan III, Kledokan, Caturtunggal',
            ],
        ]
    ]);
});

Route::get('/reviews', function () {
    return view('home.reviews', [
        'reviews' => [
            [
                'profpic' => asset('images/profpic.jpg'),
                'username' => 'Michael Chen',
                'role' => 'Office Manager',
                'comment' => 'I will never go to other laundry. Atma Laundry understands my needs and never disappoints.',
                'star' => 5,
            ],
            [
                'profpic' => asset('images/profpic.jpg'),
                'username' => 'James Smith',
                'role' => 'Commoner',
                'comment' => 'Atma Laundry has the best service compared to other laundries in the area!',
                'star' => 5,
            ],
            [
                'profpic' => asset('images/profpic.jpg'),
                'username' => 'Rachel Lee',
                'role' => 'President of USA',
                'comment' => 'It’s very affordable and the result is definitely top-notch! I look forward to your future branch opening.',
                'star' => 5,
            ],
            [
                'profpic' => asset('images/profpic.jpg'),
                'username' => 'James Smith',
                'role' => 'Commoner',
                'comment' => 'Atma Laundry has the best service compared to other laundries in the area!',
                'star' => 5,
            ],
            [
                'profpic' => asset('images/profpic.jpg'),
                'username' => 'Tux',
                'role' => 'Customer',
                'comment' => 'I will never go to other laundry. Atma Laundry understands my needs and never disappoints.',
                'star' => 5,
            ],
        ]
    ]);
});

Route::get('/howitworks', function () {
    return view('home.howitworks', [
        'hiw' => [
            [
                'number' => 1,
                'name' => 'Register',
                'desc' => "Start by signing up on the My Order page to create your account.",
            ],
            [
                'number' => 2,
                'name' => 'Select Service',
                'desc' => "Choose the service you need from the available options, and once you're ready, click Checkout.",
            ],
            [
                'number' => 3,
                'name' => 'View Orders',
                'desc' => "You'll be taken to the Orders menu, where you can view the status of your current orders. Here, you'll also find a button to Create New Order.",
            ],
            [
                'number' => 4,
                'name' => 'Create Order',
                'desc' => "Click the button and fill out the necessary details in the form provided.",
            ],
            [
                'number' => 5,
                'name' => 'Product Details',
                'desc' => "After filling out the form, you'll receive the product details for your order. At this stage, provide your name, delivery address, and contact number for delivery and move to the transaction page.",
            ],
            [
                'number' => 6,
                'name' => 'Payment',
                'desc' => "On the transaction page, complete the payment process and click Confirm Payment.",
            ],
            [
                'number' => 7,
                'name' => 'Order Status',
                'desc' => "Once payment is confirmed, you'll be directed to the Order Status page to track your order.",
            ],
        ],
    ]);
});

Route::post('/login', [AkunController::class, 'login']);

Route::get('/register', function () {
    return view('account.register');
})->name('register');


Route::post('/register', [AkunController::class, 'register']);

Route::post('/logout', [AkunController::class, 'logout'])->name('logout');

Route::get('/login', function () {
    if(Auth::guard('user')->check()){
        return redirect('userDashboard');
    }else if(Auth::guard('admin')->check()){
        return redirect('adminDashboard');
    }
    return view('account.login');
})->name('login');

Route::middleware(['auth:user'])->group(function(){
    Route::get('/userDashboard', function (BalanceController $balanceController, UserController $userController) {

        $balance = $balanceController->showMyBalance();
        
        $recentOrder = $userController->dashboard(); 
    
        $statistic = [
            [
                'name' => 'Total Order',
                'value' => 7, 
            ],
            [
                'name' => 'On Progress',
                'value' => 1, 
            ],
            [
                'name' => 'Completed',
                'value' => 6, 
            ],
            [
                'name' => 'Point',
                'value' => 6, 
            ],
        ];
    
    
        return view('user.index', [
            'recentOrder' => $recentOrder,
            'balance' => $balance,  
            'statistic' => $statistic,
        ]);
    })->name('user.index');

    
    Route::get('/checkout', function () {
        return view('user.checkout');
    });
    
    Route::get('/summary', function () {
        return view('user.summary');
    });
    
    Route::get('/orderForm', function () {
        return view('user.orderForm');
    });
    
    Route::get('/orderList', function () {
        return view('user.orderList', [
            'order' => [
                [
                    'id' => '#0107',
                    'packet' => 'A',
                    'category' => 'Bed cover',
                    'weight' => 2,
                    'price' => 12000,
                    'date' => '07/10/2024',
                    'status' => 'folding',
                    'remainingTime' => 1,
                    'request' => 'Request: pewangi mama lemon',
                ],
                [
                    'id' => '#0081',
                    'packet' => 'C',
                    'category' => 'Pakaian',
                    'weight' => 4.5,
                    'price' => 40500,
                    'date' => '04/10/2024',
                    'status' => 'done',
                    'remainingTime' => 0,
                    'request' => '-',
                ],
                [
                    'id' => '#0040',
                    'packet' => 'B',
                    'category' => 'Bed cover',
                    'weight' => 3.2,
                    'price' => 22400,
                    'date' => '30/09/2024',
                    'status' => 'done',
                    'remainingTime' => 0,
                    'request' => '-',
                ],
                [
                    'id' => '#0035',
                    'packet' => 'C',
                    'category' => 'Pakaian',
                    'weight' => 3.2,
                    'price' => 28800,
                    'date' => '26/09/2024',
                    'status' => 'done',
                    'remainingTime' => 0,
                    'request' => '-',
                ],
                [
                    'id' => '#0024',
                    'packet' => 'A',
                    'category' => 'Boneka',
                    'weight' => 3.2,
                    'price' => 19200,
                    'date' => '17/09/2024',
                    'status' => 'done',
                    'remainingTime' => 0,
                    'request' => '-',
                ],
                [
                    'id' => '#0013',
                    'packet' => 'C',
                    'category' => 'Pakaian',
                    'weight' => 5,
                    'price' => 45000,
                    'date' => '09/09/2024',
                    'status' => 'done',
                    'remainingTime' => 0,
                    'request' => '-',
                ],
            ]
        ]);
    });
    
    Route::get('/serviceList', [LayananController::class, 'index'])->name('user.serviceList');
    
    Route::get('/orderStatus', function () {
        return view('user.orderStatus', [
            'services' => [
                'Pencucian baju',
                'Pengeringan baju',
                'Lipat baju',
                'Setrika baju',
            ],
        ]);
    });
    
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
    Route::post('/profileUpdate', [UserController::class, 'update'])->name('profile.update');
    //Route::get('/userDashboard', [UserController::class, 'dashboard'])->name('user.index');
    
    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/orderForm', [PesananController::class, 'index'])->name('pesanan.index');

    Route::get('/orderList', [PesananController::class, 'orderList'])->name('orderList');
    //Route::get('/orderDetail/{id}', [PesananController::class, 'orderDetail'])->name('pesanan.orderStatus');
    Route::get('/orderStatus/{id}', [PesananController::class, 'orderDetail'])->name('orderStatus');
    


});

Route::middleware(['auth:admin'])->group(function(){

    Route::get('/adminDashboardTemplate', function () {
        return view('admin.dashboard');
    });

    
    Route::get('/adminDashboard', function (BalanceController $balanceController, AdminController $adminController) {
        $balance = $balanceController->showMyBalance();
    
        $recentOrders = $adminController->dashboard();
    
        $statistic = [
            [
                'name' => 'Received Orders',
                'value' => 107,
            ],
            [
                'name' => 'Total Order',
                'value' => 0,
            ],
            [
                'name' => 'On Progress',
                'value' => 0,
            ],
            [
                'name' => 'Completed',
                'value' => 0,
            ],
        ];
    
        
        return view('admin.index', [
            'recentOrders' => $recentOrders,
            'balance' => $balance,  
            'statistic' => $statistic,
        ]);
    })->name('admin.index');
    
    
    // Route::get('/customerList', function () {
    //     return view('admin.customerList');
    // });
    
    // Route::get('/adminOrderList', function () {
    //     return view('admin.orderList');
    // });

    Route::get('/customerList', [AdminController::class, 'showCustomerList'])->name('admin.customerList');
    Route::delete('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::put('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    //Route::get('/adminDashboard', [AdminController::class, 'dashboard'])->name('admin.index');

    Route::get('/adminOrderList', [AdminController::class, 'showOrderList'])->name('admin.orderList');
    Route::delete('/admin/orders/{id}/delete', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
    Route::put('/admin/orders/{order}/update-status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    
    Route::get('/adminServiceList', [AdminController::class, 'showLayanan'])->name('admin.serviceList');
    
    Route::get('/newServiceList', [AdminController::class, 'showCreate'])->name('admin.newServiceList');
    
    Route::post('/newServiceList', [AdminController::class, 'createLayanan'])->name('admin.createNewServiceList');

    Route::get('/editServiceList/{id}', [AdminController::class, 'showEdit'])->name('admin.showEditServiceList');

    Route::post('/editServiceList/{id}', [AdminController::class, 'editLayanan'])->name('admin.editServiceList');

    Route::get('/deleteService/{id}', [AdminController::class, 'destroyLayanan'])->name('admin.deleteService');
});
