<?php

namespace Bdwey\Specs\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bdwey\Specs\Traits\Specsable;
use Bdwey\Specs\Traits\Assistant;
use App\Models\Products;
use Bdwey\Specs\Model\Specs;

class SpecsController extends Controller
{
    use Assistant;

    public function index()
    {
        $product = Products::find(4179);
    }
}
