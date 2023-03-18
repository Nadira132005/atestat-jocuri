const body = document.querySelector("body");
const openDialogButton = document.getElementById("open-dialog");
const deleteReviewButton = document.getElementById("delete-review");
const cancelButton = document.getElementById("cancel");
const modal = document.getElementsByClassName("modal-delete-reviews")[0];

let reviewIdToDelete = null;

cancelButton.addEventListener("click", () => {
  modal.classList.remove("open");
});

openDialogButton.addEventListener("click", () => {
  modal.classList.add("open");
  deleteReviewButton.value = openDialogButton.value;
});
