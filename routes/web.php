<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Backend\AdminController;
use App\Http\Controllers\Auth\Backend\AdminForgotController;
use App\Http\Controllers\Backend\AdminAccountController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\ProductAttributeController;
use App\Http\Controllers\Backend\AffiliateController;
use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\CsvProductController;
use App\Http\Controllers\Backend\BulkDeleteController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\HomePageController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeOptionController;
use App\Http\Controllers\Backend\FabricController;
use App\Http\Controllers\Backend\FaqCategoryController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\EmailSettingController;
use App\Http\Controllers\Backend\SmsSettingController;
use App\Http\Controllers\Backend\SitemapController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\AdminTicketController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ShippingServiceController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\AdminOrderController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\ReviewController;


use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguagesController;
use App\Http\Controllers\Frontend\CatalogController;  
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ViewAllController;
use App\Http\Controllers\Frontend\HomeCustomizeController;
use App\Http\Controllers\Frontend\User\SocialLoginController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\TicketController;
use App\Http\Controllers\Frontend\User\WishlistController;
use App\Http\Controllers\Frontend\User\CartController;
use App\Http\Controllers\Frontend\User\OrderController;

use App\Http\Controllers\Frontend\Payment\AuthorizeController;
use App\Http\Controllers\Frontend\Payment\FlutterwaveController;
use App\Http\Controllers\Frontend\Payment\MercadopagoController;
use App\Http\Controllers\Frontend\Payment\PaytmController;
use App\Http\Controllers\Frontend\Payment\RazorpayController;
use App\Http\Controllers\Frontend\Payment\SslCommerzController;
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


// ************************************ ADMIN PANEL **********************************************


