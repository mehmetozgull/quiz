<x-app-layout>
    <x-slot:header>
            {{ $quiz->title }}
    </x-slot>
    <form method="post" action="{{ route('quiz.result', $quiz->slug) }}">
        @csrf
        @foreach ($quiz->questions as $question)
        <div class="px-5 py-5">

            @if ($question->image)
            <div>
                <img src="{{ asset($question->image) }}" alt="{{ $question->question }}" class="rounded-3xl w-1/2">
            </div>
            @endif
            <div class="mt-3">
                <strong>{{ $loop->iteration }}. </strong>{{ $question->question }}
            </div>
            <div class="flex flex-col mb-5">
                <div class="flex items-center mt-2 mb-2">
                    <input id="quiz{{ $question->id }}1" type="radio" value="answer1" name="{{ $question->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                    <label for="quiz{{ $question->id }}1" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer1 }}</label>
                </div>
                <div class="flex items-center">
                    <input id="{{ $question->id }}2" type="radio" value="answer2" name="{{ $question->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                    <label for="{{ $question->id }}2" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer2 }}</label>
                </div>
                <div class="flex items-center mt-2 mb-2">
                    <input id="quiz{{ $question->id }}3" type="radio" value="answer3" name="{{ $question->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                    <label for="quiz{{ $question->id }}3" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer3 }}</label>
                </div>
                <div class="flex items-center">
                    <input id="{{ $question->id }}4" type="radio" value="answer4" name="{{ $question->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                    <label for="{{ $question->id }}4" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer4 }}</label>
                </div>
            </div>
            <hr>
        </div>
        @endforeach
        <div class="text-center px-5 pb-5">
            <button href="{{ route('quiz.join', $quiz->slug) }}" class="items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg w-full hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                Quiz'i Bitir
                <i class="fa-solid fa-check ml-2"></i>
            </button>
        </div>
    </form>

</x-app-layout>
