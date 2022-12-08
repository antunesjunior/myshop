<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\StockFeed;
use App\Models\User;
use App\Models\Vendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PdfController extends Controller
{
    public function reports()
    {
        return view('admin.reports');
    }

    public function deliver($invoice)
    {
        $invoice = Invoice::findOrFail($invoice);
        $user = Str::slug($invoice->user->name);
        $date = date('d-m-Y', strtotime($invoice->created_at));

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'total' => $invoice->shop->sum('total')
        ]);
        return $pdf->stream("nossa-loja-entrega-{$user}-{$date}.pdf");
    }

    public function caixaYear(Request $request)
    {
        $yearTotal = 0;
        $monthsTotal = [];
        $year = $request->year;

        for ($i=1; $i < 13; $i++) { 
            strlen($i) == 1 ? $date = "{$year}-0{$i}-%" : $date = "{$year}-{$i}-%";
            $monthsTotal[] = Invoice::where('created_at', 'like', $date)->sum('total');
        }

       foreach ($monthsTotal as $value) {
            $yearTotal += $value;
       }

        $pdf = Pdf::loadView('pdf.caixa.caixa-year', [
            'months' => DateHelper::getMonths(),
            'values' => $monthsTotal,
            'yearTotal' => $yearTotal,
            'year' => $year
        ]);
        return $pdf->stream("nossa-loja-relatorio-caixa-{$year}.pdf");
    }

    public function saleYear(Request $request)
    {
        $month = $request->month;
        $monthsList = DateHelper::getMonths();

        $date = "{$request->year}-%";
        $total = Shop::where('created_at', 'like', $date)->sum('total');
        $mais =  Shop::where('created_at', 'like', $date)->groupBy('product_id')->count();
        $menos = Shop::where('created_at', 'like', $date)->groupBy('product_id')->min('product_id');

      dd($total, $mais, $menos);

        $pdf = Pdf::loadView('pdf.sale', [
            'year' => $request->year,
            'total' => $total,
            'mais' => $mais,
            'menos' => $menos,
        ]);
        return $pdf->stream("nossa-loja-relatorio-venda.pdf");
    }

    public function caixaMonth(Request $request)
    {
        $month = $request->month;
        $monthsList = DateHelper::getMonths();

        strlen($month) == 1 ? $month = "0{$month}" :'';
        $date = "{$request->year}-{$month}-%";
        $monthTotal = Invoice::where('created_at', 'like', $date)->sum('total');

        $fileName = "{$monthsList[$month - 1]}-{$request->year}";

        $pdf = Pdf::loadView('pdf.caixa.caixa-month', [
            'year' => $request->year,
            'month' => $monthsList[$month - 1],
            'ammount' => $monthTotal,
        ]);
        return $pdf->stream("nossa-loja-relatorio-caixa-{$fileName}.pdf");
    }

    public function caixaDay()
    {
        $default = date('Y-m-d');
        $format = date('d-m-Y');
        $toDay = Invoice::whereDate('created_at', $default)->sum('total');

        $pdf = Pdf::loadView('pdf.caixa.caixa-day', [
            'date' => $format,
            'ammount' => $toDay,
        ]);
        return $pdf->stream("nossa-loja-relatorio-caixa-de-{$format}.pdf");
    }

    public function caixaPeriod(Request $request)
    {
        $request->validate([
            "from" => ['required', 'date'],
            "to" => ['required', 'date'],
        ]);

        $from = date_create($request->from);
        $to = date_create($request->to);
        $now = date_create();
        $fromFormat = date('d-m-Y', strtotime($request->from));
        $toFormat = date('d-m-Y', strtotime($request->to));

        if ((date_diff($now, $from)->invert == 0) || (date_diff($now, $to)->invert == 0)) {
            dd('As datas nao podem ser maiores que a data actual');
        }

        if (date_diff($from, $to)->invert == 1) {
            dd('A data de inicio tem de ser menor que a data final');
        }

        $result = Invoice::whereDate('created_at',">=", $request->from)
            ->whereDate('created_at', "<=", $request->to)->sum('total');

        $pdf = Pdf::loadView('pdf.caixa.caixa-period', [
            'from' => $fromFormat,
            'to' => $toFormat,
            'ammount' => $result
        ]);
        return $pdf->stream("nossa-loja-relario-caixa-{$fromFormat}-a-{$toFormat}.pdf");
    }


    public function invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $total = $invoice->shop->sum('total');

        $fileName = 'factura '.strtolower(Auth::user()->name);
        $fileName = $fileName .' '. date('d-m-Y', strtotime($invoice->created_at));
        $fileName = Str::slug($fileName) ;

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'total' => $total
        ]);
        return $pdf->download("nossa-loja-{$fileName}.pdf");
    }

    public function products()
    {
        $datas['all_products'] = Product::withTrashed()->count();
        $datas['selling'] = Product::all()->count();
        $datas['not_selling'] = Product::onlyTrashed()->count();
        $datas['max_price'] = Product::where('price', Product::all()->max('price'))->first();
        $datas['min_price'] = Product::where('price', Product::all()->min('price'))->first();
        $datas['all_category'] = Category::all()->count();

        $pdf = Pdf::loadView('pdf.products', ['datas' => $datas]);
        return $pdf->stream('nossa-loja-relatorio-produtos.pdf');
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
        return $pdf->stream('nossa-loja-relatorio-fornecedores.pdf');

    }

    public function stock()
    {
        $datas['all_stock']   = Stock::all()->sum('qtd_prod');
        $datas['max_stock']['qtd']   = Stock::all()->max('qtd_prod');
        $datas['max_stock']['prod']   = Stock::where('qtd_prod', $datas['max_stock']['qtd'])->first();

        $datas['min_stock']['qtd']   = Stock::all()->min('qtd_prod');
        $datas['min_stock']['prod']   = Stock::where('qtd_prod', $datas['min_stock']['qtd'])->first();
        
        $datas['max_prod'] = StockFeed::all()->groupBy('product_id')->max()[0];
        $datas['max_prod_feed']  = StockFeed::all()->groupBy('product_id')->max()->count();
        $datas['min_prod']  = StockFeed::all()->groupBy('product_id')->min()[0];
        $datas['min_prod_feed']  = StockFeed::all()->groupBy('product_id')->min()->count();

        $datas['last_feed']  = StockFeed::select('created_at')->orderBy('created_at', 'desc')->first();
        $datas['last_feed_date']  = date('Y-m-d', strtotime($datas['last_feed']->created_at));
        $datas['last_feed_prods'] = StockFeed::select('distinct product_id')
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
