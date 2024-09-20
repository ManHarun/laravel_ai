let chatHistory = JSON.parse(localStorage.getItem("chatHistory")) || [];

async function getRespons() {
    try {
        const inputElement = document.getElementById("search");
        const message = inputElement.value;
        if (message === "") {
            alert("Input tidak boleh kosog!!");
            return;
        }
        const params = new URLSearchParams();
        params.append("message", message);
        const data = params.toString();
        console.log(message);
        const url = "http://puskesmas.test/chat?" + data;
        const response = await fetch(url, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });
        const dataResponse = await response.json();
        console.log("Success:", dataResponse);
        marked.use({
            pedantic: false,
            gfm: true,
        });
        let textMark = marked.parse(dataResponse);
        clearMessage();
        messageDisplay = document.getElementById("response-container");
        messageDisplay.innerHTML = textMark;
    } catch (error) {
        console.error("Error:", error);
    }
}
document
    .getElementById("data-form")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form standar

        const inputElement = document.getElementById("search");
        const message = inputElement.value;
        clearMessage();
        displayGeneratingMessage();

        if (message) {
            const url = new URL(window.location);
            url.searchParams.set("search", message);
            window.history.pushState({}, "", url); // Memperbarui URL tanpa memuat ulang halaman
        }
        sendMessage();
        getRespons();
        inputElement.value = "";
    });

function sendMessage() {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get("search");
    if (message && !chatHistory.includes(message)) {
        chatHistory.push(message);
        localStorage.setItem("chatHistory", JSON.stringify(chatHistory)); // Menyimpan ke localStorage
        displayChatHistory();
    }
}

function displayGeneratingMessage() {
    const messageDisplay = document.getElementById("response-container");
    messageDisplay.textContent = "Generating...";
}

function clearMessage() {
    const messageDisplay = document.getElementById("response-container");
    messageDisplay.textContent = "";
}

function displayMessage(data) {
    messageDisplay = document.getElementById("response-container");
    messageDisplay.innerHTML = text;
}

function displayChatHistory() {
    const chatHistoryContainer = document.getElementById("chat-history");
    chatHistoryContainer.innerHTML = "";

    chatHistory.forEach((message, index) => {
        const messageElement = document.createElement("li");
        messageElement.className = "mb-2";

        const checkbox = document.createElement("input");
        checkbox.className = "hidden peer";
        checkbox.type = "checkbox";
        checkbox.id = `checkbox-${index}`;
        checkbox.name = `checkbox-${index}`;
        checkbox.value = index;

        const label = document.createElement("label");
        label.htmlfor = `checkbox-${index}`;
        label.className =
            "inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700";

        // Add an event listener to the checkbox
        label.addEventListener("click", function () {
            const checkbox = document.getElementById(`checkbox-${index}`);
            checkbox.checked = !checkbox.checked;
        });

        const svg = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "svg"
        );
        svg.setAttribute("class", "w-6 h-6");
        svg.setAttribute("aria-hidden", "true");
        svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
        svg.setAttribute("fill", "currentColor");
        svg.setAttribute("viewBox", "0 0 24 24");

        const path = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "path"
        );
        path.setAttribute("fill-rule", "evenodd");
        path.setAttribute(
            "d",
            "M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
        );
        path.setAttribute("clip-rule", "evenodd");

        svg.appendChild(path);

        const pesan = document.createElement("p");
        pesan.className = "w-full block ml-2 truncate";
        pesan.id = `pesan-${index}`;
        pesan.textContent = `${message}`;

        label.prepend(pesan);
        label.prepend(svg);
        messageElement.prepend(label);
        messageElement.prepend(checkbox);
        chatHistoryContainer.appendChild(messageElement);
    });
}

function deleteSelectedMessages() {
    const checkboxes = document.querySelectorAll(
        '#chat-history input[type="checkbox"]:checked'
    );
    if (checkboxes.length === 0) {
        alert("Silakan pilih riwayat yang akan dihapus.");
        return;
    }
    const indicesToRemove = Array.from(checkboxes).map((checkbox) =>
        parseInt(checkbox.value)
    );
    chatHistory = chatHistory.filter(
        (_, index) => !indicesToRemove.includes(index)
    );
    localStorage.setItem("chatHistory", JSON.stringify(chatHistory)); // Menyimpan perubahan ke localStorage
    displayChatHistory();
}

async function resendSelectedMessages() {
    try {
        const checkboxes = document.querySelectorAll(
            '#chat-history input[type="checkbox"]:checked'
        );
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const messagesToResend = Array.from(checkboxes).map((checkbox) => {
            const index = parseInt(checkbox.value);
            const messageElement = document.getElementById(`pesan-${index}`);
            const message = messageElement.textContent;
            return message;
        });
        if (checkboxes.length === 0) {
            alert("Silakan pilih riwayat yang akan dikirim ulang.");
            return;
        }
        if (messagesToResend.length === 1) {
            displayGeneratingMessage();
        }
        if (messagesToResend.length > 1) {
            alert("Silakan pilih hanya satu data untuk dikirimkan.");
            return;
        }
        // Data yang akan dikirimkan dalam request
        const params = new URLSearchParams();
        messagesToResend.forEach((message) => {
            params.append("message", message);
        });
        const data = params.toString();
        console.log(data);
        const url = "http://puskesmas.test/chat?" + data;
        const response = await fetch(url, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });
        const dataResponse = await response.json();
        console.log("Success:", dataResponse);
        marked.use({
            pedantic: false,
            gfm: true,
        });
        let textMark = marked.parse(dataResponse);
        clearMessage();
        messageDisplay = document.getElementById("response-container");
        messageDisplay.innerHTML = textMark;
    } catch (error) {
        console.error("Error:", error);
    }
}
// Panggil displayChatHistory saat halaman dimuat untuk menampilkan riwayat yang disimpan
displayChatHistory();
