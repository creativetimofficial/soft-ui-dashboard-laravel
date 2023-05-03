<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Stores;
use App\Models\ProductsFirebird;
use App\Models\LogsDiscounts;
use App\Models\User;
use Session;
use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class FbProdController extends Controller
{
    public function getConnections(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json('Sem permissão', 400);
        }

        //busca no banco todas as lojas
        $stores = DB::connection('firebird')->table('LOJAS')->select('CDLOJA AS store_id', 'ENDFTP AS title', 'BANCO AS dbhost', 'SERVIDOR AS server')->where('FLGATIVO', 'S')->get();

        //passando por tudo e tendo dados, retorna a api
        return response()->json($stores, 200);
    }

    public function getStoreProdsUnique(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json(['message' => 'Sem permissão'], 400);
        }

        $data = $request->all();

        //define a variável de busca por nome do produto
        $product_id = $data['product_id'];

        //define a variável da loja selecionada
        $store = $data['store_id'];

        if(!is_numeric($store)){
            return response()->json(['message' => 'Código de loja inválido'], 400);
        }
        if(!is_numeric($product_id)){
            return response()->json(['message' => 'Código de produto inválido'], 400);
        }

        $serverStore = $data['serverStore'];
        $dbStore = $data['dbStore'];
        
        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);

        //define a query de busca de produtos usando as variáveis acima
        $products = DB::connection('firebird_store_external')
            ->select( 
                DB::raw("
                    SELECT
                    P.CDPRODUTO,
                    P.DESCRICAO as DESCRICAO,
                    S.DESCRICAO AS CATEGORIA,
                    P.VLRSUGERIDO, 
                    COALESCE(O.VLRSUGERIDO,0) AS PROMO,
                    E.VLRCUSTOCIMP,
                    S.LMTDESCGERENTE,
                    E.QUANTIDADE,
                    E.GIRO, 
                    E.GIRO90D
                    FROM PRODUTOS P
                    LEFT OUTER JOIN  PROMOCOES O  ON 
                    P.CDPRODUTO = O.CDPRODUTO 
                    AND O.DTINICIO <= CURRENT_DATE 
                    AND O.DTFIM    >= CURRENT_DATE 
                    AND ((O.CDLOJA  = 0) 
                    OR (O.CDLOJA  = ?)) 
                    INNER JOIN ESTOQUELOJAS E ON E.CDLOJA = ? AND E.CDPRODUTO = P.CDPRODUTO
                    AND E.CDPRODUTO = ?
                    INNER JOIN SUBGRUPO S ON P.CDGRUPO = S.CDGRUPO AND P.CDSUBGRUPO = S.CDSUBGRUPO"
            ), [$store, $store, $product_id]
        );

        DB::disconnect('firebird_store_external');
        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);

        if(!$products){
            return response()->json(['message' => 'Nenhum produto encontrado'], 400);
        }

        foreach($products as $product) {
            $product->DESCRICAO = utf8_decode($product->DESCRICAO);
            $product->CATEGORIA = utf8_decode($product->CATEGORIA);

            if($product->PROMO>0){
                $product->MARGEM = number_format((($product->PROMO/$product->VLRCUSTOCIMP)*100)-100,2);
                // $product->MARGEM = $product->PROMO .'-'. $product->VLRCUSTOCIMP;
            }else{
                if($product->VLRCUSTOCIMP>0){
                    $product->MARGEM = number_format((($product->VLRSUGERIDO/$product->VLRCUSTOCIMP)*100)-100,2);
                }else{
                    $product->MARGEM = 100;
                }
                // $product->MARGEM = number_format((($product->VLRSUGERIDO/$product->VLRCUSTOCIMP)*100)-100,2).'%';
            }
            
            $product->VLRSUGERIDO = $product->VLRSUGERIDO;
            $product->PROMO = $product->PROMO;
            $product->LMTDESCGERENTE = intval($product->LMTDESCGERENTE).'%';
            $product->VLRCUSTOCIMP = $product->VLRCUSTOCIMP;
            $product->QUANTIDADE = intval($product->QUANTIDADE);
            
        }
        
        //passando por tudo e tendo dados, retorna a api
        return response()->json($products, 200);
    }

    public function getStoreProds(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json(['message' => 'Sem permissão'], 400);
        }

        $data = $request->all();

        //define a variável de busca por nome do produto
        $description = $data['search'];

        //define a variável da loja selecionada
        $store = $data['store_id'];

        if(!is_numeric($store)){
            return response()->json(['message' => 'Código de loja inválido'], 400);
        }
        
        $serverStore = $data['serverStore'];
        $dbStore = $data['dbStore'];
        
        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);

        if(is_numeric($description)){
            $description = $data['search'];

            $products = DB::connection('firebird_store_external')
                ->select( 
                    DB::raw("
                        SELECT
                        P.CDPRODUTO,
                        P.DESCRICAO as DESCRICAO,
                        S.DESCRICAO AS CATEGORIA,
                        P.VLRSUGERIDO, 
                        S.LMTDESCGERENTE,
                        COALESCE(O.VLRSUGERIDO,0) AS PROMO,
                        E.VLRCUSTOCIMP,
                        E.QUANTIDADE,
                        E.GIRO, 
                        E.GIRO90D
                        FROM PRODUTOS P
                        LEFT OUTER JOIN  PROMOCOES O  ON 
                        P.CDPRODUTO = O.CDPRODUTO 
                        AND O.DTINICIO <= CURRENT_DATE 
                        AND O.DTFIM    >= CURRENT_DATE 
                        AND ((O.CDLOJA  = 0) 
                        OR (O.CDLOJA  = ?)) 
                        INNER JOIN ESTOQUELOJAS E ON E.CDLOJA = ? AND E.CDPRODUTO = P.CDPRODUTO
                        AND P.FLGATIVO = 'S'
                        AND P.CDPRODUTO = ?
                        INNER JOIN SUBGRUPO S ON P.CDGRUPO = S.CDGRUPO AND P.CDSUBGRUPO = S.CDSUBGRUPO"
                ), [$store, $store, $description]
            );
        }else{
            //define a variável de busca por nome do produto
            $description = strtoupper($data['search']).'%';

            $products = DB::connection('firebird_store_external')
                ->select( 
                    DB::raw("
                        SELECT
                        P.CDPRODUTO,
                        P.DESCRICAO as DESCRICAO,
                        S.DESCRICAO AS CATEGORIA,
                        P.VLRSUGERIDO, 
                        S.LMTDESCGERENTE,
                        COALESCE(O.VLRSUGERIDO,0) AS PROMO,
                        E.VLRCUSTOCIMP,
                        E.QUANTIDADE,
                        E.GIRO, 
                        E.GIRO90D
                        FROM PRODUTOS P
                        LEFT OUTER JOIN  PROMOCOES O  ON 
                        P.CDPRODUTO = O.CDPRODUTO 
                        AND O.DTINICIO <= CURRENT_DATE 
                        AND O.DTFIM    >= CURRENT_DATE 
                        AND ((O.CDLOJA  = 0) 
                        OR (O.CDLOJA  = ?)) 
                        INNER JOIN ESTOQUELOJAS E ON E.CDLOJA = ? AND E.CDPRODUTO = P.CDPRODUTO
                        AND P.FLGATIVO = 'S'
                        AND P.DESCRICAO LIKE ?
                        INNER JOIN SUBGRUPO S ON P.CDGRUPO = S.CDGRUPO AND P.CDSUBGRUPO = S.CDSUBGRUPO"
                ), [$store, $store, $description]
            );
        }

        DB::disconnect('firebird_store_external');
        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);
       
        //se não achar produto no select, retorna erro
        if(!$products){
            return response()->json(['message' => 'Nenhum registro encontrado','data'=>$products], 200);
        }

        //ao achar os produtos, precisa de tratamento em alguns campos
        foreach($products as $product) {
            //descrição está sem padrão utf8 - field DESCRICAO its not utf8, need to be decoded
            $product->DESCRICAO = utf8_decode($product->DESCRICAO);
            $product->CATEGORIA = utf8_decode($product->CATEGORIA);

            //MARGEM é calculado a porcentagem do lucro, caso o campo promo tenha valor, ele altera.
            //MARGEM field is calculated to take the proffit.
            if($product->PROMO>0){
                if($product->VLRCUSTOCIMP>0){
                    $product->MARGEM = number_format((($product->PROMO/$product->VLRCUSTOCIMP)*100)-100,2).'%';
                }else{
                    $product->MARGEM = '100.00%';
                }
                // $product->MARGEM = $product->PROMO .'-'. $product->VLRCUSTOCIMP;
            }else{
                if($product->VLRCUSTOCIMP>0){
                    if($product->VLRSUGERIDO>0){
                        $product->MARGEM = number_format((($product->VLRSUGERIDO/$product->VLRCUSTOCIMP)*100)-100,2).'%';
                    }else{
                        $product->MARGEM = 'CONFERIR %';
                    }
                }else{
                    $product->MARGEM = '100.00%';
                }
                // $product->MARGEM = number_format((($product->VLRSUGERIDO/$product->VLRCUSTOCIMP)*100)-100,2).'%';
            }
            
            $product->VLRSUGERIDO = toMoney($product->VLRSUGERIDO);
            $product->LMTDESCGERENTE = intval($product->LMTDESCGERENTE).'%';
            $product->PROMO = toMoney($product->PROMO);
            $product->VLRCUSTOCIMP = toMoney($product->VLRCUSTOCIMP);
            $product->QUANTIDADE = intval($product->QUANTIDADE);
            
        }
        
        //passando por tudo e tendo dados, retorna a api
        return response()->json(['message' => 'success','data'=>$products], 200);
    }

    public function getStockStore(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json(['message' => 'Sem permissão'], 400);
        }

        $data = $request->all();

        //define a variável de busca por nome do produto
        $product_id = $data['product_id'];

        if(!is_numeric($product_id)){
            return response()->json(['message' => 'Código de produto inválido'], 400);
        }

        //define a query de busca de produtos usando as variáveis acima
        $products = DB::connection('firebird')
            ->select( 
                DB::raw("
                    SELECT
                    L.ENDFTP AS LOJA,
                    E.QUANTIDADE,
                    E.GIRO,
                    E.GIRO90D,
                    E.GIROANUAL,
                    E.ESTSEG
                    FROM
                    ESTOQUELOJAS E, LOJAS L
                    WHERE E.CDLOJA = L.CDLOJA
                    AND L.FLGATIVO ='S'
                    AND E.CDPRODUTO = ?"
            ), [$product_id]
        );

        foreach($products as $product) {
            $product->QUANTIDADE = intval($product->QUANTIDADE);
        }
        
        //passando por tudo e tendo dados, retorna a api
        return response()->json(['message' => 'success','data'=>$products], 200);
        
    }

    public function getSuppliersList(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json(['message' => 'Sem permissão'], 400);
        }

        $data = $request->all();

        //define a variável de busca por nome do produto
        $product_id = $data['product_id'];
        // $product_id = 9740;

        if(!is_numeric($product_id)){
            return response()->json(['message' => 'Código de produto inválido'], 400);
        }

        //define a query de busca de produtos usando as variáveis acima
        $products = DB::connection('sqlsrv')
            ->select( 
                DB::raw("
                SELECT
                F.DESCRICAO AS DISTRIBUIDORA,
                E.QUANTIDADE AS QUANTIDADE,
                E.VALOR AS PREÇO,
                E.VLRPROMOCAO AS PREÇO_PROMO
                FROM ESTOQUEDIST E, FORNECEDORES F  
                WHERE E.CDFORNECEDOR = F.CDFORNECEDOR 
                AND E.CDPRODUTO = ?
                ORDER BY VLRPROMOCAO ASC"
            ), [$product_id]
        );

        foreach($products as $product) {
            $product->QUANTIDADE = intval($product->QUANTIDADE);
        }
        
        //passando por tudo e tendo dados, retorna a api
        return response()->json(['message' => 'success','data'=>$products], 200);
    }

    public function saveProduct(Request $request){
        $data = $request->all();
        $store_id = $data['store_id'];
        $serverStore = $data['serverStore'];
        $dbStore = $data['dbStore'];
        $product_value = $data['product_value'];
        $product_id = $data['product_id'];
        $user_id = $data['user_id'];

        $datalog = [
            'store_id'=> $store_id,
            'product_value'=> $product_value,
            'product_id'=> $product_id,
            'user_id'=> $user_id,
        ];

        LogsDiscounts::create($datalog);

        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);

        // $products = DB::connection('firebird_store_external')
        //     ->select( 
        //         DB::raw("SELECT * FROM PRODUTOS WHERE CDPRODUTO = ?"
        //     ), [$product_id]
        // );

        $products = DB::connection('firebird_store_external')
            ->select( 
                DB::raw("DELETE FROM PROMOCOES WHERE CDPRODUTO = ?"
            ), [$product_id]
        );
        $products = DB::connection('firebird_store_external')
            ->select( 
                DB::raw("UPDATE PRODUTOS SET VLRDESCONTO = ?, VLRDESCMIN = 0, FLGDESCONTO = 'S' WHERE CDPRODUTO = ?"
            ), [$product_value, $product_id]
        );

        DB::disconnect('firebird_store_external');
        Config::set("database.connections.firebird_store_external", [
            'driver' => 'firebird',
            "host" => $serverStore,
            "database" => $dbStore,
            "username" => "SYSDBA",
            "password" => "money",
            "port" => '3050',
            'charset'   => 'utf8',
        ]);

        return response()->json(['product'=>$products,'data'=>$data,'message'=>'success'], 200);
    }

    public function getLogs(Request $request){
        $varSecurity = $request->header('Authorization');

        // se não existir a variável de segurança, retorna um erro
        if($varSecurity!='Bearer api'){
            return response()->json(['message' => 'Sem permissão'], 400);
        }

        $data = $request->all();

        $logs = LogsDiscounts::select('*')->orderBy('created_at', 'DESC')->get();

        if(!$logs){
            return response()->json(['message' => 'Nenhum log encontrado'], 400);
        }

        $stores = DB::connection('firebird')->table('LOJAS')->select('CDLOJA AS store_id', 'ENDFTP AS title', 'BANCO AS dbhost', 'SERVIDOR AS server')->where('FLGATIVO', 'S')->get();
        $storeData=array();
        foreach($stores as $store){
            $storeData[$store->store_id]['title'] = $store->title;
        }
        foreach($logs as $log){
            $log->nameStore = $storeData[$log->store_id]['title'];
            $log->userName = User::select('name')->where('id', $log->user_id)->first();
            $log->data = Carbon::parse($log->created_at)->format('d/m/Y H:i');
            $log->valorNovo = $log->product_value.'%';
        }
        
        //passando por tudo e tendo dados, retorna a api
        return response()->json($logs, 200);       
    }
}