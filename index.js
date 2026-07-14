// Client-side checks so the user gets feedback before a round trip.
// The server in index.php re-validates everything, since this can be bypassed.
const form = document.querySelector("form");

form.addEventListener("submit", (event) => {
    const name = document.getElementById("name").value.trim();
    const age = document.getElementById("age").value.trim();
    const email = document.getElementById("email").value.trim();

    const problems = [];

    if (name === "") {
        problems.push("Please enter your name.");
    }
    if (!/^\d+$/.test(age) || Number(age) < 1 || Number(age) > 120) {
        problems.push("Please enter an age between 1 and 120.");
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        problems.push("Please enter a valid email address.");
    }

    if (problems.length > 0) {
        event.preventDefault();
        showErrors(problems);
    }
});

function showErrors(problems) {
    document.querySelectorAll(".submitmsg.client").forEach((el) => el.remove());

    problems.forEach((text) => {
        const p = document.createElement("p");
        p.className = "submitmsg client";
        p.textContent = text;
        form.parentNode.insertBefore(p, form);
    });
}
