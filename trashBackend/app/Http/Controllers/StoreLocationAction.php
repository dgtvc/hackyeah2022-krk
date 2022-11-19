<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use Illuminate\Http\Response;

final class StoreLocationAction extends Controller
{
    public function __invoke(StoreLocationRequest $request)
    {
        $data = $request->validated();

        return new Response('xd', Response::HTTP_OK);
    }
}
