<?php

namespace App\Http\Controllers\Client;

use App\Mail\AskProductQuestion;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;


class CatalogController extends Controller
{
    private $page;

    /**
     * CatalogController constructor.
     */
    public function __construct()
    {
        $this->page = Page::whereSlug('catalog')->first();
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.index', [
            'page' => $this->page,
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'categories' => ProductCategories::get(),
            'products' => $products->paginate(24),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function all(Request $request): View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.all', [
            'page' => $this->page,
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'categories' => ProductCategories::get(),
            'products' => $products->get(),
        ]);
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product->handleViewed();

        return \view('client.catalog.show', [
            'page' => $this->page,
            'product' => $product,
            'popular' => Product::orderByDesc('views_count')->take(3)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function question(Request $request, Product $product): RedirectResponse
    {
        $data = [
            'user' =>(object)$request->only('name', 'phone', 'email'),
            'message' => $request->input('message'),
        ];
        Mail::send(new AskProductQuestion($data, $product));

        return redirect()->back();
    }


    private function handleSearch(Request $request)
    {
        $search = null;
        $products = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $products = $products->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $products;
    }

    /**
     * @param Request $request
     * @param $products
     * @return mixed
     */
    private function handleFilters(Request $request, $products)
    {
        if ($request->filled('category')) {
            $ids = ProductCategories::whereIn('slug', explode(',', $request->input('category')))
                ->pluck('id');

            $products = $products->whereHas('categories', function (Builder $builder) use ($ids) {
                $builder->whereIn('id', $ids);
            });
        }

        if ($request->filled('order')) {
            switch ($request->get('order')) {
                case 'cheap':
                    $products = $products->orderBy('price');
                    break;
                case 'expensive':
                    $products = $products->orderByDesc('price');
                    break;
                case 'most_viewed':
                    $products = $products->orderByDesc('views_count');
                    break;
            }
        }
        return $products;
    }

}
