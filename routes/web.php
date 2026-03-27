<?php

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactInquiryController as AdminContactInquiryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InternshipApplicationController as AdminInternshipApplicationController;
use App\Http\Controllers\Admin\JobApplicationController as AdminJobApplicationController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductInquiryController as AdminProductInquiryController;
use App\Http\Controllers\Admin\VacancyController as AdminVacancyController;
use App\Http\Controllers\AdminEntryRedirectController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InternshipApplicationController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\ProductInquiryController;
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogoController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('logos', LogoController::class);
});
Route::resource('logos', LogoController::class)->except(['show', 'edit']);

Route::post('/locale', [LocaleController::class, 'update'])->name('locale.switch');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/produk', [ProductCatalogController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductCatalogController::class, 'show'])->name('products.show');
Route::post('/produk/{slug}/inquiry', [ProductInquiryController::class, 'store'])
    ->middleware('throttle:public-form-submissions')
    ->name('products.inquiries.store');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])
    ->middleware('throttle:public-form-submissions')
    ->name('contact.store');

Route::get('/magang', [CareerController::class, 'internships'])->name('internships.index');
Route::get('/magang/tahap-1', [InternshipApplicationController::class, 'createStepOne'])->name('internships.steps.one');
Route::post('/magang/tahap-1', [InternshipApplicationController::class, 'storeStepOne'])
    ->middleware('throttle:public-form-submissions')
    ->name('internships.steps.one.store');
Route::get('/magang/tahap-2', [InternshipApplicationController::class, 'createStepTwo'])->name('internships.steps.two');
Route::post('/magang/tahap-2', [InternshipApplicationController::class, 'storeStepTwo'])
    ->middleware('throttle:public-form-submissions')
    ->name('internships.steps.two.store');
Route::view('/magang/selesai', 'pages.magang-selesai')->name('magang.selesai');

Route::post('/magang/selesai', function () {
    return redirect()->route('magang.selesai');
});
Route::get('/lowongan', [CareerController::class, 'vacancies'])->name('careers.index');
Route::get('/lowongan/detail', [CareerController::class, 'showVacancy'])->name('careers.show.default');
Route::get('/lowongan/form', [CareerController::class, 'createApplication'])->name('careers.applications.create.default');
Route::get('/lowongan/{slug}/detail', [CareerController::class, 'showVacancy'])->name('careers.show.slug');
Route::get('/lowongan/{slug}/formulir', [CareerController::class, 'createApplication'])->name('careers.applications.create.slug');
Route::get('/lowongan/{slug}', [CareerController::class, 'showVacancy'])->name('careers.show');
Route::get('/lowongan/{slug}/form', [CareerController::class, 'createApplication'])->name('careers.applications.create');
Route::post('/lowongan/{slug}/form', [JobApplicationController::class, 'store'])
    ->middleware('throttle:public-form-submissions')
    ->name('careers.applications.store');

Route::get('/publikasi', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publikasi/flipbook', [PublicationController::class, 'flipbook'])->name('publications.flipbook');
Route::redirect('/login', '/admin/login');
Route::get('/admin', AdminEntryRedirectController::class);
Route::get('/dashboard', AdminEntryRedirectController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'store'])->name('login.store');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::resource('vacancies', AdminVacancyController::class)->except(['show']);
        Route::get('/product-inquiries', [AdminProductInquiryController::class, 'index'])->name('product-inquiries.index');
        Route::delete('/product-inquiries/{productInquiry}', [AdminProductInquiryController::class, 'destroy'])->name('product-inquiries.destroy');
        Route::get('/contact-inquiries', [AdminContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::delete('/contact-inquiries/{contactInquiry}', [AdminContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');
        Route::get('/job-applications', [AdminJobApplicationController::class, 'index'])->name('job-applications.index');
        Route::get('/job-applications/{jobApplication}', [AdminJobApplicationController::class, 'show'])->name('job-applications.show');
        Route::get('/job-applications/{jobApplication}/download', [AdminJobApplicationController::class, 'download'])->name('job-applications.download');
        Route::patch('/job-applications/{jobApplication}/status', [AdminJobApplicationController::class, 'updateStatus'])->name('job-applications.status.update');
        Route::delete('/job-applications/{jobApplication}', [AdminJobApplicationController::class, 'destroy'])->name('job-applications.destroy');
        Route::get('/internship-applications', [AdminInternshipApplicationController::class, 'index'])->name('internship-applications.index');
        Route::get('/internship-applications/{internshipApplication}', [AdminInternshipApplicationController::class, 'show'])->name('internship-applications.show');
        Route::get('/internship-applications/{internshipApplication}/download', [AdminInternshipApplicationController::class, 'download'])->name('internship-applications.download');
        Route::patch('/internship-applications/{internshipApplication}/status', [AdminInternshipApplicationController::class, 'updateStatus'])->name('internship-applications.status.update');
        Route::delete('/internship-applications/{internshipApplication}', [AdminInternshipApplicationController::class, 'destroy'])->name('internship-applications.destroy');
    });
});
