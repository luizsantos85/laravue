<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;

class ProductController extends Controller
{

    private $product, $totalPage = 5;
    private $pathUpload = 'products';

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->product->getResults($request->all(), $this->totalPage);

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::kebab($request->name);
            $ext = $request->image->extension();

            $nameFile = "{$name}.{$ext}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->pathUpload, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $product = $this->product->create($data);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('category')->find($id);

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);
        }

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($product->image) {
                if (Storage::exists("{$this->pathUpload}/{$product->image}")) {
                    Storage::delete("{$this->pathUpload}/{$product->image}");
                }
            }

            $name = Str::kebab($request->name);
            $ext = $request->image->extension();

            $nameFile = "{$name}.{$ext}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->pathUpload, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $product->update($data);

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);
        }

        if ($product->image) {
            if (Storage::exists("{$this->pathUpload}/{$product->image}")) {
                Storage::delete("{$this->pathUpload}/{$product->image}");
            }
        }

        $product->delete();
        return response()->json(['success' => true], 204);
    }
}
