// Tab switching code
const detectingSummaryTab = document.getElementById("detecting-summary-tab");
const recordingAttemptTab = document.getElementById("recording-attempt-tab");
const detectingSummaryContent = document.getElementById(
    "detecting-summary-content"
);
const recordingAttemptContent = document.getElementById(
    "recording-attempt-content"
);

detectingSummaryTab.addEventListener("click", () => {
    detectingSummaryTab.classList.add("active");
    recordingAttemptTab.classList.remove("active");
    detectingSummaryContent.classList.remove("hide");
    recordingAttemptContent.classList.add("hide");
});

recordingAttemptTab.addEventListener("click", () => {
    recordingAttemptTab.classList.add("active");
    detectingSummaryTab.classList.remove("active");
    recordingAttemptContent.classList.remove("hide");
    detectingSummaryContent.classList.add("hide");
});

// Bar and Circular Chart Initialization
const barCtx = document.getElementById("barChart").getContext("2d");
const barChart = new Chart(barCtx, {
    type: "bar",
    data: {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
        datasets: [
            {
                label: "Detecting Summary for October",
                data: [10, 15, 8, 12],
                backgroundColor: "rgba(75, 192, 192, 0.6)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: "Detecting Count" },
            },
            x: { title: { display: true, text: "Weeks" } },
        },
    },
});

const circularCtx = document.getElementById("circularChart").getContext("2d");
const circularChart = new Chart(circularCtx, {
    type: "doughnut",
    data: {
        labels: ["Detected", "Not Detected"],
        datasets: [
            {
                data: [60, 40],
                backgroundColor: [
                    "rgba(54, 162, 235, 0.7)",
                    "rgba(255, 99, 132, 0.7)",
                ],
                borderColor: ["rgba(54, 162, 235, 1)", "rgba(255, 99, 132, 1)"],
                borderWidth: 1,
            },
        ],
    },
    options: { responsive: true, plugins: { legend: { position: "top" } } },
});
