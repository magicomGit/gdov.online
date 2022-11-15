<x-app-layout>
    <div class="max-w-7xl  mx-auto p-4 min-h-[60vh] relative">

        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="flex flex-col gap-3 py-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input name="user_id" type="text" value={{ $post->user_id }} hidden>

            <input name="files[]" type="file" multiple>
            <input name="title" type="text" class="w-[850px]  " value="{{ $post->title }}" placeholder="title">
            <x-input-error :messages="$errors->get('title')" class="mt-1" />

                <input name="created_at" type="text" class="w-[850px]  " value="{{ $post->created_at }}" placeholder="title">

            <textarea name="preview" id="" cols="10" rows="15" class="w-[850px] " placeholder="text preview">{{ $post->preview }}</textarea>
            <x-input-error :messages="$errors->get('preview')" class="mt-1" />



                {{-- <div class="w-[850px]">
                    <input id="x" type="hidden" name="content" value="{{ $post->content }}">
                    <trix-editor class="w-[850px] h-[350px] bg-white" input="x" ></trix-editor>
                </div> --}}
            <textarea name="content" id="" cols="10" rows="15" class="w-[850px] " placeholder="content">{{ $post->content }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-1" />

            <button type="submit"
                class="px-4 py-2 border border-gray-300  w-28 bg-[#3C8C73] text-white">Обновить</button>

        </form>


        <hr>
        {{-- pictures -----------------------------}}
        <div class="flex gap-2 py-4">

            @for ($i = 0; $i < count($post->pictures); $i++)
                <div class="relative" id="{{ $post->pictures[$i]->id }}">
                    <div class="absolute right-1 top-1 bg-white p-1 cursor-pointer"
                        onclick="CheckDeletePicture(this, {{ $post->pictures[$i]->id }})">
                        <img class="w-6 h-6" src="{{ config('app.url', 'http://localhost') }}/img/svg/delete.svg">
                    </div>

                    <img class="max-h-[150px] "
                        src="{{ config('app.url', 'http://localhost') }}/img/{{ $post->pictures[$i]->path }}/600-{{ $post->pictures[$i]->picture }} " />
                </div>
            @endfor
        </div>

        <form hidden id="picture-delete-form" action="{{ route('pictures.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <input id="picture-delete-input" value="" name="id" type="text">
            <input name="post_id" value="{{ $post->id }}" name="id" type="text">

        </form>
        {{-- popup-modal --}}
        <div id="popup-modal" class="absolute hidden bg-gray-600 bg-opacity-70 z-40 inset-0   ">
            <div class="mx-auto mt-[40%] p-4 w-full max-w-md h-full md:h-auto bg-opacity-100 ">
                <div class=" bg-white rounded-lg shadow  z-50 ">
                    <button onclick="HidePopup()" type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center ">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Подтвердите удаление
                            изображения</h3>
                        <button type="button" onclick="DeletePicture()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Удалить
                        </button>
                        <button onclick="HidePopup()" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Отмена</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('trix')
        @vite(['resources/css/trix.css', 'resources/js/trix.js'])
    @endpush
</x-app-layout>

<script>
    const pictureIdForDelete = []
    const picturesCount = {{ count($post->pictures) }}
    var popup = document.querySelector('#popup-modal');
    var pictureDeleteInput = document.querySelector('#picture-delete-input');
    var pictureDeleteForm = document.querySelector('#picture-delete-form');

    function CheckDeletePicture(e, id) {
        //var element = document.querySelector('#'+id);
        if (picturesCount == pictureIdForDelete.length + 1) {
            alert('У новости должна быть минимум одна картинка')
            return
        }
        popup.style.display = 'block'
        pictureDeleteInput.value = id

        console.log(pictureDeleteInput.value)

        // e.parentElement.style.display = 'none'
        // pictureIdForDelete.push(id)

    }

    function HidePopup() {
        popup.style.display = 'none'
    }


    function DeletePicture() {
        pictureDeleteForm.submit();
    }
</script>
