<x-dashboardmain>
  <div class="w-3/5 p-4 sm:ml-64">
    <div class="p-4 mt-14">
      <h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-2xl dark:text-gray-900">Create new Post</h3>
      <form method="POST" action="/dashboard/posts">
        @csrf
        <div class="mb-5">
          <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-900">Title</label>
          <input value="{{ old('title') }}" type="text" id="title" name="title" autofocus class="@error('title') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="mb-5">
          <label for="slug" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-900">Slug</label>
          <input value="{{ old('slug') }}" type="text" id="slug" name="slug" class="@error('slug') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div>
          <label for="content" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-900">Content</label>
          <textarea value="{{ old('content') }}" required name="content" class="@error('content') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="editor"></textarea>
        </div>
        <button type="submit" class="mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Post</button>
      </form>
    </div>
  </div>

  <script>
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    title.addEventListener('change', function(){
      fetch('/dashboard/posts/checkSlug?title=' + title.value, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrfToken
        },
      })
      .then((response) => response.json())
        .then((data) => {
            slug.value = data;
            console.log(slug.value);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
    });
    
  </script>


<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    const quill = new Quill('#editor', {
      modules: {
      history: {
        delay: 2000,
        maxStack: 500,
        userOnly: true
      },
    },
      theme: 'snow'
    });
</script>

</x-dashboardmain>