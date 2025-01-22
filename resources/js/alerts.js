document.addEventListener("DOMContentLoaded", () => {
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.classList.add("opacity-0", "transition", "duration-300");
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
