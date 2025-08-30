document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.body.dataset.success;
    const errorMessage = document.body.dataset.error;

    if(successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'عملیات موفق',
            text: successMessage,
            confirmButtonColor: '#4f46e5'
        });
    }

    if(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'خطا',
            text: errorMessage,
            confirmButtonColor: '#dc2626'
        });
    }

    const logoutButton  = document.getElementById('logout-button');

    if(logoutButton) {
        logoutButton.addEventListener('click', function(e) {
            e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'آیا مطمئن هستید؟',
            text: 'با خروج حساب شما حذف خواهد شد',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'بله خارج شو',
            cancelButtonText: 'خیر',
        }).then((result) => {
            if (result.isConfirmed){
                document.getElementById('logout-form').submit();
            }
        });
    });
    }
});
