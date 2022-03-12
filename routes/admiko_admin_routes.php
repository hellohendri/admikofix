<?php
/** Admiko routes. This file will be overwritten on page import. Don't add your code here! **/

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**Wallet**/
Route::delete("wallet/destroy", [WalletController::class,"destroy"])->name("wallet.delete");
Route::resource("wallet", WalletController::class)->parameters(["wallet" => "wallet"]);
/**Transaction**/
Route::delete("transaction/destroy", [TransactionController::class,"destroy"])->name("transaction.delete");
Route::resource("transaction", TransactionController::class)->parameters(["transaction" => "transaction"]);
/**TransactionType**/
Route::delete("transaction_type/destroy", [TransactionTypeController::class,"destroy"])->name("transaction_type.delete");
Route::resource("transaction_type", TransactionTypeController::class)->parameters(["transaction_type" => "transaction_type"]);
/**TransactionCategory**/
Route::delete("transaction_category/destroy", [TransactionCategoryController::class,"destroy"])->name("transaction_category.delete");
Route::resource("transaction_category", TransactionCategoryController::class)->parameters(["transaction_category" => "transaction_category"]);
/**Outlets**/
Route::delete("outlets/destroy", [OutletsController::class,"destroy"])->name("outlets.delete");
Route::resource("outlets", OutletsController::class)->parameters(["outlets" => "outlets"]);
/**Product**/
Route::delete("product/destroy", [ProductController::class,"destroy"])->name("product.delete");
Route::resource("product", ProductController::class)->parameters(["product" => "product"]);
/**ProductCategory**/
Route::delete("product_category/destroy", [ProductCategoryController::class,"destroy"])->name("product_category.delete");
Route::resource("product_category", ProductCategoryController::class)->parameters(["product_category" => "product_category"]);
/**Customers**/
Route::delete("customers/destroy", [CustomersController::class,"destroy"])->name("customers.delete");
Route::resource("customers", CustomersController::class)->parameters(["customers" => "customers"]);
/**PaymentMethod**/
Route::delete("payment_method/destroy", [PaymentMethodController::class,"destroy"])->name("payment_method.delete");
Route::resource("payment_method", PaymentMethodController::class)->parameters(["payment_method" => "payment_method"]);
/**PaymentStatus**/
Route::delete("payment_status/destroy", [PaymentStatusController::class,"destroy"])->name("payment_status.delete");
Route::resource("payment_status", PaymentStatusController::class)->parameters(["payment_status" => "payment_status"]);
/**Sales**/
Route::delete("sales/destroy", [SalesController::class,"destroy"])->name("sales.delete");
Route::resource("sales", SalesController::class)->parameters(["sales" => "sales"]);
/**Losses**/
Route::delete("losses/destroy", [LossesController::class,"destroy"])->name("losses.delete");
Route::resource("losses", LossesController::class)->parameters(["losses" => "losses"]);
/**LossesType**/
Route::delete("losses_type/destroy", [LossesTypeController::class,"destroy"])->name("losses_type.delete");
Route::resource("losses_type", LossesTypeController::class)->parameters(["losses_type" => "losses_type"]);
