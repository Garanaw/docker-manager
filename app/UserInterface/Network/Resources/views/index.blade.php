<x-app-layout>
    <main class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <h1 class="text-2xl text-gray-200">{{ __('network.networks') }}</h1>
                    <a href="{{ route('networks.create') }}">{{ __('shared.create') }}</a>
                </div>
                <section class="p-6 sm:px-20 dark:bg-gray-800 border-b border-gray-200 mt-5 rounded-lg">
                    @foreach($networks as $network)
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                                    {{ $network->name }}
                                </h3>
                                <p class="mt-1 text-sm leading-5 text-gray-500 dark:text-gray-400">
                                    {{ $network->description }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('networks.show', $network->id) }}" class="text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 dark:text-gray-100">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </main>
</x-app-layout>
