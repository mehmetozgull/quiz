<x-app-layout>
    <x-slot name="header">{{ $quiz->title }} Quizine ait sorular</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex justify-between">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">
                <a href="{{ route("quizzes.index") }}" class="py-3 px-2.5 mr-2 mb-2 text-sm font-medium text-white hover:text-gray-900 focus:outline-none bg-gray-500 rounded-lg border border-gray-200 hover:bg-gray-300 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Quizlere Dön
                </a>
            </h5>
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">
                <a href="{{ route("questions.create", $quiz->id) }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
                    <i class="fa-solid fa-plus mr-1"></i> Soru Oluştur
                </a>
            </h5>
        </div>
        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <table class="w-full text-sm text-left text-gray-500 table-sm">
                <thead class="text-sm text-gray-700 bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Soru
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Fotoğraf
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        1. Cevap
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        2. Cevap
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        3. Cevap
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        4. Cevap
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Doğru Cevap
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        İşlemler
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($quiz->questions as $question)
                        <tr class="@if($loop->iteration % 2 == 1) bg-white @else bg-gray-50 @endif border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                {{ $question->question }}
                            </th>
                            <td class="py-4 px-6 text-center" style="">
                                @if ($question->image)
                                <a href="{{ asset($question->image) }}" target="_blank" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-2">Görüntüle</a>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                {{ $question->answer1 }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                {{ $question->answer2 }}
                            </td>
                            <td class="py-4 px-6 text-center ">
                                {{ $question->answer3 }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                {{ $question->answer4 }}
                            </td>
                            <td class="py-4 px-6 text-center text-green-400">
                                {{ Str::substr($question->correct_answer, -1) }}. Cevap
                            </td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <a href="{{ route('questions.edit', [$question->quiz_id, $question->id]) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3.5 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
