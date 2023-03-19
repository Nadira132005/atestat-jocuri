const closeMessageButton = document.getElementById("close-message");
if (closeMessageButton) {
  closeMessageButton.addEventListener("click", () => {
    console.log("CLICK!");
    closeMessageButton.parentElement.style.display = "none";
  });
}
