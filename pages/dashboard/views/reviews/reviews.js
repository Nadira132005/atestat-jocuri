const deleteReviewButton = document.getElementById("delete-review");
const cancelButton = document.getElementById("cancel");
const modal = document.getElementsByClassName("modal-delete-reviews")[0];

const openDialogButtons = Array.from(
  document.getElementsByClassName("open-dialog")
);

if (openDialogButtons.length && deleteReviewButton && cancelButton && modal) {
  openDialogButtons.forEach((button) =>
    button.addEventListener("click", () => {
      modal.classList.add("open");
      deleteReviewButton.value = button.value;
    })
  );

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
