<x-layouts>
    <main id="about" class="container pt-20">
        <h1 class="block font-bold mb-4 text-dark text-4xl lg:text-5xl mt-5 sm:text-3xl sm:text-center">Puskesmas Wara</h1>
        
        <!-- Bagian Flex yang Responsif -->
        <div class="flex flex-col lg:flex-row items-center lg:items-start lg:justify-between">
            
            <!-- Gambar Responsif -->
            <div class="lg:w-1/2 flex items-center justify-center pt-5 mx-8 mr-8 lg:mb-0">
                <img
                    src="../../asset/img/profil/home.jpg"
                    alt=""
                    width="300"
                    height="300"
                    class="max-w-full mx-auto sm:w-64 lg:w-auto" />
            </div>

            <!-- Konten Post -->
            <div class="lg:w-1/2">
                @foreach ($posts as $post)
                    <article class="prose mt-4 mb-10 lg:prose-base text-justify sm:text-sm">
                        <h2 class="mt-5 font-medium text-secondary text-lg mb-5 lg:text-2xl sm:text-xl">
                            {{ $post['title'] }}
                        </h2>
                        <p class="font-medium text-secondary mb-10 leading-relaxed">
                            {{ $post['content'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </main>
    
    <footer>
        <x-footer></x-footer>
    </footer>
</x-layouts>
