const copyButton = document.getElementById("copy-button");
const copyLinkBtn = document.getElementById("copy-link-btn");
const meetingLink = document.getElementById("meeting-link");

copyButton.addEventListener("click", function () {
    navigator.clipboard.writeText(meetingLink.value);
    alert("Meeting link copied!");
});

copyLinkBtn.addEventListener("click", function () {
    navigator.clipboard.writeText(meetingLink.value);
    alert("Meeting link copied!");
});
