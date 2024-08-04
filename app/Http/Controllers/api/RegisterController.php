<?php

namespace App\Http\Controllers\api;

use App\Events\SendMailToUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\RegisterRequest;
use App\Http\Resources\clientResource;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use App\Models\Client;
use Faker\Core\Uuid;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use JsonCustomHelper;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\RequestBody;
use OpenApi\Attributes\RequestBody as AttributesRequestBody;

#[OA\Info(title: "My First API", version: "0.1")]
class OpenApi
{
}


class RegisterController extends Controller
{


    #[
        OA\Post(
            path: '/api/v1/client/register',
            requestBody: new OA\RequestBody(
                content: new OA\JsonContent(
                    type: 'object',
                    ref: '#components/schemas/client'
                ),

            ),
            responses: [
                new OA\Response(
                    response: 200,
                    content: new OA\JsonContent(
                        ref: '#components/schemas/client'
                    )
                ),
                new OA\Response(
                    response: 400,
                    description: 'access forbidden'
                )
            ]
        )
    ]

    public function __invoke(RegisterRequest $request)
    {
        // here all data verified from the RegisterRequest

        /*
            error model
            {
                "message" : "message of containe how many input missing",
                "error" : {
                    "fieldName": [
                        "message"
                    ]
                }
            }
        */

        $file = $request->file('image');

        if ($file == null) {
            return response(content: [
                "image" => "image of profile photo not exits"
            ]);
        }


        $uuid = Str::uuid()->toString();
        $file_name = $request->input('firstname') . $uuid . '.' . $file->extension();

        $full_path = $file->storeAs(
            'public/profiles-photo',
            $file_name
        );
        $full_path = str_replace('public', '/storage', $full_path);


        $input_correct_name_convention = JsonCustomHelper::camel_to_snake($request->input());
        $input_correct_name_convention['password'] = Hash::make($input_correct_name_convention['password']);
        $input_correct_name_convention['image_path'] = $full_path;



        $client = Client::create($input_correct_name_convention);

        if (App::environment('MAIL_DEBUG')) {
            $client->mail_verified = true;
            $client->save();
        } else {
            $email_hash = hash('sha256', $client->email);
            $hash = hash('sha256', $email_hash);
            $date = Date::now()->addDay();
            $client->verify_hash = $hash;
            $client->hash_ex_time = $date;
            $client->save();
            SendMailToUserEvent::dispatch($client, $hash);
        }

        return new ClientResource(Client::find($client->id));
    }
}
