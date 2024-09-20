// Pilih elemen sidebar dan tombol toggle
const sidebar = document.querySelector(".sidebar-menu");
const toggleButton = document.querySelector(".sidebar-toggle");

// Tambahkan event listener pada tombol toggle
toggleButton.addEventListener("click", () => {
    // Tambahkan atau hapus class 'hidden' pada sidebar
    sidebar.classList.toggle("hidden");
    sidebar.classList.toggle("mian");
});
