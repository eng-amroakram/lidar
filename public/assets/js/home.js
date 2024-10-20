// Tab switching functionality
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
