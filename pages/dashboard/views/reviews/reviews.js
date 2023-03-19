const openDialogButton = document.getElementById("open-dialog");
const deleteReviewButton = document.getElementById("delete-review");
const cancelButton = document.getElementById("cancel");
const modal = document.getElementsByClassName("modal-delete-reviews")[0];

if (openDialogButton && deleteReviewButton && cancelButton && modal) {
  openDialogButton.addEventListener("click", () => {
    modal.classList.add("open");
    deleteReviewButton.value = openDialogButton.value;
  });

  cancelButton.addEventListener("click", () => {
    modal.classList.remove("open");
  });
}

const closeMessageButton = document.getElementById("close-message");
if (closeMessageButton) {
  closeMessageButton.addEventListener("click", () => {
    console.log("CLICK!");
    closeMessageButton.parentElement.style.display = "none";
  });
}
