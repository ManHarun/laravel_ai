const searchInput = document.getElementById("search");
const searchResults = document.getElementById("results");

// Simpan tinggi awal searchInput
const originalHeight = searchInput.clientHeight;

// Fungsi untuk menampilkan hasil pencarian
function displayResults(results) {
    searchResults.innerHTML = results
        .map(
            (result) =>
                `<div role="button" class="result-item">${result.keyword}</div>`
        )
        .join("");
    searchResults.classList.remove("hidden");

    // Tambahkan kelas untuk styling tambahan
    searchInput.classList.add("search-input-active");
    searchResults.classList.add("search-results-active");

    searchInput.style.height = "56px";

    const resultItems = searchResults.querySelectorAll(".result-item");
    resultItems.forEach((item) => {
        item.addEventListener("click", (event) => {
            const selectedResult = event.target.textContent;
            searchInput.value = selectedResult;
            hideResults();
        });
    });
}

// Fungsi untuk menyembunyikan hasil pencarian dan mengembalikan tinggi input
function hideResults() {
    searchResults.classList.add("hidden");
    searchInput.classList.remove("search-input-active");
    searchResults.classList.remove("search-results-active");

    searchInput.style.height = `${originalHeight}px`;
}

//melakukan request
let allData = []; // Array untuk menyimpan data dari server
// Request untuk mengambil semua data saat halaman dimuat
window.onload = function () {
    fetch("/chat/keywords", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            allData = data;
            console.log(allData);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
};
// Event listener untuk input
searchInput.addEventListener("keyup", (event) => {
    const searchTerm = event.target.value.toLowerCase();
    if (searchTerm === "") {
        hideResults();
        return;
    }
    const results = allData.filter((data) => {
        return data.keyword.toLowerCase().startsWith(searchTerm);
    });
    if (results.length > 0) {
        displayResults(results);
    } else {
        hideResults();
    }
});
