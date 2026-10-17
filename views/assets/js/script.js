$(document).ready( function () {
    // Reset Form Fields
    $('#resetBtn').on('click', function () {
        const form = $(this).closest('form');

        form.find('input').each(function () {
            const input = $(this);
            const type = input.attr('type');

            if (type === 'radio' || type === 'checkbox') {
                input.prop('checked', false);
            } else if (type !== 'submit' && type !== 'button') {
                input.val('');
            }
        });
    });

    // Delete item
    $('.delete-item').on('click', function (e) {
        e.preventDefault();

        // Prevent deletion if the button is disabled
        if ($(this).hasClass('disabled')) {
            return false;
        }

        const deleteUrl = $(this).attr('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    });

    // Update item
    $(document).on('submit', 'form.update-item', function (e) {
        e.preventDefault();

        const form = this;

        // Prevent duplicate confirmation dialogs
        if (form.dataset.confirmed === 'true') {
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update this item?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.dataset.confirmed = 'true';

                const submitButton = form.querySelector('button[type="submit"][name="edit"]');

                if (submitButton) {
                    const hiddenEdit = document.createElement('input');
                    hiddenEdit.type = 'hidden';
                    hiddenEdit.name = submitButton.name;
                    hiddenEdit.value = submitButton.value;
                    form.appendChild(hiddenEdit);
                }

                form.submit();
            }
        });
    });
});