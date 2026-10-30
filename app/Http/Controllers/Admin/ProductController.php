<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDrink;
use App\Models\ProductFlavour;
use App\Models\ProductRemovable;
use App\Models\ProductSauce;
use App\Models\ProductSide;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProducts = Product::with('category_details')->get();

        $pageName = 'product_list';
        return view('admin/product/list', ['pageName' => $pageName, 'allProducts' => $allProducts, 'orderCount' => $this->orderCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'create_product';
        $categories = Category::where('status', 'active')->get();
        return view('admin/product/create', ['pageName' => $pageName, 'categories' => $categories, 'orderCount' => $this->orderCount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allVariationNames = $request->get('variation_name');
        $allVariationPrice = $request->get('variation_price');
        $allVariationType = $request->get('variation_type');
        $allRemovables = $request->get('removables');

        $variation_and_removable_inputs = array(
            'all_variation_input_check' => 'everything is set',
            'all_variation_numeric_check' => 'everything is numeric',
            'all_removable_input_check' => 'everything is set',
        );

        foreach ($allVariationNames as $name) :
            if ($name == '') {
                $variation_and_removable_inputs['all_variation_input_check'] = '';
            }
        endforeach;
        foreach ($allVariationPrice as $price) :
            if ($price == '') {
                $variation_and_removable_inputs['all_variation_input_check'] = '';
            }
            if (is_numeric($price) == false) {
                $variation_and_removable_inputs['all_variation_numeric_check'] = '';
            }
        endforeach;

        if ($allRemovables != null) {
            foreach ($allRemovables as $removable) :
                if ($removable == '') {
                    $variation_and_removable_inputs['all_removable_input_check'] = '';
                }
            endforeach;
        }
        $rules = array(
            'all_variation_input_check' => 'required',
            'all_variation_numeric_check' => 'required',
            'all_removable_input_check' => 'required',
        );
        $messageError = array(
            'all_variation_input_check.required' => 'Please fill all the variation fields.',
            'all_variation_numeric_check.required' => 'All price should be numeric.',
            'all_removable_input_check.required' => 'Please fill all the removable fields.',
        );

        $validate = Validator::make($variation_and_removable_inputs, $rules, $messageError);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()], 422);
            // return redirect()->back()->withErrors($validate)->withInput();
        }

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'status' => 'required',
        ]);

        $input = $request->all();
        $input['image'] = time() . '.' . $request->image->extension();
        $productData = Product::create($input);

        $input['image'] = $productData->id . '.' . $request->image->extension();
        $request->image->move(public_path('images/product/'), $input['image']);

        $productData->image = $input['image'];
        $productData->save();

        $product_id = $productData->id;
        $productVariationData['product_id'] = $product_id;
        foreach ($allVariationNames as $key => $variationName) :
            $productVariationData['name'] = $variationName;
            $productVariationData['price'] = $allVariationPrice[$key];
            $productVariationData['type'] = $allVariationType[$key];
            ProductVariation::create($productVariationData);
        endforeach;

        if ($allRemovables != null) {
            $productRemovableData['product_id'] = $product_id;
            foreach ($allRemovables as $removable) :
                $productRemovableData['name'] = $removable;
                ProductRemovable::create($productRemovableData);
            endforeach;
        }

        $product_flavours = $request->get('product_flavours');
        if ($product_flavours != null) {
            $productFlavourData['product_id'] = $product_id;
            foreach ($product_flavours as $flavour) :
                $productFlavourData['name'] = $flavour;
                ProductFlavour::create($productFlavourData);
            endforeach;
        }

        $product_sides = $request->get('product_sides');
        if ($product_sides != null) {
            $productSideData['product_id'] = $product_id;
            foreach ($product_sides as $side) :
                $productSideData['name'] = $side;
                ProductSide::create($productSideData);
            endforeach;
        }

        $product_drinks = $request->get('product_drinks');
        if ($product_drinks != null) {
            $productDrinkData['product_id'] = $product_id;
            foreach ($product_drinks as $drink) :
                $productDrinkData['name'] = $drink;
                ProductDrink::create($productDrinkData);
            endforeach;
        }

        $product_sauces = $request->get('product_sauces');
        if ($product_sauces != null) {
            $productSauceData['product_id'] = $product_id;
            foreach ($product_sauces as $sauce) :
                $productSauceData['name'] = $sauce;
                ProductSauce::create($productSauceData);
            endforeach;
        }

        Session::flash('success_message', 'Product created successfully.');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productData = Product::find($id);


        $selectedDrinks = array();
        foreach ($productData->product_drinks as $drink) {
            array_push($selectedDrinks, $drink->name);
        }
        $selectedFlavours = array();
        foreach ($productData->product_flavours as $flavour) {
            array_push($selectedFlavours, $flavour->name);
        }
        $selectedSauces = array();
        foreach ($productData->product_sauces as $sauce) {
            array_push($selectedSauces, $sauce->name);
        }
        $selectedSides = array();
        foreach ($productData->product_sides as $side) {
            array_push($selectedSides, $side->name);
        }


        $categories = Category::where('status', 'active')->get();

        $pageName = 'edit_product';
        return view('admin/product/edit', [
            'pageName' => $pageName, 'productData' => $productData, 'categories' => $categories, 'selectedDrinks' => $selectedDrinks, 'selectedFlavours' => $selectedFlavours, 'selectedSauces' => $selectedSauces, 'selectedSides' => $selectedSides, 'orderCount' => $this->orderCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'details' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $productData = Product::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);

            if ($productData->image != "" && file_exists(public_path('images/product/') . $productData->image)) {
                unlink(public_path('images/product/') . $productData->image);
            }

            $input['image'] = $id . '.' . $request->image->extension();
            $request->image->move(public_path('images/product/'), $input['image']);
            $productData->image = $input['image'];
        }

        $productData->name = $input['name'];
        $productData->category = $input['category'];
        $productData->details = $input['details'];
        $productData->status = $input['status'];
        $productData->save();

        Session::flash('success_message', 'Product updated successfully.');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function productVariationUpdate(Request $request, $id)
    {
        $allVariationNames = $request->get('variation_name');
        $allVariationPrice = $request->get('variation_price');
        $allVariationType = $request->get('variation_type');

        $variation_and_removable_inputs = array(
            'all_variation_input_check' => 'everything is set',
            'all_variation_numeric_check' => 'everything is numeric',
        );

        foreach ($allVariationNames as $name) :
            if ($name == '') {
                $variation_and_removable_inputs['all_variation_input_check'] = '';
            }
        endforeach;
        foreach ($allVariationPrice as $price) :
            if ($price == '') {
                $variation_and_removable_inputs['all_variation_input_check'] = '';
            }
            if (is_numeric($price) == false) {
                $variation_and_removable_inputs['all_variation_numeric_check'] = '';
            }
        endforeach;
        $rules = array(
            'all_variation_input_check' => 'required',
            'all_variation_numeric_check' => 'required',
        );
        $messageError = array(
            'all_variation_input_check.required' => 'Please fill all the variation fields.',
            'all_variation_numeric_check.required' => 'All price should be numeric.',
        );
        $validate = Validator::make($variation_and_removable_inputs, $rules, $messageError);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()], 422);
            // return redirect()->back()->withErrors($validate)->withInput();
        }

        ProductVariation::where('product_id', $id)->delete();

        $productVariationData['product_id'] = $id;
        foreach ($allVariationNames as $key => $variationName) :
            $productVariationData['name'] = $variationName;
            $productVariationData['price'] = $allVariationPrice[$key];
            $productVariationData['type'] = $allVariationType[$key];
            ProductVariation::create($productVariationData);
        endforeach;

        return response()->json(['success' => 'success'], 200);
    }

    public function productFlavourUpdate(Request $request, $id)
    {
        ProductFlavour::where('product_id', $id)->delete();

        $product_flavours = $request->get('product_flavours');
        if ($product_flavours != null) {
            $productFlavourData['product_id'] = $id;
            foreach ($product_flavours as $flavour) :
                $productFlavourData['name'] = $flavour;
                ProductFlavour::create($productFlavourData);
            endforeach;
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function productSideUpdate(Request $request, $id)
    {
        ProductSide::where('product_id', $id)->delete();

        $product_sides = $request->get('product_sides');
        if ($product_sides != null) {
            $productSideData['product_id'] = $id;
            foreach ($product_sides as $side) :
                $productSideData['name'] = $side;
                ProductSide::create($productSideData);
            endforeach;
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function productRemovableUpdate(Request $request, $id)
    {
        $allRemovables = $request->get('removables');
        if ($allRemovables == null) {
            ProductRemovable::where('product_id', $id)->delete();
            return response()->json(['success' => 'success'], 200);
        }

        $removable_inputs = array(
            'all_removable_input_check' => 'everything is set',
        );


        foreach ($allRemovables as $removable) :
            if ($removable == '') {
                $removable_inputs['all_removable_input_check'] = '';
            }
        endforeach;
        $rules = array(
            'all_removable_input_check' => 'required',
        );
        $messageError = array(
            'all_removable_input_check.required' => 'Please fill all the removable fields.',
        );
        $validate = Validator::make($removable_inputs, $rules, $messageError);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()], 422);
            // return redirect()->back()->withErrors($validate)->withInput();
        }

        ProductRemovable::where('product_id', $id)->delete();

        $product_removables = $request->get('removables');
        if ($product_removables != null) {
            $productRemovableData['product_id'] = $id;
            foreach ($product_removables as $removable) :
                $productRemovableData['name'] = $removable;
                ProductRemovable::create($productRemovableData);
            endforeach;
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function productDrinkUpdate(Request $request, $id)
    {
        ProductDrink::where('product_id', $id)->delete();

        $product_drinks = $request->get('product_drinks');
        if ($product_drinks != null) {
            $productDrinkData['product_id'] = $id;
            foreach ($product_drinks as $drink) :
                $productDrinkData['name'] = $drink;
                ProductDrink::create($productDrinkData);
            endforeach;
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function productSauceUpdate(Request $request, $id)
    {
        ProductSauce::where('product_id', $id)->delete();

        $product_sauces = $request->get('product_sauces');
        if ($product_sauces != null) {
            $productSauceData['product_id'] = $id;
            foreach ($product_sauces as $sauce) :
                $productSauceData['name'] = $sauce;
                ProductSauce::create($productSauceData);
            endforeach;
        }

        return response()->json(['success' => 'success'], 200);
    }
}
