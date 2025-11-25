// MOBILE MENU
const menuButton = document.getElementById("menu-button");
const navLinks = document.querySelector(".nav-links");

menuButton.addEventListener("click", () => {
    navLinks.classList.toggle("open");
    const isOpen = navLinks.classList.contains("open");
    menuButton.innerHTML = isOpen ? "✕" : "☰";
});

const form = document.getElementById("contact-form");
const messageDiv = document.getElementById("form-message");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const msg = document.getElementById("message").value.trim();
    if (name === "" || email === "" || msg === "") {
        messageDiv.textContent = "Bruh… fill all the fields ";
        messageDiv.style.color = "red";
        return;
    }
    messageDiv.textContent = "Your message has been sent";
    messageDiv.style.color = "green";
    form.reset();
});

// SCROLL REVEAL
const sections = document.querySelectorAll("section");
window.addEventListener("scroll", () => {
    const trigger = window.innerHeight * 0.8;
    sections.forEach(sec => {
        const top = sec.getBoundingClientRect().top;
        if (top < trigger) sec.classList.add("show");
    });
});

const heroContent = document.querySelector(".hero-content");
window.addEventListener("scroll", () => {
    let offset = window.scrollY * 0.2;
    heroContent.style.transform = `translateY(${offset}px)`;
});
