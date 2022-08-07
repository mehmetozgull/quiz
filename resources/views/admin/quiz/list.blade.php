<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex justify-between">
                <div class="w-3/4">
                    <form method="GET" action="">
                        <div class="mb-6 px-2 w-1/4 inline-block">
                            <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ request()->get('title') }}" placeholder="Quiz Başlığı">
                        </div>
                        <div class="mb-6 px-2 w-1/4 inline-block">
                            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " onchange="this.form.submit()">
                            <option value="">Durumu Seçiniz</option>
                            <option @selected(request()->get('status') == 'publish') value="publish">Yayında</option>
                            <option @selected(request()->get('status')== 'draft') value="draft">Taslak</option>
                            <option @selected(request()->get('status') == 'passive') value="passive">Pasif</option>
                            </select>
                        </div>
                        @if (request()->get('title') || request()->get('status'))
                        <a href="{{ route("quizzes.index") }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">Sıfırla</a>
                        @endif
                    </form>
                </div>
                <div class="w-1/4 mb-6 px-2 text-end self-center">
                    <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">
                        <a href="{{ route("quizzes.create") }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
                            <i class="fa-solid fa-plus mr-1"></i> Quiz Oluştur
                        </a>
                    </h5>
                </div>
        </div>
        <div class="overflow-x-auto relative sm:rounded-lg mb-5">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-sm text-gray-700 bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Quiz
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Soru Sayısı
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Durum
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Bitiş Tarihi
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
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
                            <td class="py-4 px-6 text-center">
                                {{ $quiz->questions_count }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @switch($quiz->status)
                                    @case('publish')
                                    @if (!$quiz->finished_at)
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Yayında</span>
                                    @elseif ($quiz->finished_at > now())
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Yayında</span>
                                    @else
                                    <span class="bg-gray-200 text-gray-900 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Süresi Dolmuş</span>
                                    @endif
                                    @break
                                    @case('draft')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Taslak</span>
                                    @break
                                    @case('passive')
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Pasif</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span title="{{ $quiz->finished_at }}">{{ $quiz->finished_at ? $quiz->finished_at->diffForhumans() : '-' }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('quizzes.details', $quiz->id) }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-info"></i></a>
                                <a href="{{ route('questions.index', $quiz->id) }}" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-question"></i></a>
                                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3.5 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('quizzes.destroy', $quiz->id) }}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
        </div>
        {{ $quizzes->withQueryString()->links() }}
    </div>
</x-app-layout>
