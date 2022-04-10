<x-app-layout>
    <main class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <h1 class="text-2xl text-gray-200">{{ __('network.networks') }}</h1>
                    <a href="{{ route('networks.create') }}">{{ __('shared.create') }}</a>
                </div>
                <section class="p-6 sm:px-20 dark:bg-gray-800 border-b border-gray-200 mt-5 rounded-lg text-white">
                    <form name="create_network" action="{{ route('networks.store') }}" method="POST">
                        @csrf
                        <section>
                            <label for="name">{{ __('shared.name') }}</label>
                            <input type="text" name="name" id="name" class="block w-full px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg" required>
                        </section>

                        <section>
                            <label for="description">{{ __('shared.description') }}</label>
                            <textarea name="description" id="description" class="block w-full px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg" required></textarea>
                        </section>

                        <section class="flex items-baseline">
                            <div class="flex flex-col w-1/2">
                                <label for="driver">{{ __('network.driver') }}</label>
                                <select name="driver" id="driver" class="block px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg" required>
                                    <option value="">{{ __('shared.select') }}</option>
                                    @foreach(Domain\Network\Enum\Driver::getCreatable() as $driver)
                                        <option value="{{ $driver->value }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <label for="scope">{{ __('network.scope') }}</label>
                                <select name="scope" id="scope" class="block px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg">
                                    <option value="">{{ __('shared.select') }}</option>
                                    @foreach(Domain\Network\Enum\Scope::all() as $scope)
                                        <option value="{{ $scope->value }}">{{ $scope->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </section>

                        <section class="flex items-baseline">
                            <div class="flex flex-col w-1/3">
                                <label for="gateway">{{ __('network.gateway') }}</label>
                                <input type="text" name="gateway" id="gateway" class="block px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg">
                            </div>
                            <div class="flex flex-col w-1/3 items-center">
                                <label for="attachable">{{ __('network.attachable') }}</label>
                                <input
                                    type="checkbox"
                                    name="attachable"
                                    id="attachable"
                                    class="block mt-3 px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg"
                                >
                            </div>
                            <div class="flex flex-col w-1/3 items-center">
                                <label for="ipv6">{{ __('network.ipv6') }}</label>
                                <input
                                    type="checkbox"
                                    name="ipv6"
                                    id="ipv6"
                                    class="block mt-3 px-4 py-2 leading-tight text-gray-200 bg-gray-900 border border-gray-900 rounded-lg"
                                >
                            </div>
                        </section>

{{--                        Now we are going to create a submit button --}}
                        <section class="flex justify-end mt-5">
                            <button type="submit" class="inline-block px-4 py-2 leading-tight text-white bg-gray-900 border border-gray-900 rounded-lg">
                                {{ __('shared.create') }}
                            </button>
                        </section>
                    </form>
                </section>
            </div>
        </div>
    </main>
</x-app-layout>
