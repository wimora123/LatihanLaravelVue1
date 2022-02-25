<template>
    <div class="container">
        <h2 class="text-center p-2 text-white bg-primary mt-5">Contact List</h2>

        <table class="table">
           <thead>
               <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Biography</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="1">Action</th>
               </tr>
           </thead>
           <tbody v-for="contact in contacts" :key="contact.id">
               <tr>
                   <td scope="row">{{ contact.id }}</td>
                   <td scope="row">{{ contact.name }}</td>
                   <td scope="row">{{ contact.email }}</td>
                   <td scope="row">{{ contact.bio }}</td>
                   <td scope="row">{{ contact.designation }}</td>
                   <td scope="row">{{ contact.contact_no }}</td>
                    <td scope="row">  <img :src="`${url+'/'+contact.image}`" class="img-responsive" alt="image" width="100" height="70"></td>
                   <td scope="row"><button class="btn btn-danger" @click.prevent="deleteContact(contact.id)">Delete</button>
                   <router-link :to="{ name:'get_contact', params: {id: contact.id} }"  class="btn btn-success">Edit</router-link>
                   </td>
               </tr>
           </tbody>
        </table>
    </div>
</template>

<script>
export default{
    name:'ContactList',
    created(){
        this.loadData();
    },
    methods:{
        loadData(){
            let url=this.url+'/api/getContacts';
            this.axios.get(url).then((response)=>{
                this.contacts = response.data;
                console.info(this.contacts);
            })
        },
        deleteContact(id){
            let url = this.url+`/api/delete_contact/${id}`;
            this.axios.delete(url).then((response)=>{
                if(response.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data berhasil dihapus'
                    })
                    this.loadData();
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    })
                }
            })
        }
    },
    mounted(){
        console.info('Contact list mounted');
    },
    data(){
        return{
            url: document.head.querySelector('meta[name="url"]').content,
            contacts:[]
        }
    }
    
    
}

</script>

<style scoped>

</style>