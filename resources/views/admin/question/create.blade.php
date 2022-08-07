<x-app-layout>
    <x-slot:header>{{ $quiz->title }} için yeni bir soru oluştur</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">

        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <form action="{{ route('questions.store', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6 px-2 mt-4">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900">Soru</label>
                    <textarea id="question" name="question" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('question') }}</textarea>
                </div>
                <div class="mb-6 px-2 mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Fotoğraf</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer  focus:outline-none" >
                </div>
                <div class="flex mb-6 px-2 mt-4">
                    <div class="w-1/2 mr-2">
                        <label for="answer1" class="block mb-2 text-sm font-medium text-gray-900">1. Cevap</label>
                        <textarea id="answer1" name="answer1" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('answer1') }}</textarea>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label for="answer2" class="block mb-2 text-sm font-medium text-gray-900">2. Cevap</label>
                        <textarea id="answer2" name="answer2" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('answer2') }}</textarea>
                    </div>
                  </div>
                  <div class="flex mb-6 px-2 mt-4">
                    <div class="w-1/2 mr-2">
                        <label for="answer3" class="block mb-2 text-sm font-medium text-gray-900">3. Cevap</label>
                        <textarea id="answer3" name="answer3" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('answer3') }}</textarea>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label for="answer4" class="block mb-2 text-sm font-medium text-gray-900">4. Cevap</label>
                        <textarea id="answer4" name="answer4" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('answer4') }}</textarea>
                    </div>
                  </div>
                <div class="mb-6 px-2 mt-4">
                    <label for="correct_answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Doğru Cevap</label>
                    <select id="correct_answer" name="correct_answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required>
                    <option @selected(old('correct_answer') == 'answer1') value="answer1">1. Cevap</option>
                    <option @selected(old('correct_answer') == 'answer2') value="answer2">2. Cevap</option>
                    <option @selected(old('correct_answer') == 'answer3') value="answer3">3. Cevap</option>
                    <option @selected(old('correct_answer') == 'answer4') value="answer4">4. Cevap</option>
                    </select>
                </div>
                <div class="mb-6 px-2">
                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">Gönder</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

