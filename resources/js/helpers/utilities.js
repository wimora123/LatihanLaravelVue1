// import { swal } from "vue/types/umd"

export default{
    showSuccess(title, message){
        swal.fire(
            title,
            message,
            'success'
        )
    },

    showError(title,message){
       swal.fire({
            type:'',
            title:title,
            text:message,
       })
    }
}