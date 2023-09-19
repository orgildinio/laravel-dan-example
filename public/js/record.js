const startButton = document.getElementById("startRecording");
const stopButton = document.getElementById("stopRecording");
const audioPlayer = document.getElementById("audioPlayer");
const uploadButton = document.getElementById("uploadAudio");

let mediaRecorder;
let audioChunks = [];

startButton.addEventListener("click", async () => {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    mediaRecorder = new MediaRecorder(stream);

    mediaRecorder.ondataavailable = (event) => {
        if (event.data.size > 0) {
            audioChunks.push(event.data);
        }
    };

    mediaRecorder.onstop = () => {
        const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
        const audioUrl = URL.createObjectURL(audioBlob);
        audioPlayer.src = audioUrl;
        uploadButton.classList.remove("hidden");
    };

    mediaRecorder.start();
    startButton.classList.add("hidden");
    stopButton.classList.remove("hidden");
});

stopButton.addEventListener("click", () => {
    mediaRecorder.stop();
    startButton.classList.remove("hidden");
    stopButton.classList.add("hidden");
});

uploadButton.addEventListener("click", async () => {
    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });

    const formData = new FormData();
    formData.append("audio", audioBlob, "recording.wav");

    try {
        const response = await fetch("/complaint", {
            method: "POST",
            body: formData,
        });

        if (response.ok) {
            alert("Audio uploaded successfully.");
        } else {
            alert("Failed to upload audio.");
        }
    } catch (error) {
        console.error("Error:", error);
    }
});
