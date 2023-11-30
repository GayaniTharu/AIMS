function copyToClipboard() {
    // Get the result element by class name
    var resultElement = document.querySelector(".result");

    // Create a temporary input element to hold the text to be copied
    var tempInput = document.createElement("input");
    tempInput.value = resultElement.textContent;
    document.body.appendChild(tempInput);

    // Select the text in the input element
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices

    // Copy the selected text to the clipboard
    document.execCommand("copy");

    // Remove the temporary input element
    document.body.removeChild(tempInput);

    // Provide visual feedback to the user (e.g., change the icon color)
    var copyIcon = document.querySelector(".copy-icon");
    copyIcon.innerText = "✅"; // Change the icon to a checkmark
    copyIcon.style.color = "green"; // Change the icon color to green
}
