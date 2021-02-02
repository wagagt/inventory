<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Crm Statuses
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customers
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Notes
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Documents
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Stores
    Route::delete('stores/destroy', 'StoresController@massDestroy')->name('stores.massDestroy');
    Route::resource('stores', 'StoresController');

    // Providers
    Route::delete('providers/destroy', 'ProvidersController@massDestroy')->name('providers.massDestroy');
    Route::resource('providers', 'ProvidersController');

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoriesController@massDestroy')->name('product-categories.massDestroy');
    Route::resource('product-categories', 'ProductCategoriesController');

    // Product Tags
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductsController');

    // Products Bases
    Route::delete('products-bases/destroy', 'ProductsBaseController@massDestroy')->name('products-bases.massDestroy');
    Route::resource('products-bases', 'ProductsBaseController');

    // Product Specs
    Route::delete('product-specs/destroy', 'ProductSpecsController@massDestroy')->name('product-specs.massDestroy');
    Route::resource('product-specs', 'ProductSpecsController');

    // Items
    Route::delete('items/destroy', 'ItemsController@massDestroy')->name('items.massDestroy');
    Route::resource('items', 'ItemsController');

    // Transaction Statuses
    Route::delete('transaction-statuses/destroy', 'TransactionStatusController@massDestroy')->name('transaction-statuses.massDestroy');
    Route::resource('transaction-statuses', 'TransactionStatusController');

    // Transaction Types
    Route::delete('transaction-types/destroy', 'TransactionTypesController@massDestroy')->name('transaction-types.massDestroy');
    Route::resource('transaction-types', 'TransactionTypesController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/media', 'TransactionsController@storeMedia')->name('transactions.storeMedia');
    Route::post('transactions/ckmedia', 'TransactionsController@storeCKEditorImages')->name('transactions.storeCKEditorImages');
    Route::resource('transactions', 'TransactionsController');

    // Transaction Details
    Route::delete('transaction-details/destroy', 'TransactionDetailController@massDestroy')->name('transaction-details.massDestroy');
    Route::resource('transaction-details', 'TransactionDetailController');

    // Customer Charge Accounts
    Route::delete('customer-charge-accounts/destroy', 'CustomerChargeAccountsController@massDestroy')->name('customer-charge-accounts.massDestroy');
    Route::resource('customer-charge-accounts', 'CustomerChargeAccountsController');

    // Survey Ubications
    Route::delete('survey-ubications/destroy', 'SurveyUbicationsController@massDestroy')->name('survey-ubications.massDestroy');
    Route::resource('survey-ubications', 'SurveyUbicationsController');

    // Surveys
    Route::delete('surveys/destroy', 'SurveysController@massDestroy')->name('surveys.massDestroy');
    Route::resource('surveys', 'SurveysController');

    // Survey Details
    Route::delete('survey-details/destroy', 'SurveyDetailController@massDestroy')->name('survey-details.massDestroy');
    Route::resource('survey-details', 'SurveyDetailController');

    // Survey Responders
    Route::delete('survey-responders/destroy', 'SurveyRespondersController@massDestroy')->name('survey-responders.massDestroy');
    Route::resource('survey-responders', 'SurveyRespondersController');

    // Survey Responses
    Route::delete('survey-responses/destroy', 'SurveyResponsesController@massDestroy')->name('survey-responses.massDestroy');
    Route::resource('survey-responses', 'SurveyResponsesController');

    // Survey Answer Types
    Route::delete('survey-answer-types/destroy', 'SurveyAnswerTypesController@massDestroy')->name('survey-answer-types.massDestroy');
    Route::resource('survey-answer-types', 'SurveyAnswerTypesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
