<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\VerificationController;
use App\Http\Controllers\Admin\CatchReceiptController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\IntervalController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserReservationController;
use App\Http\Controllers\Admin\UserSubscriptionController;
use Illuminate\Support\Facades\Route;
use jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController;

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
Route::prefix('/admin')->group(function () {

    //  start Authentication Routes...
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.show_login_form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.show_register_form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
    Route::get('email/verify', [VerificationController::class, 'show'])->name('admin.verification.notice');
    Route::get('email/verify', [VerificationController::class, 'verify'])->name('admin.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('admin.verification.resend');
    //  end Authentication Routes...
    Route::middleware(['auth:admin'])->group(function () {


        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');

        #users
        Route::resource('/users', UserController::class);
        #employees
        Route::resource('/employees', EmployeController::class);


        #Interval
        Route::resource('/Intervals', IntervalController::class);
        Route::resource('/MessageSms', MessageController::class);
        #services
        Route::resource('/services', ServiceController::class);
        #subscriptions
        Route::resource('/subscriptions', SubscriptionController::class);

        Route::post('subscriptions_search',[UserSubscriptionController::class,'search_ajax'])->name('admin.subscriptions_search');

        #user_subscriptions
        Route::resource('/user_subscriptions', UserSubscriptionController::class);
        Route::resource('/user_reservations', UserReservationController::class);
        Route::post('get_intervals_price',[UserReservationController::class,'get_intervals_price'])->name('admin.get_intervals_price');
        Route::post('checkDateReservation',[UserReservationController::class,'checkDateReservation'])->name('admin.checkDateReservation');
        Route::post('checkDateReservationEdit',[UserReservationController::class,'checkDateReservationEdit'])->name('admin.checkDateReservationEdit');

        #user_subscriptions_with_ajax
        Route::post('/getSubscriptionData', [UserSubscriptionController::class,'getSubscriptionData'])->name('admin.getSubscriptionData');
        Route::put('/RenewSubscription', [UserSubscriptionController::class,'renewSubcription'])->name('admin.renewal_subscriptions');

        #invoices
        Route::resource('/invoices', InvoiceController::class);
        #getReceiptInvoices
        Route::get('/getReceiptInvoices', [InvoiceController::class,'getReceiptInvoices'])->name('admin.getReceiptInvoices');

        #catch_receipts
        Route::resource('/catch_receipts', CatchReceiptController::class);

        #receipts
        Route::resource('/receipts', ReceiptController::class);

        #user_invoices_with_ajax
        Route::post('/getInvoicesData', [CatchReceiptController::class,'getInvoicesData'])->name('admin.getInvoiceData');

        #getCatchReceipt_with_ajax
        Route::post('/getCatchReceipt', [CatchReceiptController::class,'getCatchReceipt'])->name('admin.getCatchReceipt');

        #settings
        Route::resource('settings',SettingController::class);

        #admins
        Route::resource('admins',AdminController::class);

        #roles
        Route::resource('roles',RoleController::class);

        #Archive
        Route::get('/getUserArchive', [ArchiveController::class,'getUsers'])->name('admin.get_usersArchive');
        Route::post('/restoreUser',[ArchiveController::class,'restoreUser'])->name('admin.restoreUser');

        Route::get('/getEmployeeArchive', [ArchiveController::class,'getEmployees'])->name('admin.get_employeesArchive');
        Route::post('/restoreEmployee',[ArchiveController::class,'restoreEmployee'])->name('admin.restoreEmployee');

        Route::get('/getServicesArchive', [ArchiveController::class,'getServices'])->name('admin.get_servicesArchive');
        Route::post('/restoreServices',[ArchiveController::class,'restoreService'])->name('admin.restoreServices');

        Route::get('/getUserSubscriptions', [ArchiveController::class,'getUserSubscriptions'])->name('admin.get_UserSubscriptionArchive');
        Route::post('/restoreSubscriptions',[ArchiveController::class,'restoreUserSubscription'])->name('admin.restoreUserSubscription');

        Route::get('/getCatchReceiptsArchive', [ArchiveController::class,'getCatchReceipts'])->name('admin.getCatchReceiptsArchive');
        Route::post('/restoreCatchReceipt',[ArchiveController::class,'restoreCatchReceipt'])->name('admin.restoreCatchReceipt');

        Route::get('/getReceiptsArchive', [ArchiveController::class,'getReceipts'])->name('admin.getReceiptsArchive');
        Route::post('/restoreReceipt',[ArchiveController::class,'restoreReceipt'])->name('admin.restoreReceipt');
        #end Archive

        //Expenses
        Route::resource('expenses',ExpensesController::class);


        //reports
        Route::get('ReceiptReport',[\App\Http\Controllers\Admin\ReportController::class,'receiptsReport'])->name('admin.receipt_report');
        Route::get('CatchReceiptReport',[\App\Http\Controllers\Admin\ReportController::class,'catchReceiptsReport'])->name('admin.catch_receipt_report');
        Route::get('ExpensesReport',[\App\Http\Controllers\Admin\ReportController::class,'expensesReport'])->name('admin.expenses_report');
        Route::get('SubscriptionsReport',[\App\Http\Controllers\Admin\ReportController::class,'subscriptionsReport'])->name('admin.subscriptions_report');

    });
});
