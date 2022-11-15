<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Picture;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('pictures')->orderByDesc('id')->paginate(15);
        return view('posts.posts', compact('posts'));
    }


    public function lastPosts()
    {
        $posts = Post::latest()->take(4)->get();

        return view('home', compact('posts'));
    }

    public function create()
    {

        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'preview' => ['required', 'string', 'max:600'],
                'content' => ['required', 'string'],
                'user_id' => ['required'],
            ]
        );


        if (!$request->hasfile('files')) {
            return redirect(route('posts.create'));
        }

        $post = Post::create(
            [
                'title' => $request->title,
                'preview' => $request->preview,
                'content' => $request->content,
                'user_id' => $request->user_id,
            ]
        );

        //---------------------------------------
        $pathImg = date('m-Y');
        $time = time();
        foreach ($request->file('files') as $key => $file) {
            $filename = ($time) . '.webp';

            $image = Image::make($file);
            $image_1024 = $image;
            $image_600 = $image;
            $image_300 = $image;

            $image->resize(1280, 720)->save('img/' . $pathImg . '/' . $filename, 70);
            $image_1024->resize(1024, 576)->save('img/' . $pathImg . '/1024-' . $filename, 70);
            $image_600->resize(600, 338)->save('img/' . $pathImg . '/600-' . $filename, 70);
            $image_300->resize(300, 169)->save('img/' . $pathImg . '/300-' . $filename, 70);

            Picture::create(
                [
                    'post_id' => $post->id,
                    'picture' => $filename,
                    'path' => $pathImg,
                ]
            );

            $time++;
        }

        // $path = Storage::put('img', $image);

        return redirect('/');
    }

    public function show($id)
    {

        $post = Post::where('id', $id)->first();

        return view('posts.post', ['post' => $post]); //"Posts show {$id}";
    }



    public function edit($id)
    {
        //dd($id);
        $post = Post::where('id', $id)->first();

        return view('posts.edit', ['post' => $post]);
    }



    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if ($request->hasfile('files')) {
            $pathImg = date('m-Y');
            $time = time();
            foreach ($request->file('files') as $key => $file) {
                $filename = ($time) . '.webp';

                $image = Image::make($file);
                $image_1024 = $image;
                $image_600 = $image;
                $image_300 = $image;

                $image->resize(1280, 720)->save('img/' . $pathImg . '/' . $filename, 80);
                $image_1024->resize(1024, 576)->save('img/' . $pathImg . '/1024-' . $filename, 80);
                $image_600->resize(600, 338)->save('img/' . $pathImg . '/600-' . $filename, 80);
                $image_300->resize(300, 169)->save('img/' . $pathImg . '/300-' . $filename, 80);

                Picture::create(
                    [
                        'post_id' => $post->id,
                        'picture' => $filename,
                        'path' => $pathImg,
                    ]
                );

                $time++;
            }
        }
//-----------------------------
        $post->title = $request->title;
        $post->created_at = $request->created_at;
        $post->preview = $request->preview;
        $post->content = $request->content;
        $post->save();


        //dd($post->title);
        return redirect(route('posts.edit', $post->id));
    }

    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        //dd($post);

        $post->delete();

        return redirect('posts');

    }


    public function pictureDestroy(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        $picture->delete();
        //dd($request->id);
        return redirect(route('posts.edit', $request->post_id));
    }
}
