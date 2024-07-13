<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SampleEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SenderController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"Sender"},
     *     path="/api/send/email",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"email"},
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Add Category.")
     * )
     */
    public function send_email(Request $request) : JsonResponse
    {
        $inputs = $request->all();
        Mail::to($inputs["email"])->send(new SampleEmail());
        return response()->json($inputs["email"], 200)
            ->header("Content-Type", 'application/json; charset=utf-8');
    }
}
