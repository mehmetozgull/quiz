<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
        <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">
            <a href="{{ route("quizzes.create") }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
                <i class="fa-solid fa-plus mr-1"></i> Quiz Oluştur
            </a>
        </h5>
        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-sm text-gray-700 bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Quiz
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Durum
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Bitiş Tarihi
                    </th>
                    <th scope="col" class="py-3 px-6">
                        İşlemler
                    </th>
                </tr>
                </thead>
                <tbody>
                @isset($quizzes)
                    @foreach($quizzes as $quiz)
                        <tr class="@if($loop->iteration % 2 == 1) bg-white @else bg-gray-50 @endif border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $quiz->title }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $quiz->status }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $quiz->finished_at }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3.5 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('quizzes.destroy', $quiz->id) }}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-3.5 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
        </div>
        {{ $quizzes->links() }}
    </div>
</x-app-layout>
