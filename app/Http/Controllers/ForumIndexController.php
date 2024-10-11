<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
 use App\Http\Resources\DiscussionResource;


class ForumIndexController extends Controller
{
  public function __invoke() {
    return inertia()->render('Forum/Index',[
        // If using a resource class
         'discussions' => DiscussionResource::collection(
             Discussion::with('topic')->paginate(10)
         )

    ]);
  }
}
