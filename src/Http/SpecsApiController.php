<?php

namespace Bdwey\Specs\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bdwey\Specs\Traits\Specsable;
use Bdwey\Specs\Traits\Assistant;
use App\Models\Products;
use Bdwey\Specs\Model\Specs;

class SpecsApiController extends Controller
{
    use Assistant;

    public function getSpecs($id)
    {
        $specs = [];
        $category = $this->getCategoryModel()::find($id);
        if(!empty($category)) {
            $specs = $category->categorySpecs()->orderBy('order')->get();
        }
        return response(
            view('Specs::specs', ['specs' => $specs])
        );
    }
}