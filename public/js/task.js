// Handle toaster
function showToast(message, type) {
    let toast = $("<div>").addClass("toast").hide().text(message);

    if (type === "add") {
        toast.addClass("toast-add");
    } else if (type === "update") {
        toast.addClass("toast-update");
    } else if (type === "delete") {
        toast.addClass("toast-delete");
    }

    $("#toast-container").prepend(toast);
    toast.fadeIn(300);

    setTimeout(function () {
        toast.fadeOut(300, function () {
            $(this).remove();
        });
    }, 4000);
}

    // Handle show modal
    window.confirmDelete = function (taskId) {
        let modal = $("#deleteModal");
        $("#deleteForm").attr("action", `/tasks/${taskId}`);
        modal.removeClass("hidden");
        setTimeout(function () {
            modal.addClass("opacity-100");
            modal.children().first().addClass("scale-100");
        }, 10);
    };

    // Handle close modal
    window.closeModal = function () {
        let modal = $("#deleteModal");
        modal.removeClass("opacity-100");
        modal.children().first().removeClass("scale-100");

        setTimeout(function () {
            modal.addClass("hidden");
        }, 300);
    };

$(document).ready(function () {
    // Handle task list loading
    let taskList = $("#taskList");
    let loadingIndicator = $("#loadingIndicator");
    let noDataMessage = $("#noDataMessage");

    if (taskList.length && loadingIndicator.length && noDataMessage.length) {
        loadingIndicator.removeClass("hidden");
        taskList.addClass("hidden");
        noDataMessage.addClass("hidden");

        setTimeout(function () {
            loadingIndicator.addClass("hidden");

            if (taskList.children().length > 0) {
                taskList.removeClass("hidden");
            } else {
                noDataMessage.removeClass("hidden");
            }
        }, 1000);
    }

    // Handle toggle status (AJAX)
    $(document).on("click", ".toggle-status-button", function () {
        let button = $(this);
        if (button.prop("disabled")) return;

        button.prop("disabled", true);
        let taskId = button.data("task-id");

        $.ajax({
            url: `/tasks/${taskId}/toggle-status`,
            type: "PATCH",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data.success) {
                    showToast("Status updated successfully!", "update");

                    let newStatus = data.status ? "Completed ✅" : "Pending ❌";
                    let newStatusClass = data.status
                        ? "text-[#00D26A]"
                        : "text-[#F92F60]";
                    let newButtonText = data.status
                        ? "Mark as Pending"
                        : "Mark as Completed";
                    let newButtonClass = data.status
                        ? "bg-red-500 hover:bg-red-600"
                        : "bg-green-500 hover:bg-green-600";

                    $("#status-text-" + taskId)
                        .text(newStatus)
                        .attr("class", newStatusClass);
                    button
                        .text(newButtonText)
                        .attr(
                            "class",
                            `toggle-status-button mt-2 px-4 py-2 rounded text-white text-sm w-full ${newButtonClass}`
                        );
                } else {
                    alert("Failed to update task status.");
                }
            },
            error: function () {
                alert("An error occurred while updating the task status.");
            },
            complete: function () {
                button.prop("disabled", false);
            },
        });
    });

    // Handle delete task (AJAX)
    $("#deleteForm").on("submit", function (e) {
        e.preventDefault();

        let deleteForm = $(this);
        let taskId = deleteForm.attr("action").split("/").pop();
        let csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `/tasks/${taskId}`,
            type: "DELETE",
            headers: { "X-CSRF-TOKEN": csrfToken },
            success: function (data) {
                if (data.success) {
                    showToast("Task deleted successfully!", "delete");

                    setTimeout(function () {
                        $("#task-" + taskId).remove();
                    }, 1000);

                    closeModal();
                } else {
                    alert("Failed to delete the task.");
                }
            },
            error: function () {
                alert("An error occurred while deleting the task.");
            },
        });
    });
});
