export function  useSwalSuccess(message) {
    Swal.fire({
        toast: true,
        icon: 'success',
        title: message,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
    })
}

export function  useSwalError(message) {
    Swal.fire({
        toast: true,
        icon: 'error',
        title: message,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
    })
}