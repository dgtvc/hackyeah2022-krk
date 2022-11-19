<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FetchLocationRequest;
use Illuminate\Http\Response;

final class FetchLocationAction extends Controller
{
    public function __invoke(FetchLocationRequest $request)
    {
        $data = $request->validated();

        return new Response('xd');
    }
}
