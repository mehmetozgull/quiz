<x-app-layout>
    <x-slot:header>
            {{ $quiz->title }}
    </x-slot>
    <div class="flex justify-between mb-15" style="margin: 25px 0;">
        <div class="flex items-center w-1/3 ml-6">
            <ul class="w-full text-center mx-auto border border-gray-200 py-4 rounded-xl text-sm">
                @if ($quiz->my_rank)
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class="font-semibold px-2.5 py-0.5 rounded">Sıralama</div>
                    <span class="bg-green-600 text-white rounded-lg p-2 py-0.5">{{ $quiz->my_rank }}</span>
                </li>
                @endif
                @if ($quiz->my_result)
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class="font-semibold px-2.5 py-0.5 rounded">Puan</div>
                    <span class="bg-blue-600 text-white rounded-lg p-2 py-0.5">{{ $quiz->my_result->point }}</span>
                </li>
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class="font-semibold px-2.5 py-0.5 rounded">Doğru / Yanlış Sayısı</div>
                    <div class="self-center">
                        <span class="bg-green-600 text-white rounded-lg p-2 py-0.5">{{ $quiz->my_result->correct }} Doğru</span>
                        <span class="bg-red-600 text-white rounded-lg p-2 py-0.5">{{ $quiz->my_result->wrong }} Yanlış</span>
                    </div>

                </li>
                @endif
                @if ($quiz->finished_at)
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class="font-semibold px-2.5 py-0.5 rounded">Son Katılım Tarihi</div>
                    <span class="bg-gray-200 rounded-lg p-2 py-0.5">{{ $quiz->finished_at->diffForHumans() }}</span>
                </li>
                @endif
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class="font-semibold px-2.5 py-0.5 rounded">Soru Sayısı</div>
                    <span class="bg-gray-200 rounded-lg p-2 py-0.5">{{ $quiz->questions_count }}</span>
                </li>
                @if ($quiz->details)
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class=" font-semibold mr-2 px-2.5 py-0.5 rounded">Katılımcı Sayısı</div>
                    <span class="bg-yellow-500 text-white rounded-lg p-2 py-0.5">{{ $quiz->details['join_count'] }}</span>
                </li>
                <li class="text-gray-600 font-semibold mr-2 px-2.5 py-0.5 rounded flex justify-between">
                    <div class=" font-semibold mr-2 px-2.5 py-0.5 rounded">Ortalama Puan</div>
                    <span class="bg-yellow-500 text-white rounded-lg p-2 py-0.5">{{ $quiz->details['average'] }}</span>
                </li>
                @endif
            </ul>
        </div>

        <div class="flex items-center w-2/3">
            <div class="p-6 rounded-xl border-gray-200 border ml-2 mr-4 ">
                <p class="mb-3 font-normal text-gray-700">{{ $quiz->description }}</p>
                @if ($quiz->my_result)
                <a href="{{ route('quiz.join', $quiz->slug) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    Quiz'i Görüntüle
                    <i class="fa-solid fa-check ml-2"></i>
                </a>
                @elseif ($quiz->finished_at > now())
                <a href="{{ route('quiz.join', $quiz->slug) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Quiz'e Katıl
                    <i class="fa-solid fa-arrow-right-to-bracket ml-2"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
    @if (count($quiz->topTen) > 0)
    <div class="flex justify-between mb-15" style="margin: 25px 0;">
        <div class="flex items-center w-1/3 ml-6">
            <ul class="w-full text-center mx-auto border border-gray-200 py-4 rounded-xl text-sm">
                <span class="text-xl">İlk 10</span>
                @foreach ($quiz->topTen as $result)
                <li class="text-gray-600 font-semibold my-3 mr-2 px-2.5 py-0.5 rounded flex items-center justify-between">
                    <div>
                        <strong class="mr-2">{{ $loop->iteration }}.</strong>
                        <img src="{{ asset($result->user->profile_photo_path) }}" class="rounded-full inline-block w-12" alt="">
                        <div class="font-semibold px-2.5 py-0.5 rounded inline-block @if (auth()->user()->id == $result->user_id) text-red underline @endif">{{ $result->user->name }}</div>
                    </div>
                    <div class="bg-green-600 text-white rounded-lg p-2 py-0.5">{{ $result->point }}</div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</x-app-layout>
