<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    public function changeStatus(Request $request){
        $data = $request->all();
        // dd($data);
        try {
            Order::where('id',$data['id'])->update(['status'=>$data['status']]);
            session()->flash('success', 'Pedido alterado.');
            return 'success';
        } catch (\Throwable $th) {
            session()->flash('error', 'Erro ao alterar pedido.');
            return 'error';
        }
        
    }

    public function cancelOrder(Request $request){
        $data = $request->all();
        $order = array();
        // Config::set('app.debug', true);
        // set_time_limit(999999999999999999);
        $oldOrder = Order::where('order_number',$data['order_number'])->count();
        if($oldOrder>0) {
            session()->flash('error', 'Erro ao cancelar pedido. Este pedido já foi cancelado.');
            return back();
        }
        try {
            if(isset($data['check_products'])){$data['check_products']=1;}else{$data['check_products']=0;}
            if(isset($data['check_stores'])){$data['check_stores']=1;}else{$data['check_stores']=0;}
            if(isset($data['check_transfer'])){$data['check_transfer']=1;}else{$data['check_transfer']=0;}
            $order['order_number'] = $data['order_number'];
            $order['order_id'] = $data['order_id'];
            $order['attendant_name'] = $data['attendant_name'];
            $order['attendant_cpf'] = $data['attendant_cpf'];
            $order['observation'] = $data['observation'];
            $order['nf'] = $data['nf'];
            $order['client_cpf'] = $data['cpf'];
            $order['check_products'] = $data['check_products'];
            $order['check_stores'] = $data['check_stores'];
            $order['check_transfer'] = $data['check_transfer'];
            if($data['payment_id']==2){
                $order['type'] = 2;
            }else{
                $order['type'] = 1;
            }
            
            $order['total'] = $data['total_order'];
            $order['store_id'] = $data['store_id'];
            $order['status'] = 'pending';
            Order::create($order);
            session()->flash('success', 'Ordem de cancelamento enviado, aguarde até 48h(horário comercial) para receber retorno de cancelamento.');
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Erro ao cancelar pedido.');
            return back();
        }
    }

    public function reversalOrder(Request $request){
        $data = $request->all();
        $order = array();
        // Config::set('app.debug', true);
        // set_time_limit(999999999999999999);
        $oldOrder = Order::where('order_number',$data['order_number'])->count();
        if($oldOrder>0) {
            session()->flash('error', 'Erro ao cancelar pedido. Este pedido já foi cancelado.');
            return back();
        }
        try {
            if(isset($data['check_products'])){$data['check_products']=1;}else{$data['check_products']=0;}
            if(isset($data['check_stores'])){$data['check_stores']=1;}else{$data['check_stores']=0;}
            if(isset($data['check_transfer'])){$data['check_transfer']=1;}else{$data['check_transfer']=0;}
            $order['order_number'] = $data['order_number'];
            $order['order_id'] = $data['order_id'];
            $order['attendant_name'] = $data['attendant_name'];
            $order['attendant_cpf'] = $data['attendant_cpf'];
            $order['observation'] = $data['observation'];
            $order['nf'] = $data['nf'];
            $order['client_cpf'] = $data['cpf'];
            $order['check_products'] = $data['check_products'];
            $order['check_stores'] = $data['check_stores'];
            $order['check_transfer'] = $data['check_transfer'];
            if($data['payment_id']==2){
                $order['type'] = 2;
            }else{
                $order['type'] = 1;
            }
            
            $order['total'] = $data['total_order'];
            $order['store_id'] = $data['store_id'];
            $order['status'] = 'pending';
            Order::create($order);
            session()->flash('success', 'Ordem de estorno enviado, em até 48h(horário comercial) o pedido será estornado.');
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Erro ao cancelar pedido.');
            return back();
        }
    }
}