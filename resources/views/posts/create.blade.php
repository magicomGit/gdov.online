<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col gap-3"
                enctype="multipart/form-data">
                @csrf

                <input name="user_id" type="text" value="{{ Auth::user()->id }}" hidden>

                <input name="files[]" type="file" multiple>
                <input name="title" type="text" class="w-[850px] rounded-md " placeholder="title">
                <x-input-error :messages="$errors->get('title')" class="mt-1" />

                <textarea name="preview" id="" cols="10" rows="5" class="w-[850px] rounded-md"
                    placeholder="text preview"></textarea>
                <x-input-error :messages="$errors->get('preview')" class="mt-1" />

                <div class="w-[850px]">
                    <input id="x" type="hidden" name="content">
                    <trix-editor class="w-[850px] h-[350px] bg-white" input="x"></trix-editor>
                </div>

                <x-input-error :messages="$errors->get('content')" class="mt-1" />

                <button type="submit"
                    class="px-4 py-2 border border-gray-300 rounded-md w-28 bg-[#3C8C73] text-white">Send</button>

            </form>
        </div>
    </div>

    @push('trix')
        @vite(['resources/css/trix.css', 'resources/js/trix.js'])
    @endpush
</x-app-layout>
