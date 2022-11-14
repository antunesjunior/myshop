<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockFeed;
use App\Models\User;
use App\Models\Vendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function products()
    {
        $datas['all_products'] = Product::withTrashed()->count();
        $datas['selling'] = Product::all()->count();
        $datas['not_selling'] = Product::onlyTrashed()->count();
        $datas['max_price'] = Product::where('price', Product::all()->max('price'))->first();
        $datas['min_price'] = Product::where('price', Product::all()->min('price'))->first();
        $datas['all_category'] = Category::all()->count();

        $pdf = Pdf::loadView('pdf.products', ['datas' => $datas]);
        return $pdf->stream('relatorio-produtos.pdf');
    }

    public function vendors()
    {
        $datas['all_vendors'] = Vendor::withTrashed()->count();
        $datas['active']      = Vendor::all()->count();
        $datas['not_active']  = Vendor::onlyTrashed()->count();
        $datas['max_vendor']  = StockFeed::all()->groupBy('vendor_id')->max()[0];
        $datas['max_vendor_prod']  = StockFeed::all()->groupBy('vendor_id')->max()->count();
        $datas['min_vendor']  = StockFeed::all()->groupBy('vendor_id')->min()[0];
        $datas['min_vendor_prod']  = StockFeed::all()->groupBy('vendor_id')->min()->count();

        $pdf = Pdf::loadView('pdf.vendors', ['datas' => $datas]);
        return $pdf->stream('relatorio-fornecedores.pdf');

    }

    public function stock()
    {
        $datas['all_stock']   = Stock::all()->sum('qtd_prod');
        $datas['max_stock']['qtd']   = Stock::all()->max('qtd_prod');
        $datas['max_stock']['prod']   = Stock::where('qtd_prod', $datas['max_stock']['qtd'])->first();

        $datas['min_stock']['qtd']   = Stock::all()->min('qtd_prod');
        $datas['min_stock']['prod']   = Stock::where('qtd_prod', $datas['min_stock']['qtd'])->first();
        
        $datas['max_prod']    = StockFeed::all()->groupBy('product_id')->max()[0];
        $datas['max_prod_feed']  = StockFeed::all()->groupBy('product_id')->max()->count();
        $datas['min_prod']  = StockFeed::all()->groupBy('product_id')->min()[0];
        $datas['min_prod_feed']  = StockFeed::all()->groupBy('product_id')->min()->count();

        $datas['last_feed']  = StockFeed::select('created_at')->orderBy('created_at', 'desc')->first();
        $datas['last_feed_date']  = date('Y-m-d', strtotime($datas['last_feed']->created_at));
        $datas['last_feed_prods']  = StockFeed::select('distinct product_id')
                                    ->where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->count();
        $datas['last_feed_qtd']  = StockFeed::select('distinct product_id')
                                    ->where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->sum('qtd_prod');


        $datas['last_feed_max_prod']['qtd']  = StockFeed::select('distinct product_id')
                                    ->where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->max('qtd_prod');
        $datas['last_feed_max_prod']['prod']  = StockFeed::where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->where('qtd_prod',  $datas['last_feed_max_prod']['qtd'])->first();

        $datas['last_feed_min_prod']['qtd']  = StockFeed::where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->min('qtd_prod');
        $datas['last_feed_min_prod']['prod']  = StockFeed::where('created_at', 'like', "%{$datas['last_feed_date']}%")
                                    ->where('qtd_prod',  $datas['last_feed_min_prod']['qtd'])->first();

        $pdf = Pdf::loadView('pdf.stock', ['datas' => $datas]);
        return $pdf->stream('relatorio-stock.pdf');
    }
}
