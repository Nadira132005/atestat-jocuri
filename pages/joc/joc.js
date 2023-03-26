const deleteReviewButton = document.getElementById("delete-review");
const cancelButton = document.getElementById("cancel");
const dialogWindow = document.getElementsByClassName(
  "dialog-delete-reviews"
)[0];

const openDialogButtons = Array.from(
  document.getElementsByClassName("open-dialog")
);

if (
  openDialogButtons.length &&
  deleteReviewButton &&
  cancelButton &&
  dialogWindow
) {
  openDialogButtons.forEach((button) =>
    button.addEventListener("click", () => {
      dialogWindow.classList.add("open");
      deleteReviewButton.value = button.value;
    })
  );

  cancelButton.addEventListener("click", () => {
    dialogWindow.classList.remove("open");
  });
}

const closeMessageButton = document.getElementById("close-message");
if (closeMessageButton) {
  closeMessageButton.addEventListener("click", () => {
    const message = closeMessageButton.parentElement;
    // To close the message we delete it
    message.remove();
  });
}
