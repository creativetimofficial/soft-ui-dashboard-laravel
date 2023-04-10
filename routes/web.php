<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Art;
use Illuminate\Support\Facades\Http;
use App\Models\Card;
use App\Models\CardLog;
use App\Models\CampanhaSucesso;
use App\Models\Download;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		$users = User::count();
		$cards = Card::with('user')->with('read')->orderBy('id','DESC')->limit(3)->get();
		$infos = Art::where('status','1')->with('user')->with('read')->orderBy('id','DESC')->limit(3)->get();
		$infosCount = CardLog::count();
		$totalCards = Card::count();
		$downloads = Download::where('type','2')->count();
		return view('dashboard')->with('totalUsers',$users)->with('totalInfos',$infosCount)->with('totalCards',$totalCards)->with('cardsList',$cards)->with('infosList',$infos)->with('totalDownloads',$downloads);
	})->name('dashboard');

	Route::get('/informativo/{id}', function ($id) {
		$user = Auth::user();
		CardLog::create(['card_id'=>$id,'user_id'=>$user->id]);
		$card = Card::with('user')->with('read')->where('id',$id)->get();
		$othersCards = Card::with('user')->with('read')->where('id','<>',$id)->inRandomOrder()->limit(3)->get();
		return view('card')->with('card',$card)->with('othersCards',$othersCards);
	})->name('informativo');
	
	Route::get('artes', function () {
		$arts = Art::where('status','1')->with('user')->with('download')->orderBy('order','ASC')->get();
		return view('arts')->with('arts',$arts);
	})->name('artes');

	Route::get('informativos', function () {
		$cards = Card::with('user')->with('read')->orderBy('id','DESC')->get();
		return view('cards')->with('cards',$cards);
	})->name('informativos');

	Route::get('usuario', function () {
		$user = Auth::user();
		return view('profile')->with('user',$user);
	})->name('usuario');

	Route::get('campanha/plano-de-sucesso', function () {
		$user = Auth::user();
		if($user->store_id==''){
			if($user->store_id==''){
				session()->flash('error', 'Sem loja cadastrada, vincule sua loja na página de Usuário.');
            	return back();
			}
		}
		$regiao = CampanhaSucesso::select('updated_at','cdregiao')->where('cdloja',$user->store_id)->orderBy('id', 'DESC')->first();
		if(!$regiao) {
			session()->flash('error', 'Sem região nos dados, espere os dados serem cadastrados.');
			return back();
		}
		$arrayUsers = [10,13,164,167,43,165,168,178,179,39];
		if(in_array($user->id,$arrayUsers)){
			$results = CampanhaSucesso::where('updated_at','>=',date('Y-m-d'))->orderBy('cdloja','ASC')->get();
		}else{
			$results = CampanhaSucesso::where('cdregiao', $regiao->cdregiao)->where('updated_at','>=',date('Y-m-d'))->orderBy('cdloja','ASC')->get();
		}
		return view('plano-de-sucesso')->with('user',$user)->with('results',$results)->with('dateUpdated',$regiao->updated_at);
	})->name('campanha/plano-de-sucesso');

	Route::get('cancelamentos', function () {
		$user = Auth::user();
		$totalCancel = Order::where('type',1)->count();
		$totalCancelStore = Order::where('store_id',$user->store_id)->where('type',1)->count();
		if(!$user->store_id) return redirect('usuario')->with('error','Para acessar essa página, vincule um código de loja ao seu usuário.');
		return view('cancels')->with('totalCancel',$totalCancel)->with('totalCancelStore',$totalCancelStore)->with('user',$user)->with('type','cancel');
	})->name('cancelamentos');

	Route::get('estornos', function () {
		$user = Auth::user();
		$totalCancel = Order::where('type',2)->count();
		$totalCancelStore = Order::where('store_id',$user->store_id)->where('type',2)->count();
		if(!$user->store_id) return redirect('usuario')->with('error','Para acessar essa página, vincule um código de loja ao seu usuário.');
		return view('reversals')->with('totalCancel',$totalCancel)->with('totalCancelStore',$totalCancelStore)->with('user',$user)->with('type','cancel');
	})->name('estornos');
	
	Route::get('sugestoes', function () {
		$user = Auth::user();
		return view('profile')->with('user',$user);
	})->name('sugestoes');

	Route::get('requisicao-de-arte', function () {
		$user = Auth::user();
		if(!$user->store_id) return redirect('usuario')->with('error','Para acessar essa página, vincule um código de loja ao seu usuário.');
		return view('requisicao-de-arte')->with('user',$user);
	})->name('requisicao-de-arte');

	Route::get('/arte/{id}', function ($id) {
		$user = Auth::user();
		$art = Art::where('status','1')->with('user')->with('download')->with('read')->with('allfields')->where('id',$id)->first();
		if($art->permission!=''&&$user->store_id==''){
			if($user->store_id==''){
				session()->flash('error', 'Sem loja cadastrada, vincule sua loja na página de Usuário.');
            	return back();
			}
			$storesPermission = explode(',',$art->permission);
			if(!in_array($user->store_id,$storesPermission)){
				session()->flash('error', 'Loja não habilitada para criação dessa arte, verifique seu cadastro com o suporte.');
				return back();
			}
		}
		Download::create(['art_id'=>$id,'user_id'=>$user->id,'type'=>1]);
		$othersArts = Art::with('user')->with('download')->where('id','<>',$id)->inRandomOrder()->limit(3)->get();
		switch ($art->type) {
			case '5':
				return view('qrcodesix')->with('art',$art)->with('othersArts',$othersArts);
				break;
			case '6':
				return view('qrcodetwo')->with('art',$art)->with('othersArts',$othersArts);
				break;
			default:
				return view('art')->with('art',$art)->with('othersArts',$othersArts);
				break;
		}
	})->name('arte');

	Route::post('/createart/{id}', [ArtController::class, 'createart'])->name('createart');

	Route::post('/saveUser/{id}', [InfoUserController::class, 'saveUser'])->name('salvar-usuario');

	Route::get('pedidos', function () {
		$user = Auth::user();
		if(!$user->store_id) return redirect('usuario')->with('error','Para acessar essa página, vincule um código de loja ao seu usuário.');
		$allData = Http::get('https://maxxieconomica.com/api/pedidos/'.$user->store_id);
		if(!$allData->successful()){
			$allData = array();
		}
		return view('orders')->with('user',$user)->with('allData',$allData);
	})->name('pedidos');

	Route::get('financeiro', function () {
		$user = Auth::user();
		if($user->role_id!=2) return redirect('usuario')->with('error','Sem permissão de acesso a essa página.');
		$ordersD = Order::where('type',2)->where('status','done')->orderBy('id', 'DESC')->limit(20)->get();
		$ordersR = Order::where('type',2)->where('status','request')->orderBy('id', 'DESC')->limit(20)->get();
		$ordersP = Order::where('type',2)->where('status','pending')->orderBy('id', 'DESC')->get();
		$ordersDe = Order::where('type',2)->where('status','denied')->orderBy('id', 'DESC')->limit(20)->get();
		
		return view('orders_financ')->with('user',$user)->with('ordersD',$ordersD)->with('ordersR',$ordersR)->with('ordersP',$ordersP)->with('ordersDe',$ordersDe);
	})->name('financeiro');

	Route::get('/order_financ/', [OrderController::class, 'changeStatus'])->name('change-order');

	Route::post('/cancel-order', [OrderController::class, 'cancelOrder'])->name('cancel-order');
	Route::post('/reversal-order', [OrderController::class, 'reversalOrder'])->name('reversal-order');

	
	

	Route::get('/adddownload', [ArtController::class, 'adddownload'])->name('add-download');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	// Route::get('billing', function () {
	// 	return view('billing');
	// })->name('billing');

	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');

	// Route::get('tables', function () {
	// 	return view('tables');
	// })->name('tables');
	
	// Route::get('static-sign-up', function () {
	// 	return view('static-sign-up');
	// })->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
	// Route::get('/login/forgot-password', [ResetController::class, 'create']);
	// Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');