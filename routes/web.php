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

// 세션정보 확인용
Route::get('/session',function(){
    dd(session()->all());
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/layout', 'HomeController@onLayoutChange');
Route::post('/search', 'HomeController@search')->name('search');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// 차트 데이터
Route::post('/chart', 'ChartController@index');
Route::post('/chart/app_daily', 'ChartController@onGetAppDailyChartData');
Route::get('/chart/app_total', 'ChartController@onGetAppChartData');
Route::get('/chart/ma_daily', 'ChartController@onGetMaDailyChartData');

// 매출 통계표
Route::post('/sales', 'SalesController@getPlatformData');




// 결제관리
Route::view('/appspaylist', 'appspaylist')->name('appspaylist.view');
Route::get('/appspaylist/data', 'AppsPaymentController@getAppsPaymentData')->name('appspaylist');
Route::get('/appspaydetail/{idx}', 'AppsPaymentController@getSingleData')->name('appspaydetail');
Route::post('/appspayupdate/{idx}', 'AppsPaymentController@update')->name('appspayupdate');

// 프로모션
Route::view('/promolist', 'promolist')->name('promolist.view');
Route::get('/promolist/data', 'PromotionController@getPromotionData')->name('promolist');
Route::get('/promodetail/{idx}', 'PromotionController@getSingleData')->name('promodetail');

// 앱 접수
Route::view('/appsorderlist', 'appsorderlist')->name('appsorderlist.view');
Route::get('/appsorderlist/data', 'AppsOrderController@getAppsOrderData')->name('appsorderlist');
Route::get('/appsorderdetail/{idx}', 'AppsOrderController@getSingleData')->name('appsorderdetail');

// 앱 목록
Route::view('/appslist', 'appslist')->name('appslist.view');
Route::get('/appslist/data', 'AppsListController@getAppsListData')->name('appslist');
Route::get('/appsdetail/{idx}', 'AppsListController@getSingleData')->name('appsdetail');

// 업데이트 관리
Route::view('/appsupdatelist', 'appsupdatelist')->name('appsupdatelist.view');
Route::get('/appsupdatelist/data', 'AppsUpdateController@getAppsUpdateData')->name('appsupdatelist');
Route::get('/appsupdatedetail/{idx}', 'AppsUpdateController@getSingleData')->name('appsupdatedetail');

// APK 관리
Route::view('/apklist', 'apklist')->name('apklist.view');
Route::get('/apklist/data', 'ApkController@getApkData')->name('apklist');
Route::get('/apkdetail/{idx}', 'ApkController@getSingleData')->name('apkdetail');

// 푸쉬 현황
Route::view('/pushlist', 'pushlist')->name('pushlist.view');
Route::get('/pushlist/data', 'PushController@getPushListData')->name('pushlist');
Route::get('/pushdetail/{idx}', 'PushController@getSingleData')->name('pushdetail');

// 소식 관리
Route::view('/pushnewslist', 'pushnewslist')->name('pushnewslist.view');
Route::get('/pushnewslist/data', 'PushNewsController@getPushNewsListData')->name('pushnewslist');
Route::get('/pushnewsdetail/{idx}', 'PushNewsController@getSingleData')->name('pushnewsdetail');

// 인증회원 관리
Route::view('/appspointmemberlist', 'appspointmemberlist')->name('appspointmemberlist.view');
Route::get('/appspointmemberlist/data', 'AppsPointMemberController@getAppsPointMemberListData')->name('appspointmemberlist');
Route::get('/appspointmemberdetail/{idx}', 'AppsPointMemberController@getSingleData')->name('appspointmemberdetail');

// 앱포인트 관리
Route::view('/appspointlist', 'appspointlist')->name('appspointlist.view');
Route::get('/appspointlist/data', 'AppsPointController@getAppsPointListData')->name('appspointlist');
Route::get('/appspointdetail/{idx}', 'AppsPointController@getSingleData')->name('appspointdetail');

//  테스터 관리
Route::view('/pushtesterlist', 'pushtesterlist')->name('pushtesterlist.view');
Route::get('/pushtesterlist/data', 'PushTesterController@getPushTesterListData')->name('pushtesterlist');
Route::get('/pushtesterdetail/{idx}', 'PushTesterController@getSingleData')->name('pushtesterdetail');

//  부가서비스 관리
Route::view('/appendixorderlist', 'appendixorderlist')->name('appendixorderlist.view');
Route::get('/appendixorderlist/data', 'AppendixOrderController@getAppendixOrderListData')->name('appendixorderlist');
Route::get('/appendixorderdetail/{idx}', 'AppendixOrderController@getSingleData')->name('appendixorderdetail');

//  MA 이용 업체
Route::view('/malist', 'malist')->name('malist.view');
Route::get('/malist/data', 'MAController@getMAListData')->name('malist');
Route::get('/madetail/{idx}', 'MAController@getSingleData')->name('madetail');

//  앱 설치 통계
Route::view('/appsdownstatlist', 'appsdownstatlist')->name('appsdownstatlist.view');
Route::get('/appsdownstatlist/data', 'AppsDownStatController@getAppsDownStatListData')->name('appsdownstatlist');
Route::get('/appsdownstatdetail/{idx}', 'AppsDownStatController@getSingleData')->name('appsdownstatdetail');

//  앱 이용 통계
Route::view('/appsstatlist', 'appsstatlist')->name('appsstatlist.view');
Route::get('/appsstatlist/data', 'AppsStatController@getAppsStatListData')->name('appsstatlist');
Route::get('/appsstatdetail/{idx}', 'AppsStatController@getSingleData')->name('appsstatdetail');

//  앱 매출 통계
Route::view('/appssalestatlist', 'appssalestatlist')->name('appssalestatlist.view');
Route::get('/appssalestatlist/data', 'AppsSaleStatController@getAppsSaleStatListData')->name('appssalestatlist');
Route::get('/appssalestatdetail/{idx}', 'AppsSaleStatController@getSingleData')->name('appssalestatdetail');
