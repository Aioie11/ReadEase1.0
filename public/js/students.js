document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("readingLanguagesBtn");
    const dropdownContainer = toggleBtn.closest(".dropdown-container");

    toggleBtn.addEventListener("click", function (e) {
        e.preventDefault(); // Prevent the # link from jumping
        dropdownContainer.classList.toggle("show");
    });

    // Close the dropdown if clicking outside
    document.addEventListener("click", function (event) {
        if (!dropdownContainer.contains(event.target)) {
            dropdownContainer.classList.remove("show");
        }
    });
}); 