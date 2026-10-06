import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

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