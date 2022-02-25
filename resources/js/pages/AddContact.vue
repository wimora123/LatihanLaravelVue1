<template>
    <div>
        <div class="container">
            <h2 class="text-center p-2 mt-5 bg-primary text-white">Add Contact</h2>

            <div class="card-body">
                <div class="col-md-6 offset-sm-3">
                    <form id="validateForm" @submit.prevent="saveContact" enctype="multipart/form-data" novalidate>

                    <div class="alert alert-danger" v-if="errors.length">
                        <ul class="mb-0">
                            <li v-for="(error,index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="contact.name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" v-model="contact.email" class="form-control">
                        </div>
                       <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" id="designation" v-model="contact.designation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bio">Biography</label>
                            <textarea id="bio" name="bio" cols="20" rows="10" v-model="contact.bio" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="number" id="contact_no" v-model="contact.contact_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="validateCustomFile" class="custom-file-control" v-on:change="saveImage">
                            <label class="custom-file-control">Choose file....</label>
                        </div>
                        <button class="btn btn-primary mt-4">Add Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default{
    data(){
        return{
            url:document.head.querySelector('meta[name="url"]').content,
            contact:{},
            name:'',
            email:'',
            bio:'',
            designation:'',
            contact_no:'',
            errors:[]
        }
    },
    methods:{
        saveContact(){
            this.errors=[];
            if(!this.contact.name){
                this.errors.push('Name is required');
            }
            if(!this.contact.email){
                this.errors.push('Email is required');
            }
            if(!this.contact.designation){
                this.errors.push('Designation is required');
            }
            if(!this.image){
                this.errors.push('Image is required');
            }
            if(!this.contact.contact_no){
                this.errors.push('Contact number is required');
            }
            if(!this.contact.bio){
                this.errors.push('Biography is required');
            }

            if(!this.errors.length){
                let formData = new FormData();

                // Kalau tidak, nanti pada saat insert, data yg kosong bisa-bisa nambah terus
                let instance=this;
                formData.append('name', instance.contact.name);
                formData.append('email', instance.contact.email);
                formData.append('image', instance.image);
                formData.append('designation', instance.contact.designation);
                formData.append('bio', instance.contact.bio);
                formData.append('contact_no', instance.contact.contact_no);

                let url=this.url + '/api/save_contact';

                this.axios.post(url, formData).then(function(response){
                    if(response.status){
                        // this.$utils.showSuccess('success', response.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil ditambah'
                        })

                        document.getElementById("name").value = '';
                        document.getElementById("email").value = '';
                        document.getElementById("designation").value = '';
                        document.getElementById("bio").value = '';
                        document.getElementById("contact_no").value = '';
                        document.getElementById("validateCustomFile").value = '';
                        // instance.$router.go();

                        // Nah, ada cara bagus, kosongkan setelah berhasil supaya data benar-benar kosong. Kalau tidak, bisa2 data yg diinput sebelumnya muncul walau kosong
                        instance.contact={};
                    }
                    else{
                        // this.$utils.showError('Error', response.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                }).catch((error)=>{
                    this.errors.push(error.response.data.error);
                    console.info(this.errors.push(error.response.data.error));
                });
            }
        }, saveImage(e){
            this.image = e.target.files[0];
            console.info(this.image);
        }
    },
    mounted:function()
    {
            console.info('Add contacts component loaded');
    }
}

</script>