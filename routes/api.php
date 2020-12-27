<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Crm Statuses
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customers
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Notes
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Documents
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Stores
    Route::apiResource('stores', 'StoresApiController');

    // Providers
    Route::apiResource('providers', 'ProvidersApiController');

    // Product Categories
    Route::apiResource('product-categories', 'ProductCategoriesApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::apiResource('products', 'ProductsApiController');

    // Products Bases
    Route::apiResource('products-bases', 'ProductsBaseApiController');

    // Product Specs
    Route::apiResource('product-specs', 'ProductSpecsApiController');

    // Items
    Route::apiResource('items', 'ItemsApiController');

    // Transaction Statuses
    Route::apiResource('transaction-statuses', 'TransactionStatusApiController');

    // Transaction Types
    Route::apiResource('transaction-types', 'TransactionTypesApiController');

    // Transactions
    Route::post('transactions/media', 'TransactionsApiController@storeMedia')->name('transactions.storeMedia');
    Route::apiResource('transactions', 'TransactionsApiController');

    // Transaction Details
    Route::apiResource('transaction-details', 'TransactionDetailApiController');
});
