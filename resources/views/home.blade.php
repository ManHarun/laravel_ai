<x-layouts>
    <main class="container pt-20 mb-28">
        <div class="w-full px-4 mb-20 text-center">
            <h1 class="text-base font-semibold text-primary md:text-xl lg:text-2xl mb-3">Puskesmas Wara</h1>
            <p class="block font-medium text-dark tracking-tighter text-4xl lg:text-5xl mb-5 sm:text-2xl">Teman <span class="text-primary">ahli kesehatan</span></p>
            <p class="block font-medium text-dark tracking-tighter text-4xl lg:text-5xl mb-10 sm:text-2xl">Mendukung hingga 24/7</p>
            <a href="chat" class="text-base font-semibold text-light bg-dark py-3 px-10 rounded-2xl hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out sm:text-sm sm:px-5 sm:py-2">Chat to AI</a>
            <p class="text-xs text-primary mt-6">Ini adalah AI Kesehatan gratis yang tersedia di Website Puskesmas Wara kota Palopo</p>
        </div>

        <!-- Bagian Flex -->
        <div class="flex mt-16 sm:flex-col sm:items-center sm:mt-8">
            <div>
                <h1 class="text-base font-semibold text-primary md:text-xl lg:text-2xl sm:text-xl">
                    Selamat Datang di Website Kami
                    <span class="block font-bold text-dark text-4xl lg:text-5xl my-5 sm:text-3xl">Puskesmas Wara</span>
                </h1>
                <div>
                    @foreach ($posts as $post)
                        <article class="prose sm:prose-sm">
                            <h2 class="font-medium text-secondary text-lg mt-3 mb-5 lg:text-2xl sm:text-xl">
                                {{ $post['title'] }}
                            </h2>
                            <p class="font-medium text-secondary mb-10 leading-relaxed sm:mb-5">
                                {{ Str::limit($post['content'], 100) }}
                            </p>
                        </article>
                    @endforeach
                    <a href="about" class="mt-4 text-base font-semibold text-light bg-primary py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out sm:text-sm sm:px-5 sm:py-2">Selengkapnya</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</x-layouts>
