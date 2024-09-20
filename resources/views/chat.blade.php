<x-layouts>
    <main class="container flex pt-20">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <section class=" h-screen flex flex-col justify-evenly relative w-full lg:w-[80%]">
            <div class="flex">
                <div class="w-full px-4">
                    <h1 class="text-base font-semibold text-primary md:text-xl lg:text-2xl mb-3">Puskesmas Wara</h1>
                    <p class="block font-medium text-dark tracking-tighter text-4xl lg:text-5xl mb-10">Apa yang bisa saya <span class=" text-primary">bantu?</span></p>
                </div>
                <div class="lg:hidden">
                    <button class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class=" flex flex-col">
                {{-- card kata kunci start--}}
                <div class=" flex justify-center flex-wrap gap-2 xl:w-10/12 xl:mx-auto">
                    <div class=" relative w-96 mb-2 h-16 py-3 px-4 rounded-xl border border-secondary hover:border-primary group">
                        <p class=" font-semibold text-sm text-dark">Masalah Kesehatan</p>
                        <p class=" text-xs text-secondary">Menghadapi masalah kesehatan?</p>
                    </div>
                    <div class=" relative w-96 mb-2 h-16 py-3 px-4 rounded-xl border border-secondary hover:border-primary group">
                        <p class=" font-semibold text-sm text-dark">Nutrisi</p>
                        <p class=" text-xs text-secondary">Mencoba mencari nutrisi terbaik!</p>
                    </div>
                    <div class=" relative w-96 mb-2 h-16 py-3 px-4 rounded-xl border border-secondary hover:border-primary group">
                        <p class=" font-semibold text-sm text-dark">Herbal</p>
                        <p class=" text-xs text-secondary">Solusi warisan nenek moyang</p>
                    </div>
                    <div class=" relative w-96 mb-2 h-16 py-3 px-4 rounded-xl border border-secondary hover:border-primary group">
                        <p class=" font-semibold text-sm text-dark">P3k</p>
                        <p class=" text-xs text-secondary">Penaganan pertama dengan mudah</p>
                    </div>
                </div>
                {{-- card kata kunci end--}}
                <div id="answer" class="mx-auto px-2 mb-2 output">
                        <article class="prose lg:prose-base font-medium text-dark text-justify leading-7 tracking-tight">
                            <x-markdown>
                                <p id="response-container">
                                </p>
                            </x-markdown>
                        </article>
                </div>
                <div class="w-full px-4 xl:w-[78%] xl:mx-auto">
                    <form id="data-form"  action="/chat">
                        <div class="relative">
                            <button onclick="sendMessage()" type="submit" class=" absolute right-[5%] top-4">
                                <svg class="w-6 h-6 text-gray-800 dark:text-slate-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                </svg>
                            </button>
                            <input
                                    type="text"
                                    autofocus
                                    id="search"
                                    required;
                                    name="message"
                                    type="search"
                                    placeholder="Masukkan keluhan anda..."
                                    autocomplete="off"
                                    class="w-full h-14 bg-light text-dark p-3 rounded-md focus:outline-none focus:border-primary border border-primary" />
                                    <div id="results" class="text-dark hidden p-3 absolute bg-light shadow-md w-[96%] rounded-md mt-2 ring-primary"></div>
                        </div>
                    </form>
                </div>
                    <p class="text-xs text-secondary mt-8 pb-14 text-center">Jawaban yang anda dapat mungkin tidak sesui, cek kembali jawaban anda!!</p>
            </div>
        </section>
        <aside>
            <div id="drawer-navigation" class="md:hidden fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-slate-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
                <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close menu</span>
                </button>
                <div class="py-4 overflow-y-auto">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <button onclick="resendSelectedMessages()" type="submit" class="text-white w-3/4 h-12 mb-3 bg-slate-900 px-3 rounded-xl flex items-center gap-4 hover:bg-slate-700">
                                <img src="../../asset/icons/plus.svg" alt="" class=" w-6">
                                Kirim Ulang
                            </button>
                            </a>
                        </li>
                        <li>
                            <button onclick="deleteSelectedMessages()" class=" text-white w-3/4 h-12 mb-3 bg-slate-900 px-3 rounded-xl flex items-center gap-4 hover:bg-slate-700">
                                <img src="../../asset/icons/delete.svg" alt="" class=" w-6">
                                Hapus Riwayat
                            </button>
                        </li>
                        <li>
                            <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Riwayat</h5>
                        </li>
                        <li>
                            <div class="pt-6 overflow-y-auto scrollbar-hide no-scrollbar">
                                <ul id="chat-history" class="max-h-96">
                                    <li class="mb-2">
                                        <input type="checkbox" id="history" name="history" class="hidden peer"/>
                                        <label for="history" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="w-full block ml-2 truncate">Periksa kembali jawaban anda</p>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="aside-lg" class="lg:block sm:hidden w-[20%] right-0 h-screen bg-light px-5 shadow-lg text-light fixed">
                <button onclick="resendSelectedMessages()" type="submit" class=" w-3/4 h-12 mb-3 bg-dark px-3 rounded-xl flex items-center gap-4 hover:bg-primary">
                    <img src="../../asset/icons/plus.svg" alt="" class=" w-6">
                    Kirim Ulang
                </button>
                <button onclick="deleteSelectedMessages()" class=" w-3/4 h-12 bg-dark px-3 rounded-xl flex items-center gap-4 hover:bg-primary text-light">
                    <img src="../../asset/icons/delete.svg" alt="" class=" w-6">
                    Hapus Riwayat
                </button>
                <section class=" pt-7">
                    <h5 class=" px-3 text-dark font-semibold">Terbaru</h5>
                    <div class="pt-6 overflow-y-auto scrollbar-hide no-scrollbar">
                        <ul id="chat-history" class="max-h-96">
                            <li class="mb-2">
                                <input type="checkbox" id="history" name="history" class="hidden peer"/>
                                <label for="history" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="w-full block ml-2 truncate">Periksa kembali jawaban anda</p>
                                </label>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </aside>

        <script src="../../js/gemini.js"></script> 
        <script src="../../js/keywords.js"></script> 
    </main>
</x-layouts>
<script>
    function checkScreenSize() {
    const asideLg = document.getElementById('aside-lg');
    const asideSm = document.getElementById('drawer-navigation');

    // Mendapatkan lebar jendela
    if (window.innerWidth >= 1024) {
        asideLg.style.display = 'block';
        asideSm.style.display = 'none';
    } else {
        asideLg.style.display = 'none';
        asideSm.style.display = 'block';
    }
}

// Jalankan fungsi saat halaman diload dan saat ukuran layar berubah
window.addEventListener('load', checkScreenSize);
window.addEventListener('resize', checkScreenSize);
</script>
