<x-app-layout>
    <main class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <h1 class="text-2xl text-gray-200">{{ __('network.networks') }}</h1>
                    <a href="{{ route('networks.create') }}">{{ __('shared.create') }}</a>
                </div>
                <section class="p-6 sm:px-20 dark:bg-gray-800 border-b border-gray-200 mt-5 rounded-lg">
                    @dump($network)
                </section>
            </div>
        </div>
    </main>
</x-app-layout>