Route::prefix('admin')->group(function () {
//------------ AUTH ------------
//Route::get('/register',[AdminController::class, 'AdminRegister'])->name('admin.register');
//Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
Route::get('/login',[AdminController::class, 'Index'])->name('back.login');
Route::post('/login/submit',[AdminController::class, 'Login'])->name('admin.login');
Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');

//------------ FORGOT ------------
Route::get('/forgot', [AdminForgotController::class, 'showForm'])->name('admin.forgot');
Route::post('/forgot-submit', [AdminForgotController::class, 'forgot'])->name('admin.forgot.submit');
Route::get('/change-password/{token}', [AdminForgotController::class, 'showChangePassForm'])->name('back.change.token');
Route::post('/change-password-submit', [AdminForgotController::class, 'changepass'])->name('admin.change.password');

Route::group(['middleware' => 'admin'], function () {
//------------ DASHBOARD & PROFILE ------------
Route::get('/', [AdminAccountController::class, 'index'])->name('admin.dashboard');
Route::get('/profile', [AdminAccountController::class, 'profileForm'])->name('admin.profile');
Route::post('/profile/update', [AdminAccountController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('/password', [AdminAccountController::class, 'passwordResetForm'])->name('admin.password');
Route::post('/password/update', [AdminAccountController::class, 'updatePassword'])->name('admin.password.update');

      

Route::group(['middleware' => 'permissions:Manage Categories'], function () {
  //------------ CATEGORY ------------
Route::get('category/view', [CategoryController::class, 'index'])->name('admin.category.index');
Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('category/update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('category/delete/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
Route::get('category/status/{id}/{status}', [CategoryController::class, 'status'])->name('admin.category.status');
Route::get('category/feature/{id}/{status}', [CategoryController::class, 'feature'])->name('admin.category.feature');
//------------ SUB CATEGORY ------------
Route::get('subcategory/view', [SubCategoryController::class, 'index'])->name('admin.subcategory.index');
Route::get('subcategory/create', [SubCategoryController::class, 'create'])->name('admin.subcategory.create');
Route::post('subcategory/store', [SubCategoryController::class, 'store'])->name('admin.subcategory.store');
Route::get('subcategory/edit/{subcategory}', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
Route::put('subcategory/update/{subcategory}', [SubCategoryController::class, 'update'])->name('admin.subcategory.update');
Route::delete('subcategory/delete/{subcategory}', [SubCategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
Route::get('subcategory/status/{id}/{status}', [SubCategoryController::class, 'status'])->name('admin.subcategory.status');
  //------------ CHILD CATEGORY ------------
  Route::get('childcategory/view', [ChildCategoryController::class, 'index'])->name('admin.childcat.index');
  Route::get('childcategory/create', [ChildCategoryController::class, 'create'])->name('admin.childcat.create');
  Route::post('childcategory/store', [ChildCategoryController::class, 'store'])->name('admin.childcat.store');
  Route::get('childcategory/edit/{childcategory}', [ChildCategoryController::class, 'edit'])->name('admin.childcat.edit');
  Route::put('childcategory/update/{childcategory}', [ChildCategoryController::class, 'update'])->name('admin.childcat.update');
  Route::delete('childcategory/delete/{childcategory}', [ChildCategoryController::class, 'destroy'])->name('admin.childcat.destroy');
  Route::get('childcategory/status/{id}/{status}', [ChildCategoryController::class, 'status'])->name('admin.childcat.status');
  Route::get('subcategory/ajax/{category_id}', [ChildCategoryController::class, 'GetSubCategory']);
});


Route::group(['middleware' => 'permissions:Manage Fabric Types'], function () {
  //------------ Fabric Type ------------
  Route::get('fabric/view', [FabricController::class, 'fabricIndex'])->name('admin.fabric.index');
  Route::get('fabric/create', [FabricController::class, 'fabricCreate'])->name('admin.fabric.create');
  Route::post('fabric/store', [FabricController::class, 'fabricStore'])->name('admin.fabric.store');
  Route::get('fabric/edit/{fabric}', [FabricController::class, 'fabricEdit'])->name('admin.fabric.edit');
  Route::put('fabric/update/{fabric}', [FabricController::class, 'fabricUpdate'])->name('admin.fabric.update');
  Route::delete('fabric/delete/{fabric}', [FabricController::class, 'fabricDestroy'])->name('admin.fabric.destroy');
 //------------ Fit ------------
 Route::get('fit/view', [FabricController::class, 'fitIndex'])->name('admin.fit.index');
Route::get('fit/create', [FabricController::class, 'fitCreate'])->name('admin.fit.create');
Route::post('fit/store', [FabricController::class, 'fitStore'])->name('admin.fit.store');
Route::get('fit/edit/{fit}', [FabricController::class, 'fitEdit'])->name('admin.fit.edit');
Route::put('fit/update/{fit}', [FabricController::class, 'fitUpdate'])->name('admin.fit.update');
Route::delete('fit/delete/{fit}', [FabricController::class, 'fitDestroy'])->name('admin.fit.destroy');
 //------------ SLEEVE------------
 Route::get('sleeve/view', [FabricController::class, 'sleeveIndex'])->name('admin.sleeve.index');
 Route::get('sleeve/create', [FabricController::class, 'sleeveCreate'])->name('admin.sleeve.create');
 Route::post('sleeve/store', [FabricController::class, 'sleeveStore'])->name('admin.sleeve.store');
 Route::get('sleeve/edit/{sleeve}', [FabricController::class, 'sleeveEdit'])->name('admin.sleeve.edit');
 Route::put('sleeve/update/{sleeve}', [FabricController::class, 'sleeveUpdate'])->name('admin.sleeve.update');
 Route::delete('sleeve/delete/{sleeve}', [FabricController::class, 'sleeveDestroy'])->name('admin.sleeve.destroy');
  
 //------------ PATTERN ------------
 Route::get('pattern/view', [FabricController::class, 'patternIndex'])->name('admin.pattern.index');
 Route::get('pattern/create', [FabricController::class, 'patternCreate'])->name('admin.pattern.create');
 Route::post('pattern/store', [FabricController::class, 'patternStore'])->name('admin.pattern.store');
 Route::get('pattern/edit/{pattern}', [FabricController::class, 'patternEdit'])->name('admin.pattern.edit');
 Route::put('pattern/update/{pattern}', [FabricController::class, 'patternUpdate'])->name('admin.pattern.update');
 Route::delete('pattern/delete/{pattern}', [FabricController::class, 'patternDestroy'])->name('admin.pattern.destroy');
 //------------ OCCASION ------------
 Route::get('occasion/view', [FabricController::class, 'occasionIndex'])->name('admin.occasion.index');
 Route::get('occasion/create', [FabricController::class, 'occasionCreate'])->name('admin.occasion.create');
 Route::post('occasion/store', [FabricController::class, 'occasionStore'])->name('admin.occasion.store');
 Route::get('occasion/edit/{occasion}', [FabricController::class, 'occasionEdit'])->name('admin.occasion.edit');
 Route::put('occasion/update/{occasion}', [FabricController::class, 'occasionUpdate'])->name('admin.occasion.update');
 Route::delete('occasion/delete/{occasion}', [FabricController::class, 'occasionDestroy'])->name('admin.occasion.destroy');
  
//------------ NECK ------------
Route::get('neck/view', [FabricController::class, 'neckIndex'])->name('admin.neck.index');
Route::get('neck/create', [FabricController::class, 'neckCreate'])->name('admin.neck.create');
Route::post('neck/store', [FabricController::class, 'neckStore'])->name('admin.neck.store');
Route::get('neck/edit/{neck}', [FabricController::class, 'neckEdit'])->name('admin.neck.edit');
Route::put('neck/update/{neck}', [FabricController::class, 'neckUpdate'])->name('admin.neck.update');
Route::delete('neck/delete/{neck}', [FabricController::class, 'neckDestroy'])->name('admin.neck.destroy');

});
      


            
 
Route::group(['middleware' => 'permissions:Manage Products'], function () {
  //------------ BRAND ------------
Route::get('brand/view', [BrandController::class, 'index'])->name('admin.brand.index');
Route::get('brand/create', [BrandController::class, 'create'])->name('admin.brand.create');
Route::post('brand/store', [BrandController::class, 'store'])->name('admin.brand.store');
Route::get('brand/edit/{brand}', [BrandController::class, 'edit'])->name('admin.brand.edit');
Route::put('brand/update/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
Route::delete('brand/delete/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
Route::get('brand/status/{id}/{status}/{type}', [BrandController::class, 'status'])->name('admin.brand.status');

//------------ Color ------------
Route::get('color/view', [AttributeController::class, 'colorIndex'])->name('admin.color.index');
Route::get('color/create', [AttributeController::class, 'colorCreate'])->name('admin.color.create');
Route::post('color/store', [AttributeController::class, 'colorStore'])->name('admin.color.store');
Route::get('color/edit/{color}', [AttributeController::class, 'colorEdit'])->name('admin.color.edit');
Route::put('color/update/{color}', [AttributeController::class, 'colorUpdate'])->name('admin.color.update');
Route::get('color/status/{color}/{status}', [AttributeController::class, 'colorStatus'])->name('admin.color.status');
Route::delete('color/delete/{color}', [AttributeController::class, 'colorDestroy'])->name('admin.color.destroy');
//------------ Sizes------------
Route::get('size/view', [AttributeController::class, 'SizeIndex'])->name('admin.size.index');
Route::get('size/create', [AttributeController::class, 'sizeCreate'])->name('admin.size.create');
Route::post('size/store', [AttributeController::class, 'sizeStore'])->name('admin.size.store');
Route::get('size/edit/{size}', [AttributeController::class, 'sizeEdit'])->name('admin.size.edit');
Route::put('size/update/{size}', [AttributeController::class, 'sizeUpdate'])->name('admin.size.update');
Route::get('size/status/{size}/{status}', [AttributeController::class, 'sizeStatus'])->name('admin.size.status');
Route::delete('size/delete/{size}', [AttributeController::class, 'sizeDestroy'])->name('admin.size.destroy');

 //------------ PRODUCT------------
 Route::get('product/add', [ProductController::class, 'add'])->name('admin.product.add');
 Route::get('product/view', [ProductController::class, 'index'])->name('admin.product.index');
 Route::get('product/create', [ProductController::class, 'create'])->name('admin.product.create');
 Route::post('product/store', [ProductController::class, 'store'])->name('admin.product.store');
 Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
 Route::put('product/update/{product}', [ProductController::class, 'update'])->name('admin.product.update');
 Route::get('product/status/{product}/{status}', [ProductController::class, 'status'])->name('admin.product.status');
 Route::delete('product/delete/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
 Route::get('subcategory/product/ajax/{category_id}', [ProductController::class, 'GetSubCategory']);
 Route::get('childcategory/product/ajax/{subcategory_id}', [ProductController::class, 'GetSubSubCategory']);


//------------ ATTRIBUTE OPTION ------------
Route::get('attribute/view/{product}', [AttributeController::class, 'index'])->name('admin.attribute.index');
Route::get('attribute/create/{product}', [AttributeController::class, 'create'])->name('admin.attribute.create');
Route::post('attribute/store/{product}', [AttributeController::class, 'store'])->name('admin.attribute.store');
Route::get('attribute/edit/{product}/{attribute}', [AttributeController::class, 'edit'])->name('admin.attribute.edit');
Route::put('attribute/update/{product}/{attribute}', [AttributeController::class, 'update'])->name('admin.attribute.update');
Route::delete('attribute/destroy/{id}', [AttributeController::class, 'destroy'])->name('admin.attribute.destroy');



//------------ ATTRIBUTE OPTION ------------
Route::get('option/view/{product}', [AttributeOptionController::class, 'index'])->name('admin.option.index');
Route::get('option/create/{product}', [AttributeOptionController::class, 'create'])->name('admin.option.create');
Route::get('option/size/{product}', [AttributeOptionController::class, 'size'])->name('admin.option.size');
Route::post('option/store/{product}', [AttributeOptionController::class, 'store'])->name('admin.option.store');
Route::get('option/edit/{product}/{option}', [AttributeOptionController::class, 'edit'])->name('admin.option.edit');
Route::put('option/update/{product}/{option}', [AttributeOptionController::class, 'update'])->name('admin.option.update');
Route::delete('attribute/destroy/{product}/{option}', [AttributeOptionController::class, 'destroy'])->name('admin.option.destroy');

//------------ Product ATTRIBUTE OPTION ------------
Route::match(['get','post'],'add-attributes/{id}', [ProductAttributeController::class, 'addAttributes']);
Route::match(['get','post'],'edit-attributes/{id}', [ProductAttributeController::class, 'editAttributes'])->name('admin.attr.edit');
Route::post('update-attribute-status', [ProductAttributeController::class, 'updateAttributeStatus'])->name('admin.attr.update');
Route::get('delete-attribute/{id}', [ProductAttributeController::class, 'deleteAttribute'])->name('admin.attr.destroy');

 // --------- DIGITAL PRODUCT -----------//
 Route::get('/digital/create', [ProductController::class, 'digitalProductCreate'])->name('admin.digital.product.create');
 Route::post('/digital/store', [ProductController::class, 'digitalProductStore'])->name('admin.digital.product.store');
 Route::get('/digital/edit/{id}', [ProductController::class, 'digitalProductEdit'])->name('admin.digital.product.edit');
 
 // --------- LICENSE PRODUCT -----------//
 Route::get('/license/create', [ProductController::class, 'licenseProductCreate'])->name('admin.license.product.create');
 Route::post('/license/store', [ProductController::class, 'licenseProductStore'])->name('admin.license.product.store');
 Route::get('/license/edit/{id}', [ProductController::class, 'licenseProductEdit'])->name('admin.license.product.edit');

 // ----------- AFFILIATE PRODUCT -----------//
 Route::get('affiliate/add', [AffiliateController::class, 'add'])->name('admin.affiliate.add');
 Route::get('affiliate/view', [AffiliateController::class, 'index'])->name('admin.affiliate.index');
 Route::get('affiliate/create', [AffiliateController::class, 'create'])->name('admin.affiliate.create');
 Route::post('affiliate/store', [AffiliateController::class, 'store'])->name('admin.affiliate.store');
 Route::get('affiliate/edit/{affiliate}', [AffiliateController::class, 'edit'])->name('admin.affiliate.edit');
 Route::put('affiliate/update/{affiliate}', [AffiliateController::class, 'update'])->name('admin.affiliate.update');
 Route::get('affiliate/status/{affiliate}/{status}', [AffiliateController::class, 'status'])->name('admin.affiliate.status');
 Route::delete('affiliate/delete/{affiliate}', [AffiliateController::class, 'destroy'])->name('admin.affiliate.destroy');

  // ----------- HIGHLIGHT PRODUCT -----------//
 Route::get('product/highlight/{product}', [ProductController::class, 'highlight'])->name('admin.product.highlight');
 Route::post('product/highlight/update/{product}', [ProductController::class, 'highlight_update'])->name('admin.product.highlight.update');

 // ----------- Galleries PRODUCT -----------//
 Route::get('product/galleries/{product}', [ProductController::class, 'galleries'])->name('admin.product.gallery');
 Route::post('product/galleries/update', [ProductController::class, 'galleriesUpdate'])->name('admin.product.galleries.update');
 Route::delete('product/gallery/{gallery}/delete', [ProductController::class, 'galleryDelete'])->name('admin.product.gallery.delete');
 
  // ----------- STOCK OUT PRODUCT -----------//
 Route::get('stock/out/product', [ProductController::class, 'stockOut'])->name('admin.product.stock.out');

 // ----------- CAMPAIGN-----------//
Route::get('campaign/view', [CampaignController::class, 'index'])->name('admin.campaign.index');
Route::post('campaign/store', [CampaignController::class, 'store'])->name('admin.campaign.store');
Route::get('campaign/status/{id}/{status}/{type}', [CampaignController::class, 'status'])->name('admin.campaign.status');
Route::delete('campaign/delete/{id}', [CampaignController::class, 'destroy'])->name('admin.campaign.destroy');
 
 // ----------- BULK PRODUCT UPLOAD-----------//
Route::get('/product/csv/export', [CsvProductController::class, 'export'])->name('admin.csv.export');
Route::get('bulk/product/index', [CsvProductController::class, 'index'])->name('admin.bulk.product.index');
Route::post('csv/import', [CsvProductController::class, 'import'])->name('admin.csv.import');
// ----------- TRANSACTION CSV UPLOAD-----------//
Route::get('transaction/csv/export', [CsvProductController::class, 'transactionExport'])->name('admin.csv.transaction.export');
// ----------- ORDER CSV UPLOAD-----------//
Route::get('order/csv/export', [CsvProductController::class, 'orderExport'])->name('admin.csv.order.export');
Route::get('bulk/deletes', [BulkDeleteController::class, 'bulkDelete'])->name('admin.bulk.delete');
  
//------------ REVIEW ----------------//
Route::get('review/view', [ReviewController::class, 'index'])->name('admin.review.index');
Route::post('review/store/', [ReviewController::class, 'store'])->name('admin.review.store');
Route::get('review/edit/{review}', [ReviewController::class, 'show'])->name('admin.review.show');
Route::delete('review/destroy/{review}', [ReviewController::class, 'destroy'])->name('admin.review.destroy');
Route::get('review/status/{id}/{status}', [ReviewController::class, 'status'])->name('admin.review.status');

});



  Route::group(['middleware' => 'permissions:Ecommerce'], function () {
//------------ CURRENCY ------------
Route::get('currency/add', [CurrencyController::class, 'add'])->name('admin.currency.add');
Route::get('currency/view', [CurrencyController::class, 'index'])->name('admin.currency.index');
Route::get('currency/create', [CurrencyController::class, 'create'])->name('admin.currency.create');
Route::post('currency/store', [CurrencyController::class, 'store'])->name('admin.currency.store');
Route::get('currency/edit/{currency}', [CurrencyController::class, 'edit'])->name('admin.currency.edit');
Route::put('currency/update/{currency}', [CurrencyController::class, 'update'])->name('admin.currency.update');
Route::delete('currency/delete/{currency}', [CurrencyController::class, 'destroy'])->name('admin.currency.destroy');
Route::get('currency/status/{id}/{status}', [CurrencyController::class, 'status'])->name('admin.currency.status');

//------------ TAX SETTING ------------
Route::get('tax/add', [TaxController::class, 'add'])->name('admin.tax.add');
Route::get('tax/view', [TaxController::class, 'index'])->name('admin.tax.index');
Route::get('tax/create', [TaxController::class, 'create'])->name('admin.tax.create');
Route::post('tax/store', [TaxController::class, 'store'])->name('admin.tax.store');
Route::get('tax/edit/{tax}', [TaxController::class, 'edit'])->name('admin.tax.edit');
Route::put('tax/update/{tax}', [TaxController::class, 'update'])->name('admin.tax.update');
Route::delete('tax/delete/{tax}', [TaxController::class, 'destroy'])->name('admin.tax.destroy');
Route::get('tax/status/{id}/{status}', [TaxController::class, 'status'])->name('admin.tax.status');

//------------ STATE TAX SETTING ------------
Route::get('state/add', [StateController::class, 'add'])->name('admin.state.add');
Route::get('state/view', [StateController::class, 'index'])->name('admin.state.index');
Route::get('state/create', [StateController::class, 'create'])->name('admin.state.create');
Route::post('state/store', [StateController::class, 'store'])->name('admin.state.store');
Route::get('state/edit/{state}', [StateController::class, 'edit'])->name('admin.state.edit');
Route::put('state/update/{state}', [StateController::class, 'update'])->name('admin.state.update');
Route::delete('state/delete/{state}', [StateController::class, 'destroy'])->name('admin.state.destroy');
Route::get('state/status/{id}/{status}', [StateController::class, 'status'])->name('admin.state.status');

//------------ PROMO CODE ------------
Route::get('coupons',[CouponController::class, 'coupons']);
Route::post('update-coupon-status',[CouponController::class, 'updateCouponStatus']);
Route::match(['get','post'],'add-edit-coupon/{id?}',[CouponController::class, 'addEditCoupon']);
Route::get('delete-coupon/{id}',[CouponController::class, 'deleteCoupon']);
Route::get('code/status/{id}/{status}', [CouponController::class, 'status'])->name('admin.coupon.status');
// Route::get('coupon/add', [CouponController::class, 'add'])->name('admin.coupon.add');
// Route::get('coupon/view', [CouponController::class, 'index'])->name('admin.coupon.index');
// Route::get('coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
// Route::post('coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
// Route::get('coupon/edit/{code}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
// Route::put('coupon/update/{code}', [CouponController::class, 'update'])->name('admin.coupon.update');
// Route::delete('coupon/delete/{code}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
// Route::get('code/status/{id}/{status}', [CouponController::class, 'status'])->name('admin.coupon.status');

//------------ SHIPPING SERVICE ------------
Route::get('shipping/add', [ShippingServiceController::class, 'add'])->name('admin.shipping.add');
Route::get('shipping/view', [ShippingServiceController::class, 'index'])->name('admin.shipping.index');
Route::get('shipping/create', [ShippingServiceController::class, 'create'])->name('admin.shipping.create');
Route::post('shipping/store', [ShippingServiceController::class, 'store'])->name('admin.shipping.store');
Route::get('shipping/edit/{shipping}', [ShippingServiceController::class, 'edit'])->name('admin.shipping.edit');
Route::put('shipping/update/{shipping}', [ShippingServiceController::class, 'update'])->name('admin.shipping.update');
Route::delete('shipping/delete/{shipping}', [ShippingServiceController::class, 'destroy'])->name('admin.shipping.destroy');
Route::get('shipping/status/{id}/{status}', [ShippingServiceController::class, 'status'])->name('admin.shipping.status');

//------------ PAYMENT SETTING ------------
Route::get('/setting/payment', [PaymentSettingController::class, 'payment'])->name('admin.setting.payment');
Route::post('/setting/payment/update', [PaymentSettingController::class, 'update'])->name('admin.setting.payment.update');
});

  

Route::group(['middleware' => 'permissions:Manage Site'], function () {
  //------------ SETTING ------------
  Route::get('/setting/menu', [SettingController::class, 'menu'])->name('admin.setting.menu');
  Route::get('/setting/social', [SettingController::class, 'social'])->name('admin.setting.social');
  Route::get('/setting/system', [SettingController::class, 'system'])->name('admin.setting.system');
  Route::post('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
  Route::get('/setting/section', [SettingController::class, 'section'])->name('admin.setting.section');
  Route::post('/setting/update/visible', [SettingController::class, 'visible'])->name('admin.setting.visible.update');
  Route::get('/announcement', [SettingController::class, 'announcement'])->name('admin.subscribers.announcement');
  Route::get('/cookie/alert', [SettingController::class, 'cookie'])->name('admin.cookie.alert');
  Route::get('/maintainance', [SettingController::class, 'maintainance'])->name('admin.setting.maintainance');
  
 //------------ SLIDER ------------
 Route::get('slider/view', [SliderController::class, 'index'])->name('admin.slider.index');
 Route::get('slider/create', [SliderController::class, 'create'])->name('admin.slider.create');
 Route::post('slider/store', [SliderController::class, 'store'])->name('admin.slider.store');
 Route::get('slider/edit/{slider}', [SliderController::class, 'edit'])->name('admin.slider.edit');
 Route::put('slider/update/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
 Route::delete('slider/delete/{slider}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
 
  //------------ SERVICE ------------
  Route::get('service/view', [ServiceController::class, 'index'])->name('admin.service.index');
  Route::get('service/create', [ServiceController::class, 'create'])->name('admin.service.create');
  Route::post('service/store', [ServiceController::class, 'store'])->name('admin.service.store');
  Route::get('service/edit/{service}', [ServiceController::class, 'edit'])->name('admin.service.edit');
  Route::put('service/update/{service}', [ServiceController::class, 'update'])->name('admin.service.update');
  Route::delete('service/delete/{service}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
 
  //   Home Page Customizations
  Route::get('home-page', [HomePageController::class, 'index'])->name('admin.homePage');
  Route::post('home-page/hero/banner/update', [HomePageController::class, 'hero_banner_update'])->name('admin.hero.banner.update');
  Route::post('home-page/first/banner/update', [HomePageController::class, 'first_banner_update'])->name('admin.first.banner.update');
  Route::post('home-page/second/banner/update', [HomePageController::class, 'second_banner_update'])->name('admin.second.banner.update');
  Route::post('home-page/third/banner/update', [HomePageController::class, 'third_banner_update'])->name('admin.third.banner.update');
  Route::post('home-page/popular/category/update', [HomePageController::class, 'popular_category_update'])->name('admin.popular.category.update');
  Route::post('home-page/tree/cloumn/category/update', [HomePageController::class, 'tree_column_category_update'])->name('admin.tree.column.category.update');
  Route::post('home-page/feature/category/category/update', [HomePageController::class, 'feature_category_update'])->name('admin.feature.category.update');
  Route::post('home-page4/banner/update', [HomePageController::class, 'homepage4update'])->name('admin.home_page4.banner.update');
  Route::post('home-page4/category/update', [HomePageController::class, 'homepage4categoryupdate'])->name('admin.home4.category.update');
  
  Route::post('home-page/hot-deals/update', [HomePageController::class, 'hotUpdate'])->name('admin.hot.update');
  Route::post('home-page/special-deals/update', [HomePageController::class, 'specialUpdate'])->name('admin.special.update');
  Route::post('home-page/feature-deals/update', [HomePageController::class, 'featureUpdate'])->name('admin.super.update');
  Route::post('home-page/super-deals/update', [HomePageController::class, 'superUpdate'])->name('admin.feature.update');
 
 //------------ LANGUAGE SETTING ------------
Route::get('language/view', [LanguageController::class, 'index'])->name('admin.language.index');
Route::get('language/create', [LanguageController::class, 'create'])->name('admin.language.create');
Route::post('language/store', [LanguageController::class, 'store'])->name('admin.language.store');
Route::get('language/edit/{language}', [LanguageController::class, 'edit'])->name('admin.language.edit');
Route::put('language/update/{language}', [LanguageController::class, 'update'])->name('admin.language.update');
Route::delete('language/delete/{language}', [LanguageController::class, 'destroy'])->name('admin.language.destroy');
Route::get('language/status/{id}/{status}', [LanguageController::class, 'status'])->name('admin.language.status');

//------------ SOCIAL ------------
Route::get('social/view', [SocialController::class, 'index'])->name('admin.social.index');
Route::get('social/create', [SocialController::class, 'create'])->name('admin.social.create');
Route::post('social/store', [SocialController::class, 'store'])->name('admin.social.store');
Route::get('social/edit/{social}', [SocialController::class, 'edit'])->name('admin.social.edit');
Route::put('social/update/{social}', [SocialController::class, 'update'])->name('admin.social.update');
Route::delete('social/delete/{social}', [SocialController::class, 'destroy'])->name('admin.social.destroy');


 //------------ EMAIL TEMPLATE ------------
 Route::get('/setting/email', [EmailSettingController::class, 'email'])->name('admin.setting.email');
 Route::post('/setting/email/update', [EmailSettingController::class, 'emailUpdate'])->name('admin.email.update');
 Route::get('email/template/{template}/edit', [EmailSettingController::class, 'edit'])->name('admin.template.edit');
 Route::put('email/template/update/{template}', [EmailSettingController::class, 'update'])->name('admin.template.update');
 
  // ----------- SMS SETTING ---------------//
  Route::get('/setting/configuration/sms', [SmsSettingController::class, 'sms'])->name('admin.setting.sms');
  Route::post('/setting/sms/update', [SmsSettingController::class, 'smsUpdate'])->name('admin.sms.update');

// --------- Genarate Sitemap _______
Route::get('/sitemap', [SitemapController::class, 'index'])->name('admin.sitemap.index');
Route::get('/sitemap/add', [SitemapController::class, 'add'])->name('admin.sitemap.add');
Route::post('/sitemap/store', [SitemapController::class, 'store'])->name('admin.sitemap.store');
Route::delete('/sitemap/delete/{id}/', [SitemapController::class, 'delete'])->name('admin.sitemap.delete');
Route::post('/sitemap/download', [SitemapController::class, 'download'])->name('admin.sitemap.download');

//------------ FEATURE ------------
Route::get('feature/image', [FeatureController::class, 'featureImage'])->name('admin.feature.image');
//Route::resource('feature', App\Http\Controllers\Back\FeatureController::class);
// ['as' => 'back', 'except' => 'show']);

});


Route::group(['middleware' => 'permissions:Manage System User'], function () {
  //------------ ROLE ------------
  Route::get('role/view', [RoleController::class, 'index'])->name('admin.role.index');
Route::get('role/create', [RoleController::class, 'create'])->name('admin.role.create');
Route::post('role/store', [RoleController::class, 'store'])->name('admin.role.store');
Route::get('role/edit/{role}', [RoleController::class, 'edit'])->name('admin.role.edit');
Route::put('role/update/{role}', [RoleController::class, 'update'])->name('admin.role.update');
Route::delete('role/delete/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy'); 
  //------------ STAFF ------------
  Route::get('staff/view', [StaffController::class, 'index'])->name('admin.staff.index');
  Route::get('staff/create', [StaffController::class, 'create'])->name('admin.staff.create');
  Route::post('staff/store', [StaffController::class, 'store'])->name('admin.staff.store');
  Route::get('staff/edit/{staff}', [StaffController::class, 'edit'])->name('admin.staff.edit');
  Route::put('staff/update/{staff}', [StaffController::class, 'update'])->name('admin.staff.update');
  Route::delete('staff/delete/{staff}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');
  });


Route::group(['middleware' => 'permissions:Manage Faqs Contents'], function () {
//------------ FAQ CATEGORY ------------
Route::get('faqcategory/view', [FaqCategoryController::class, 'index'])->name('admin.fcategory.index');
Route::get('faqcategory/create', [FaqCategoryController::class, 'create'])->name('admin.fcategory.create');
Route::post('faqcategory/store', [FaqCategoryController::class, 'store'])->name('admin.fcategory.store');
Route::get('faqcategory/edit/{fcategory}', [FaqCategoryController::class, 'edit'])->name('admin.fcategory.edit');
Route::put('faqcategory/update/{fcategory}', [FaqCategoryController::class, 'update'])->name('admin.fcategory.update');
Route::delete('faqcategory/delete/{fcategory}', [FaqCategoryController::class, 'destroy'])->name('admin.fcategory.destroy');
Route::get('faq-category/{id}/{status}', [FaqCategoryController::class, 'status'])->name('admin.fcategory.status');       
//------------ FAQ ------------
Route::get('faq/view', [FaqController::class, 'index'])->name('admin.faq.index');
Route::get('faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
Route::post('faq/store', [FaqController::class, 'store'])->name('admin.faq.store');
Route::get('faq/edit/{faq}', [FaqController::class, 'edit'])->name('admin.faq.edit');
Route::put('faq/update/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
Route::delete('faq/delete/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

});

Route::group(['middleware' => 'permissions:Manages Pages'], function () {
    //------------ PAGE ------------
  Route::get('page/view', [PageController::class, 'index'])->name('admin.page.index');
  Route::get('page/create', [PageController::class, 'create'])->name('admin.page.create');
  Route::post('page/store', [PageController::class, 'store'])->name('admin.page.store');
  Route::get('page/edit/{page}', [PageController::class, 'edit'])->name('admin.page.edit');
  Route::put('page/update/{page}', [PageController::class, 'update'])->name('admin.page.update');
  Route::delete('page/delete/{page}', [PageController::class, 'destroy'])->name('admin.page.destroy');
  Route::get('page/pos/{id}/{pos}', [PageController::class, 'pos'])->name('admin.page.pos');
  });
  
Route::group(['middleware' => 'permissions:Manage Orders'], function () {
//------------ ORDER ------------
Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.order.index');
Route::delete('/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin.order.delete');
Route::get('/order/print/{id}', [AdminOrderController::class, 'printOrder'])->name('admin.order.print');
Route::get('/order/invoice/{id}', [AdminOrderController::class, 'invoice'])->name('admin.order.invoice');
Route::get('/order/status/{id}/{field}/{value}', [AdminOrderController::class, 'status'])->name('admin.order.status');
});

//------------ NOTIFICATIONS ------------
Route::get('/notifications', [NotificationController::class, 'notifications'])->name('admin.notifications');
Route::get('/notifications/view', [NotificationController::class, 'view_notification'])->name('admin.view.notification');
Route::get('/notification/delete/{id}', [NotificationController::class, 'delete'])->name('admin.notification.delete');
Route::get('/notifications/clear', [NotificationController::class, 'clear_notf'])->name('admin.notifications.clear');

Route::group(['middleware' => 'permissions:Customer List'], function () {
  // --------- Customer List _______
  Route::get('user/view', [UserController::class, 'index'])->name('admin.user.index');
  Route::get('user/show/{user}', [UserController::class, 'show'])->name('admin.user.show');
  Route::put('user/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
  Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});


Route::group(['middleware' => 'permissions:System Backup'], function () {
// -------------- SYSTEM BACKUP ---------------//
Route::get('system/backup', [BackupController::class, 'systemBackup'])->name('admin.system.backup');
Route::get('database/backup', [BackupController::class, 'databaseBackup'])->name('admin.database.backup');
});


Route::group(['middleware' => 'permissions:Manages Tickets'], function () {
//------------ TICKET ------------
Route::get('ticket/view', [AdminTicketController::class, 'index'])->name('admin.ticket.index');
Route::get('ticket/create', [AdminTicketController::class, 'create'])->name('admin.ticket.create');
Route::post('ticket/store', [AdminTicketController::class, 'store'])->name('admin.ticket.store');
Route::get('ticket/edit/{ticket}', [AdminTicketController::class, 'edit'])->name('admin.ticket.edit');
Route::put('ticket/update/{ticket}', [AdminTicketController::class, 'update'])->name('admin.ticket.update');
Route::delete('ticket/delete/{ticket}', [AdminTicketController::class, 'destroy'])->name('admin.ticket.destroy');
Route::get('ticket/status/{id}', [AdminTicketController::class, 'status'])->name('admin.ticket.status');
});



Route::group(['middleware' => 'permissions:Transactions'], function () {
//------------ TRANSACTION ----------------//
Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transaction.index');
Route::delete('/transaction/delete/{id}', [TransactionController::class, 'delete'])->name('admin.transaction.delete');
});

});


Route::group(['middleware' => 'permissions:Subscribers List'], function () {
//------------ SUBSCRIBER ------------
Route::get('/subscribers', [SubscriberController::class, 'index'])->name('admin.subscribers.index');
Route::delete('/subscriber/delete/{id}', [SubscriberController::class, 'delete'])->name('admin.subscriber.delete');
Route::get('/subscribers/send-mail', [SubscriberController::class, 'sendMail'])->name('admin.subscribers.mail');
Route::post('/subscribers/send-mail/submit', [SubscriberController::class, 'sendMailSubmit'])->name('admin.subscribers.mail.submit');
});
});


// ************************************ ADMIN PANEL ENDS**********************************************










// ************************************ GLOBAL LOCALIZATION **********************************************

Route::group(['middleware' => 'maintainance'], function () {
Route::group(['middleware' => 'localize'], function () {

// ************************************ USER PANEL **********************************************
  
Route::prefix('user')->group(function () {
  Route::get('/contact', [IndexController::class, 'contact'])->name('front.contacts');
  Route::post('/contact/submit', [IndexController::class, 'contactEmail'])->name('front.contact.submit');
     
    // //------------ FORGOT ------------
    Route::get('/forgot', [ForgotController::class, 'showForm'])->name('user.forgot');
    Route::post('/forgot-submit', [ForgotController::class, 'forgot'])->name('user.forgot.submit');
    Route::get('/change-password/{token}', [ForgotController::class, 'showChangePassForm'])->name('user.change.token');
    Route::post('/change-password-submit', [ForgotController::class, 'changepass'])->name('user.change.password');

    //------------ DASHBOARD ------------
    Route::get('/dashboard', [AccountController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [AccountController::class, 'profile'])->name('user.profile');
   //------------ SETTING ------------
   Route::post('/profile/update', [AccountController::class, 'profileUpdate'])->name('user.profile.update');
   Route::get('/addresses', [AccountController::class, 'addresses'])->name('user.address');
   Route::post('/billing/addresses', [AccountController::class, 'billingSubmit'])->name('user.billing.submit');
   Route::post('/shipping/addresses', [AccountController::class, 'shippingSubmit'])->name('user.shipping.submit');
   Route::get('/remove-account', [AccountController::class, 'removeAccount'])->name('user.account.remove');


    // ----------- TICKET ---------------//
    Route::get('/ticket', [TicketController::class, 'ticket'])->name('user.ticket');
    Route::get('/ticket/new', [TicketController::class, 'ticketNew'])->name('user.ticket.create');
    Route::post('/ticket/store', [TicketController::class, 'ticketStore'])->name('user.ticket.store');
    Route::get('/ticket/view/{id}', [TicketController::class, 'ticketView'])->name('user.ticket.view');
    Route::post('/ticket/reply/store', [TicketController::class, 'ticketReply'])->name('user.ticket.reply');
    Route::get('/ticket/delete/{id}', [TicketController::class, 'ticketDelete'])->name('user.ticket.delete');

  //------------ WISHLIST ------------
  Route::get('/wishlists', [WishlistController::class, 'index'])->name('user.wishlist.index');
  Route::get('/wishlist/store/{id}', [WishlistController::class, 'store'])->name('user.wishlist.store');
  Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete'])->name('user.wishlist.delete');
  Route::get('/wishlista/delete/all', [WishlistController::class, 'alldelete'])->name('user.wishlist.delete.all');



    //------------ ORDER ------------
    Route::get('/orders', [OrderController::class, 'index'])->name('user.order.index');
    Route::get('/order/print/{id}', [OrderController::class, 'printOrder'])->name('user.order.print');
    Route::get('/order/invoice/{id}', [OrderController::class, 'details'])->name('user.order.invoice');
    Route::get('/order/delete/{id}', [OrderController::class, 'delete'])->name('user.order.delete');
  

    Route::get('/checkout/billing/address', [CheckoutController::class, 'ship_address'])->name('front.checkout.billing');
Route::post('/checkout/billing/store', [CheckoutController::class, 'billingStore'])->name('front.checkout.store');
  });


Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.provider');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

// ************************************ USER PANEL ENDS**********************************************

    


// ************************************ FRONTEND **********************************************
// Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){
   
// }); 
Route::get('/', [IndexController::class, 'index']);
// Route::get('/', [IndexController::class, 'index'])->name('front.index');
/// Multi Language All Routes ////
Route::get('/language/hindi', [LanguagesController::class, 'Hindi'])->name('hindi.language');
Route::get('/language/french', [LanguagesController::class, 'French'])->name('french.language');
Route::get('/language/english', [LanguagesController::class, 'English'])->name('english.language');

Route::get('/extra-index', [IndexController::class, 'extraIndex'])->name('front.extraindex');
//------------ CATALOG ------------
Route::get('/catalog', [CatalogController::class, 'index'])->name('front.category');
Route::get('/search/suggest', [CatalogController::class, 'suggestSearch'])->name('front.search.suggest');
Route::get('/catalog/view/{type}', [CatalogController::class, 'viewType'])->name('front.catalog.view');


Route::get('/catalog/tag/{id}/{tags}', [SearchController::class, 'TagWise']);
Route::get('/catalog/subcat/{id}/{slug_en}', [SearchController::class, 'SubCatWiseProduct']);
Route::get('/catalog/childcat/{id}/{slug_en}', [SearchController::class, 'ChildCatWiseProduct']);
Route::get('/category/{id}/{slug_en}', [SearchController::class, 'CatWiseProduct']);
Route::get('/search', [SearchController::class, 'Search'])->name('front.search');
Route::get('/all/catalog', [SearchController::class, 'Search'])->name('all.catalog');

Route::get('/brands/brand', [SearchController::class, 'Search'])->name('front.brands');
Route::get('/campaign/products', [IndexController::class, 'campaignProduct'])->name('front.campaign');
Route::get('/product/{slug_en}', [IndexController::class, 'products'])->name('product.details');

//------------ View All ------------
Route::get('/rec/products', [ViewAllController::class, 'recommended'])->name('front.rec');
Route::get('/deals/products', [ViewAllController::class, 'specialDeals'])->name('front.special.deals');
Route::get('/offer/products', [ViewAllController::class, 'specialOffer'])->name('front.special.offer');
Route::get('/featured/products', [ViewAllController::class, 'featured'])->name('front.featured');

Route::get('/faq', [IndexController::class, 'faq'])->name('front.faq');
Route::get('/faq/{slug}', [IndexController::class, 'show'])->name('front.faq.details');
//------------ PAGE ------------
Route::get('/{slug}', [IndexController::class, 'page'])->name('front.page');
//------------ COMPARE PRODUCT ------------//
Route::get('compare/product/{id}', [CompareController::class, 'compare'])->name('front.compare.product');
Route::get('compare/remove/{id}', [CompareController::class, 'compareRemove'])->name('front.compare.remove');
Route::get('compare/products', [CompareController::class, 'compare_product'])->name('front.compare.index');

//------------ CART ------------
Route::get('/user/cart', [CartController::class, 'index'])->name('front.cart');
Route::get('/product/add/cart', [CartController::class, 'addToCart'])->name('product.addcart');
Route::get('/front/cart/clear', [CartController::class, 'cartClear'])->name('front.cart.clear');
Route::get('/header/cart/load', [CartController::class, 'headerCartLoad'])->name('front.header.cart');
Route::get('/main/cart/load', [CartController::class, 'CartLoad'])->name('cart.get.load');
Route::post('/cart/submit', [CartController::class, 'store'])->name('front.cart.submit');
Route::get('/product/cart/update/{id}', [CartController::class, 'update'])->name('product.update.single');

// Apply Coupon
Route::post('/apply-coupon',[CartController::class, 'applyCoupon']);

Route::post('/promo/submit', [CartController::class, 'promoStore'])->name('front.promo.submit');
Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('front.cart.destroy');
Route::post('/shipping/submit', [CartController::class, 'shippingStore'])->name('front.shipping.submit');
Route::post('/shipping/charge/get', [CartController::class, 'shippingCharge'])->name('front.shipping.charge');

//------------ CHECKOUT ------------

Route::get('/checkout/shpping/address', [CheckoutController::class, 'shipping'])->name('front.checkout.shipping');
Route::post('/checkout/shpping/store', [CheckoutController::class, 'shippingStore'])->name('front.checkout.shipping.store');
Route::get('/checkout/review/payment', [CheckoutController::class, 'payment'])->name('front.checkout.payment');
Route::get('/checkout/state/setup/{state_id}', [CheckoutController::class, 'stateSetUp'])->name('front.state.setup');
Route::post('/checkout-submit', [CheckoutController::class, 'checkout'])->name('front.checkout.submit');
Route::get('/checkout/success', [CheckoutController::class, 'paymentSuccess'])->name('front.checkout.success');
Route::get('/checkout/cancle', [CheckoutController::class, 'paymentCancle'])->name('front.checkout.cancle');
Route::get('/paypal/checkout/redirect', [CheckoutController::class, 'paymentRedirect'])->name('front.checkout.redirect');
Route::get('/checkout/mollie/notify', [CheckoutController::class, 'mollieRedirect'])->name('front.checkout.mollie.redirect');
Route::post('/paytm/notify', [PaytmController::class, 'notify'])->name('front.paytm.notify');
Route::post('/paytm/submit', [PaytmController::class, 'store'])->name('front.paytm.submit');
Route::post('/razorpay/notify', [RazorpayController::class, 'notify'])->name('front.razorpay.notify');
Route::post('/razorpay/submit', [RazorpayController::class, 'store'])->name('front.razorpay.submit');
Route::post('/flutterwave/notify', [FlutterwaveController::class, 'notify'])->name('front.flutterwave.notify');
Route::post('/flutterwave/submit', [FlutterwaveController::class, 'store'])->name('front.flutterwave.submit');
Route::post('/mercadopago/submit', [MercadopagoController::class, 'store'])->name('front.mercadopago.submit');
Route::post('/authorize/submit', [AuthorizeController::class, 'store'])->name('front.authorize.submit');

Route::post('/sslcommerz/notify', [SslCommerzController::class, 'notify'])->name('front.sslcommerz.notify');
Route::post('/sslcommerz/submit', [SslCommerzController::class, 'store'])->name('front.sslcommerz.submit');


Route::get('/reviews', [IndexController::class, 'reviews'])->name('front.reviews');
Route::get('/review/page', [IndexController::class, 'review_submit'])->name('front.rev.page');
Route::get('/review/sub', [IndexController::class, 'slider_o_update'])->name('front.rev.subbmit');
Route::get('/top-reviews', [IndexController::class, 'topReviews'])->name('front.top.reviews');
Route::post('/review/submit', [IndexController::class, 'reviewSubmit'])->name('front.review.submit');
Route::post('/subscriber/submit', [IndexController::class, 'subscribeSubmit'])->name('front.subscriber.submit');
Route::get('set/currency/{id}', [IndexController::class, 'currency'])->name('front.currency.setup');
Route::get('set/language/{id}', [IndexController::class, 'language'])->name('front.language.setup');

// ---------- EXTRA INDEX ROUTE ----------//
Route::get('popular/category/get/{slug_en}/{type}/{check}', [HomeCustomizeController::class, 'CategoryGet'])->name('front.popular.category');
Route::get('product/get/type/{type}', [HomeCustomizeController::class, 'productGet'])->name('front.get.product');

// ----------- TRACK ORDER ----------//
Route::get('/track/order', [IndexController::class, 'trackOrder'])->name('front.order.track');
Route::get('/order/track/submit', [IndexController::class, 'track'])->name('front.order.track.submit');

Route::get('/cache/clear', function () {
Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');
return redirect()->route('admin.dashboard')->withSuccess(__('System Cache Has Been Cleared Successfully.'));
})->name('front.cache.clear');

// ************************************ FRONTEND ENDS**********************************************

// ************************************ GLOBAL LOCALIZATION ENDS **********************************************
       });
});
Route::get('/website/maintainance', [IndexController::class, 'maintainance'])->name('front.maintainance');













require __DIR__.'/auth.php';