// Reset Form Fields
$(document).ready( function () {
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
});