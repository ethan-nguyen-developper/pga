import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

export function useSwalSuccess(message) {
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

export function useSwalError(message) {
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

export function useSwalConfirm(message, callback) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            callback()
        }
    })
}