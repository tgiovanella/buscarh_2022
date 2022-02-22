<?php
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

/**
 * Rotas Usuário Comun
 **/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->name('user.')->namespace('User')->group(function () {

    Auth::routes();

    Route::get('email/{id}', function ($id) {
        return view('user.emails.ads-order.' . $id);
    });




    Route::get('checkout/{token}', 'CheckoutOrderController@create')->name('checkout.create');
    Route::post('checkout/{token}', 'CheckoutOrderController@store')->name('checkout.store');

    Route::get('cancel/{ads}', 'CheckoutOrderController@cancel')->name('checkout.cancel');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/segundo', 'HomeController@segundo')->name('home.segundo');

    Route::resource('ads', 'AdvertController');
    Route::get('users/ads/{advert}', 'AdvertController@edit')->name('users.ads.edit');

    Route::get('users/company', 'UserController@company')->name('users.company');
    Route::post('users/company', 'UserController@createCompany')->name('users.company.store');


    Route::post('users/quotation', 'QuotationController@store')->name('users.quotation.store');
    Route::post('users/quotation/delete', 'QuotationController@delete')->name('users.quotation.delete');

    Route::post('users/proposal', 'QuoteProposalController@store')->name('users.proposal.store');

    Route::get('users/candidate/{quote_id?}', 'QuoteCandidateController@index')->name('candidate');
    Route::get('users/opportunity', 'QuoteCandidateController@opportunity')->name('users.opportunity');
    Route::get('users/proposal/{id}', 'QuoteCandidateController@info')->name('users.proposal.info');
    Route::post('users/accept-proposal', 'QuoteCandidateController@acceptProposal')->name('users.proposal.accept');

    Route::post('users/quotes-nps', 'QuoteCandidateController@saveNps');
    Route::post('users/quotes-buy-coins', 'QuoteCandidateController@buyCoins');
    Route::post('users/config-buy-coins', 'QuoteCandidateController@configBuyCoins');
    Route::post('users/update-buy-status-coin', 'QuoteCandidateController@saveStatusBuyCoin');


    Route::post('users/comment-proposal', 'QuoteProposalController@addComment')->name('users.proposal.comment');
    
    Route::get('users/comment-proposal/{id}/{quote_id}', 'QuoteProposalController@getComments')->name('users.proposal.get.comment');

    Route::get('users/proposal-viewed/{id}', 'NotificationController@wasViewed')->name('users.proposal.viewed');

    Route::get('candidate/notification/{quote_id?}', 'NotificationController@dispatchQuotation')->name('candidate.notification');

    Route::get('users/company/{company}/edit', 'UserController@editCompany')->name('users.company.edit');
    Route::put('users/company/{company}/edit', 'UserController@updateCompany')->name('users.company.update');
    Route::delete('users/company/{company}/edit', 'UserController@destroyCompany')->name('users.company.destroy');


    Route::resource('users', 'UserController');

    Route::post('reports/{company}', 'ReportController@store')->name('reports.store');
    Route::get('denunciar-anuncio', 'ReportController@createAds')->name('ads-reports.index');
    Route::post('denunciar-anuncio', 'ReportController@storeAds')->name('ads-reports.store');


    Route::get('institucional/{slug}', 'PageController@show')->name('institucional.show');

    //para usuários normais
    Route::get('empresas/{category?}/{subcategory?}', 'CompanySearchController@index')->name('company.search'); //index($category = null, $subcategory = null)
    Route::get('empresa/{city}/{slug}/', 'CompanySearchController@show')->name('company.show'); //


    //contato
    Route::get('contato', 'ContactController@create')->name('contacts.create');
    Route::post('contato', 'ContactController@store')->name('contacts.store');

    //avaliação
    Route::get('avaliacao/{id}', 'CompanyEvaluationController@create')->name('companyevaluation.create');
    Route::post('avaliacao', 'CompanyEvaluationController@store')->name('companyevaluation.store');

    //faq
    Route::get('faq', 'FaqController@index')->name('faqs.index');


    //anuncie
    Route::get('anuncie', 'AdvertController@create')->name('ads.create');
    Route::post('anuncie', 'AdvertController@store')->name('ads.store');

    //reivindicar-empresa
    Route::get('reivindicar-empresa', 'ClaimCompanyController@create')->name('claims.create');
    Route::post('reivindicar-empresa', 'ClaimCompanyController@store')->name('claims.store');



    //para auteticação
    Route::middleware('auth:user')->group(function () {
        // Route::get('home', 'HomeController@index')->name('home');
    });
});

#fixe https://stackoverflow.com/questions/44049706/route-password-reset-not-defined-in-laravel-5-4-in-resetpasswords-php
// Password reset link request routes...
Route::get('password/email', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.email');
Route::post('password/email', 'User\Auth\ForgotPasswordController@sendResetLinkEmail');


// Password reset routes...
Route::get('password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'User\Auth\ResetPasswordController@postReset')->name('password.reset');


/**
 * rotas admin
 **/
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
    Auth::routes();



    Route::get('/', function () {
        return redirect(route('admin.login'));
    });

    Route::middleware('auth:admin')->group(function () {

        //auditoria
        Route::post('adits/{id}/show/', 'AuditController@show')->name('audits.show');

        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('contacts', 'ContactController');
        Route::resource('categories', 'CategoryController');
        Route::resource('subcategories', 'SubcategoryController');
        Route::resource('companies', 'CompanyController');
        Route::resource('quotations', 'QuotationController');
        Route::resource('nps', 'NpsController');
        Route::get('config-coins', 'NpsController@indexCoins');
        Route::put('companies/{company}/highlighted', 'CompanyController@highlighted')->name('companies.highlighted');


        Route::resource('reports', 'ReportController');
        Route::post('reports/{id}/block', 'ReportController@block');
        Route::post('reports/{id}/ignore-block', 'ReportController@ignoreBlock');


        Route::get('reports-ads', 'ReportController@indexAds')->name('reports.ads');
        Route::get('quotes', 'QuoteController@index')->name('quotes.index');
        Route::post('quotes/search', 'QuoteController@search')->name('quotes.search');
        Route::post('quotes/excel', 'QuoteController@export')->name('quotes.excel.export');
        Route::post('quotes/pdf', 'QuoteController@exportPDF')->name('quotes.pdf.export');


        Route::resource('pages', 'PageController');
        Route::resource('faqs', 'FaqController');
        Route::resource('navs', 'PageNavController');

        Route::resource('ads', 'AdvertController');
        Route::post('ads/{id}/remove-file', 'AdvertController@destroyFile');
        Route::resource('ads-config', 'AdvertConfigurationController');


        Route::resource('configurations', 'ConfigurationController');


        Route::get('analytics/terms', 'AnalyticSearchController@terms')->name('analytics.terms');
        Route::get('analytics/terms-export', 'AnalyticSearchController@export')->name('analytics.terms-export');


        Route::resource('planes', 'PlaneController');
        Route::resource('orders', 'OrderPaymentController');

        Route::resource('claims', 'ClaimCompanyController');
        Route::resource('users', 'UserController');

        Route::resource('report/list-contacts', 'Reports\ContactsReportsController');
        Route::resource('report/clicks-regions', 'Reports\RegionsReportsController');
        Route::get('report/clicks-regions/{id}/detail', 'Reports\RegionsReportsController@detail')->name('clicks-regions.details');



        Route::get('report/list-contacts-export', 'Reports\ContactsReportsController@export')->name('report.contacts.exp');
    });
});
