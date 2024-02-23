<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
// use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StudentController;
// use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\WebSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function () {

    Route::resource('banners', BannerController::class);
    Route::post('/banner/updates-status-process', [BannerController::class, 'updateStatus'])->name('banners.update.status');
    Route::get('/banner/trash', [BannerController::class, 'trash'])->name('banners.trash');
    Route::post('/banner/restore', [BannerController::class, 'restore'])->name('banners.restore');

    Route::resource('categoryTypes', CategoryTypeController::class);
    Route::post('/categoryType/updates-status-process', [CategoryTypeController::class, 'updateStatus'])->name('categoryTypes.update.status');
    Route::get('/categoryType/trash', [CategoryTypeController::class, 'trash'])->name('categoryTypes.trash');
    Route::post('/categoryType/restore', [CategoryTypeController::class, 'restore'])->name('categoryTypes.restore');

    Route::resource('categories', CategoryController::class);
    Route::post('/category/updates-status-process', [CategoryController::class, 'updateStatus'])->name('categories.update.status');
    Route::get('/category/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('/category/restore', [CategoryController::class, 'restore'])->name('categories.restore');

    Route::resource('permissions', PermissionController::class);
    
    //Products
    Route::resource('product', ProductController::class);

    Route::resource('pages', PageController::class);
    Route::post('/page/updates-status-process', [PageController::class, 'updateStatus'])->name('pages.update.status');
    Route::get('/page/trash', [PageController::class, 'trash'])->name('pages.trash');
    Route::post('/page/restore', [PageController::class, 'restore'])->name('pages.restore');

    Route::resource('roles', RoleController::class);
    Route::post('/roles/updates-status-process', [RoleController::class, 'updateStatus'])->name('roles.update.status');
    Route::get('/role/trash', [RoleController::class, 'trash'])->name('roles.trash');
    Route::post('/role/restore', [RoleController::class, 'restoreRole'])->name('roles.restore');

    Route::resource('statuses', StatusController::class);
    Route::post('/status/updates-status-process', [StatusController::class, 'updateStatus'])->name('statuses.update.status');
    Route::get('/status/trash', [StatusController::class, 'trash'])->name('statuses.trash');
    Route::post('/status/restore', [StatusController::class, 'restore'])->name('statuses.restore');

    Route::resource('users', UserController::class);
    Route::post('/users/updates-status-process', [UserController::class, 'updateStatus'])->name('users.update.status');
    Route::get('/user/trash', [UserController::class, 'trash'])->name('users.trash');
    Route::post('/user/restore', [UserController::class, 'restoreUser'])->name('users.restore');

    Route::get('/product/{id}/variation', [VariationController::class, 'create'])->name('product.variation.create');
    Route::post('/product-variation-index', [VariationController::class, 'index'])->name('product.variation.index');
    Route::post('/product-variation-store', [VariationController::class, 'store'])->name('product.variation.store');
    Route::get('/product/{id}/variation/{vId}/edit', [VariationController::class, 'edit'])->name('product.variation.edit');
    Route::put('/product-variation-update/{id}', [VariationController::class, 'update'])->name('product.variation.update');
    Route::post('/update-variation-status', [VariationController::class, 'updateStatus'])->name('product.variation.update.status');


    Route::post('product-status', [ProductController::class, 'change_product_status'])->name('product.update.status');
    Route::get('product-trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::post('restore-product', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('force-delete-product/{id}', [ProductController::class, 'forceDelete'])->name('product.forceDelete');

    Route::get('/get-simple-product-fields', function () {
        return view('backend.products.simple-product-fields')->render();
    })->name('product.get.simple.product.fields');

    Route::get('/get-product-discount-fields', function () {
        return view('backend.products.product-discount-fields')->render();
    })->name('product.get.product.discount.fields');


    // CONTACT QUEIES
    Route::get('contact-queries', [ContactController::class, 'index'])->name('contact.queries');
    Route::get('/contact-read-message', [ContactController::class, 'readMessage'])->name('contact.read.message');
    Route::post('/reomve-message', [ContactController::class, 'removeMessage'])->name('remove.message');

    //CMS Routes
    Route::resource('pageContent', PageContentController::class);
    Route::post('/pageContents/updates-status-process', [PageContentController::class, 'updateStatus'])->name('pageContent.update.status');
    Route::get('/websetting', [WebSettingController::class, 'webLogos'])->name('websetting');
    Route::get('/contactInfo', [WebSettingController::class, 'contactInfo'])->name('contactInfo');
    Route::post('/contactInfo_process', [WebSettingController::class, 'contactInfoProcess'])->name('contactInfo.process');
    Route::post('/web-logo-process', [WebSettingController::class, 'webLogosProcess'])->name('web.logos.process');
    Route::get('/websetting/trash', [WebSettingController::class, 'trash'])->name('websetting.trash');
    Route::post('/class-location-process', [WebSettingController::class, 'classLocationProcess'])->name('class.location.process');


    //Blog Routes
    // Route::resource('blogs', BlogController::class);
    // Route::post('/blog/updates-status-process', [BlogController::class, 'updateStatus'])->name('blogs.update.status');
    // Route::get('blog/trash', [BlogController::class, 'trash'])->name('blogs.trash');
    // Route::post('/blog/restore', [BlogController::class, 'restore'])->name('blogs.restore');

    //Social Link Routes
    // Route::resource('socialIcons', SocialLinkController::class);
    // Route::post('update-status', [SocialLinkController::class, 'update_social_link_status'])->name('socialIcons.update.status');

    //Testimonial Routes
    // Route::resource('testimonials', TestimonialController::class);
    // Route::post('/testimonial/updates-status-process', [TestimonialController::class, 'updateStatus'])->name('testimonials.update.status');
    // Route::get('/testimonial/trash', [TestimonialController::class, 'trash'])->name('testimonials.trash');
    // Route::post('/testimonial/restore', [TestimonialController::class, 'restore'])->name('testimonials.restore');

    Route::name('admin.')->group(function () {
        //Orders
        Route::resource('orders', OrderController::class);
        Route::get('/order/history/{id}', [OrderController::class, 'orderHistory'])->name('order.history');
        Route::post('/order-status/update-order-status', [OrderController::class, 'orderUpdateStatus'])->name('order.update.status');

        /* Order Statuses Controller */
        Route::get('/orders-status/all', [OrderStatusController::class, 'allStatuses'])->name('all.orders.statuses');
        Route::post('/order-status/add-process', [OrderStatusController::class, 'addOrderStatusesProcess'])->name('add.orders.statuses.process');
        Route::get('/order-status/edit', [OrderStatusController::class, 'editOrderStatus'])->name('edit.orders.statuses');
        Route::post('/orders-status/update-process', [OrderStatusController::class, 'updateOrderStatusesProcess'])->name('update.orders.statuses.process');
        /* End Order Statuses Controller */


        Route::get('students', [StudentController::class, 'index'])->name('all.students');
        Route::get('all-students', [StudentController::class, 'allStudents'])->name('view.all.students');
        Route::post('find-students', [StudentController::class, 'findStudents'])->name('find.students');
        Route::post('update-student-status', [StudentController::class, 'updateStatus'])->name('update.student.status');
        Route::post('add-student-location', [StudentController::class, 'addLocation'])->name('add.student.location');
        Route::post('change-course-dates', [StudentController::class, 'changeCourseDates'])->name('change.course.dates');
        Route::post('change-course-dates', [StudentController::class, 'changeCourseDates'])->name('change.course.dates');

    })->name('admin.middleware');
});

Route::middleware(['auth', 'verified'])->name('general.')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'allNotifications'])->name('all.notifications');
    Route::get('/read-notification', [NotificationController::class, 'readNotification'])->name('read.notification');
    Route::get('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('mark.all.read');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/update-profile-process', [UserController::class, 'updateProfileProcess'])->name('update.profile.process');
    Route::post('/change-password-process', [UserController::class, 'changePasswordProcess'])->name('change.password.process');
    Route::post('/change-picture-process', [UserController::class, 'changePictureProcess'])->name('change.picture.process');
});

?>