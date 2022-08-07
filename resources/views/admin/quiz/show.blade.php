<x-app-layout>
    <x-slot:header>
            {{ $quiz->title }}
    </x-slot>
    <div class="flex justify-between mb-15" style="margin: 25px 0;">
        <div class="flex items-center w-1/3 ml-6">
            <ul class="w-full text-center mx-auto border border-gray-200 py-4 rounded-xl text-sm">
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
                <div class="overflow-x-auto relative sm:rounded-lg mb-5">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-sm text-gray-700 bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Adı ve Soyadı
                            </th>
                            <th scope="col" class="py-3 px-6 text-center">
                                Puan
                            </th>
                            <th scope="col" class="py-3 px-6 text-center">
                                Doğru
                            </th>
                            <th scope="col" class="py-3 px-6 text-center">
                                Yanlış
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz->results as $result)
                                <tr class="@if($loop->iteration % 2 == 1) bg-white @else bg-gray-50 @endif border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $result->user->name}}
                                    </th>
                                    <td class="py-4 px-6 text-center">
                                        {{ $result->point}}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{ $result->correct}}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{ $result->wrong}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
