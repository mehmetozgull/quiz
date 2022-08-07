<x-app-layout>
    <x-slot name="header">
            {{ __('Ana sayfa') }}
    </x-slot>
    <div class="flex justify-between">
        <div class="w-3/5">
            @foreach ($quizzes as $quiz)
            <div class="flex flex-col bg-white border rounded-xl m-5 ">
                <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 ">
                    {{ $quiz->title }}
                </h3>
                <p class="mt-2 text-gray-800 ">
                    {{ Str::limit($quiz->description, 120) }}
                </p>
                <p class="mt-1 font-bold text-xs text-gray-600 ">
                    {{ $quiz->questions_count }} Soru
                </p>
                <a href="{{ route('quiz.detail', $quiz->slug) }}" class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-blue-500 hover:text-blue-700">
                    Card link
                    <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>
                </div>
                <div class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 ">
                <p class="mt-1 text-sm text-gray-500 ">
                    {{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() . ' bitiyor' : 'Bitiş Süresi Yok' }}
                </p>
                </div>
            </div>
            @endforeach
            <div class="bg-white">
                {{ $quizzes->links() }}
            </div>
        </div>
        <div class="w-2/5 m-5">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5">
                  <p class="mt-1 text-sm text-gray-500 ">
                    Quiz Sonuçları
                  </p>
                </div>
                @foreach ($results as $result)
                <div class="p-4 md:p-4">
                    <h3 class="text-md text-gray-800">
                        <strong>{{ $result->point }}</strong> -
                      <a href="{{ route('quiz.detail', $result->quiz->slug) }}" class="text-blue-500 hover:underline hover:text-blue-600">{{ $result->quiz->title }}</a>
                    </h3>
                  </div>
                @endforeach
              </div>
        </div>
</x-app-layout>
