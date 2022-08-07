<x-app-layout>
    <x-slot:header>{{ $question->question }} Düzenle</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">

        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <form action="{{ route('questions.update', [$question->quiz_id, $question->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf @method("PUT")
                <div class="mb-6 px-2 mt-4">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900">Soru</label>
                    <textarea id="question" name="question" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ $question->question }}</textarea>
                </div>
                <div class="mb-6 px-2 mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Fotoğraf</label>
                    @if ($question->image)
                    <div id="question_image">
                        <img class="w-3/4 mb-2" src="{{ asset($question->image) }}">
                        <button type="button" id="remove-photo" quiz-id={{ $question->quiz_id }} question-id={{ $question->id }} class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-4 block w-1/6">Fotoğrafı Kaldır</button>
                    </div>
                    @endif
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer  focus:outline-none" >
                </div>
                <div class="flex mb-6 px-2 mt-4">
                    <div class="w-1/2 mr-2">
                        <label for="answer1" class="block mb-2 text-sm font-medium text-gray-900">1. Cevap</label>
                        <textarea id="answer1" name="answer1" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ $question->answer1 }}</textarea>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label for="answer2" class="block mb-2 text-sm font-medium text-gray-900">2. Cevap</label>
                        <textarea id="answer2" name="answer2" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ $question->answer2 }}</textarea>
                    </div>
                  </div>
                  <div class="flex mb-6 px-2 mt-4">
                    <div class="w-1/2 mr-2">
                        <label for="answer3" class="block mb-2 text-sm font-medium text-gray-900">3. Cevap</label>
                        <textarea id="answer3" name="answer3" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ $question->answer3 }}</textarea>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label for="answer4" class="block mb-2 text-sm font-medium text-gray-900">4. Cevap</label>
                        <textarea id="answer4" name="answer4" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ $question->answer4 }}</textarea>
                    </div>
                  </div>
                <div class="mb-6 px-2 mt-4">
                    <label for="correct_answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Doğru Cevap</label>
                    <select id="correct_answer" name="correct_answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required>
                    <option @selected($question->correct_answer == 'answer1') value="answer1">1. Cevap</option>
                    <option @selected($question->correct_answer == 'answer2') value="answer2">2. Cevap</option>
                    <option @selected($question->correct_answer == 'answer3') value="answer3">3. Cevap</option>
                    <option @selected($question->correct_answer == 'answer4') value="answer4">4. Cevap</option>
                    </select>
                </div>
                <div class="mb-6 px-2">
                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">Gönder</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot:jquery>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $("#remove-photo").click(function () {
                let quiz_id = $(this).attr("quiz-id")
                let question_id = $(this).attr("question-id")
                $.ajax({
                    type: 'post',
                    url: '{{ route('questions.removePhoto') }}',
                    data: {quiz_id:quiz_id, question_id:question_id, _token:'{{ csrf_token() }}'},
                    success:function (data) {
                        $('#question_image').hide("slow").remove()
                    },
                    error: function (request, status, error) {
                        console.log("HATA!");
                    }
                })
            });
        </script>
    </x-slot>
</x-app-layout>

