<x-app-layout>
    <x-slot:header>Quiz Güncelle</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">

        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
                @method("PUT")
                @csrf
                <div class="mb-6 px-2 mt-4">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Quiz Başlığı</label>
                    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $quiz->title }}" required>
                </div>
                <div class="mb-6 px-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Quiz Açıklama</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $quiz->description }}</textarea>
                </div>
                <div class="mb-6 px-2 mt-4">
                    <input id="isFinished" type="checkbox" name="isFinished" @if ($quiz->finished_at != "") checked @endif class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="isFinished" class="ml-2 text-sm font-medium text-gray-900">Bitiş tarihi olacak mı?</label>
                </div>
                <div class="mb-6 px-2 mt-4 @if ($quiz->finished_at == "") hidden @endif" id="finishTime">
                    <label for="finished_at" class="block mb-2 text-sm font-medium text-gray-900">Bitiş Tarihi</label>
                    <input type="datetime-local" id="finished_at" name="finished_at" value="{{ $quiz->finished_at }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="mb-6 px-2">
                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">Quiz Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot:jquery>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $("#isFinished").change(function () {
                if($(this).is(':checked')){
                    $("#finishTime").slideDown()
                }else{
                    $("#finishTime").slideUp()
                }
            });
        </script>
    </x-slot>
</x-app-layout>

