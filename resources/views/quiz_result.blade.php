<x-app-layout>
    <x-slot:header>
            {{ $quiz->title }} Quiz'i Sonucu
    </x-slot>
    <div class="p-5">
        <h2 class="font-bold">Puan: {{ $quiz->my_result->point}}</h2>
    </div>
    <div class="bg-gray-50 text-sm text-gray-600 rounded-md p-5 " role="alert">

        <div class="mb-2">
            <i class="fa-solid fa-circle"></i> <span class="font-bold">İşaretlediğin Şık</span>
        </div>
        <div class="mb-2">
            <i class="fa-solid fa-check text-green-600"></i> <span class="font-bold">Doğru Cevap</span>
        </div>
        <div>
            <i class="fa-solid fa-times text-red-600"></i> <span class="font-bold">Yanlış Cevap</span>
        </div>
      </div>
    @foreach ($quiz->questions as $question)
    <div class="px-5 py-5">
        @if ($question->image)
        <div>
            <img src="{{ asset($question->image) }}" alt="{{ $question->question }}" class="rounded-3xl w-1/2">
        </div>
        @endif
        <div class="mt-3">
            @if ($question->correct_answer == $question->my_answer->answer)
            <i class="fa-solid fa-check text-green-600"></i>
            @else
            <i class="fa-solid fa-times text-red-600"></i>
            @endif
            <strong>{{ $loop->iteration }}. </strong>{{ $question->question }}
        </div>
        <div class="flex flex-col mb-5">
            <div class="flex items-center mt-2 mb-2">
                @if ('answer1' == $question->correct_answer)
                    <i class="fa-solid fa-check text-green-600"></i>
                @elseif ('answer1' == $question->my_answer->answer)
                    <i class="fa-solid fa-circle"></i>
                @endif
                <label for="quiz{{ $question->id }}1" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer1 }}</label>
            </div>
            <div class="flex items-center">
                @if ('answer2' == $question->correct_answer)
                    <i class="fa-solid fa-check text-green-600"></i>
                @elseif ('answer2' == $question->my_answer->answer)
                    <i class="fa-solid fa-circle"></i>
                @endif
                <label for="{{ $question->id }}2" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer2 }}</label>
            </div>
            <div class="flex items-center mt-2 mb-2">
                @if ('answer3' == $question->correct_answer)
                    <i class="fa-solid fa-check text-green-600"></i>
                @elseif ('answer3' == $question->my_answer->answer)
                    <i class="fa-solid fa-circle"></i>
                @endif
                <label for="quiz{{ $question->id }}3" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer3 }}</label>
            </div>
            <div class="flex items-center mb-2">
                @if ('answer4' == $question->correct_answer)
                    <i class="fa-solid fa-check text-green-600"></i>
                @elseif ('answer4' == $question->my_answer->answer)
                    <i class="fa-solid fa-circle"></i>
                @endif
                <label for="{{ $question->id }}4" class="ml-2 text-sm font-medium text-gray-900 ">{{ $question->answer4 }}</label>
            </div>
            <small class="text-gray-500">Bu soruya <strong>%{{ $question->true_percent }}</strong> oranında doğru cevap verilmiştir.</small>
        </div>
        <hr>
    </div>
    @endforeach
</x-app-layout>
