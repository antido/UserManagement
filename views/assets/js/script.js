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

    // Confirmation on update
    $('#editForm').on('submit', function (e) {
        const confirmed = confirm('Are you sure you want to update this item?');

        if (!confirmed) {
            e.preventDefault();
        }
    });
});