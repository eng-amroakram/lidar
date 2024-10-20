function createMeeting() {
    // Get the form values
    const meetingName = document.getElementById("meeting-name").value;
    const meetingDate = document.getElementById("meeting-date").value;
    const meetingTime = document.getElementById("meeting-time").value;
    const participants = document.getElementById("participants").value;

    // Validate form inputs
    if (!meetingName || !meetingDate || !meetingTime || !participants) {
        alert("Please fill out all fields.");
        return;
    }

    // Send data to the backend to create the meeting
    const data = {
        meetingName: meetingName,
        meetingDate: meetingDate,
        meetingTime: meetingTime,
        participants: participants,
    };

    fetch("create_meeting.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((result) => {
            if (result.success) {
                document.getElementById("success-message").style.display =
                    "block";
                // Reload past meetings list
                loadPastMeetings();
            } else {
                alert("Error creating meeting: " + result.error);
            }
        });
}

function loadPastMeetings() {
    fetch("get_past_meetings.php")
        .then((response) => response.json())
        .then((meetings) => {
            const meetingsList = document.getElementById("meetingsList");
            meetingsList.innerHTML = ""; // Clear existing list
            meetings.forEach((meeting) => {
                const listItem = document.createElement("li");
                listItem.textContent = `${meeting.name} - ${meeting.date}`;
                meetingsList.appendChild(listItem);
            });
        });
}

// Load past meetings on page load
document.addEventListener("DOMContentLoaded", loadPastMeetings);
